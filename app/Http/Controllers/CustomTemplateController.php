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
            $customTemplate = CustomTemplate::find(1);

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

            if ($customTemplate->web_logo) {
                $customTemplate['web_logo'] =  url("/") . Storage::url($customTemplate->web_logo);
            } else {
                $customTemplate['web_logo'] = url("/") . "/dashboard/icon/icon.png";
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
        unset($data["web_logo"]);
        $existCustomData = CustomTemplate::find(1);
        if (!$existCustomData) {
            if ($request->file("web_logo")) {
                $data["web_logo"] = $request->file("web_logo")->store("assets/setting", "public");
            }

            CustomTemplate::create($data);
            return response()->json([
                "status" => 200,
                "message" => "Setting Web berhasil diubah"
            ]);
        }

        if ($request->file("web_logo")) {
            $oldImagePath = "public/" . $existCustomData->web_logo;
            if (Storage::exists($oldImagePath)) {
                Storage::delete($oldImagePath);
            }
            $data["web_logo"] = $request->file("web_logo")->store("assets/setting", "public");
        }

        $existCustomData->update($data);
        return response()->json([
            "status" => 200,
            "message" => "Settin Web berhasil diubah"
        ]);
    }
}
