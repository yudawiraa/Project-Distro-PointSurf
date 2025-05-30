<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Produk;
use App\Models\Pelanggan;
use App\Models\Pengguna;
use App\Models\Transaksi;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Illuminate\Pagination\Paginator::useBootstrap();

        // Share entity counts with all views
        View::composer('*', function ($view) {
            $view->with([
                'totalProduk' => Produk::count(),
                'totalPelanggan' => Pelanggan::count(),
                'totalPengguna' => Pengguna::count(),
                'totalTransaksi' => Transaksi::count(),
            ]);
        });
    }
}
