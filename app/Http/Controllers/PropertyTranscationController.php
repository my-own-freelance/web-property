<?php

namespace App\Http\Controllers;

use App\Models\CustomTemplate;
use App\Models\Property;
use App\Models\PropertyTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PropertyTranscationController extends Controller
{
    public function index()
    {
        $title = "Transaksi Properti";
        $setting = CustomTemplate::first();
        if ($setting) {
            $title = $setting->web_title;
        }
        return view("pages.admin.prop-transaction", compact("title"));
    }

    // HANDLER API
    public function dataTable(Request $request)
    {
        $query = PropertyTransaction::query();

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
            $action = " <div class='dropdown-primary dropdown open'>
                            <button class='btn btn-sm btn-primary dropdown-toggle waves-effect waves-light' id='dropdown-{$item->id}' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'>
                                Aksi
                            </button>
                            <div class='dropdown-menu' aria-labelledby='dropdown-{$item->id}' data-dropdown-out='fadeOut'>
                                <a class='dropdown-item' onclick='return getData(\"{$item->id}\");' href='javascript:void(0);' title='Edit'>Edit</a>
                                <a class='dropdown-item' onclick='return removeData(\"{$item->id}\");' href='javascript:void(0)' title='Hapus'>Hapus</a>
                            </div>
                        </div>";


            $item['action'] = $action;
            return $item;
        });

        $total = PropertyTransaction::count();
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
            $propTransaction = PropertyTransaction::find($id);

            if (!$propTransaction) {
                return response()->json([
                    "status" => "error",
                    "message" => "Data tidak ditemukan",
                ], 404);
            }

            return response()->json([
                "status" => "success",
                "data" => $propTransaction
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
                "name" => "required|string",
            ];

            $messages = [
                "name.required" => "Nama Transaksi harus diisi",
            ];

            $validator = Validator::make($data, $rules, $messages);
            if ($validator->fails()) {
                return response()->json([
                    "status" => "error",
                    "message" => $validator->errors()->first(),
                ], 400);
            }

            unset($data['id']);
            PropertyTransaction::create($data);
            return response()->json([
                "status" => "success",
                "message" => "Data berhasil dibuat"
            ]);
        } catch (\Exception $err) {
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
                "name" => "required|string",
            ];

            $messages = [
                "id.required" => "Data ID harus diisi",
                "id.integer" => "Type ID tidak sesuai",
                "name.required" => "Nama Transaksi harus diisi",
            ];

            $validator = Validator::make($data, $rules, $messages);
            if ($validator->fails()) {
                return response()->json([
                    "status" => "error",
                    "message" => $validator->errors()->first(),
                ], 400);
            }

            $propTransaction = PropertyTransaction::find($data['id']);
            if (!$propTransaction) {
                return response()->json([
                    "status" => "error",
                    "message" => "Data tidak ditemukan"
                ], 404);
            }

            $propTransaction->update($data);
            return response()->json([
                "status" => "success",
                "message" => "Data berhasil diperbarui"
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
            $propTransaction = PropertyTransaction::find($id);
            if (!$propTransaction) {
                return response()->json([
                    "status" => "error",
                    "message" => "Data tidak ditemukan"
                ], 404);
            }

            // cek apakah ada relasi atau tidak
            $checkRelation = Property::where('property_transaction_id', $id)->count();
            if ($checkRelation > 0) {
                return response()->json([
                    "status" => "error",
                    "message" => "Data masih digunakan untuk properti tertentu"
                ], 404);
            }

            $propTransaction->delete();
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

    public function dropdown()
    {
        $propTransaction = PropertyTransaction::all();
        return response()->json([
            "status" => "success",
            "data" => $propTransaction
        ]);
    }
}
