<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use DB;

class KeranjangController extends Controller
{
    public function add(Request $request)
    {
        try {
            $barang = Barang::where("id_barang", $request->id_barang)->first();
            $created = Keranjang::create([
                "id_costumer" => $request->input("id_costumer"),
                "id_sales" => $request->input("id_sales"),
                "id_barang" => $request->input("id_barang"),
                "jml_barang" => $request->input("jml_barang"),
                "harga" => $barang->harga_barang
            ]);
            return response()->json([
                "code" => 200, "status" => "Berhasil", "pesan" => "Data Berhasil Masuk Keranjang",
                "data" => $created
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                "code" => 500, "status" => "Gagal", "pesan" => "Data Gagal Masuk Keranjang"
            ], 500);
        }
    }

    public function updateTambah(Request $request)
    {
        try {
            $id_barang = $request->input("id_barang");
            $id_costumer = $request->input("id_costumer");
            $item = Keranjang::where("id_barang", $id_barang)->where("id_costumer", $id_costumer)->first();
            $updated = $item->update([
                "jml_barang" => $item->jml_barang + 1
            ]);
            return response()->json([
                "code" => 200,
                "status" => $updated === true ?  "Berhasil" : "Gagal",
                "pesan" => $updated === true ? "Data Keranjang Berhasil Diupdate" : "Data Keranjang Gagal Diupdate"
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                "code" => 500, "status" => "Gagal", "pesan" => "Data Keranjang Gagal Diupdate"
            ], 500);
        }
    }

    public function updateKurang(Request $request)
    {
        try {
            $id_barang = $request->input("id_barang");
            $id_costumer = $request->input("id_costumer");
            $item = Keranjang::where("id_barang", $id_barang)->where("id_costumer", $id_costumer)->first();
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
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                "code" => 500, "status" => "Gagal", "pesan" => "Data Keranjang Gagal Diupdate"
            ], 500);
        }
    }

    public function updateHarga(Request $request)
    {
        $item = Keranjang::where("id_keranjang", $request->id_keranjang)->first();
        if ($request->harga < $item->harga) {
            return response()->json([
                "code" => 500, "status" => "Gagal", "pesan" => "Harga Yang Dimasukan Tidak Valid"
            ], 500);
        } else {
            $updated = $item->update([
                "harga" => $request->harga
            ]);
            return $updated === true
                ? response()->json(["code" => 200, "status" => "Berhasil", "pesan" => "Update Harga Berhasil Dilakukan"], 200)
                : response()->json(["code" => 500, "status" => "Gagal", "pesan" => "Update Harg Gagal Dilakukan"]);
        }
    }

    public function hapusKeranjang(Request $request)
    {
        $item = Keranjang::where("id_keranjang", $request->id_keranjang)->first();
        $deleted = $item->delete();
        return $deleted === true
            ? response()->json(["code" => 200, "status" => "Berhasil", "pesan" => "Keranjang Berhasil Dihapus"], 200)
            : response()->json(["code" => 500, "status" => "Gagal", "pesan" => "Keranjang Gagal Dihapus"], 500);
    }

    public function total(Request $request)
    {
        $total = 0;
        $id_costumer = $request->id_costumer;
        $item = Keranjang::where("id_costumer", $id_costumer)->get();
        foreach ($item as $i) {
            $total += $i->jml_barang * $i->harga;
        }
        return response()->json([
            "code" => 200, "data" => $total
        ], 200);
    }


    public function keranjangCostumer(Request $request)
    {
        // $id_costumer = $request->input('idCost');
        $id = $request->input('id');
        // $id = 1;
        // $barang = Barang::select('barang.id_barang', 'barang.nama_barang', 'barang.harga_barang', 'kategori.id_kategori', 'keranjang.jml_barang', 'keranjang.id_costumer', 'barang.foto_barang', 'keranjang.harga AS hargaSementara');

        // $barang->leftJoin(
        //     'kategori',
        //     function ($join) {
        //         $join->on('barang.id_kategori', '=', 'kategori.id_kategori');
        //         return $join;
        //     }
        // )->leftJoin(
        //     'keranjang',
        //     function ($join1) {
        //         $join1->on('barang.id_barang', '=', 'keranjang.id_barang');
        //         return $join1;
        //     }
        // )->where('keranjang.id_costumer', '=', $id)->get();

        $barang = DB::table('keranjang')
            ->leftJoin('barang', 'barang.id_barang', '=', 'keranjang.id_barang')
            ->leftJoin('kategori', 'barang.id_kategori', '=', 'kategori.id_kategori')
            ->where('keranjang.id_costumer', '=', $id)
            ->get();


        if ($barang) {
            return response()->json([
                "code" => 200,
                "status" => "Berhasil",
                "data" => $barang
            ], 200);
        } else {
            return ResponseFormatter::error(null, 404);
        }
    }
}
