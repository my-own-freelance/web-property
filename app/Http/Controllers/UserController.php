<?php

namespace App\Http\Controllers;

use App\Http\Services\UserService;
use App\Models\District;
use App\Models\Province;
use App\Models\SubDistrict;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function indexAgen()
    {
        $title = "Data Agen";
        $user = Auth()->user();
        if ($user->role == "agen") {
            return redirect()->route("dashboard");
        }
        return view("pages.admin.agen", compact('title', 'user'));
    }

    public function indexOwner()
    {
        $title = "Data Owner";
        $user = Auth()->user();
        if ($user->role == "agen") {
            return redirect()->route("dashboard");
        }
        return view("pages.admin.owner", compact('title', 'user'));
    }

    // HANDLER API
    public function dataTable(Request $request, $role)
    {
        $query = User::select("id", "name", "username", "email", "phone_number", "role", "is_active")
            ->where("role", $role);

        if ($request->query('search')) {
            $searchValue = $request->query("search")['value'];
            $query->where(function ($query) use ($searchValue) {
                $query->where('name', 'like', '%' . $searchValue . '%')
                    ->orWhere('username', 'like', '%' . $searchValue . '%')
                    ->orWhere('email', 'like', '%' . $searchValue . '%')
                    ->orWhere('phone_number', 'like', '%' . $searchValue . '%');
            });
        }

        $recordsFiltered = $query->count();

        $data = $query->orderBy('name', 'asc')
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
            $role = "";
            if ($item->role == "owner") {
                $role = "OWNER";
            } else if ($item->role == "agen") {
                $role = "AGEN";
            }

            $is_active = $item->is_active == 'Y' ? '
                    <div class="text-center">
                        <span class="label-switch">Active</span>
                    </div>
                    <div class="input-row">
                        <div class="toggle_status on">
                            <input type="checkbox" onclick="return updateStatus(\'' . $item->id . '\', \'Disabled\');" />
                            <span class="slider"></span>
                        </div>
                    </div>' :
                '
                    <div class="text-center">
                        <span class="label-switch">Disabled</span>
                    </div>
                    <div class="input-row">
                        <div class="toggle_status off">
                            <input type="checkbox" onclick="return updateStatus(\'' . $item->id . '\', \'Active\');" />
                            <span class="slider"></span>
                        </div>
                    </div>';

            $item['action'] = $action;
            $item['role'] = $role;
            $item['status_active'] = $item['is_active'];
            $item['is_active'] = $is_active;
            return $item;
        });

        $total = User::where('role', $role)->count();
        return response()->json([
            'draw' => $request->query('draw'),
            'recordsFiltered' => $recordsFiltered,
            'recordsTotal' => $total,
            'data' => $output,
        ]);
    }

    public function createAgen(Request $request)
    {
        try {
            $rules = [
                "name" => "required|string",
                "username" => "required|string|unique:users",
                "email" => "required|string|email|unique:users",
                "email" => "required|string|email|unique:users",
                "phone_number" => "required|string|unique:users|digits_between:10,15",
                "password" => "required|string|min:5",
                "position" => "required|string",
                "caption" => "required|string",
                "image" => "required|image|max:1024|mimes:giv,svg,jpeg,png,jpg",
                "city_of_birth" => "required|string",
                "date_of_birth" => "required|date",
                "gender" => "required|string|in:L,P",
                "is_active" => "required|string|in:Y,N",
                "province_id" => "required|integer",
                "district_id" => "required|integer",
                "sub_district_id" => "required|integer",
                "address" => "required|string"
            ];

            $messages = [
                "name.required" => "Nama harus diisi",
                "username.required" => "Username harus diisi",
                "username.unique" => "Username sudah digunakan",
                "email.required" => "Email harus diisi",
                "email.unique" => "Email sudah digunakan",
                "email.email" => "Email tidak valid",
                "phone_number.required" => "Nomor telepon harus diisi",
                "phone_number.unique" => "Nomor telepon sudah digunakan",
                "phone_number.digits_between" => "Nomor telepon harus memiliki panjang antara 10 hingga 15 karakter",
                "password.required" => "Password harus diisi",
                "password.min" => "Password minimal 5 karakter",
                "position.required" => "Jabatan harus diisi",
                "caption.required" => "Caption harus diisi",
                "image.required" => "Gambar harus di isi",
                "image.image" => "Gambar yang di upload tidak valid",
                "image.max" => "Ukuran gambar maximal 1MB",
                "image.mimes" => "Format gambar harus giv/svg/jpeg/png/jpg",
                "city_of_birth.required" => "Kota Kelahiran harus diisi",
                "date_of_birth.required" => "Tanggal Lahir harus diisi",
                "date_of_birth.date" => "Tanggal Lahir tidak valid",
                "gender" => "Gender harus diisi",
                "gender.in" => "Gender tidak sesuai",
                "is_active" => "Status harus diisi",
                "is_active.in" => "Status tidak sesuai",
                "province_id.required" => "Provinsi harus diisi",
                "province_id.integer" => "Provinsi tidak valid",
                "district_id.required" => "Kabupaten harus diisi",
                "district_id.integer" => "Kabupaten tidak valid",
                "sub_district_id.required" => "Kecamatan harus diisi",
                "sub_district_id.integer" => "Kecamatan tidak valid",
                "address.required" => "Alamat harus diisi"
            ];

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return response()->json([
                    "status" => "error",
                    "message" => $validator->errors()->first(),
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

            $data = $request->all();
            $data["password"] = Hash::make($request->password);
            $data["role"] = "agen";
            $data["phone_number"] = preg_replace('/^08/', '628', $data['phone_number']);

            if ($request->file('image')) {
                $data['image'] = $request->file('image')->store('assets/user', 'public');
            }

            User::create($data);

            return response()->json([
                "status" => "success",
                "message" => "Berhasil menambahkan data pengguna"
            ]);
        } catch (\Exception $err) {
            return response()->json([
                "status" => "error",
                "message" => $err->getMessage()
            ], 500);
        }
    }

    public function getDetail($id)
    {
        try {
            $user = User::find($id);

            if (!$user) {
                return response()->json([
                    "status" => "error",
                    "message" => "Data tidak ditemukan",
                ], 404);
            }

            return response()->json([
                "status" => "success",
                "data" => $user
            ]);
        } catch (\Exception $err) {
            return response()->json([
                "status" => "error",
                "message" => $err->getMessage()
            ], 500);
        }
    }

    public function updateStatus(Request $request)
    {
        try {
            $data = $request->all();
            $rules = [
                "id" => "required|integer",
                "is_active" => "required|in:N,Y",
            ];

            $messages = [
                "id.required" => "Data ID harus diisi",
                "id.integer" => "Type ID tidak sesuai",
                "is_active.required" => "Status harus diisi",
                "is_active.in" => "Status tidak sesuai",
            ];

            $validator = Validator::make($data, $rules, $messages);
            if ($validator->fails()) {
                return response()->json([
                    "status" => "error",
                    "message" => $validator->errors()->first(),
                ], 400);
            }

            $user = User::find($data['id']);
            if (!$user) {
                return response()->json([
                    "status" => "error",
                    "message" => "Data pengguna tidak ditemukan"
                ], 404);
            }
            $user->update(["is_active" => $data["is_active"]]);
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
            $user = User::find($id);
            if (!$user) {
                return response()->json([
                    "status" => "error",
                    "message" => "Data tidak ditemukan"
                ], 404);
            }

            $user->delete();
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
