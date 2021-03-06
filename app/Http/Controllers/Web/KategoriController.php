<?php

namespace App\Http\Controllers\Web;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class KategoriController extends Controller
{

    public function index() {
        $kategori = Kategori::get();
        return view("pages.kategori.index",compact("kategori"));
    }

    public function getUpdateKategori(Kategori $k) {
        return view("pages.kategori.update",compact("k"));
    }

    public function putUpdateKategori(Request $request, Kategori $k) {
        $request->validate([
            "nama_kategori" => ["required"]
        ]);
        !empty($k->gambar) ? Storage::delete($k->gambar) : "";
        $data = $request->all();
        $data["gambar"] = $request->file("gambar")->store("kategori");
        $edited = $k->update($data);
        $edited === true
        ? Alert::success("Berhasil", "Update Data Berhasil Dilakukan")
        : Alert::error("Gagal", "Update Data Gagal Dilakukan");
        return redirect()->route("listBarang");
    }

    public function deleteKategori(Kategori $k) {
        Storage::delete($k->gambar);
        $deleted = $k->delete();
        $deleted === true
        ? Alert::success("Berhasil", "Data Berhasil Dihapus")
        : Alert::error("Gagal", "Data Gagal Dihapus");
        return redirect()->back();
    }

    public function getAddKategori() {
        return view("pages.kategori.add");
    }

    public function postAddKategori(Request $request) {
        $request->validate([
            "nama_kategori" => ["required", "unique:kategori,nama_kategori"]
        ]);
        $data = $request->all();
        $data["gambar"] = $request->file("gambar")->store("kategori");
        $created = Kategori::create($data);
        $created->id_kategori > 0
        ? Alert::success("Berhasil", "Data Berhasil Ditambahkan")
        : Alert::error("Gagal", "Data Gagal Ditambahkan");
        return redirect()->route("listKategori");
    }

}
