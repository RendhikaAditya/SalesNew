<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\AdminController;
use App\Http\Controllers\Web\BarangController;
use App\Http\Controllers\Web\CustomerController;
use App\Http\Controllers\Web\KategoriController;
use App\Http\Controllers\Web\SalesController;
use App\Models\Barang;

Route::get('/', [AuthController::class, 'getLogin'])->name("login");
Route::post('/', [AuthController::class, 'postLogin']);

Route::group(["prefix" => "admin"],function() {
    Route::get("", [AdminController::class, 'index'])->name("adminIndex");

    Route::group(["prefix" => "sales"],function() {
        Route::get("", [SalesController::class, "index"])->name("listSales");
        Route::get("/update/{s:id_sales}", [SalesController::class, 'getUpdateSales'])->name("updateSales");
        Route::put("/update/{s:id_sales}", [SalesController::class, "putUpdateSales"]);
        Route::delete("/delete/{s:id_sales}", [SalesController::class, 'deleteSales'])->name("deleteSales");
        Route::get('/add', [SalesController::class,'getAddSales'])->name("addSales");
        Route::post('/add', [SalesController::class,'postAddSales']);
    });

    Route::group(["prefix" => "barang"],function() {
        Route::get("", [BarangController::class, "index"])->name("listBarang");
        Route::get('/update/{b:id_barang}', [BarangController::class,'getUpdateBarang'])->name("updateBarang");
        Route::put('/update/{b:id_barang}', [BarangController::class, "putUpdateBarang"]);
        Route::get('/add', [BarangController::class, "getAddBarang"])->name("addBarang");
        Route::post('/add', [BarangController::class, "postAddBarang"]);
        Route::delete('/delete/{b:id_barang}', [BarangController::class, 'deleteBarang'])->name("deleteBarang");
    });

    Route::group(["prefix" => "kategori"],function() {
        Route::get('', [KategoriController::class, "index"])->name("listKategori");
        Route::get("/update/{k:id_kategori}", [KategoriController::class, "getUpdateKategori"])->name("updateKategori");
        Route::put('/update/{k:id_kategori}', [KategoriController::class, "putUpdateKategori"]);
        Route::delete('/delete/{k:id_kategori}', [KategoriController::class, "deleteKategori"])->name("deleteKategori");
        Route::get('/add', [KategoriController::class, "getAddKategori"])->name("addKategori");
        Route::post('/add', [KategoriController::class, "postAddKategori"]);
    });

    Route::group(["prefix" => "customer"],function() {
        Route::get("", [CustomerController::class, "index"])->name("listCustomer");
        Route::get('/update/{c:id_costumer}', [CustomerController::class, "getUpdateCostumer"])->name("updateCostumer");
        Route::put('/update/{c:id_costumer}', [CustomerController::class, "putUpdateCostumer"]);
        Route::get('/add', [CustomerController::class, "getAddCostumer"])->name("addCustomer");
        Route::post('/add', [CustomerController::class, "postAddCostumer"]);
        Route::delete('/delete/{c:id_costumer}',[CustomerController::class, "deleteCostumer"])->name("deleteCostumer");
    });

});
