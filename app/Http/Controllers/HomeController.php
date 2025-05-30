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

        // Tambahkan data top transaksi
        $topTransaksi = Transaksi::with('pelanggan')
            ->orderBy('total_harga', 'desc')
            ->take(5)
            ->get();

        // Get products in stock
        $productsInStock = Produk::where('stok', '>', 0)
            ->orderBy('stok', 'desc')
            ->take(5)
            ->get();

        // Get out of stock products
        $productsOutOfStock = Produk::where('stok', '=', 0)
            ->orderBy('updated_at', 'desc')
            ->take(5)
            ->get();

        return view('home', compact(
            'totalProduk', 
            'totalPelanggan', 
            'omset', 
            'keuntungan',
            'recentTransaksi',
            'recentPelanggan',
            'topTransaksi',
            'productsInStock',
            'productsOutOfStock'
        ));
    }
}
