<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\AdminController;
use App\Http\Controllers\Web\SalesController;

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

});