<?php

use App\Http\Controllers\DataPersonalController;
use App\Http\Controllers\DataStockController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(DataPersonalController::class)->group(function() {
    Route::get('/admin/data_personal','show');
    Route::get('/admin/data_personal/{id}/detail','show_detail');
    Route::put('/admin/data_personal/{id}/update','update_data');
});

Route::controller(DataStockController::class)->group(function() {
    Route::get('/admin/data_stock','show');
    Route::get('/admin/data_stock/{id}/detail','show_detail');
    Route::put('/admin/data_stock/{id}/update','update_data');
});