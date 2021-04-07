<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use App\Models\Keranjang;
use App\Models\Detail_Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class TransaksiController extends Controller
{

    public function transaksi(Request $request)
    {
        try {
            $keranjang = Keranjang::where("id_costumer", $request->id_costumer)->where("id_sales", $request->id_sales)->get();
            $total = 0;
            $idOrder = date("dmY") . "ORD" . date("His");
            foreach ($keranjang as $k) {
                // return response()->json($order->id_order);
                $detail = Detail_Order::create([
                    "id_order" => $idOrder,
                    "id_barang" => $k->id_barang,
                    "jml_barang" => $k->jml_barang,
                    "harga" => $k->harga
                ]);
                $total +=  $k->jml_barang * $k->harga;
                $k->delete();
            }

            $order = Order::create([
                "id_order" => $idOrder,
                "id_costumer" => $request->id_costumer,
                "id_sales" => $request->id_sales,
                "total_harga" => $total,
                "tgl_order" => date("Y-m-d")
            ]);
            return response()->json([
                "code" => 200,
                "pesan" => "Data Berhasil Masuk Orderan",
                "status" => "Berhasil"
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                "code" => 500,
                "pesan" => "Data Gagal Masuk Order",
                "status" => "Gagal"
            ], 500);
        }
    }

    public function ambil_histori(Request $request)
    {
        $idCost = $request->input("id");
        // cari terlebih dahulu data di transaksi_detail

        $transaks = DB::table('detail_order')
            ->leftJoin('order', 'order.id_order', '=', 'detail_order.id_order')
            ->where('order.id_costumer', '=', $idCost)
            ->orderBy('detail_order.created_at', 'DESC')
            ->first();

        $idSales = $transaks->id_sales;
        $idOrd = $transaks->id_order;

        $transaksi_detail = DB::table('detail_order')
            ->where('id_order', '=', $idOrd)
            ->get();

        // dd($transaksi_detail);
        // kemudian pindahkan ia kebali ke tabel transaksi_tmp
        foreach ($transaksi_detail as $no => $row) {
            // dd($transaksi_detail);
            DB::table('keranjang')
                ->insert([
                    'id_costumer' => $idCost,
                    'id_sales' => $idSales,
                    'id_barang' => $row->id_barang,
                    'jml_barang' => $row->jml_barang,
                    'harga' => $row->harga,
                ]);
        }

        // // hapus data di bagian transaksi
        // DB::table('order')
        //     ->where('order.id_order', '=', $idOrd)
        //     ->delete();

        // // hapus data di bagian transaksi detail
        // DB::table('detail_order')
        //     ->where('detail_order.id_order', '=', $idOrd)
        //     ->delete();

        return response()->json([
            "code" => 200,
            "pesan" => "Data Berhasil Masuk Orderan",
            "status" => "Berhasil"
        ], 200);

        // // redirect ke riwayat
        // return redirect()->route('user.transaksiwaiting')->with('success', 'Transaksi Berhasil Dibatalkan!');
    }
}
