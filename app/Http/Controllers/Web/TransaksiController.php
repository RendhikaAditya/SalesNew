<?php

namespace App\Http\Controllers\Web;

use App\Models\Detail_Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class TransaksiController extends Controller
{

    public function index() {
        $order = Detail_Order::get();
        return view("pages.supervisor.transaksi.index",compact("order"));
    }

    public function approve(Detail_Order $o) {
        $edited = $o->update([
            "status" => "1"
        ]);
        $edited === true
        ? Alert::success("Berhasil", "Transaksi Telah Disetujui")
        : Alert::error("Gagal", "Transaksi Gagal Dilakukan");
        return redirect()->back();
    }

    public function unapprove(Detail_Order $o) {
        $edited = $o->update([
            "status" => "0"
        ]);
        $edited === true
        ? Alert::success("Berhasil", "Transaksi Telah Dibatalkan")
        : Alert::error("Gagal", "Transaksi Gagak Dibatalkan");
        return redirect()->back();
    }

}
