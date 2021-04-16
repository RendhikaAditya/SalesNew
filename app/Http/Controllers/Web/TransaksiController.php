<?php

namespace App\Http\Controllers\Web;

use App\Exports\LaporanTransaksi;
use App\Models\Order;
// use App\Models\Detail_Order;
// use App\Models\Detail_Order;
use App\Models\Sales;
use App\Models\Costumer;
use App\Models\Detail_Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\LaporanTransaksi as ModelsLaporanTransaksi;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class TransaksiController extends Controller
{

    public function getData() {
        $order = Order::orderBy('id','desc')->get();
        return $order;
    }

    public function index()
    {
        $order_detail = $this->getData();
        return view("pages.supervisor.transaksi.index", compact("order_detail"));
    }

    public function filter(Request $request) {
        $costumer = $request->costumer;
        $sales = $request->sales;
        $tgl_awal = $request->tgl_awal;
        $tgl_akhir = $request->tgl_akhir;
        $order_detail = [];
        // Tidak ada filter
        if($costumer === null && $sales === null && $tgl_awal === null && $tgl_akhir === null) {
            $order_detail = $this->getData();
        } else if($costumer !== null && $sales === null && $tgl_awal === null && $tgl_akhir === null) {
            $cc = Costumer::where("nama_costumer", "LIKE", '%'.$costumer.'%')->get();
           foreach ($cc as $c) {
                foreach ($c->order as $o) {
                    array_push($order_detail,$o);
                }
            }
        } else if($sales !== null && $costumer === null && $tgl_akhir === null && $tgl_awal === null) {
            $ss = Sales::where("nama_sales", "LIKE", "%".$sales."%")->get();
            foreach ($ss as $s) {
                foreach ($s->order as $s) {
                    array_push($order_detail,$s);
                }
            }
        } else if($tgl_awal !== null && $tgl_akhir !== null) {
            $order_detail = Order::whereBetween("tgl_order", [$tgl_awal,$tgl_akhir])->get();
        }
        return view("pages.supervisor.transaksi.index", compact("order_detail"));
     }

    public function approve($o)
    {
        $detail_orders = Detail_Order::where("id_order",$o)->get();
        $edited = null;
        foreach ($detail_orders as $d) {
            // dd($d->order->costumer->reset === (int)date("m"));
            if($d->order->costumer->reset !== (int)date("m")) {
                $d->order->costumer->update([
                    "target_tercapai" => 0,
                    "reset" => (int) date("m")
                ]);
            }
            $edited = $d->update([
                "status" => 1
            ]);
            $target_tercapai = (int)$d->order->costumer->target_tercapai + ($d->harga * $d->jml_barang);
            $d->order->costumer->update([
                "target_tercapai" => $target_tercapai
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
            $target_tercapai = $d->order->costumer->target_tercapai -  $d->order->costumer->target_tercapai - ($d->harga * $d->jumlah);
            $d->order->costumer->update([
                "target_tercapai" => $target_tercapai
            ]);
            $edited = $d->update([
                "status" => "0"
            ]);
        }
        $edited === true
            ? Alert::success("Berhasil", "Transaksi Telah Dibatalkan")
            : Alert::error("Gagal", "Transaksi Gagak Dibatalkan");
        return redirect()->back();
    }

    public function detail($o) {
        $detail = Detail_Order::where("id_order",$o)->get();
        return view("pages.supervisor.transaksi.detail",compact("detail","o"));
    }

    public function prosesDetail(Request $request, $o) {
        $total = 0;
        foreach ($request->id_detail_order as $id => $d) {
            $detail = Detail_Order::where("id",$d)->first();
            $detail->update([
                "jml_barang" => $request->jumlah[$id],
                "harga" => $request->harga[$id]
            ]);
            $total += $detail->harga * $detail->jml_barang;
        }
        $order = Order::where("id_order",$o)->first();
        $order->update([
            "total_harga" => $total
        ]);
        Alert::success("Berhasil", "Detail Order Berhasil Diubah");
        return redirect()->route("listTransaksi");
    }

    public function download() {
        return Excel::download(new LaporanTransaksi, "laporan-transaksi.xlsx");
    }

    public function laporan() {
        $detail_order = Detail_Order::where("status",1)->orderBy('id', 'desc')->get();
        ModelsLaporanTransaksi::truncate();
        foreach ($detail_order as $d) {
           DB::table('laporan_transaksis')->insert([
                "id_order" => $d->id_order,
                "nama_barang" => $d->barang->nama_barang,
                "nama_costumer" => $d->order->costumer->nama_costumer,
                "nama_sales" => $d->order->sales->nama_sales,
                "jml_barang" => $d->jml_barang,
                "tgl_order" => $d->order->tgl_order,
                "status" => "Dikonfirmasi"
            ]);
        }
       return $this->download();
    }

    public function deleteTransaksi($o) {
        DB::table('detail_order')->where('id_order',$o)->delete();
        DB::table('order')->where('id_order',$o)->delete();
        Alert::success("Berhasil", "Data Transaksi Berhasil Diupdate");
        return redirect()->back();
    }

}
