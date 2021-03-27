<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Helpers\ResponseFormatter;
use App\Models\Costumer;
use App\Models\Kategori;
use Illuminate\Http\Request;

class ContollerCostumer extends Controller
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
}
