<?php

namespace App\Http\Controllers\Web;

use App\Models\Kota;
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
        $data = [];
        $sales = Sales::get();
        foreach ($sales as $s) {
            array_push($data,[
                "id" => $s->id_sales,
                "nohp" => $s->nohp,
                "username" => $s->username,
                "nama_sales" => $s->nama_sales,
                "alamat_sales" => $s->alamat_sales,
                "gender_sales" => $s->gender_sales,
                "provinsi" => $s->provinsi->provinsi,
                "id_kota" => $s->id_kota,
                "kota" => []
            ]);
        }
        // $kota = '';
        foreach ($sales as $no => $s) {
            $id_kota = explode("-",$s->id_kota);
            foreach ($id_kota as $i) {
                if ($i !== "") {
                    $kotaGet = Kota::where('id',$i)->first();
                    array_push($data[$no]['kota'],$kotaGet->kabupaten_kota);
                }
            }
        }
        // dd($data);
        return view("pages.sales.index",compact("data"));
    }

    public function getUpdateSales($s)
    {   $data = Sales::where('id_sales',$s)->first();
        $prov = $this->prov;
        $kota = $this->kota;
        $id_kota = explode("-", $data->id_kota);
        return view("pages.sales.update",compact("data","prov","kota", "id_kota"));
    }

    public function putUpdateSales(SalesRequest $request, Sales $s) {
        $id_kota = "";
        foreach ($request->id_kota as $no => $k) {
            $id_kota.=$k.="-";
        }
        $data = $request->all();
        $data['id_kota'] = $id_kota;
        $data['umur_sales'] = 0;
        $updated = $s->update($data);
        $updated === true
        ? Alert::success("Berhasil", "Update Data Berhasil Dilakukan")
        : Alert::error("Gagal", "Update Data Gagal Dilakukan");
        return redirect()->route("listSales");
    }

    public function deleteSales($s) {
        $data = Sales::where('id_sales',$s)->first();
        $deleted = $data->delete();
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
        $id_kota = "";
        foreach ($request->id_kota as $no => $k) {
            $id_kota.=$k.="-";
        }
        $data = $request->all();
        $data["password"] = Hash::make($request->password);
        $data['id_kota'] = $id_kota;
        $data['umur_sales'] = 0;
        // dd($data['id_kota']);
        $created = Sales::create($data);
        $created->id_sales > 0
        ? Alert::success("Berhasil", "Data Berhasil Ditambahkan")
        : Alert::error("Error", "Data Gagal Ditambahkan");
        return redirect()->route("listSales");
    }

}
