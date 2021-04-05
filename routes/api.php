<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\ControllerBarang;
use App\Http\Controllers\Api\ControllerCostumer;
use App\Http\Controllers\Api\ControllerSales;

// use App\Http\Controllers\Api\ContollerBarang;
// use App\Http\Controllers\Api\ContollerCostumer;
// use App\Http\Controllers\Api\ContollerSales;
use App\Http\Controllers\Api\KeranjangController;
use App\Http\Controllers\Api\TransaksiController;

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
Route::get("/kategoriAll", [ControllerBarang::class, 'kategoriAll']);
Route::get("/costumer", [ControllerCostumer::class, 'all']);
Route::post("/costumer/get", [ControllerCostumer::class, 'getCostumer']);
Route::post("/sales/login", [ControllerSales::class, 'login']);

// Route::post("/barang", [ContollerBarang::class, 'all']);
// Route::get("/kategori", [ContollerBarang::class, 'kategori']);
// Route::get("/costumer", [ContollerCostumer::class, 'all']);
// Route::post("/sales/login", [ContollerSales::class, 'login']);

Route::group(["prefix" => "keranjang"], function () {
    Route::get('/total-belanja', [KeranjangController::class, "total"]);
    Route::post('/add', [KeranjangController::class, "add"]);
    Route::post('/update-tambah', [KeranjangController::class, 'updateTambah']);
    Route::post('/update-kurang', [KeranjangController::class, 'updateKurang']);
    Route::post('/update-harga', [KeranjangController::class, 'updateHarga']);
    Route::post('/hapus-keranjang', [KeranjangController::class, 'hapusKeranjang']);
});

Route::group(["prefix" => "transaksi"], function() {
    Route::post('', [TransaksiController::class, "transaksi"]);
});
