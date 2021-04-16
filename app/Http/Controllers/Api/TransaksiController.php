<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use App\Models\Order;
use App\Models\Keranjang;
use App\Models\Detail_Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\BentukPembayaran;
use DB;

class TransaksiController extends Controller
{

    public function transaksi(Request $request)
    {
        try {
            $jenis_bayar = $request->input('jenis_bayar');
            $keranjang = Keranjang::where("id_costumer", $request->id_costumer)->where("id_sales", $request->id_sales)->get();
            $total = 0;
            $idOrder = date("dmY") . "ORD" . rand(0,rand() * 100);
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
                "tgl_order" => date("Y-m-d"),
                "bentuk_pembayaran" => $jenis_bayar
            ]);
            return response()->json([
                "code" => 200,
                "pesan" => "Data Berhasil Masuk Orderan",
                "status" => "Berhasil"
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                "code" => 500,
                "pesan" => $th->getMessage(),
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

    public function riwayatTransaksi(Request $request)
    {


        if ($request->has('id')) {
            $ids = $request->input('id');
            $barang = Order::select()
                ->where('id_sales', '=',  $ids)
                ->leftJoin('costumer', 'costumer.id_costumer', 'order.id_costumer')
                ->orderBy('order.id', 'DESC')
                ->get();
        } else {
            $barang = Order::select()
                ->leftJoin('costumer', 'costumer.id_costumer', 'order.id_costumer')
                ->orderBy('order.id', 'DESC')
                ->get();
        }

        foreach ($barang as $i => $memu) {
            $idORd = $memu['id_order'];
            $data = Detail_Order::select()->where('id_order', '=', $idORd);
            $num = $data->count();
            $barang[$i]["jumlah"] = $num;
        }

        // dd($barang->toSql());

        if ($barang) {
            return ResponseFormatter::success($barang);
        } else {
            return ResponseFormatter::error(null, 404);
        }
    }

    public function barangRiwayat(Request $request)
    {

        $ids = $request->input('id');
        $barang = Detail_Order::select()
            ->where('id_order', '=',  $ids)
            ->leftJoin('barang', 'barang.id_barang', 'detail_order.id_barang')
            ->orderBy('id', 'DESC')
            ->get();


        // foreach ($barang as $i => $memu) {
        //     $idORd = $memu['id_order'];
        //     $data = Detail_Order::select()->where('id_order', '=', $idORd);
        //     $num = $data->count();
        //     $barang[$i]["jumlah"] = $num;
        // }

        // dd($barang);

        if ($barang) {
            return ResponseFormatter::success($barang);
        } else {
            return ResponseFormatter::error(null, 404);
        }
    }

    public function bentukBayar()
    {
        $bayar = BentukPembayaran::get();

        if ($bayar) {
            return ResponseFormatter::success($bayar);
        } else {
            return ResponseFormatter::error(null, 404);
        }
    }
}
