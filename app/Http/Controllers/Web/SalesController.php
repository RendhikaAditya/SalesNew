<?php

namespace App\Http\Controllers\Web;

use App\Models\Sales;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\Sales\SalesRequest;
use App\Http\Requests\Sales\AddSalesRequest;

class SalesController extends Controller
{
    public function __construct()
    {
        $this->prov = Provinsi::where('id',3)->first();

        $this->kota =  DB::table("tbl_provinsi")
        ->join('tbl_kabkot' ,'tbl_provinsi.id', '=', 'tbl_kabkot.provinsi_id')
        ->where('tbl_provinsi.id',3)->get(["tbl_kabkot.kabupaten_kota", "tbl_kabkot.id"]);

        $this->kecamatan =  DB::table("tbl_provinsi")
        ->join('tbl_kabkot' ,'tbl_provinsi.id', '=', 'tbl_kabkot.provinsi_id')
        ->join('tbl_kecamatan', 'tbl_kabkot.id', '=', 'tbl_kecamatan.kabkot_id')
        ->where("tbl_provinsi.id",3)->get(["tbl_kecamatan.id","tbl_kecamatan.kecamatan"]);

        $this->kelurahan = DB::table("tbl_provinsi")
        ->join('tbl_kabkot' ,'tbl_provinsi.id', '=', 'tbl_kabkot.provinsi_id')
        ->join('tbl_kecamatan', 'tbl_kabkot.id', '=', 'tbl_kecamatan.kabkot_id')
        ->join('tbl_kelurahan', 'tbl_kecamatan.id', '=', 'tbl_kelurahan.kecamatan_id')
        ->where('tbl_provinsi.id',3)->get(["tbl_kelurahan.kelurahan", "tbl_kelurahan.id"]);
    }

    public function index() {
        $sales = Sales::get();
        return view("pages.sales.index",compact("sales"));
    }

    public function getUpdateSales(Sales $s) {
        return view("pages.sales.update",compact("s"));
    }

    public function putUpdateSales(SalesRequest $request, Sales $s) {
        $updated = $s->update($request->all());
        $updated === true
        ? Alert::success("Berhasil", "Update Data Berhasil Dilakukan")
        : Alert::error("Gagal", "Update Data Gagal Dilakukan");
        return redirect()->route("listSales");
    }

    public function deleteSales(Sales $s) {
        $deleted = $s->delete();
        $deleted === true
        ? Alert::success("Berhasil", "Hapus Data Berhasil Dilakukan")
        : Alert::error("Gagal", "Hapus Data Gagal Dilakukan");
        return redirect()->back();
    }

    public function getAddSales() {
        $prov = $this->prov;
        $kota = $this->kota;
        $kec = $this->kecamatan;
        $kelurahan = $this->kelurahan;
        return view("pages.sales.add",compact("prov","kota","kec","kelurahan"));
    }

    public function postAddSales(AddSalesRequest $request) {
        $data = $request->all();
        $data["password"] = Hash::make($request->password);
        $created = Sales::create($data);
        $created->id_sales > 0
        ? Alert::success("Berhasil", "Data Berhasil Ditambahkan")
        : Alert::error("Error", "Data Gagal Ditambahkan");
        return redirect()->route("listSales");
    }

}
