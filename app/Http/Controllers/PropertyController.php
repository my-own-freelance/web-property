<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\PropertyImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PropertyController extends Controller
{
    public function index()
    {
        $title = "Properti";
        return view("pages.admin.property.index", compact("title"));
    }

    public function pending()
    {
        return view("pages.admin.property.pending");
    }

    public function approved()
    {
        return view("pages.admin.property.approved");
    }

    public function rejected()
    {
        return view("pages.admin.property.rejected");
    }

    // HANDLER API
    public function dataTable(Request $request)
    {
        $query = Property::query();

        if ($request->query("search")) {
            $searchValue = $request->query("search")['value'];
            $query->where(function ($query) use ($searchValue) {
                $query->where('short_title', 'like', '%' . $searchValue . '%')
                    ->Orwhere('long_title', 'like', '%' . $searchValue . '%')
                    ->Orwhere('code', 'like', '%' . $searchValue . '%');
            });
        }

        $user = auth()->user();
        // role agen only see his own property
        if ($user->role == "agen") {
            $query->where("agen_id", $user->id);
        }

        // filter status
        if ($request->query("is_publish") && $request->query('is_publish') != "") {
            $query->where('is_publish', $request->query('is_publish'));
        }

        // filter status approved
        if ($request->query('admin_approval') && in_array($request->query("admin_approval"), ['pending', 'approved', 'rejected'])) {
            $query->where('admin_approval', strtoupper($request->query('admin_approval')));
        }

        // filter status sold 
        if ($request->query('is_sold') && in_array($request->query("is_sold"), ['true', 'false'])) {
            $query->where('is_sold', $request->query('is_sold'));
        }

        // filter properti transaction
        if ($request->query("property_transaction_id") && $request->query('property_transaction_id') != "") {
            $query->where('property_transaction_id', $request->query('property_transaction_id'));
        }

        // filter property type
        if ($request->query("property_type_id") && $request->query('property_type_id') != "") {
            $query->where('property_type_id', $request->query('property_type_id'));
        }

        // filter property certificate
        if ($request->query("property_certificate_id") && $request->query('property_certificate_id') != "") {
            $query->where('property_certificate_id', $request->query('property_certificate_id'));
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

        $recordsFiltered = $query->count();
        $data = $query->orderBy('created_at', 'desc')
            ->skip($request->query('start'))
            ->limit($request->query('length'))
            ->get();

        $output = $data->map(function ($item) {
            $user = auth()->user();
            $action_approve = $user->role == "owner" ? "<a class='dropdown-item' onclick='return approveData(\"{$item->id}\");' href='javascript:void(0)' title='Approve'>Approve</a>" : "";
            $action_reject = $user->role == "owner" ? "<a class='dropdown-item' onclick='return rejectData(\"{$item->id}\");' href='javascript:void(0)' title='Reject'>Reject</a>" : "";
            $action_pending = $user->role == "owner" ? "<a class='dropdown-item' onclick='return pendingData(\"{$item->id}\");' href='javascript:void(0)' title='Set Pending'>Set Pending</a>" : "";
            $action_delete = $user->id == $item->agen_id && $user->role == "agen" ? "<a class='dropdown-item' onclick='return removeData(\"{$item->id}\");' href='javascript:void(0)' title='Hapus'>Hapus</a>" : "";
            $action = " <div class='dropdown-primary dropdown open'>
                            <button class='btn btn-sm btn-primary dropdown-toggle waves-effect waves-light' id='dropdown-{$item->id}' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'>
                                Aksi
                            </button>
                            <div class='dropdown-menu' aria-labelledby='dropdown-{$item->id}' data-dropdown-out='fadeOut'>
                                <a class='dropdown-item' onclick='return getData(\"{$item->id}\");' href='javascript:void(0);' title='Edit'>Edit</a>
                                <a class='dropdown-item' onclick='return removeData(\"{$item->id}\");' href='javascript:void(0)' title='Hapus'>Hapus</a>
                                " . $action_approve . "
                                " . $action_reject . "
                                " . $action_pending . "
                                " . $action_delete . "
                            </div>
                        </div>";

            $image = '<div class="thumbnail">
                        <div class="thumb">
                            <img src="' . Storage::url($item->image) . '" alt="" width="300px" height="300px" 
                            class="img-fluid img-thumbnail" alt="' . $item->short_title . '">
                        </div>
                    </div>';

            $approveStatus = $item->admin_approval == 'PENDING'
                ? '<div class="badge badge-warning">Pending</div>'
                : ($item->admin_approval == 'APPROVED'
                    ? '<div class="badge badge-success">Approved</div>'
                    : '<div class="badge badge-danger">Rejected</div>');

            $customTitle = '<small>
                                <strong>Code </strong>: ' . $item->code . '
                                <br>
                                <strong>Judul</strong> : ' . $item->short_title . '
                                <br>
                            </small>';

            $customPrice = '<small>
                                <strong>Harga </strong>: Rp. ' . number_format($item->price, 0, ',', '.') . '
                                <br>
                                <strong>Harga m<sup>2</sup></strong> : Rp. ' . number_format($item->price_per_meter, 0, ',', '.') . '
                                <br>
                            </small>';

            $customSpesification = '<small>
                                        <strong>L. Tanah </strong>: ' . $item->land_sale_area . 'm<sup>2</sup>
                                        <br>
                                        <strong>L. Bangunan</strong> : ' . $item->building_sale_area . 'm<sup>2</sup>
                                        <br>
                                        <strong>K. Tidur</strong> : ' . $item->bedrooms . '
                                        <br>
                                        <strong>K. Mandi</strong> : ' . $item->bathrooms . '
                                    </small>';
            $item['action'] = $action;
            $item['image_url'] = url("/") . Storage::url($item->image);
            $item['image'] = $image;
            $item['status_approval'] = $approveStatus;
            $item['custom_title'] = $customTitle;
            $item['custom_price'] = $customPrice;
            $item['custom_spec'] = $customSpesification;

            if ($user->role == "agen") {
                $is_publish = $item->is_publish == 'Y' ? '
                    <div class="text-center">
                        <span class="label-switch">Publish</span>
                    </div>
                    <div class="input-row">
                        <div class="toggle_status on">
                            <input type="checkbox" onclick="return updateStatus(\'' . $item->id . '\', \'Draft\');" />
                            <span class="slider"></span>
                        </div>
                    </div>' :
                    '<div class="text-center">
                        <span class="label-switch">Draft</span>
                    </div>
                    <div class="input-row">
                        <div class="toggle_status off">
                            <input type="checkbox" onclick="return updateStatus(\'' . $item->id . '\', \'Publish\');" />
                            <span class="slider"></span>
                        </div>
                    </div>';
                $item['custom_status'] = $is_publish;
            }

            if ($user->role == "owner") {
                $is_publish = $item->is_publish == 'Y' ? '<div class="badge badge-success">Published</div>' : '<div class="badge badge-warning">Draft</div>';
                $item['custom_status'] = $is_publish;
            }
            return $item;
        });

        $total = Property::count();

        if ($user->role == "agen") {
            $total = Property::where("agen_id", $user->id)->count();
        }

        return response()->json([
            'draw' => $request->query('draw'),
            'recordsFiltered' => $recordsFiltered,
            'recordsTotal' => $total,
            'data' => $output,
        ]);
    }

    public function getDetail($id)
    {
        try {
            $property = null;
            $user = auth()->user();
            if ($user->role == "agen") {
                $property = Property::where("agen_id", $user->id)->first();
            } else if ($user->role == "owner") {
                $property = Property::find($id);
            }

            if (!$property) {
                return response()->json([
                    "status" => "error",
                    "message" => "Data tidak ditemukan",
                ], 404);
            }

            return response()->json([
                "status" => "success",
                "data" => $property
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
        try {
            $data = $request->all();
            $rules = [
                "title" => "required|string",
                "excerpt" => "required|string|max:250",
                "description" => "required|string",
                "is_publish" => "required|string|in:Y,N",
                "image" => "required|image|max:1024|mimes:giv,svg,jpeg,png,jpg"
            ];

            $messages = [
                "title.required" => "Judul harus diisi",
                "excerpt.required" => "Kutipan harus diisi",
                "excerpt.max" => "Kutipan harus kurang dari 250 karakter",
                "description.required" => "Deskripsi harus diisi",
                "is_publish.required" => "Status harus diisi",
                "is_publish.in" => "Status tidak sesuai",
                "image.required" => "Gambar harus di isi",
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

            if ($request->file('image')) {
                $data['image'] = $request->file('image')->store('assets/article', 'public');
            }
            unset($data['id']);
            $data["slug"] = Str::slug($data["title"]);
            $data["code"] = Str::random(10);

            Property::create($data);
            return response()->json([
                "status" => "success",
                "message" => "Data berhasil dibuat"
            ]);
        } catch (\Exception $err) {
            if ($request->file("image")) {
                $uploadedImg = "public/assets/article" . $request->image->hashName();
                if (Storage::exists($uploadedImg)) {
                    Storage::delete($uploadedImg);
                }
            }
            return response()->json([
                "status" => "error",
                "message" => $err->getMessage(),
            ], 500);
        }
    }

    public function update(Request $request)
    {
        try {
            $data = $request->all();
            $rules = [
                "id" => "required|integer",
                "title" => "required|string",
                "excerpt" => "required|string|max:250",
                "description" => "required|string",
                "is_publish" => "required|string|in:Y,N",
                "image" => "nullable"
            ];

            if ($request->file('image')) {
                $rules['image'] .= '|image|max:1024|mimes:giv,svg,jpeg,png,jpg';
            }

            $messages = [
                "id.required" => "Data ID harus diisi",
                "id.integer" => "Type ID tidak sesuai",
                "title.required" => "Judul harus diisi",
                "excerpt.required" => "Kutipan harus diisi",
                "excerpt.max" => "Kutipan harus kurang dari 250 karakter",
                "description.required" => "Deskripsi harus diisi",
                "is_publish.required" => "Status harus diisi",
                "is_publish.in" => "Status tidak sesuai",
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

            $property = null;
            $user = auth()->user();
            if ($user->role == "agen") {
                $property = Property::where("agen_id", $user->id)->first();
            } else if ($user->role == "owner") {
                $property = Property::find($data['id']);
            }

            if (!$property) {
                return response()->json([
                    "status" => "error",
                    "message" => "Data tidak ditemukan"
                ], 404);
            }

            // delete undefined data image
            unset($data["image"]);
            if ($request->file("image")) {
                $oldImagePath = "public/" . $property->image;
                if (Storage::exists($oldImagePath)) {
                    Storage::delete($oldImagePath);
                }
                $data["image"] = $request->file("image")->store("assets/property", "public");
            }

            if ($data["title"]) {
                $data["slug"] = Str::slug($data["title"]);
            }

            $property->update($data);
            return response()->json([
                "status" => "success",
                "message" => "Data berhasil diperbarui"
            ]);
        } catch (\Exception $err) {
            if ($request->file("image")) {
                $uploadedImg = "public/property" . $request->image->hashName();
                if (Storage::exists($uploadedImg)) {
                    Storage::delete($uploadedImg);
                }
            }
            return response()->json([
                "status" => "error",
                "message" => $err->getMessage(),
            ], 500);
        }
    }

    public function updateStatus(Request $request)
    {
        try {
            $data = $request->all();
            $rules = [
                "id" => "required|integer",
                "is_publish" => "required|string|in:Y,N",
            ];

            $messages = [
                "id.required" => "Data ID harus diisi",
                "id.integer" => "Type ID tidak sesuai",
                "is_publish.required" => "Status harus diisi",
                "is_publish.in" => "Status tidak sesuai",
            ];

            $validator = Validator::make($data, $rules, $messages);
            if ($validator->fails()) {
                return response()->json([
                    "status" => "error",
                    "message" => $validator->errors()->first(),
                ], 400);
            }

            $property = null;
            $user = auth()->user();
            if ($user->role == "agen") {
                $property = Property::where("agen_id", $user->id)->first();
            } else if ($user->role == "owner") {
                $property = Property::find($data['id']);
            }

            if (!$property) {
                return response()->json([
                    "status" => "error",
                    "message" => "Data tidak ditemukan"
                ], 404);
            }
            $property->update($data);
            return response()->json([
                "status" => "success",
                "message" => "Status berhasil diperbarui"
            ]);
        } catch (\Exception $err) {
            return response()->json([
                "status" => "error",
                "message" => $err->getMessage(),
            ], 500);
        }
    }

    public function approveStatus(Request $request)
    {
        try {
            $data = $request->all();
            $rules = [
                "id" => "required|integer",
                "admin_approval" => "required|in:pending,approved,rejected",
            ];

            $messages = [
                "id.required" => "Data ID harus diisi",
                "id.integer" => "Type ID tidak sesuai",
                "admin_approval.required" => "Approve status harus diisi",
                "admin_approval.in" => "Approve status tidak valid",
            ];

            $validator = Validator::make($data, $rules, $messages);
            if ($validator->fails()) {
                return response()->json([
                    "status" => "error",
                    "message" => $validator->errors()->first(),
                ], 400);
            }

            $property = Property::find($data['id']);
            if (!$property) {
                return response()->json([
                    "status" => "error",
                    "message" => "Data tidak ditemukan"
                ], 404);
            }
            $data["admin_approval"] = strtoupper($data["admin_approval"]);
            $property->update($data);
            return response()->json([
                "status" => "success",
                "message" => "Status berhasil diperbarui"
            ]);
        } catch (\Exception $err) {
            return response()->json([
                "status" => "error",
                "message" => $err->getMessage(),
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
            $property = null;

            $user = auth()->user();
            if ($user->role == "agen") {
                $property = Property::where("agen_id", $user->id)->first();
            } else if ($user->role == "owner") {
                $property = Property::find($id);
            }

            if (!$property) {
                return response()->json([
                    "status" => "error",
                    "message" => "Data tidak ditemukan"
                ], 404);
            }

            $oldImagePath = "public/" . $property->image;
            if (Storage::exists($oldImagePath)) {
                Storage::delete($oldImagePath);
            }

            // property images
            $propertyImages = PropertyImage::where("property_id", $property->id)->get();
            foreach ($propertyImages as $pi) {
                $piImagePath = "public/" . $pi->image;
                if (Storage::exists($piImagePath)) {
                    Storage::delete($piImagePath);
                }
                PropertyImage::where("id", $pi->id)->delete();
            }

            $property->delete();
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
