<?php

namespace App\Http\Controllers\Web;

use App\Models\Sales;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Sales\AddSalesRequest;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\Sales\SalesRequest;

class SalesController extends Controller
{

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
        return view("pages.sales.add");
    }

    public function postAddSales(AddSalesRequest $request) {
        $data = $request->all();
        $data["password"] = bcrypt($request->password);
        $created = Sales::create($data);
        $created->id_sales > 0
        ? Alert::success("Berhasil", "Data Berhasil Ditambahkan")
        : Alert::error("Error", "Data Gagal Ditambahkan");
        return redirect()->route("listSales");
    }

}
