<?php

namespace App\Http\Controllers;

use App\Models\CustomTemplate;
use App\Models\Partnership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PartnershipController extends Controller
{
    public function index()
    {
        $title = "Partnership";
        $setting = CustomTemplate::first();
        if ($setting) {
            $title = $setting->web_title;
        }
        return view("pages.admin.partnership", compact("title"));
    }


    // HANDLER API
    public function create(Request $request)
    {
        try {
            $data = $request->all();
            $rules = [
                "name" => "required|string",
                "image" => "required|image|max:1024|mimes:giv,svg,jpeg,png,jpg"
            ];

            $messages = [
                "name.required" => "Nama harus diisi",
                "image.required" => "Gambar harus diisi",
                "image.image" => "Gambar yang di upload tidak valid",
                "image.max" => "Ukuran gambar maximal 1MB",
                "image.mimes" => "Format gambar harus giv/svg/jpeg/png/jpg"
            ];

            $validator = Validator::make($data, $rules, $messages);
            if ($validator->fails()) {
                return response()->json([
                    "status" => "error",
                    "message" => $validator->errors()->first(),
                ], 400);
            }
            $data['image'] = $request->file('image')->store('assets/partnership', 'public');
            unset($data['id']);
            Partnership::create($data);

            return response()->json([
                "status" => "success",
                "message" => "Data berhasil disimpan"
            ]);
        } catch (\Exception $err) {
            if ($request->file("image")) {
                $uploadedImg = "public/assets/partnership" . $request->image->hashName();
                if (Storage::exists($uploadedImg)) {
                    Storage::delete($uploadedImg);
                }
            }
            return response()->json([
                "status" => "error",
                "message" => $err->getMessage()
            ], 500);
        }
    }

    public function getDetail($id)
    {
        try {
            $partnership = Partnership::find($id);

            if (!$partnership) {
                return response()->json([
                    "status" => "error",
                    "message" => "Data tidak ditemukan",
                ], 404);
            }

            return response()->json([
                "status" => "success",
                "data" => $partnership
            ]);
        } catch (\Exception $err) {
            return response()->json([
                "status" => "error",
                "message" => $err->getMessage()
            ], 500);
        }
    }

    public function update(Request $request)
    {
        try {
            $data = $request->all();
            $rules = [
                "id" => "required|integer",
                "name" => "required|string",
                "image" => "nullable",
            ];

            if ($request->file('image')) {
                $rules['image'] .= '|image|max:1024|mimes:giv,svg,jpeg,png,jpg';
            }

            $messages = [
                "id.required" => "Data ID harus diisi",
                "id.integer" => "Type ID tidak sesuai",
                "name.required" => "Nama harus diisi",
                "image.image" => "Gambar yang di upload tidak valid",
                "image.max" => "Ukuran gambar maximal 1MB",
                "image.mimes" => "Format gambar harus giv/svg/jpeg/png/jpg"
            ];

            $validator = Validator::make($data, $rules, $messages);
            if ($validator->fails()) {
                return response()->json([
                    "status" => "error",
                    "message" => $validator->errors()->first(),
                ], 400);
            }
            $partnership = Partnership::find($data['id']);

            if (!$partnership) {
                return response()->json([
                    "status" => "error",
                    "message" => "Data partnership tidak ditemukan"
                ], 404);
            }

            // delete undefined data image
            unset($data["image"]);
            if ($request->file('image')) {
                $oldImagePath = "public/" . $partnership->image;
                if (Storage::exists($oldImagePath)) {
                    Storage::delete($oldImagePath);
                }
                $data['image'] = $request->file('image')->store('assets/partnership', 'public');
            }

            $partnership->update($data);
            return response()->json([
                "status" => "success",
                "message" => "Data partnership berhasil diperbarui"
            ]);
        } catch (\Exception $err) {
            if ($request->file("image")) {
                $uploadedImg = "public/assets/partnership" . $request->image->hashName();
                if (Storage::exists($uploadedImg)) {
                    Storage::delete($uploadedImg);
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
            $partnership = Partnership::find($id);
            if (!$partnership) {
                return response()->json([
                    "status" => "error",
                    "message" => "Data partnership tidak ditemukan"
                ], 404);
            }

            $oldImagePath = "public/" . $partnership->image;
            if (Storage::exists($oldImagePath)) {
                Storage::delete($oldImagePath);
            }

            $partnership->delete();
            return response()->json([
                "status" => "success",
                "message" => "Data partnership berhasil dihapus"
            ]);
        } catch (\Exception $err) {
            return response()->json([
                "status" => "error",
                "message" => $err->getMessage()
            ], 500);
        }
    }

    public function dataTable(Request $request)
    {
        $query = Partnership::query();

        if ($request->query("search")) {
            $searchValue = $request->query("search")['value'];
            $query->where(function ($query) use ($searchValue) {
                $query->where('name', 'like', '%' . $searchValue . '%');
            });
        }

        $recordsFiltered = $query->count();

        $data = $query->orderBy('id', 'desc')
            ->skip($request->query('start'))
            ->limit($request->query('length'))
            ->get();

        $output = $data->map(function ($item) {
            $action = "<div class='dropdown-primary dropdown open'>
                            <button class='btn btn-sm btn-primary dropdown-toggle waves-effect waves-light' id='dropdown-{$item->id}' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'>
                                Aksi
                            </button>
                            <div class='dropdown-menu' aria-labelledby='dropdown-{$item->id}' data-dropdown-out='fadeOut'>
                                <a class='dropdown-item' onclick='return getData(\"{$item->id}\");' href='javascript:void(0);' title='Edit'>Edit</a>
                                <a class='dropdown-item' onclick='return removeData(\"{$item->id}\");' href='javascript:void(0)' title='Hapus'>Hapus</a>
                            </div>
                        </div>";

            $image = '<div class="thumbnail">
                        <div class="thumb">
                            <img src="' . Storage::url($item->image) . '" alt="" width="200px" height="200px" 
                            class="img-fluid img-thumbnail" alt="' . $item->title . '">
                        </div>
                    </div>';
            $item['action'] = $action;
            $item['image'] = $image;
            return $item;
        });

        $total = Partnership::count();
        return response()->json([
            'draw' => $request->query('draw'),
            'recordsFiltered' => $recordsFiltered,
            'recordsTotal' => $total,
            'data' => $output,
        ]);
    }
}
