<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SupervisorController extends Controller
{

    public function index() {
        $transaksi = new TransaksiController();
        return $transaksi->index();
    }

}
