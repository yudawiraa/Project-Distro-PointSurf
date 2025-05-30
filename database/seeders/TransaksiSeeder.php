<?php

namespace Database\Seeders;

use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TransaksiSeeder extends Seeder
{
    public function run(): void
    {
        $transaksis = [
            [
                'pelanggan_id' => 1,
                'produk_id' => 1,
                'jumlah' => 1,
                'tanggal_transaksi' => Carbon::now()->subDays(5),
                'total_harga' => 15999000,
                'status' => 'selesai'
            ],
            [
                'pelanggan_id' => 2,
                'produk_id' => 3,
                'jumlah' => 2,
                'tanggal_transaksi' => Carbon::now()->subDays(4),
                'total_harga' => 6998000,
                'status' => 'selesai'
            ],
            [
                'pelanggan_id' => 3,
                'produk_id' => 7,
                'jumlah' => 3,
                'tanggal_transaksi' => Carbon::now()->subDays(3),
                'total_harga' => 3897000,
                'status' => 'selesai'
            ],
            [
                'pelanggan_id' => 4,
                'produk_id' => 2,
                'jumlah' => 1,
                'tanggal_transaksi' => Carbon::now()->subDays(2),
                'total_harga' => 18999000,
                'status' => 'proses'
            ],
            [
                'pelanggan_id' => 5,
                'produk_id' => 5,
                'jumlah' => 2,
                'tanggal_transaksi' => Carbon::now()->subDays(1),
                'total_harga' => 4998000,
                'status' => 'pending'
            ],
        ];

        foreach ($transaksis as $transaksi) {
            Transaksi::create($transaksi);
        }
    }
}
