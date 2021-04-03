<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use App\Models\Keranjang;
use App\Models\Detail_Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransaksiController extends Controller
{

    public function transaksi(Request $request) {
        try {
            $keranjang = Keranjang::where("id_costumer",$request->id_costumer)->where("id_sales",$request->id_sales)->get();
            foreach ($keranjang as $k) {
                $order = Order::create([
                    "id_order" => date("dmY")."ORD".date("His"),
                    "id_costumer" => $k->id_costumer,
                    "id_sales" => $k->id_sales,
                    "total_harga" => $k->jml_barang * $k->harga,
                    "tgl_order" => date("Y-m-d")
                ]);
                // return response()->json($order->id_order);
                $detail = Detail_Order::create([
                    "id_order" => $order->id,
                    "id_barang" => $k->id_barang,
                    "jml_barang" => $k->jml_barang
                ]);
                $k->delete();
            }
        return response()->json([
            "code" => 200,
            "pesan" => "Data Berhasil Masuk Orderan",
            "status" => "Berhasil"
        ],200);
        } catch (\Throwable $th) {
            return response()->json([
                "code" => 500,
                "pesan" => "Data Gagal Masuk Order",
                "status" => "Gagal"
            ],500);
        }

    }

}
