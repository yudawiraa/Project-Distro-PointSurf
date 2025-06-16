<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ImageController;

// image upload routes
Route::get('/upload', [ImageController::class, 'create']);
Route::post('/upload', [ImageController::class, 'store'])->name('image.upload');
Route::delete('/upload/{id}', [ImageController::class, 'destroy'])->name('image.destroy');

// Require authentication for all routes except login/register
Route::middleware('auth')->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

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

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/pendaftaran-ktp', function () {
    return 'Selamat datang di halaman Pendaftaran KTP Online!';
})->middleware('check.age');

});

require __DIR__.'/auth.php';