<?php

namespace App\Http\Controllers\Web;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FilterController extends Controller
{
    public function getTotalHarga($modelActor, $fieldNama ,$fieldOrder,$namaActor,$status) {
        $arr = [];
        $total = 0;
         // Data Costumer Untuk Hitung Total
         $data = $modelActor::where($fieldNama,$namaActor)->first($fieldOrder);

         // Mencari Order Dengan id_costumer yang dicari
         $total_approve = Order::where($fieldOrder,$data->$fieldOrder)->get();

         // Proses kalkulasi total
         foreach ($total_approve as $ta) {
             if($ta->detail_order[0]->status == $status) {
                 array_push($arr, $ta);
             }
         }

         foreach ($arr as $aa) {
             $total += $aa->total_harga;
         }
         return $total;
    }

    public function getTotalBaseActor($model,$actorField,$actorName,$tgl_awal,$tgl_akhir,?int $status = null) {
        $total = 0;
        $actor = $model::where($actorField,$actorName,)->first();
        $order_detail = $actor->order()->whereBetween("tgl_order",[$tgl_awal,$tgl_akhir])->get();
        if ($status === null) {
            return $order_detail;
        }
        foreach ($order_detail as $o) {
            $o->detail_order[0]->status == $status
            ? $total += $o->total_harga
            : "";
        }
        return $total;
    }

}
