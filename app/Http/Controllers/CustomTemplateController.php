<?php

namespace App\Http\Controllers;

use App\Http\Services\CustomTemplateService;
use App\Models\CustomTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CustomTemplateController extends Controller
{
    public function index()
    {
        $title = "Setting Website";
        return view('pages.admin.setting', compact('title'));
    }

    public function detail()
    {
        try {
            $customTemplate = CustomTemplate::first();

            if (!$customTemplate) {
                return response()->json([
                    "status" => "success",
                    "message" => "Template is not set"
                ], 404);
            }

            if (!$customTemplate->web_title) {
                $customTemplate["web_title"] = "Web Properti";
            }

            if (!$customTemplate->web_description) {
                $customTemplate["web_description"] = "Situs Jual Beli Properti Terbaik";
            }

            if ($customTemplate->meta_image) {
                $customTemplate['meta_image'] =  url("/") . Storage::url($customTemplate->meta_image);
            } else {
                $customTemplate['meta_image'] = asset('frontpage/images/mockup-depan.jpg');
            }

            if ($customTemplate->web_logo) {
                $customTemplate['web_logo'] =  url("/") . Storage::url($customTemplate->web_logo);
            } else {
                $customTemplate['web_logo'] = asset('frontpage/images/logo-purple.svg');
            }

            if ($customTemplate->web_logo_white) {
                $customTemplate['web_logo_white'] =  url("/") . Storage::url($customTemplate->web_logo_white);
            } else {
                $customTemplate['web_logo_white'] = asset('frontpage/images/logo-white-1.svg');
            }

            if ($customTemplate['maps_location'] && $customTemplate['maps_location'] != "") {
                $customTemplate['maps_preview'] = "<iframe src='" . $customTemplate["maps_location"] . "' allowfullscreen class='w-100' height='500'></iframe>";
            }

            return response()->json([
                "status" => "success",
                "data" => $customTemplate
            ]);
        } catch (\Exception $err) {
            return response()->json([
                "status" => "error",
                "message" => $err->getMessage(),
            ], 500);
        }
    }

    public function saveUpdateData(Request $request)
    {
        $data = $request->all();
        unset($data['id']);
        unset($data["meta_image"]);
        unset($data["web_logo"]);
        unset($data["web_logo_white"]);
        $existCustomData = CustomTemplate::first();
        if (!$existCustomData) {
            if ($request->file("meta_image")) {
                $data["meta_image"] = $request->file("meta_image")->store("assets/setting", "public");
            }

            if ($request->file("web_logo")) {
                $data["web_logo"] = $request->file("web_logo")->store("assets/setting", "public");
            }

            if ($request->file("web_logo_white")) {
                $data["web_logo_white"] = $request->file("web_logo_white")->store("assets/setting", "public");
            }

            CustomTemplate::create($data);
            return response()->json([
                "status" => 200,
                "message" => "Setting Web berhasil diubah"
            ]);
        }

        if ($request->file("meta_image")) {
            $oldImagePath = "public/" . $existCustomData->meta_image;
            if (Storage::exists($oldImagePath)) {
                Storage::delete($oldImagePath);
            }
            $data["meta_image"] = $request->file("meta_image")->store("assets/setting", "public");
        }

        if ($request->file("web_logo")) {
            $oldImagePath = "public/" . $existCustomData->web_logo;
            if (Storage::exists($oldImagePath)) {
                Storage::delete($oldImagePath);
            }
            $data["web_logo"] = $request->file("web_logo")->store("assets/setting", "public");
        }

        if ($request->file("web_logo_white")) {
            $oldImagePath = "public/" . $existCustomData->web_logo_white;
            if (Storage::exists($oldImagePath)) {
                Storage::delete($oldImagePath);
            }
            $data["web_logo_white"] = $request->file("web_logo_white")->store("assets/setting", "public");
        }

        $existCustomData->update($data);
        return response()->json([
            "status" => 200,
            "message" => "Settin Web berhasil diubah"
        ]);
    }
}
