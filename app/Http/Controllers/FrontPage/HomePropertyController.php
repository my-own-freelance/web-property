<?php

namespace App\Http\Controllers\FrontPage;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomePropertyController extends Controller
{
    public function list(Request $request)
    {
        $title = 'List Properti';
        $query = Property::with("PropertyTransaction")
            ->with("PropertyType")
            ->with('PropertyType')
            ->with('District')
            ->with('SubDistrict')
            ->with('Agen')
            ->orderBy("id", "desc")
            ->limit(8)
            ->where("is_publish", "Y")
            ->where("admin_approval", "APPROVED")
            ->where("is_available", "Y");

        // filter search
        if ($request->query("search") && $request->query('search') != "") {
            $query->where('short_title', 'like', '%' . $request->query('search') . '%')
                ->Orwhere('long_title', 'like', '%' . $request->query('search') . '%')
                ->Orwhere('code', 'like', '%' . $request->query('search') . '%');
        }

        // filter properti transaction
        if ($request->query("trx_id") && $request->query('trx_id') != "") {
            $query->where('property_transaction_id', $request->query('trx_id'));
        }

        // filter property type
        if ($request->query("type_id") && $request->query('type_id') != "") {
            $query->where('property_type_id', $request->query('type_id'));
        }

        // filter property certificate
        if ($request->query("crt_id") && $request->query('crt_id') != "") {
            $query->where('property_certificate_id', $request->query('crt_id'));
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

        // filter bedrooms
        if ($request->query("bedrooms") && $request->query('bedrooms') != "") {
            $query->where('bedrooms', $request->query('bedrooms'));
        }

        // filter bathrooms
        if ($request->query("bathrooms") && $request->query('bathrooms') != "") {
            $query->where('bathrooms', $request->query('bathrooms'));
        }

        $properties = $query->paginate(9)->appends($request->query())->through(function ($property) {
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

        return view('pages.frontpage.list-properti', compact('title', 'properties'));
    }

    public function detail($code, $slug)
    {
        $property = Property::with([
            'PropertyTransaction',
            'PropertyType',
            'PropertyImages',
            'Province',
            'District',
            'SubDistrict',
            'Agen.SubDistrict', // Load relasi SubDistrict pada Agen
            'Agen.District',    // Load relasi District pada Agen
        ])
            ->where("is_publish", "Y")
            ->where("admin_approval", "APPROVED")
            // ->where("is_available", "Y") // kalau detail boleh menampilkan yg available nya sudah no
            ->where("code", $code)
            ->where("slug", $slug)
            ->first();

        if (!$property) {
            return abort(404);
        }

        $property->image = url("/") . Storage::url($property->image);

        if ($property->Agen && $property->Agen->image) {
            $property->Agen->image = url('/') . Storage::url($property->Agen->image);
        }

        foreach ($property->PropertyImages as $image) {
            $image->image = url('/') . Storage::url($image->image);
        }

        // tambahkan gambar utama kedalam gambar relasi
        $propertyImage = new \stdClass();
        $propertyImage->image = $property->image;
        $property->PropertyImages->prepend($propertyImage);

        $property['contact_agen'] = 'https://api.whatsapp.com/send/?phone='
            . preg_replace('/^08/', '628', $property->Agen->phone_number)
            . '&text='
            . 'Halo, saya ingin menanyakan info/data mengenai properti ini : %0A%0A'
            . url('/') . '/cari-properti/view/'
            . $property['code']
            . '/'
            . $property['slug']
            . '%0A%0AApakah masih ada? Apa ada update terbaru? %0A%0ATerima kasih';

        $property['agen_location'] = $property->Agen->SubDistrict->name . ', ' . $property->Agen->District->name;
        $property['property_transaction'] = $property->PropertyTransaction ? $property->PropertyTransaction->name : "";
        $property['property_type'] = $property->PropertyType ? $property->PropertyType->name : "";
        $property['property_certificate'] = $property->PropertyCertificate ? $property->PropertyCertificate->name : "";
        $property['province'] = $property->Province ? $property->Province->name : "";
        $property['district'] = $property->District ? $property->District->name : "";
        $property['sub_district'] = $property->SubDistrict ? $property->SubDistrict->name : "";
        $property['location'] = $property['sub_district'] . ', ' . $property['district'];
        $property['listed_on'] = Carbon::parse($property->listed_on)->format('F j, Y');
        unset($property->PropertyTransaction);
        unset($property->PropertyType);
        unset($property->PropertyCertificate);
        unset($property->Province);
        unset($property->District);
        unset($property->SubDistrict);

        // update views
        $data["views"] = $property->views + 1;
        Property::where("code", $code)->where("slug", $slug)->update($data);

        $similarProperties = Property::with([
                'PropertyTransaction',
                'PropertyType',
                'PropertyImages',
                'Province',
                'District',
                'SubDistrict',
                'Agen',
            ])
            ->limit(3)
            ->where("is_publish", "Y")
            ->where("admin_approval", "APPROVED")
            ->where("is_available", "Y")
            ->where('code', '!=', $code)
            ->where('property_transaction_id', $property->property_transaction_id)
            ->where('property_type_id', $property->property_type_id)
            ->get()
            ->map(function ($similarProp) {
                $district = $similarProp->District ? $similarProp->District->name : "";
                $subDistrict = $similarProp->SubDistrict ? $similarProp->SubDistrict->name : "";
                $location = $subDistrict . ', ' . $district;
                $whatsapp = 'https://api.whatsapp.com/send/?phone='
                    . preg_replace('/^08/', '628', $similarProp->Agen->phone_number)
                    . '&text='
                    . 'Halo, saya ingin menanyakan info/data mengenai properti ini : %0A%0A'
                    . url('/') . '/cari-properti/view/'
                    . $similarProp['code']
                    . '/'
                    . $similarProp['slug']
                    . '%0A%0AApakah masih ada? Apa ada update terbaru? %0A%0ATerima kasih';

                return (object) [
                    'id' => $similarProp->id,
                    'type' => $similarProp->PropertyType ? $similarProp->PropertyType->name : null,
                    'transaction' => $similarProp->PropertyTransaction ? $similarProp->PropertyTransaction->name : null,
                    'image' =>  url("/") . Storage::url($similarProp->image),
                    'url' => url('/') . '/cari-properti/view/' . $similarProp['code'] . '/' . $similarProp['slug'],
                    'youtube' => $similarProp->youtube_code && $similarProp->youtube_code != "" ? ("https://www.youtube.com/watch?v=" . $similarProp->youtube_code) : null,
                    'short_title' => $similarProp->short_title,
                    'price' => $similarProp->price,
                    'location' => $location,
                    'bedrooms' => $similarProp->bedrooms,
                    'bathrooms' => $similarProp->bathrooms,
                    'land_sale_area' => $similarProp->land_sale_area,
                    'building_sale_area' => $similarProp->building_sale_area,
                    'agen' => $similarProp->Agen->name,
                    'agen_image' => url("/") . Storage::url($similarProp->Agen->image),
                    'whatsapp' => $whatsapp,
                ];
            });

        $recentProperties = Property::where("is_publish", "Y")
            ->where("admin_approval", "APPROVED")
            ->where("is_available", "Y")
            ->orderBy('id', 'desc')
            ->limit(3)
            ->get()
            ->map(function ($similarProp) {

                return (object) [
                    'id' => $similarProp->id,
                    'image' =>  url("/") . Storage::url($similarProp->image),
                    'url' => url('/') . '/cari-properti/view/' . $similarProp['code'] . '/' . $similarProp['slug'],
                    'short_title' => $similarProp->short_title,
                    'price' => $similarProp->price,
                ];
            });


        // dd($property);
        $title = $property->short_title;
        return view("pages.frontpage.detail-properti", compact("title", "property", "similarProperties", "recentProperties"));
    }
}
