<?php

namespace App\Http\Controllers\FrontPage;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Property;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeAgenController extends Controller
{
    public function list(Request $request)
    {
        $title = 'List Agen';
        $query = User::withCount(['Properties' => function ($query) {
            $query->where('is_available', 'Y')
                ->where('is_publish', 'Y')
                ->where('admin_approval', 'APPROVED');
        }])
            ->where('role', 'agen')
            ->where("is_active", "Y");


        if ($request->query("search") && $request->query("search") != "") {
            $searchValue = $request->query("search");
            $query->where(function ($query) use ($searchValue) {
                $query->where('name', 'like', '%' . $searchValue . '%')
                    ->orWhere('username', 'like', '%' . $searchValue . '%')
                    ->orWhere('email', 'like', '%' . $searchValue . '%')
                    ->orWhere('code', 'like', '%' . $searchValue . '%')
                    ->orWhere('phone_number', 'like', '%' . $searchValue . '%');
            });
        }

        // filter province
        if ($request->query("province_id") && $request->query('province_id') != "") {
            $query->where('province_id', $request->query('province_id'));
        }

        // filter district
        if ($request->query("district_id") && $request->query('district_id') != "") {
            $query->where('district_id', $request->query('district_id'));
        }

        // filter sub district
        if ($request->query("sub_district_id") && $request->query('sub_district_id') != "") {
            $query->where('sub_district_id', $request->query('sub_district_id'));
        }

        $agens = $query->orderBy('id', 'desc')
            ->paginate(8)
            ->appends($request->query())
            ->through(function ($agen) {
                $whatsapp = 'https://api.whatsapp.com/send/?phone='
                    . preg_replace('/^08/', '628', $agen->phone_number)
                    . '&text='
                    . 'Halo, saya melihat profile anda di '  . url('/')  . '/cari-agen/view/' . $agen->code
                    . ' dan tertarik untuk membahas lebih lanjut mengenai properti yang Anda tawarkan.'
                    . '%0A%0ABisakah Anda memberikan informasi lebih lanjut tentang property-properti yang tersedia? Terima kasih.';

                return (object)[
                    'id' => $agen->id,
                    'code' => $agen->code,
                    'name' => $agen->name,
                    'username' => $agen->username,
                    'email' => $agen->email,
                    'phone_number' => $agen->phone_number,
                    'position' => $agen->position,
                    'image' => $agen->image ? url("/") . Storage::url($agen->image) : asset('dashboard/img/jm_denis.jpg'),
                    'link_property' => url('/') . '/list-properti?agen_code=' . $agen->code,
                    'total_property' => $agen->properties_count,
                    'whatsapp' => $whatsapp,
                    'url' => url('/') . '/cari-agen/view/' . $agen->code
                ];
            });

        $recentProperties = Property::where("is_publish", "Y")
            ->where("admin_approval", "APPROVED")
            ->where("is_available", "Y")
            ->orderBy('id', 'desc')
            ->limit(3)
            ->get()
            ->map(function ($property) {

                return (object) [
                    'id' => $property->id,
                    'image' =>  url("/") . Storage::url($property->image),
                    'url' => url('/') . '/cari-properti/view/' . $property['code'] . '/' . $property['slug'],
                    'short_title' => $property->short_title,
                    'price' => $property->price,
                ];
            });

        $recentArticles = Article::orderBy("id", "desc")
            ->limit(3)
            ->where("is_publish", "Y")
            ->get()
            ->map(function ($article) {
                return (object)[
                    'id' => $article->id,
                    'title' => $article->title,
                    'image' => url("/") . Storage::url($article->image),
                    'url' => url('/') . '/cari-artikel/view/' . $article['code'] . '/' . $article['slug'],
                    'date' => Carbon::parse($article->created_at)->format('d F, Y'),
                ];
            });

        return view("pages.frontpage.list-agen", compact("title", "agens", "recentProperties", "recentArticles"));
    }

