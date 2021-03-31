<?php

namespace App\Http\Controllers\Web;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use function PHPUnit\Framework\isNull;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\Barang\UpdateBarangRequest;

class BarangController extends Controller
{

    public function index() {
        $barang = Barang::get();
        return view("pages.barang.index",compact("barang"));
    }

    public function getUpdateBarang(Barang $b) {
        $kategori = Kategori::get();
        return view("pages.barang.update",compact("b", "kategori"));
    }

    public function putUpdateBarang(UpdateBarangRequest $request, Barang $b) {
        $filename = $request->foto_barang === null ? $b->foto_barang : $request->file("foto_barang")->store("barang");
        $request->foto_barang === null ? "" : Storage::delete($b->foto_barang);
        $data = $request->all();
        $data["foto_barang"] = $filename;
        $edited = $b->update($data);
        $edited === true
        ? Alert::success("Berhasil", "Update Data Berhasil Dilakukan")
        : Alert::error("Gagal", "Update Data Gagal Dilakukan");
        return redirect()->route("listBarang");
    }

    public function getAddBarang() {
        $kategori = Kategori::get();
        return view("pages.barang.add",compact("kategori"));
    }

    public function postAddBarang(UpdateBarangRequest $request) {
        $data = $request->all();
        $filename = $request->foto_barang !== null ? $request->file("foto_barang")->store("barang") : "Tidak Ada Foto";
        $data["foto_barang"] = $filename;
        $created = Barang::create($data);
        $created->id_barang > 0
        ? Alert::success("Berhasil", "Data Berhasil Ditambahkan")
        : Alert::error("Gagal", "Data Gagal Ditambahkan");
        return redirect()->route("listBarang");
    }

    public function deleteBarang(Barang $b) {
        $b->foto_barang !== null && $b->foto_barang !== "Tidak Ada Foto" ? Storage::delete($b->foto_barang) : "";
        $deleted = $b->delete();
        $deleted === true
        ? Alert::success("Berhasil", "Data Berhasil Dihapus")
        : Alert::error("Gagal", "Data Gagal Dihapus");
        return redirect()->back();
    }

}
