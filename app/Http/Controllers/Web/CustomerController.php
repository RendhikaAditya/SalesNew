<?php

namespace App\Http\Controllers\Web;

use App\Models\Costumer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\Costumer\CostumerRequest;

class CustomerController extends Controller
{

    public function format($num) {
        return implode("",explode(",",$num));
    }

    public function index() {
        $costumer = Costumer::get();
        return view("pages.customer.index",compact("costumer"));
    }

    public function getUpdateCostumer(Costumer $c) {
        return view("pages.customer.update",compact("c"));
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
        return view("pages.customer.add");
    }

    public function postAddCostumer(CostumerRequest $request) {
        $data = $request->all();
        $data["targer_harga_costumer"] = (int) $this->format($request->targer_harga_costumer);
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