    public function detail($code)
    {
        $agen = User::with(['Properties' => function ($query) {
            $query->where('is_available', 'Y')
                ->where('is_publish', 'Y')
                ->where('admin_approval', 'APPROVED');
        }])
            ->where("code", $code)
            ->where("role", "agen")
            ->withCount(['Properties' => function ($query) {
                $query->where('is_available', 'Y')
                    ->where('is_publish', 'Y')
                    ->where('admin_approval', 'APPROVED');
            }])
            ->first();

        $agen['image'] = $agen->image ? url("/") . Storage::url($agen->image) : asset('dashboard/img/jm_denis.jpg');
        $agen['link_property'] =  url('/') . '/list-properti?agen_code=' . $agen->code;
        $agen['whatsapp'] = 'https://api.whatsapp.com/send/?phone='
            . preg_replace('/^08/', '628', $agen->phone_number)
            . '&text='
            . 'Halo, saya melihat profile anda di '  . url('/')
            . ' dan tertarik untuk membahas lebih lanjut mengenai properti yang Anda tawarkan.'
            . '%0A%0ABisakah Anda memberikan informasi lebih lanjut tentang property-properti yang tersedia? Terima kasih.';

        $recenAgenProperty = Property::with([
            'PropertyTransaction',
            'PropertyType',
            'PropertyImages',
            'Province',
            'District',
            'SubDistrict',
            'Agen',
        ])
            ->limit(8)
            ->where("is_publish", "Y")
            ->where("admin_approval", "APPROVED")
            ->where("is_available", "Y")
            ->where("agen_id", $agen->id)
            ->get()
            ->map(function ($property) {
                $district = $property->District ? $property->District->name : "";
                $subDistrict = $property->SubDistrict ? $property->SubDistrict->name : "";
                $location = $subDistrict . ', ' . $district;
                $whatsapp = 'https://api.whatsapp.com/send/?phone='
                    . preg_replace('/^08/', '628', $property->Agen->phone_number)
                    . '&text='
                    . 'Halo, saya ingin menanyakan info/data mengenai properti ini : %0A%0A'
                    . url('/') . '/cari-properti/view/'
                    . $property['code']
                    . '/'
                    . $property['slug']
                    . '%0A%0AApakah masih ada? Apa ada update terbaru? %0A%0ATerima kasih';

                return (object) [
                    'id' => $property->id,
                    'type' => $property->PropertyType ? $property->PropertyType->name : null,
                    'transaction' => $property->PropertyTransaction ? $property->PropertyTransaction->name : null,
                    'image' =>  url("/") . Storage::url($property->image),
                    'url' => url('/') . '/cari-properti/view/' . $property['code'] . '/' . $property['slug'],
                    'youtube' => $property->youtube_code && $property->youtube_code != "" ? ("https://www.youtube.com/watch?v=" . $property->youtube_code) : null,
                    'short_title' => $property->short_title,
                    'price' => $property->price,
                    'location' => $location,
                    'bedrooms' => $property->bedrooms,
                    'bathrooms' => $property->bathrooms,
                    'land_sale_area' => $property->land_sale_area,
                    'building_sale_area' => $property->building_sale_area,
                    'agen' => $property->Agen->name,
                    'agen_image' => url("/") . Storage::url($property->Agen->image),
                    'whatsapp' => $whatsapp,
                ];
            });

        $title = "Detail Agen - " . $agen->name;
        $recentProperties = Property::where("is_publish", "Y")
            ->where("admin_approval", "APPROVED")
            ->where("is_available", "Y")
            ->orderBy('id', 'desc')
            ->limit(3)
            ->get()
            ->map(function ($property) {

                return (object) [
                    'id' => $property->id,
                    'image' =>  url("/") . Storage::url($property->image),
                    'url' => url('/') . '/cari-properti/view/' . $property['code'] . '/' . $property['slug'],
                    'short_title' => $property->short_title,
                    'price' => $property->price,
                ];
            });

        $recentArticles = Article::orderBy("id", "desc")
            ->limit(3)
            ->where("is_publish", "Y")
            ->get()
            ->map(function ($article) {
                return (object)[
                    'id' => $article->id,
                    'title' => $article->title,
                    'image' => url("/") . Storage::url($article->image),
                    'url' => url('/') . '/cari-artikel/view/' . $article['code'] . '/' . $article['slug'],
                    'date' => Carbon::parse($article->created_at)->format('d F, Y'),
                ];
            });

        return view("pages.frontpage.detail-agen", compact("title", "agen", "recenAgenProperty", "recentProperties", "recentArticles"));
    }
}
