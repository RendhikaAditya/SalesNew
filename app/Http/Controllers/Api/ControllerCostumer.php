<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Helpers\ResponseFormatter;
use App\Models\Costumer;
use Illuminate\Http\Request;

class ControllerCostumer extends Controller
{
    public function all()
    {
        $costumer = Costumer::get();



        if ($costumer->count() > 0) {
            return ResponseFormatter::success($costumer);
        } else {
            return ResponseFormatter::error(null, 404);
        }
    }

    public function getCostumer(Request $request)
    {
        $nama = $request->input('nama');


        $costumer = Costumer::where("nama_costumer", $nama)->limit(1)->get();
        // dd($costumer);

        if ($costumer->count() > 0) {
            return ResponseFormatter::success($costumer);
        } else {
            return ResponseFormatter::error(null, 404);
        }
    }
}
