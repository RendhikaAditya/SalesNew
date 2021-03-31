<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Keranjang;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    public function add(Request $request) {
        try {
            $barang = Barang::where("id_barang",$request->id_barang)->first();
            $created = Keranjang::create([
                "id_costumer" => $request->input("id_costumer"),
                "id_sales" => $request->input("id_sales"),
                "id_barang" => $request->input("id_barang"),
                "jml_barang" => $request->input("jml_barang"),
                "harga" => $barang->harga_barang
            ]);
            return response()->json([
                "code" => 200,"status" => "Berhasil", "pesan" => "Data Berhasil Masuk Keranjang",
                "data" => $created
            ],200);
        } catch (\Throwable $th) {
            return response()->json([
                "code" => 500, "status" => "Gagal", "pesan" => "Data Gagal Masuk Keranjang"
            ],500);
        }

    }

    public function updateTambah(Request $request) {
        try {
            $id_barang = $request->input("id_barang");
            $id_costumer = $request->input("id_costumer");
            $item = Keranjang::where("id_barang",$id_barang)->where("id_costumer", $id_costumer)->first();
            $updated = $item->update([
                "jml_barang" => $item->jml_barang + 1
            ]);
            return response()->json([
                "code" => 200,
                "status" => $updated === true ?  "Berhasil" : "Gagal",
                "pesan" => $updated === true ? "Data Keranjang Berhasil Diupdate" : "Data Keranjang Gagal Diupdate"
            ],200);
        } catch (\Throwable $th) {
            return response()->json([
                "code" => 500, "status" => "Gagal", "pesan" => "Data Keranjang Gagal Diupdate"
            ],500);
        }
    }

    public function updateKurang(Request $request) {
        try {
            $id_barang = $request->input("id_barang");
            $id_costumer = $request->input("id_costumer");
            $item = Keranjang::where("id_barang",$id_barang)->where("id_costumer", $id_costumer)->first();
            $created = null;
            $deleted = null;
            if ($item->jml_barang === 1) {
                $deleted = $item->delete();
            }
            $updated = $item->update([
                // "harga" => $item->harga / $item->jml_barang * ($item->jml_barang - 1) ,
                "jml_barang" => $item->jml_barang - 1
            ]);
            return response()->json([
                "code" => 200,
                "status" => "Berhasil",
                "pesan" => "Update Data Berhasil Dilakukan"
            ],200);
        } catch (\Throwable $th) {
            return response()->json([
                "code" => 500, "status" => "Gagal", "pesan" => "Data Keranjang Gagal Diupdate"
            ],500);
        }
    }

    public function updateHarga(Request $request) {
        $item = Keranjang::where("id_keranjang",$request->id_keranjang)->first();
        if ($request->harga < $item->harga) {
            return response()->json([
                "code" => 500, "status" => "Gagal", "pesan" => "Harga Yang Dimasukan Tidak Valid"
            ],500);
        } else {
            $updated = $item->update([
                "harga" => $request->harga
            ]);
            return $updated === true
            ? response()->json(["code" => 200, "status" => "Berhasil", "pesan" => "Update Harga Berhasil Dilakukan"],200)
            : response()->json(["code" => 500, "status" => "Gagal", "pesan" => "Update Harg Gagal Dilakukan"]);
        }
    }

    public function hapusKeranjang(Request $request) {
        $item = Keranjang::where("id_keranjang", $request->id_keranjang)->first();
        $deleted = $item->delete();
        return $deleted === true
        ? response()->json(["code" => 200, "status" => "Berhasil", "pesan" => "Keranjang Berhasil Dihapus"],200)
        : response()->json(["code" => 500, "status" => "Gagal", "pesan" => "Keranjang Gagal Dihapus"],500);
    }

    public function total(Request $request) {
        $total = 0;
        $id_costumer = $request->id_costumer;
        $item = Keranjang::where("id_costumer",$id_costumer)->get();
        foreach ($item as $i) {
            $total += $i->jml_barang * $i->harga;
        }
        return response()->json([
            "code" => 200, "data" => $total
        ],200);
    }



}
