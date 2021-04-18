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

    public function getHargaApprove() {
        $order =  Order::all();
        $total = 0;
        foreach ($order as $o) {
            $o->detail_order[0]->status == 1 ? $total += $o->total_harga : "";
        }
        return $total;
    }

     public function getHargaNotApprove() {
        $order =  Order::all();
        $total = 0;
        foreach ($order as $o) {
            $o->detail_order[0]->status == 0 ? $total += $o->total_harga : "";
        }
        return $total;
    }

    public function index(Request $request)
    {
        $order_detail = $this->getData();
        $total_approve = $this->getHargaApprove();
        $total_notapprove = $this->getHargaNotApprove();
        $costumer = Costumer::all();
        $sales = Sales::all();
        session()->put("order_detail",$order_detail);
        return view("pages.supervisor.transaksi.index", compact("order_detail", "total_approve", "total_notapprove","costumer", "sales"));
    }

    public function filter(Request $request)
    {
        $costumer = $request->costumer;
        $sales = $request->sales;
        $tgl_awal = $request->tgl_awal;
        $tgl_akhir = $request->tgl_akhir;
        $total_approve = null;
        $total_notapprove = null;
        $order_detail = [];
        $filter = new FilterController();
        // Tidak ada filter
        if($costumer === null && $sales === null && $tgl_awal === null && $tgl_akhir === null) {
            $order_detail = $this->getData();
            $total_approve = $this->getHargaApprove();
            $total_notapprove = $this->getHargaNotApprove();
        } else if($costumer !== null && $sales === null && $tgl_awal === null && $tgl_akhir === null) {
            // Mencari  Data Costumer Untuk Data Transaksi
            $cc = Costumer::where("nama_costumer", "LIKE", '%'.$costumer.'%')->get();
            $total_approve = $filter->getTotalHarga(Costumer::class,"nama_costumer","id_costumer",$costumer,1);
            $total_notapprove = $filter->getTotalHarga(Costumer::class,"nama_costumer","id_costumer",$costumer,0);
            foreach ($cc as $c) {
                foreach ($c->order as $o) {
                    array_push($order_detail,$o);
                }
            }

        } else if($sales !== null && $costumer === null && $tgl_akhir === null && $tgl_awal === null) {
            // Mencari  Data Costumer Untuk Data Transaksi
            $ss = Sales::where("nama_sales", "LIKE", '%'.$sales.'%')->get();
            $total_approve = $filter->getTotalHarga(Sales::class,"nama_sales","id_sales",$sales,1);
            $total_notapprove = $filter->getTotalHarga(Sales::class,"nama_sales","id_sales",$sales,0);
            foreach ($ss as $s) {
                foreach ($s->order as $o) {
                    array_push($order_detail,$o);
                }
            }
        } else if($costumer === null && $sales === null && $tgl_awal !== null && $tgl_akhir !== null) {
            $order_detail = Order::whereBetween("tgl_order", [$tgl_awal,$tgl_akhir])->get();
            $total_approve = 0;
            $total_notapprove = 0;

            foreach ($order_detail as $od) {
                $od->detail_order[0]->status == 1
                ? $total_approve += $od->total_harga
                : $total_notapprove += $od->total_harga;
            }

        } elseif ($costumer !== null && $tgl_awal !== null && $tgl_akhir !== null && $sales === null) {
            $filter = new FilterController();
            $order_detail = $filter->getTotalBaseActor(Costumer::class,"nama_costumer",$costumer,$tgl_awal,$tgl_akhir,null);
            $total_approve = $filter->getTotalBaseActor(Costumer::class,"nama_costumer",$costumer,$tgl_awal,$tgl_akhir,1);
            $total_notapprove = $filter->getTotalBaseActor(Costumer::class,"nama_costumer",$costumer,$tgl_awal,$tgl_akhir,0);
        } else if($sales !== null && $tgl_awal !== null && $tgl_akhir !== null && $costumer === null) {
            $filter = new FilterController();
            $order_detail = $filter->getTotalBaseActor(Sales::class,"nama_sales",$sales,$tgl_awal,$tgl_akhir,null);
            $total_approve = $filter->getTotalBaseActor(Sales::class,"nama_sales",$sales,$tgl_awal,$tgl_akhir,1);
            $total_notapprove = $filter->getTotalBaseActor(Sales::class,"nama_sales",$sales,$tgl_awal,$tgl_akhir,0);
        } elseif($costumer !== null && $sales !== null && $tgl_awal === null && $tgl_akhir === null) {
            $d_costumer = Costumer::where("nama_costumer",$costumer)->first("id_costumer");
            $d_sales = Sales::where("nama_sales", $sales)->first("id_sales");
            $order_detail = Order::where("id_costumer",$d_costumer->id_costumer)->where("id_sales",$d_sales->id_sales)->get();
            foreach ($order_detail as $od) {
                $od->detail_order[0]->status == 1
                ? $total_approve += $od->total_harga
                : $total_notapprove += $od->total_harga;
            }
        } elseif($costumer !== null && $sales !== null && $tgl_awal !== null && $tgl_akhir !== null) {
            $d_costumer = Costumer::where("nama_costumer",$costumer)->first("id_costumer");
            $d_sales = Sales::where("nama_sales", $sales)->first("id_sales");
            $order_detail = Order::where("id_costumer",$d_costumer->id_costumer)
            ->where("id_sales",$d_sales->id_sales)
            ->whereBetween("tgl_order",[$tgl_awal,$tgl_akhir])->get();
            foreach ($order_detail as $od) {
                $od->detail_order[0]->status == 1
                ? $total_approve += $od->total_harga
                : $total_notapprove += $od->total_harga;
            }
        }
        $costumer = Costumer::all();
        $sales = Sales::all();
        session()->put("order_detail",$order_detail);
        return view("pages.supervisor.transaksi.index", compact("order_detail", "total_approve", "total_notapprove","costumer", "sales"));
    }

    public function approve($o)
    {
        $detail_orders = Detail_Order::where("id_order",$o)->get();
        $order = Order::where('id_order',$o)->first("total_harga");
        $edited = null;
        foreach ($detail_orders as $d) {
            if((int)$d->order->costumer->reset !== (int)date("m")) {
                $d->order->costumer->update([
                    "target_tercapai" => 0,
                    "reset" => (int) date("m")
                ]);
            }
            $edited = $d->update([
                "status" => 1
            ]);
            $target_tercapai = (int)$d->order->costumer->target_tercapai + (int)$order->total_harga;
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
        $order = Order::where('id_order',$o)->first();
        foreach ($detail_orders as $d) {
            $edited = $d->update([
                "status" => "0"
            ]);
        }
        // dd($order->costumer->target_tercapai);
        $order->costumer->update(["target_tercapai" => $order->costumer->target_tercapai - $order->total_harga]);
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

    public function laporan(Request $request) {
        $detail_order = session()->get("order_detail");
        ModelsLaporanTransaksi::truncate();
        foreach ($detail_order as $d) {
            foreach ($d->detail_order as $o) {
                if ($o->status == 1) {
                    DB::table('laporan_transaksis')->insert([
                         "id_order" => $o->id_order,
                         "nama_barang" => $o->barang->nama_barang,
                         "nama_costumer" => $o->order->costumer->nama_costumer,
                         "nama_sales" => $o->order->sales->nama_sales,
                         "jml_barang" => $o->jml_barang,
                         "tgl_order" => $o->order->tgl_order,
                         "status" => "Dikonfirmasi"
                     ]);
                }
            }
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
