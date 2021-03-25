<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;

class BarangController extends Controller
{
    public function index()
    {


        return ResponseFormatter::success("d", 'd');

        // return view('user.index', ['users' => $users]);
    }
}
