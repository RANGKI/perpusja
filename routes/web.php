<?php

use App\Http\Controllers\DataPersonalController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(DataPersonalController::class)->group(function() {
    Route::get('/admin/data_personal','show');
    Route::get('/admin/data_personal/{id}/detail','show_detail');
    Route::put('/admin/data_personal/{id}/update','update_data');
});