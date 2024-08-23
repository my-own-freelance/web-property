<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Province;
use App\Models\SubDistrict;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    public function index()
    {
        $title = "Kelola Akun";
        $user = auth()->user();
        if ($user->role == "owner") {
            return view("pages.admin.account.owner", compact("title"));
        }

        if ($user->role == "agen") {
            return view("pages.admin.account.agen", compact("title"));
        }
    }

    public function updateOwner(Request $request)
    {
        try {
            $data = $request->all();
            $rules = [
                "id" => "required|integer",
                "name" => "required|string",
                "email" => "required|string|email",
                "phone_number" => "required|string|digits_between:10,15",
                "password" => "nullable",
                "gender" => "required|string|in:L,P",
                "image" => "nullable"
            ];
            if ($data['password'] != "") {
                $rules['password'] .= "|string|min:5";
            }


            if ($request->file('image')) {
                $rules['image'] .= '|image|max:1024|mimes:giv,svg,jpeg,png,jpg';
            }


            $messages = [
                "id.required" => "Data ID harus diisi",
                "id.integer" => "Type ID tidak sesuai",
                "name.required" => "Nama harus diisi",
                "email.required" => "Email harus diisi",
                "email.email" => "Email tidak valid",
                "phone_number.required" => "Nomor telepon harus diisi",
                "phone_number.digits_between" => "Nomor telepon harus memiliki panjang antara 10 hingga 15 karakter",
                "password.min" => "Password minimal 5 karakter",
                "gender" => "Gender harus diisi",
                "gender.in" => "Gender tidak sesuai",
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
            $user = User::where('role', 'owner')->where('id', $data['id'])->first();

            if (!$user) {
                return response()->json([
                    "status" => "error",
                    "message" => "Data pengguna tidak ditemukan"
                ], 404);
            }

            if ($data['password'] && $data['password'] != "") {
                $data['password'] = Hash::make($data['password']);
            } else {
                unset($data['password']);
            }


            unset($data['username']);

            // jika email di update
            if ($data['email'] != $user->email) {
                $existingEmail = User::where("email", $data['email'])->where('id', '!=', $user->id)->first();
                if ($existingEmail) {
                    return response()->json([
                        "status" => "error",
                        "message" => "Email sudah digunakan"
                    ], 404);
                }
            }

            // jika nomor telpon di update
            if ($data['phone_number'] != $user->phone_number) {
                $existingPhoneNumber = User::where("phone_number", preg_replace('/^08/', '628', $data['phone_number']))->where('id', '!=', $user->id)->first();
                if ($existingPhoneNumber) {
                    return response()->json([
                        "status" => "error",
                        "message" => "Nomor Telpon sudah digunakan"
                    ], 404);
                } else {
                    $data['phone_number'] = preg_replace('/^08/', '628', $data['phone_number']);
                }
            }

            // delete undefined data image
            unset($data["image"]);
            if ($request->file("image")) {
                $oldImagePath = "public/" . $user->image;
                if (Storage::exists($oldImagePath)) {
                    Storage::delete($oldImagePath);
                }
                $data["image"] = $request->file("image")->store("assets/user", "public");
            }

            $user->update($data);
            return response()->json([
                "status" => "success",
                "message" => "Berhasil update data pengguna"
            ]);
        } catch (\Exception $err) {
            return response()->json([
                "status" => "error",
                "message" => $err->getMessage()
            ], 500);
        }
    }

    public function updateAgen(Request $request)
    {
        try {
            $data = $request->all();
            $rules = [
                "id" => "required|integer",
                "name" => "required|string",
                "email" => "required|string|email",
                "phone_number" => "required|string|digits_between:10,15",
                "password" => "nullable",
                "position" => "required|string",
                "caption" => "required|string",
                "image" => "nullable",
                "city_of_birth" => "required|string",
                "date_of_birth" => "required|date",
                "gender" => "required|string|in:L,P",
                "province_id" => "required|integer",
                "district_id" => "required|integer",
                "sub_district_id" => "required|integer",
                "address" => "required|string"
            ];

            if ($data && $data['password'] != "") {
                $rules['password'] .= "|string|min:5";
            }

            if ($request->file('image')) {
                $rules['image'] .= '|image|max:1024|mimes:giv,svg,jpeg,png,jpg';
            }

            $messages = [
                "id.required" => "Data ID harus diisi",
                "id.integer" => "Type ID tidak sesuai",
                "name.required" => "Nama harus diisi",
                "email.required" => "Email harus diisi",
                "email.email" => "Email tidak valid",
                "phone_number.required" => "Nomor telepon harus diisi",
                "phone_number.digits_between" => "Nomor telepon harus memiliki panjang antara 10 hingga 15 karakter",
                "password.min" => "Password minimal 5 karakter",
                "position.required" => "Jabatan harus diisi",
                "caption.required" => "Caption harus diisi",
                "image.image" => "Gambar yang di upload tidak valid",
                "image.max" => "Ukuran gambar maximal 1MB",
                "image.mimes" => "Format gambar harus giv/svg/jpeg/png/jpg",
                "city_of_birth.required" => "Kota Kelahiran harus diisi",
                "date_of_birth.required" => "Tanggal Lahir harus diisi",
                "date_of_birth.date" => "Tanggal Lahir tidak valid",
                "gender" => "Gender harus diisi",
                "gender.in" => "Gender tidak sesuai",
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

            $user = User::where('role', 'agen')->where('id', $data['id'])->first();
            if (!$user) {
                return response()->json([
                    "status" => "error",
                    "message" => "Data tidak ditemukan"
                ], 404);
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

            if ($data['password'] && $data['password'] != "") {
                $data['password'] = Hash::make($data['password']);
            } else {
                unset($data['password']);
            }

            // agar username tidak bisa diganti
            unset($data['username']);

            // jika email di update
            if ($data['email'] != $user->email) {
                $existingEmail = User::where("email", $data['email'])->where('id', '!=', $user->id)->first();
                if ($existingEmail) {
                    return response()->json([
                        "status" => "error",
                        "message" => "Email sudah digunakan"
                    ], 404);
                }
            }

            // jika nomor telpon di update
            if ($data['phone_number'] != $user->phone_number) {
                $existingPhoneNumber = User::where("phone_number", preg_replace('/^08/', '628', $data['phone_number']))->where('id', '!=', $user->id)->first();
                if ($existingPhoneNumber) {
                    return response()->json([
                        "status" => "error",
                        "message" => "Nomor Telpon sudah digunakan"
                    ], 404);
                } else {
                    $data['phone_number'] = preg_replace('/^08/', '628', $data['phone_number']);
                }
            }

            // delete undefined data image
            unset($data["image"]);
            if ($request->file("image")) {
                $oldImagePath = "public/" . $user->image;
                if (Storage::exists($oldImagePath)) {
                    Storage::delete($oldImagePath);
                }
                $data["image"] = $request->file("image")->store("assets/user", "public");
            }

            $user->update($data);

            return response()->json([
                "status" => "success",
                "message" => "Berhasil menambahkan data pengguna"
            ]);
        } catch (\Exception $err) {
            if ($request->file("image")) {
                $uploadedImg = "public/assets/user" . $request->image->hashName();
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

    public function detail()
    {
        try {
            $user = Auth()->user();
            $data = User::where("username", $user->username)->first();
            if (!$user) {
                return response()->json([
                    "status" => "error",
                    "message" => "Data user tidak ditemukan"
                ], 404);
            }

            if ($data->image) {
                $data['image'] =  url("/") . Storage::url($data->image);
            }

            return response()->json([
                "status" => "success",
                "data" => $data
            ]);
        } catch (\Exception $err) {
            return response()->json([
                "status" => "error",
                "message" => $err->getMessage(),
            ], 500);
        }
    }
}
