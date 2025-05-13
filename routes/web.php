<?php

use App\Http\Controllers\DataAdminController;
use App\Http\Controllers\DataPersonalController;
use App\Http\Controllers\DataPinjamanController;
use App\Http\Controllers\DataStockController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

// Public routes (no authentication required)
Route::get('/', function () {
    return view('welcome');
});

Route::controller(LoginController::class)->group(function() {
    Route::get('/login', 'show')->name('login');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout')->name('logout');
});

// Protected routes (require authentication)
Route::middleware('auth.session')->group(function () {
    Route::controller(DataPersonalController::class)->group(function() {
        Route::get('/admin/data_personal', 'show')->name('personal.show');
        Route::get('/admin/data_personal/{id}/detail', 'show_detail')->name('personal.detail');
        Route::put('/admin/data_personal/{id}/update', 'update_data')->name('personal.update');
        Route::delete('/admin/data_personal/{id}','delete_data')->name('personal.delete');
    });

    Route::controller(DataStockController::class)->group(function() {
        Route::get('/admin/data_stock', 'show')->name('stock.show');
        Route::get('/admin/data_stock/{id}/detail', 'show_detail')->name('stock.detail');
        Route::put('/admin/data_stock/{id}/update', 'update_data')->name('stock.update');
        Route::delete('/admin/data_stock/{id}','delete_data')->name('stock.delete');
        Route::get('/admin/data_stock/create','show_create')->name('stock.show_create');
        Route::post('/admin/data_stock/create', 'create_data')->name('stock.store');
    });

    Route::get('/admin/data_pinjaman', [DataPinjamanController::class, 'show'])->name('pinjaman.show');
    Route::get('/admin/data_pinjaman/export', [DataPinjamanController::class, 'export'])->name('pinjaman.export');

    Route::controller(DataAdminController::class)->group(function() {
        Route::get('/admin/data_admin', 'show')->name('admin.show');
        Route::get('/admin/data_admin/{id}/detail', 'show_detail')->name('admin.detail');
        Route::put('/admin/data_admin/{id}/update', 'update_data')->name('admin.update');
        Route::get('/admin/data_admin/create', 'show_create')->name('admin.create');
        Route::post('/admin/data_admin/create', 'create_data')->name('admin.store');
        Route::delete('/admin/data_admin/{id}','delete_data')->name('admin.delete');
    });
});