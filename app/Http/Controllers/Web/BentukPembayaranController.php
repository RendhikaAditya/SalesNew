<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\BentukPembayaran;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BentukPembayaranController extends Controller
{

    public function index() {
        $bentuk_pembayaran = BentukPembayaran::get();
        return view("pages.pembayaran.index",compact("bentuk_pembayaran"));
    }

    public function getAddPembayaran() {
        return view("pages.pembayaran.add");
    }

    public function postAddPembayaran(Request $request) {
        $request->validate([
            "bentuk_pembayaran" => ["required"]
        ]);
        BentukPembayaran::create($request->all());
        Alert::success("Berhasil", "Bentuk Pembayaran Berhasil Ditambahkan");
        return redirect()->route("listBentukPembayaran");
    }

    public function deletePembayaran(BentukPembayaran $b) {
        $b->delete();
        Alert::success("Berhasil", "Bentuk Pembayaran Berhasil Dihapus");
        return redirect()->back();
    }

    public function getPutPembayaran(BentukPembayaran $b) {
        return view("pages.pembayaran.update",compact("b"));
    }

    public function updatePutPembayaran(Request $request, BentukPembayaran $b) {
        $b->update($request->all());
        Alert::success("Berhasil", "Data Berhasil Diupdate");
        return redirect()->route("listBentukPembayaran");
    }

}
