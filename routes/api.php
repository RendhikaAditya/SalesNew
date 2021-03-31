<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ControllerBarang;
use App\Http\Controllers\Api\ControllerCostumer;
use App\Http\Controllers\Api\ControllerSales;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post("/barang", [ControllerBarang::class, 'all']);
Route::get("/kategori", [ControllerBarang::class, 'kategori']);
Route::get("/costumer", [ControllerCostumer::class, 'all']);
Route::post("/costumer/get", [ControllerCostumer::class, 'getCostumer']);
Route::post("/sales/login", [ControllerSales::class, 'login']);
