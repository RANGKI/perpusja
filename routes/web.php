<?php

use App\Http\Controllers\DataAdminController;
use App\Http\Controllers\DataPersonalController;
use App\Http\Controllers\DataPinjamanController;
use App\Http\Controllers\DataStockController;
use App\Http\Controllers\LoginController;
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

Route::get('/admin/data_pinjaman',[DataPinjamanController::class,'show']);

Route::controller(DataAdminController::class)->group(function() {
    Route::get('/admin/data_admin','show');
    Route::get('/admin/data_admin/{id}/detail','show_detail');
    Route::put('/admin/data_admin/{id}/update','update_data');
    Route::get('/admin/data_admin/create','show_create');
    Route::post('/admin/data_admin/create','create_data');
});

Route::controller(LoginController::class)->group(function() {
    Route::get('/login','show');
    Route::post('/login','login');
    Route::post('/logout','logout');
});