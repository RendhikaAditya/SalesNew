<?php

namespace App\Http\Controllers\Api;

use App\Models\Kota;
use App\Models\Sales;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SalesCostumerRegional extends Controller
{

    public function getSalesCostumer(Request $request) {
        $data = [];

        $sales = Sales::where('id_sales',$request->id_sales)->first();
        array_push($data ,[
            "sales" => [
                "nama_sales" => $sales->nama_sales,
                "alamat_sales" => $sales->alamat_sales,
                "nohp" => $sales->nohp,
                "gender_sales" => $sales->gender_sales,
                "username" => $sales->username,
                "kota" => []
            ],
            "costumer" => []
        ]);

        $id_kota = explode("-",$sales->id_kota);
        foreach ($id_kota as $i) {
            $kota = Kota::where('id',$i)->first();
            if ($kota !== null) {
                array_push($data[0]['sales']['kota'],
                    $kota->kabupaten_kota
                );
                foreach ($kota->costumer as $c) {
                    array_push($data[0]['costumer'], [
                        "costumer" => $c->nama_costumer
                    ]);
                    // array_unique($data[0]['costumer']);
                }
            }
        }
        return response()->json($data[0]);
    }

}
