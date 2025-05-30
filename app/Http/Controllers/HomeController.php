<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Get total products
        $totalProduk = Produk::count();
        
        // Get total customers
        $totalPelanggan = Pelanggan::count();
        
        // Get total revenue (omset)
        $omset = Transaksi::sum('total_harga');
        
        // Get total profit (assuming 30% margin)
        $keuntungan = $omset * 0.3;

        // Get recent transactions
        $recentTransaksi = Transaksi::with('pelanggan')
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        // Get recent customers
        $recentPelanggan = Pelanggan::orderBy('created_at', 'desc')
            ->take(4)
            ->get();
        
        return view('home', compact(
            'totalProduk', 
            'totalPelanggan', 
            'omset', 
            'keuntungan',
            'recentTransaksi',
            'recentPelanggan'
        ));
    }
}
