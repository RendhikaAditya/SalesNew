<?php

use App\Models\Barang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\AdminController;
use App\Http\Controllers\Web\SalesController;
use App\Http\Controllers\Web\BarangController;
use App\Http\Controllers\Web\CustomerController;
use App\Http\Controllers\Web\KategoriController;
use App\Http\Controllers\Web\SupervisorController;
use App\Http\Controllers\Web\TransaksiController;
use App\Http\Controllers\Web\UserController;

Route::group(["middleware" => "guest"],function() {
    Route::get('/', [AuthController::class, 'getLogin'])->name("login");
    Route::post('/', [AuthController::class, 'postLogin']);
});


Route::group(["middleware" => "auth"],function() {

    Route::group(["middleware" => "admin", "prefix" => "admin"],function() {
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

        Route::group(["prefix" => "user"],function() {
            Route::get("", [UserController::class, "index"])->name("listUsers");
            Route::get("/update/{u:id}", [UserController::class, "getUpdateUser"])->name("updateUser");
            Route::put("/update/{u:id}", [UserController::class, "putUpdateUser"]);
            Route::delete('/delete/{u:id}', [UserController::class, "deleteUser"])->name("deleteUser");
            Route::get('/add', [UserController::class, "getAddUser"])->name("addUser");
            Route::post('/add', [UserController::class, "postAddUser"]);
        });

        Route::get('/transaksi', [TransaksiController::class, "index"])->name("adminListTransaksi");

    });

    Route::group(["middleware" => "supervisor", "prefix" => "supervisor"], function() {
        Route::get("", [SupervisorController::class, "index"])->name("supervisorIndex");

        Route::group(["prefix" => "transaksi"], function() {
            Route::get("", [TransaksiController::class, "index"])->name("listTransaksi");
            Route::get("/approve/{o:id_order}", [TransaksiController::class, "approve"])->name("approveTransaksi");
            Route::get('/unapprove/{o:id_order}', [TransaksiController::class, "unapprove"])->name("unapproveTransaksi");
        });

    });

    Route::get('/logout',function() {
        Auth::logout();
        return redirect()->route("login");
    })->name("logout");

});

