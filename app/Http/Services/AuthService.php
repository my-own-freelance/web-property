<?php

namespace App\Http\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthService
{
    public function register($request)
    {
        try {
            $rules = [
                "name" => "required|string",
                "username" => "required|string|unique:users",
                "email" => "required|string|email|unique:users",
                "password" => "required|string|min:5",
                "password_confirm" => "required|string|same:password",
                "phone_number" => "required|string|unique:users|digits_between:10,15"
            ];

            $messages = [
                "name.required" => "Nama harus diisi",
                "username.required" => "Username harus diisi",
                "username.unique" => "Username sudah digunakan",
                "email.required" => "Email harus diisi",
                "email.unique" => "Email sudah digunakan",
                "email.email" => "Email tidak valid",
                "password.required" => "Password harus diisi",
                "password.min" => "Password minimal 5 karakter",
                "password_confirm.required" => "Password Confirm harus diisi",
                "password_confirm.same" => "Password Confirm tidak sesuai",
                "phone_number.required" => "Nomor telepon harus diisi",
                "phone_number.unique" => "Nomor telepon sudah digunakan",
                "phone_number.digits_between" => "Nomor telepon harus memiliki panjang antara 10 hingga 15 karakter",
            ];

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return response()->json([
                    "status" => "error",
                    "message" => $validator->errors()->first(),
                ], 400);
            }

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->username = $request->username;
            $user->password = Hash::make($request->password);
            $user->role = "agen";
            $user->phone_number = $request->phone_number;
            $user->is_active = "Y";
            $user->code = strtoupper(Str::random(10));
            $user->save();

            return response()->json([
                "status" => "success",
                "message" => "Registrasi berhasil"
            ]);
        } catch (\Exception $err) {
            return response()->json([
                "status" => "error",
                "message" => $err->getMessage()
            ], 500);
        }
    }

    public function update($request)
    {
        try {
            $data = $request->all();
            $rules = [
                "name" => "required|string",
                "email" => "required|string|email",
                "password" => "nullable",
                "image" => "nullable"
            ];

            if (isset($data["password"]) && $data["password"] != "") {
                $rules['password'] .= "|string|min:5";
            }

            if ($request->file('image')) {
                $rules['image'] .= '|image|max:1024|mimes:giv,svg,jpeg,png,jpg';
            }

            $messages = [
                "name.required" => "Nama harus diisi",
                "email.required" => "Email harus diisi",
                "email.email" => "Email tidak valid",
                "password.min" => "Password minimal 5 karakter",
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

            $userAuth = Auth()->user();
            $user = User::where("username", $userAuth->username)->first();
            if (!$user) {
                return response()->json([
                    "status" => "error",
                    "message" => "Data user tidak ditemukan"
                ], 404);
            }

            if (isset($data["password"]) && $data["password"] != "") {
                $data["password"] = Hash::make($data["password"]);
            } else {
                unset($data["password"]);
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

            // jika email di update
            $existingEmail = User::where("email", $data['email'])->where('id', '!=', $user->id)->first();
            if ($existingEmail) {
                return response()->json([
                    "status" => "error",
                    "message" => "Email sudah digunakan"
                ], 404);
            }

            $user->update($data);

            return response()->json([
                "status" => "success",
                "message" => "Update berhasil"
            ]);
        } catch (\Exception $err) {
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
