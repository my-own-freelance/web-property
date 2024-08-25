<?php

namespace App\Http\Controllers\FrontPage;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\District;
use App\Models\Property;
use App\Models\PropertyCertificate;
use App\Models\PropertyTransaction;
use App\Models\PropertyType;
use App\Models\Province;
use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index()
    {
        $title = "Situs Jual Beli Property Terbaik";

        $types = PropertyType::all();
        $transactions = PropertyTransaction::all();
        $certificates = PropertyCertificate::all();

        $popularProperties = Property::with("PropertyTransaction")
            ->with("PropertyType")
            ->with('PropertyType')
            ->with('District')
            ->with('SubDistrict')
            ->with('Agen')
            ->orderBy("views", "desc")
            ->limit(8)
            ->where("is_publish", "Y")
            ->where("admin_approval", "APPROVED")
            ->where("is_available", "Y")
            ->get()
            ->transform(function ($property) {
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
                    'image' => url("/") . Storage::url($property->image),
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

        $propertiesByTrx = PropertyTransaction::with(['Properties' => function ($query) {
            $query->orderBy("id", "desc")
                ->limit(8)
                ->where("is_publish", "Y")
                ->where("admin_approval", "APPROVED")
                ->where("is_available", "Y")
                ->with('PropertyType')
                ->with('Province')
                ->with('District')
                ->with('SubDistrict')
                ->with('Agen');
        }])
            ->get()
            ->filter(function ($propByTrx) {
                // Filter out transactions that have no properties
                return $propByTrx->properties->isNotEmpty();
            })
            ->transform(function ($propByTrx) {
                return (object) [
                    "transaction" => $propByTrx->name,
                    "data" => $propByTrx->properties->map(function ($property) {
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
                    }),
                ];
            });

        // dd($propertiesByTrx);
        $topDistricts = DB::table('districts')
            ->leftJoin('properties', 'districts.id', '=', 'properties.district_id')
            ->select('districts.id', 'districts.name', DB::raw('COUNT(properties.id) as total_property'))
            ->groupBy('districts.id', 'districts.name')
            ->orderBy('total_property', 'desc')
            ->limit(6)
            ->get()
            ->map(function ($district) {
                return (object) [
                    'id' => $district->id,
                    'name' => $district->name,
                    'total_property' => $district->total_property,
                    'url' => '#'
                ];
            });

        $reviews = Review::orderBy("id", "desc")->limit(6)->get()->map(function ($review) {
            return (object) [
                'id' => $review->id,
                'name' => $review->name,
                'address' => $review->address,
                'review' => $review->review,
                'image' => url("/") . Storage::url($review->image),
            ];
        });

        $articles = Article::orderBy("id", "desc")->limit(3)->where("is_publish", "Y")->get()->map(function ($article) {
            return (object)[
                'id' => $article->id,
                'code' => $article->code,
                'title' => $article->title,
                'excerpt' => $article->excerpt,
                'image' => url("/") . Storage::url($article->image),
                'views' => $article->views,
                'url' => url('/') . '/cari-artikel/view/' . $article['code'] . '/' . $article['slug'],
                'date' => Carbon::parse($article->created_at)->format('d F, Y'),
            ];
        });

        $provinces = Province::all();
        // dd($propertiesByTrx);
        return view("pages.frontpage.index", compact("title", "types", "transactions", "certificates", "propertiesByTrx", "popularProperties", "topDistricts", "reviews", "articles", "provinces"));
    }
}
