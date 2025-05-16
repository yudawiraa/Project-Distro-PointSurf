<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\TransaksiController;


Route::get('/', function () {
    return view('home');
});

// Route produk
Route::resource('produk', ProdukController::class);
Route::get('/produk/{id}/delete', [ProdukController::class, 'delete'])->name('produk.delete');

// Route pelanggan
Route::resource('pelanggan', PelangganController::class);
Route::get('/pelanggan/{id}/delete', [PelangganController::class, 'delete'])->name('pelanggan.delete');

// Route pengguna
Route::resource('pengguna', PenggunaController::class);
Route::get('/pengguna/{id}/delete', [PenggunaController::class, 'delete'])->name('pengguna.delete');

// Route transaksi
Route::resource('transaksi', TransaksiController::class);
Route::get('/transaksi/{id}/delete', [TransaksiController::class, 'delete'])->name('transaksi.delete');