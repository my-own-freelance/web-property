<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Province;
use App\Models\SubDistrict;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function provinces()
    {
        $provinces = Province::all();
        return response()->json([
            "status" => "success",
            "data" => $provinces
        ]);
    }

    public function districts($provinceId)
    {
        $districts = District::where("province_id", $provinceId)->get();
        return response()->json([
            "status" => "success",
            "data" => $districts
        ]);
    }

    public function subDistricts($districtId)
    {
        $subDistricts = SubDistrict::where("district_id", $districtId)->get();
        return response()->json([
            "status" => "success",
            "data" => $subDistricts
        ]);
    }
}
