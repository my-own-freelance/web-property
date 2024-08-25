<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Property;
use App\Models\PropertyCertificate;
use App\Models\PropertyImage;
use App\Models\PropertyTransaction;
use App\Models\PropertyType;
use App\Models\Province;
use App\Models\SubDistrict;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
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
        $user = auth()->user();
        return view("pages.admin.property.pending", compact("user"));
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
        $query = Property::with(["Agen" => function ($query) {
            $query->select("id", "name", "username");
        }]);

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

        // filter status sale 
        if ($request->query('is_available') && in_array($request->query("is_available"), ['Y', 'N'])) {
            $query->where('is_available', $request->query('is_available'));
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
            $action_approve = $user->role == "owner" && $item->admin_approval != "APPROVED" ? "<a class='dropdown-item' onclick='return updateApproval(\"{$item->id}\", \"" . strtolower($item->admin_approval) . "\", \"approved\");' href='javascript:void(0)' title='Approve'>Approve</a>" : "";
            $action_reject = $user->role == "owner" && $item->admin_approval != "REJECTED" ? "<a class='dropdown-item' onclick='return updateApproval(\"{$item->id}\", \"" . strtolower($item->admin_approval) . "\", \"rejected\");' href='javascript:void(0)' title='Reject'>Reject</a>" : "";
            $action_pending = $user->role == "owner" && $item->admin_approval != "PENDING" ? "<a class='dropdown-item' onclick='return updateApproval(\"{$item->id}\", \"" . strtolower($item->admin_approval) . "\", \"pending\");' href='javascript:void(0)' title='Set Pending'>Set Pending</a>" : "";
            $action_edit = $user->id == $item->agen_id && $user->role == "agen" ? "<a class='dropdown-item' onclick='return getData(\"{$item->id}\", \"edit\");' href='javascript:void(0);' title='Edit'>Edit</a>" : "";
            $action_gallery = $user->id == $item->agen_id && $user->role == "agen" ? "<a class='dropdown-item' onclick='return addGallery(\"{$item->id}\", \"" . strtolower($item->admin_approval) . "\");' href='javascript:void(0)' title='Tambah Gallery'>Tambah Gallery</a>" : "";
            $action_delete = $user->id == $item->agen_id && $user->role == "agen" ? "<a class='dropdown-item' onclick='return removeData(\"{$item->id}\", \"" . strtolower($item->admin_approval) . "\");' href='javascript:void(0)' title='Hapus'>Hapus</a>" : "";

            $action = " <div class='dropdown-primary dropdown open'>
                            <button class='btn btn-sm btn-primary dropdown-toggle waves-effect waves-light' id='dropdown-{$item->id}' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'>
                                Aksi
                            </button>
                            <div class='dropdown-menu' aria-labelledby='dropdown-{$item->id}' data-dropdown-out='fadeOut'>
                                <a class='dropdown-item' onclick='return getData(\"{$item->id}\", \"detail\");' href='javascript:void(0);' title='Edit'>Detail</a>
                                " . $action_edit . "
                                " . $action_approve . "
                                " . $action_reject . "
                                " . $action_pending . "
                                " . $action_gallery . "
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

            $agen = $item->Agen;
            $infoAgen = $user->role == "owner" ?
                '<strong>Agen Name </strong>: ' . ($agen ? $agen->name : 'Agen Deleted') . '
                <br>
                <strong>Agen Username </strong>: ' . ($agen ? $agen->username : 'Agen Deleted') . '
                <br>' :
                "";
            unset($item['Agen']);

            $customInfo = '<small>
                                ' . $infoAgen . '
                                <strong>Code </strong>: ' . $item->code . '
                                <br>
                                <strong>Judul</strong> : ' . $item->short_title . '
                                <br>
                            </small>';

            $customPrice = '<small>
                                <strong>Harga </strong>: Rp. ' . number_format($item->price, 0, ',', '.') . '
                                <br>
                                <strong>Harga m<sup>2</sup></strong> : Rp. ' . ($item->price_per_meter ? number_format($item->price_per_meter, 0, ',', '.') : '-') . '
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
            $item['custom_info'] = $customInfo;
            $item['custom_price'] = $customPrice;
            $item['custom_spec'] = $customSpesification;

            if ($user->role == "agen") {
                $custom_status = $item->is_publish == 'Y' ? '
                    <div class="text-center mt-1">
                        <span class="label-switch">Publish</span>
                    </div>
                    <div class="input-row">
                        <div class="toggle_status on">
                            <input type="checkbox" onclick="return updateStatus(\'' . $item->id . '\', \'Draft\', \'' . $item->admin_approval . '\');" />
                            <span class="slider"></span>
                        </div>
                    </div>' :
                    '<div class="text-center mt-1">
                        <span class="label-switch">Draft</span>
                    </div>
                    <div class="input-row">
                        <div class="toggle_status off">
                            <input type="checkbox" onclick="return updateStatus(\'' . $item->id . '\', \'Publish\', \'' . $item->admin_approval . '\');" />
                            <span class="slider"></span>
                        </div>
                    </div>';

                $custom_available = $item->is_available == 'Y' ? '
                    <div class="text-center mt-1">
                        <span class="label-switch">For Sale</span>
                    </div>
                    <div class="input-row">
                        <div class="toggle_status on">
                            <input type="checkbox" onclick="return updateStatus(\'' . $item->id . '\', \'Sold\', \'' . $item->admin_approval . '\');" />
                            <span class="slider"></span>
                        </div>
                    </div>' :
                    '<div class="text-center mt-1">
                        <span class="label-switch">Sold Out</span>
                    </div>
                    <div class="input-row">
                        <div class="toggle_status off">
                            <input type="checkbox" onclick="return updateStatus(\'' . $item->id . '\', \'ForSale\', \'' . $item->admin_approval . '\');" />
                            <span class="slider"></span>
                        </div>
                    </div>';
                $item['custom_status'] = $custom_status . $custom_available;
            }

            if ($user->role == "owner") {
                $custom_status = $item->is_publish == 'Y' ? '<div class="badge badge-success">Published</div>' : '<div class="badge badge-warning">Draft</div>';
                $custom_available = $item->is_available == 'Y' ? '<div class="badge badge-success">For Sale</div>' : '<div class="badge badge-warning">Sold Out</div>';
                $item['custom_status'] = $custom_status . '<br></br>' . $custom_available;
            }
            return $item;
        });

        $queryTotal = Property::query();
        if ($request->query('admin_approval') && in_array($request->query("admin_approval"), ['pending', 'approved', 'rejected'])) {
            $queryTotal->where('admin_approval', strtoupper($request->query('admin_approval')));
        }

        if ($user->role == "agen") {
            $queryTotal->where("agen_id", $user->id);
        }
        $total = $queryTotal->count();

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
            $user = auth()->user();
            $query = Property::with(["Agen" => function ($query) {
                $query->select("id", "name", "username", "phone_number", "email", "image", "position", "caption", "address");
            }])
                ->with("PropertyTransaction")
                ->with("PropertyType")
                ->with("PropertyCertificate")
                ->with("PropertyImages")
                ->with("Province")
                ->with("District")
                ->with("SubDistrict")
                ->where('id', $id);

            if ($user->role == "agen") {
                $query->where("agen_id", $user->id);
            }

            $property = $query->first();

            if (!$property) {
                return response()->json([
                    "status" => "error",
                    "message" => "Data tidak ditemukan",
                ], 404);
            }
            $property["image"] = url("/") . Storage::url($property->image);

            if ($property->Agen && $property->Agen->image) {
                $property->Agen->image = url('/') . Storage::url($property->Agen->image);
            }

            foreach ($property->PropertyImages as $image) {
                $image->image = url('/') . Storage::url($image->image);
            }

            if ($property['maps_location'] && $property['maps_location'] != "") {
                $property['maps_preview'] = "<iframe src='" . $property["maps_location"] . "' allowfullscreen class='w-100' height='500'></iframe>";
            }

            $property['contact_agen'] = 'https://api.whatsapp.com/send/?phone='
                . preg_replace('/^08/', '628', $property->Agen->phone_number)
                . '&text='
                . 'Halo, saya ingin menanyakan info/data mengenai properti ini : %0A%0A'
                . url('/') . '/cari-properti/view/'
                . $property['code']
                . '/'
                . $property['slug']
                . '%0A%0AApakah masih ada? Apa ada update terbaru? %0A%0ATerima kasih';

            $property['property_transaction'] = $property->PropertyTransaction ? $property->PropertyTransaction->name : "";
            $property['property_type'] = $property->PropertyType ? $property->PropertyType->name : "";
            $property['property_certificate'] = $property->PropertyCertificate ? $property->PropertyCertificate->name : "";
            $property['province'] = $property->Province ? $property->Province->name : "";
            $property['district'] = $property->District ? $property->District->name : "";
            $property['sub_district'] = $property->SubDistrict ? $property->SubDistrict->name : "";
            unset($property->PropertyTransaction);
            unset($property->PropertyType);
            unset($property->PropertyCertificate);
            unset($property->Province);
            unset($property->District);
            unset($property->SubDistrict);

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
                "short_title" => "required|string",
                "long_title" => "required|string",
                "price" => "required|integer",
                "price_per_meter" => "nullable|integer",
                "bedrooms" => "nullable|integer",
                "bathrooms" => "nullable|integer",
                "land_sale_area" => "nullable|integer",
                "building_sale_area" => "nullable|integer",
                "electricity" => "nullable|integer",
                "water" => "nullable|in:PDAM,SUMUR,SUMUR BOR,OTHER",
                "warranty" => "nullable|in:Y,N",
                "facilities" => "nullable|string",
                "youtube_code" => "nullable|string",
                "floor_material" => "nullable|string",
                "building_material" => "nullable|string",
                "orientation" => "nullable|string",
                "property_transaction_id" => "required|integer",
                "property_type_id" => "required|integer",
                "property_certificate_id" => "required|integer",
                "province_id" => "required|integer",
                "district_id" => "required|integer",
                "sub_district_id" => "required|integer",
                "address" => "nullable|string",
                "image" => "required|image|max:1024|mimes:giv,svg,jpeg,png,jpg",
                "map_location" => "nullable|string",
                "description" => "required|string",
            ];

            $messages = [
                "short_title.required" => "Judul harus diisi",
                "long_title.required" => "Judul Panjang harus diisi",
                "price.required" => "Harga harus diisi",
                "price.integer" => "Harga tidak valid",
                "price_per_meter.integer" => "Harga/M2 tidak valid",
                "bedrooms.integer" => "Kamar Tidur tidak valid",
                "bathrooms.integer" => "Kamar Mandi tidak valid",
                "land_sale_area.integer" => "L. Tanah/M2 tidak valid",
                "building_sale_area.integer" => "L. Bangunan/M2 tidak valid",
                "electricity.integer" => "Tegangan Listrik tidak valid",
                "water.in" => "Suber Air tidak valid",
                "warranty.in" => "Garansi tidak valid",
                "property_transaction_id.required" => "Tipe Transaksi harus diisi",
                "property_transaction_id.integer" => "Tipe Transaksi tidak valid",
                "property_type_id.required" => "Tipe Properti harus diisi",
                "property_type_id.integer" => "Tipe Properti tidak valid",
                "property_certificate_id.required" => "Tipe Sertifikat harus diisi",
                "property_certificate_id.integer" => "Tipe Sertifikat tidak valid",
                "province_id.required" => "Privinsi harus diisi",
                "province_id.integer" => "Privinsi tidak valid",
                "district_id.required" => "Kabupaten / Kota harus diisi",
                "district_id.integer" => "Kabupaten / Kota tidak valid",
                "sub_district_id.required" => "Kecamatan harus diisi",
                "sub_district_id.integer" => "Kecamatan tidak valid",
                "image.required" => "Gambar harus di isi",
                "image.image" => "Gambar yang di upload tidak valid",
                "image.max" => "Ukuran gambar maximal 1MB",
                "image.mimes" => "Format gambar harus giv/svg/jpeg/png/jpg",
                "description.required" => "Deskripsi harus diisi",
            ];

            $validator = Validator::make($data, $rules, $messages);
            if ($validator->fails()) {
                return response()->json([
                    "status" => "error",
                    "message" => $validator->errors()->first(),
                    "body" => $data
                ], 400);
            }

            // cek tipe transaksi
            $propTransaction = PropertyTransaction::find($request->property_transaction_id);
            if (!$propTransaction) {
                return response()->json([
                    "status" => "error",
                    "message" => "Tipe Transaksi tidak ditemukan",
                ], 400);
            }

            // cek tipe properti
            $propType = PropertyType::find($request->property_type_id);
            if (!$propType) {
                return response()->json([
                    "status" => "error",
                    "message" => "Tipe Properti tidak ditemukan",
                ], 400);
            }

            // cek tipe sertifikat
            $propCertificate = PropertyCertificate::find($request->property_certificate_id);
            if (!$propCertificate) {
                return response()->json([
                    "status" => "error",
                    "message" => "Tipe Sertifikat tidak ditemukan",
                ], 400);
            }

            // cek provinsi
            $province = Province::find($request->province_id);
            if (!$province) {
                return response()->json([
                    "status" => "error",
                    "message" => "Provinsi tidak ditemukan",
                ], 400);
            }

            // cek kabupaten
            $district = District::find($request->district_id);
            if (!$district) {
                return response()->json([
                    "status" => "error",
                    "message" => "Kabupaten tidak ditemukan",
                ], 400);
            }

            // cek kecamatan
            $subDistrict = SubDistrict::find($request->sub_district_id);
            if (!$subDistrict) {
                return response()->json([
                    "status" => "error",
                    "message" => "Kecamatan tidak ditemukan",
                ], 400);
            }

            if ($request->file('image')) {
                $data['image'] = $request->file('image')->store('assets/property', 'public');
            }
            unset($data['id']);
            $data["slug"] = Str::slug($data["short_title"]);
            $data["code"] = strtoupper(Str::random(10));
            $data["agen_id"] = auth()->user()->id;

            Property::create($data);
            return response()->json([
                "status" => "success",
                "message" => "Data berhasil dibuat"
            ]);
        } catch (\Exception $err) {
            if ($request->file("image")) {
                $uploadedImg = "public/assets/property" . $request->image->hashName();
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
                "short_title" => "required|string",
                "long_title" => "required|string",
                "price" => "required|integer",
                "price_per_meter" => "nullable|integer",
                "bedrooms" => "nullable|integer",
                "bathrooms" => "nullable|integer",
                "land_sale_area" => "nullable|integer",
                "building_sale_area" => "nullable|integer",
                "electricity" => "nullable|integer",
                "water" => "nullable|in:PDAM,SUMUR,SUMUR BOR,OTHER",
                "warranty" => "nullable|in:Y,N",
                "facilities" => "nullable|string",
                "youtube_code" => "nullable|string",
                "floor_material" => "nullable|string",
                "building_material" => "nullable|string",
                "orientation" => "nullable|string",
                "property_transaction_id" => "required|integer",
                "property_type_id" => "required|integer",
                "property_certificate_id" => "required|integer",
                "province_id" => "required|integer",
                "district_id" => "required|integer",
                "sub_district_id" => "required|integer",
                "address" => "nullable|string",
                "description" => "required|string",
                "map_location" => "nullable|string",
                "image" => "nullable"
            ];

            if ($request->file('image')) {
                $rules['image'] .= '|image|max:1024|mimes:giv,svg,jpeg,png,jpg';
            }

            $messages = [
                "id.required" => "Data ID harus diisi",
                "id.integer" => "Type ID tidak sesuai",
                "short_title.required" => "Judul harus diisi",
                "long_title.required" => "Judul Panjang harus diisi",
                "price.required" => "Harga harus diisi",
                "price.integer" => "Harga tidak valid",
                "price_per_meter.integer" => "Harga/M2 tidak valid",
                "bedrooms.integer" => "Kamar Tidur tidak valid",
                "bathrooms.integer" => "Kamar Mandi tidak valid",
                "land_sale_area.integer" => "L. Tanah/M2 tidak valid",
                "building_sale_area.integer" => "L. Bangunan/M2 tidak valid",
                "electricity.integer" => "Tegangan Listrik tidak valid",
                "water.in" => "Suber Air tidak valid",
                "warranty.in" => "Garansi tidak valid",
                "property_transaction_id.required" => "Tipe Transaksi harus diisi",
                "property_transaction_id.integer" => "Tipe Transaksi tidak valid",
                "property_type_id.required" => "Tipe Properti harus diisi",
                "property_type_id.integer" => "Tipe Properti tidak valid",
                "property_certificate_id.required" => "Tipe Sertifikat harus diisi",
                "property_certificate_id.integer" => "Tipe Sertifikat tidak valid",
                "province_id.required" => "Privinsi harus diisi",
                "province_id.integer" => "Privinsi tidak valid",
                "district_id.required" => "Kabupaten / Kota harus diisi",
                "district_id.integer" => "Kabupaten / Kota tidak valid",
                "sub_district_id.required" => "Kecamatan harus diisi",
                "sub_district_id.integer" => "Kecamatan tidak valid",
                "image.required" => "Gambar harus di isi",
                "image.image" => "Gambar yang di upload tidak valid",
                "image.max" => "Ukuran gambar maximal 1MB",
                "image.mimes" => "Format gambar harus giv/svg/jpeg/png/jpg",
                "description.required" => "Deskripsi harus diisi",
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

            $query = Property::where("id", $data["id"]);
            $user = auth()->user();
            if ($user->role == "agen") {
                $query->where("agen_id", $user->id);
            }
            $property = $query->first();

            if (!$property) {
                return response()->json([
                    "status" => "error",
                    "message" => "Data tidak ditemukan"
                ], 404);
            }

            // cek tipe transaksi
            $propTransaction = PropertyTransaction::find($request->property_transaction_id);
            if (!$propTransaction) {
                return response()->json([
                    "status" => "error",
                    "message" => "Tipe Transaksi tidak ditemukan",
                ], 400);
            }

            // cek tipe properti
            $propType = PropertyType::find($request->property_type_id);
            if (!$propType) {
                return response()->json([
                    "status" => "error",
                    "message" => "Tipe Properti tidak ditemukan",
                ], 400);
            }

            // cek tipe sertifikat
            $propCertificate = PropertyCertificate::find($request->property_certificate_id);
            if (!$propCertificate) {
                return response()->json([
                    "status" => "error",
                    "message" => "Tipe Sertifikat tidak ditemukan",
                ], 400);
            }

            // cek provinsi
            $province = Province::find($request->province_id);
            if (!$province) {
                return response()->json([
                    "status" => "error",
                    "message" => "Provinsi tidak ditemukan",
                ], 400);
            }

            // cek kabupaten
            $district = District::find($request->district_id);
            if (!$district) {
                return response()->json([
                    "status" => "error",
                    "message" => "Kabupaten tidak ditemukan",
                ], 400);
            }

            // cek kecamatan
            $subDistrict = SubDistrict::find($request->sub_district_id);
            if (!$subDistrict) {
                return response()->json([
                    "status" => "error",
                    "message" => "Kecamatan tidak ditemukan",
                ], 400);
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

            if ($data["short_title"]) {
                $data["slug"] = Str::slug($data["short_title"]);
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
                "is_publish" => "string|in:Y,N",
                "is_available" => "string|in:Y,N"
            ];

            $messages = [
                "id.required" => "Data ID harus diisi",
                "id.integer" => "Type ID tidak sesuai",
                "is_publish.in" => "Status tidak sesuai",
                "is_available.in" => "Status tidak sesuai",
            ];

            $validator = Validator::make($data, $rules, $messages);
            if ($validator->fails()) {
                return response()->json([
                    "status" => "error",
                    "message" => $validator->errors()->first(),
                ], 400);
            }

            $query = Property::where("id", $data["id"]);
            $user = auth()->user();
            if ($user->role == "agen") {
                $query->where("agen_id", $user->id);
            }
            $property = $query->first();

            if (!$property) {
                return response()->json([
                    "status" => "error",
                    "message" => "Data tidak ditemukan"
                ], 404);
            }

            if ($property->admin_approval != "APPROVED") {
                return response()->json([
                    "status" => "error",
                    "message" => "Status tidak bisa diubah sebelum data di approve oleh admin"
                ], 404);
            }

            // hanya update status is_publish dan is_available
            if (isset($data['is_publish']) || isset($data['is_available'])) {
                $property->update($data);
            }

            return response()->json([
                "status" => "success",
                "message" => "Status berhasil diperbarui",
                "prop" => $property
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
            if ($data["admin_approval"] == "APPROVED") {
                $data["listed_on"] = Date::now();
                $data["is_publish"] = "Y";
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
            $query = Property::where("id", $id);
            $user = auth()->user();
            if ($user->role == "agen") {
                $query->where("agen_id", $user->id);
            }

            $property = $query->first();

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
