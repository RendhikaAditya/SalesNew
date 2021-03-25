<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function getLogin() {
        return view("login");
    }

    public function postLogin(LoginRequest $request) {
        if (Auth::attempt(["email" => $request->email, "password" => $request->password])) {
            return redirect()->route("adminIndex");
        } else {
            Alert::error("Gagal", "Kamu Gagal Login");
            return redirect()->back();
        }
    }

}
