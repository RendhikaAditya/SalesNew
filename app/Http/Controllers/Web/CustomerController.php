<?php

namespace App\Http\Controllers\Web;

use App\Models\Kota;
use App\Models\Costumer;
use App\Models\Provinsi;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\Costumer\CostumerRequest;

class CustomerController extends Controller
{
    public $prov, $kota, $kecamatan, $kelurahan;

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

    public function format($num) {
        return implode("",explode(",",$num));
    }

    public function index() {
        $costumer = Costumer::get();
        return view("pages.customer.index",compact("costumer"));
    }

    public function getUpdateCostumer(Costumer $c) {
        $prov = $this->prov;
        $kota = $this->kota;
        $kec = $this->kecamatan;
        $kelurahan = $this->kelurahan;
        return view("pages.customer.update",compact("c","prov","kota","kec","kelurahan"));
    }

    public function putUpdateCostumer(CostumerRequest $request, Costumer $c) {
        $data = $request->all();
        $data["targer_harga_costumer"] = (int) $this->format($request->targer_harga_costumer);
        $updated = $c->update($data);
        $updated === true
        ? Alert::success("Berhasil", "Update Data Berhasil Dilakukan")
        : Alert::error("Gagal", "Uodate Data Gagal Dilakukan");
        return redirect()->route("listCustomer");
    }


    public function getAddCostumer() {
        $prov = $this->prov;
        $kota = $this->kota;
        $kec = $this->kecamatan;
        $kelurahan = $this->kelurahan;
        return view("pages.customer.add",compact("prov","kota","kec","kelurahan"));
    }

    public function postAddCostumer(CostumerRequest $request) {
        $data = $request->all();
        $data["targer_harga_costumer"] = (int) $this->format($request->targer_harga_costumer);
        $data["target_tercapai"] = 0;
        $data["reset"] = (int)date("m");

        $created = Costumer::create($data);
        $created->id_costumer > 0
        ? Alert::success("Berhasil", "Data Berhasil Ditambahkan")
        : Alert::error("Gagal", "Data Gagal Ditambhkan");
        return redirect()->route("listCustomer");
    }

    public function deleteCostumer(Costumer $c) {
        $deleted = $c->delete();
        $deleted === true
        ? Alert::success("Berhasil", "Data Berhasil Dihapus")
        : Alert::error("Gagal", "Data Gagak Dihapus");
        return redirect()->back();
    }

}
