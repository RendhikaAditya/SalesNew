<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Sales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ControllerSales extends Controller
{
    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required|min:6'
        ]);

        $username = $request->input('username');
        $password = $request->input('password');

        $sales = Sales::where('username', $username)->first();
        if (!$sales) {
            return response()->json(['message' => "Username Not Found", 'code' => "401"], 401);
        }

        $isValidate = Hash::check($password, $sales->password);
        if (!$isValidate) {
            return response()->json(['message' => "Login Failed", 'code' => "401"], 401);
        }

        return response()->json(['status' => 'Sukses', 'code' => '200', 'data' => $sales]);
    }
}
