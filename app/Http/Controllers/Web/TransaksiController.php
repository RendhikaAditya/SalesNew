<?php

namespace App\Http\Controllers\Web;

use App\Models\Order;
// use App\Models\Detail_Order;
// use App\Models\Detail_Order;
use App\Models\Detail_Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class TransaksiController extends Controller
{

    public function index()
    {
        $order = DB::table('order')->get();

        $order_detail = [];
        foreach ($order as $no => $row) {
            $od = DB::table('detail_order')
                ->join('order', 'order.id_order', '=', 'detail_order.id_order')
                ->select(
                    DB::raw('count(detail_order.id_order) as id_order'),
                )
                ->groupBy('detail_order.id_order')
                ->where('detail_order.id_order', '=', $row->id_order)
                ->first();

            $ord = DB::table('order')
                ->join('costumer', 'order.id_costumer', 'costumer.id_costumer')
                ->join('sales', 'order.id_sales', 'sales.id_sales')
                ->join('detail_order', 'detail_order.id_order', 'order.id_order')
                ->select(
                    DB::raw('costumer.nama_costumer'),
                    DB::raw('sales.nama_sales'),
                    DB::raw('order.total_harga'),
                    DB::raw('order.tgl_order'),
                    DB::raw('order.id_order'),
                    DB::raw('detail_order.status')
                )
                ->first();

            $order_detail[] = [
                'total' => $od->id_order,
                'customer' => $ord->nama_costumer,
                'sales' => $ord->nama_sales,
                'harga' => $ord->total_harga,
                'tgl_order' => $ord->tgl_order,
                'id_order' => $ord->id_order,
                'status' => $ord->status
            ];
        }
        // dd($order_detail);
        // $order = DB::table('detail_order')
        //     ->join('order', 'order.id_order', '=', 'detail_order.id_order')
        //     ->join('costumer', 'order.id_costumer', '=', 'costumer.id_costumer')
        //     ->select(
        //         DB::raw('count(detail_order.id_order)'),
        //         DB::raw('costumer.nama_costumer'),
        //     )
        //     ->groupBy('detail_order.id_order')
        //     ->get();

        // dd($order);
        // dd($order_detail);
        return view("pages.supervisor.transaksi.index", compact("order_detail"));
    }

    public function approve($o)
    {
        $detail_orders = Detail_Order::where("id_order",$o)->get();
        $edited = null;
        foreach ($detail_orders as $d) {
            $edited = $d->update([
                "status" => 1
            ]);
        }
        $edited === true
            ? Alert::success("Berhasil", "Transaksi Telah Disetujui")
            : Alert::error("Gagal", "Transaksi Gagal Dilakukan");
        return redirect()->back();
    }

    public function unapprove($o)
    {
        $edited = null;
        $detail_orders = Detail_Order::where("id_order",$o)->get();
        foreach ($detail_orders as $d) {
            $edited = $d->update([
                "status" => "0"
            ]);
        }
        $edited === true
            ? Alert::success("Berhasil", "Transaksi Telah Dibatalkan")
            : Alert::error("Gagal", "Transaksi Gagak Dibatalkan");
        return redirect()->back();
    }
}
