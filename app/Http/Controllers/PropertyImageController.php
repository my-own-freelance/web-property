<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\PropertyImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PropertyImageController extends Controller
{
    public function list($property_id)
    {
        try {
            $propertyImage = PropertyImage::where("property_id", $property_id)->get();

            $data = $propertyImage->map(function ($image) {
                $image['image'] = url("/") . Storage::url($image->image);
                return $image;
            });

            return response()->json([
                "status" => "success",
                "data" => $data,
            ]);
        } catch (\Exception $err) {
            return response()->json([
                "status" => "error",
                "message" => $err->getMessage()
            ], 500);
        }
    }

    public function create(Request $request)
    {
        $uploadedImages = [];

        try {
            $data = $request->all();
            $validator = Validator::make($data, [
                "property_id" => "required|integer",
                "images" => "required",
                "images.*" => "image|max:1024|mimes:gif,svg,jpeg,png,jpg"
            ], [
                "property_id.required" => "ID Property harus diisi",
                "property_id.integer" => "Type ID Property tidak valid",
                "images.required" => "Gambar harus diisi",
                "images.*.image" => "Gambar yang di upload tidak valid",
                "images.*.max" => "Ukuran gambar maksimal 1MB per gambar",
                "images.*.mimes" => "Format gambar harus gif/svg/jpeg/png/jpg"
            ]);
            if ($validator->fails()) {
                return response()->json([
                    "status" => "error",
                    "message" => $validator->errors()->first(),
                ], 400);
            }

            $property = Property::find($data['property_id']);
            if (!$property) {
                return response()->json([
                    "status" => "error",
                    "message" => "Data Property tidak ditemukan"
                ], 404);
            }

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $imagePath = $image->store("assets/property-image", "public");
                    array_push($uploadedImages, $imagePath);

                    // Buat data PropertyImage untuk setiap gambar yang diupload
                    PropertyImage::create([
                        'property_id' => $data['property_id'],
                        'image' => $imagePath
                    ]);
                }
            }

            return response()->json([
                "status" => "success",
                "message" => "Data berhasil dibuat"
            ]);
        } catch (\Exception $err) {
            foreach ($uploadedImages as $imagePath) {
                if (Storage::exists("public/" . $imagePath)) {
                    Storage::delete("public/" . $imagePath);
                }
            }
            return response()->json([
                "status" => "error",
                "message" => $err->getMessage()
            ], 500);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), ["id" => "required|integer"], [
                "id.required" => "Data ID harus diisi",
                "id.integer" => "Type ID tidak valid"
            ]);

            if ($validator->fails()) {
                return response()->json([
                    "status" => "error",
                    "message" => $validator->errors()->first()
                ], 400);
            }

            $id = $request->id;
            $data = PropertyImage::find($id);
            if (!$data) {
                return response()->json([
                    "status" => "error",
                    "message" => "Data tidak ditemukan"
                ], 404);
            }

            $oldImagePath = "public/" . $data->image;
            if (Storage::exists($oldImagePath)) {
                Storage::delete($oldImagePath);
            }

            $data->delete();
            return response()->json([
                "status" => "success",
                "message" => "Data berhasil dihapus"
            ]);
        } catch (\Exception $err) {
            return response()->json([
                "status" => "error",
                "message" => $err->getMessage()
            ], 500);
        }
    }
}
