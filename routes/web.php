<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\StokController;

Route::redirect('/', '/barang');

Route::resource('satuan', SatuanController::class)->except(['show']);
Route::resource('vendor', VendorController::class)->except(['show']);
Route::resource('barang', BarangController::class)->except(['show']);

Route::get('/stok', [StokController::class, 'index'])->name('stok.index');
