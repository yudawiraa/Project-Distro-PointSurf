<?php

namespace Database\Seeders;

use App\Models\Produk;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{    public function run(): void
    {
        $produks = [
            [
                'nama_produk' => 'Dress Floral Summer',
                'deskripsi' => 'Dress cantik motif bunga untuk musim panas',
                'harga' => 299000,
                'stok' => 25,
                'kategori' => 'Dress',
            ],            [
                'nama_produk' => 'Kemeja Putih Slim Fit',
                'deskripsi' => 'Kemeja formal pria bahan katun premium',
                'harga' => 249000,
                'stok' => 30,
                'kategori' => 'Kemeja',
            ],
            [
                'nama_produk' => 'Celana Jeans Classic',
                'deskripsi' => 'Celana jeans pria potongan regular fit',
                'harga' => 399000,
                'stok' => 40,
                'kategori' => 'Celana',
            ],
            [
                'nama_produk' => 'Rok Midi Plisket',
                'deskripsi' => 'Rok plisket panjang model A-line',
                'harga' => 279000,
                'stok' => 20,
                'kategori' => 'Rok',
            ],            [
                'nama_produk' => 'Blazer Formal Wanita',
                'deskripsi' => 'Blazer kantor wanita potongan slim',
                'harga' => 499000,
                'stok' => 15,
                'kategori' => 'Blazer',
            ],
            [
                'nama_produk' => 'Kaos Polos Premium',
                'deskripsi' => 'Kaos polos cotton combed 30s',
                'harga' => 99000,
                'stok' => 100,
                'kategori' => 'Kaos',
            ],
            [
                'nama_produk' => 'Jaket Denim Vintage',
                'deskripsi' => 'Jaket jeans model oversized',
                'harga' => 459000,
                'stok' => 25,
                'kategori' => 'Jaket',
            ],            [
                'nama_produk' => 'Celana Kulot',
                'deskripsi' => 'Celana kulot wanita bahan crepe premium',
                'harga' => 229000,
                'stok' => 35,
                'kategori' => 'Celana',
            ],
            [
                'nama_produk' => 'Sweater Rajut',
                'deskripsi' => 'Sweater rajut tebal model turtleneck',
                'harga' => 189000,
                'stok' => 40,
                'kategori' => 'Sweater',
            ],
            [
                'nama_produk' => 'Kemeja Flanel',
                'deskripsi' => 'Kemeja flanel pria motif kotak-kotak',
                'harga' => 199000,
                'stok' => 45,
                'kategori' => 'Kemeja',
            ],            [
                'nama_produk' => 'Dress Mini Korean Style',
                'deskripsi' => 'Mini dress model korean style',
                'harga' => 259000,
                'stok' => 30,
                'kategori' => 'Dress',
            ],
            [
                'nama_produk' => 'Celana Chino',
                'deskripsi' => 'Celana chino pria slim fit',
                'harga' => 279000,
                'stok' => 50,
                'kategori' => 'Celana',
            ],
            [
                'nama_produk' => 'Blouse Wanita',
                'deskripsi' => 'Blouse lengan panjang motif bunga',
                'harga' => 169000,
                'stok' => 40,
                'kategori' => 'Blouse',
            ],            [
                'nama_produk' => 'Cardigan Rajut',
                'deskripsi' => 'Cardigan rajut wanita model panjang',
                'harga' => 189000,
                'stok' => 35,
                'kategori' => 'Cardigan',
            ],
            [
                'nama_produk' => 'Kemeja Batik Modern',
                'deskripsi' => 'Kemeja batik pria motif kontemporer',
                'harga' => 289000,
                'stok' => 30,
                'kategori' => 'Kemeja',
            ],
            [
                'nama_produk' => 'Rok Denim A-Line',
                'deskripsi' => 'Rok jeans model A-line dengan kancing',
                'harga' => 239000,
                'stok' => 25,
                'kategori' => 'Rok',
            ],            [
                'nama_produk' => 'Celana Jogger',
                'deskripsi' => 'Celana jogger pria bahan cotton',
                'harga' => 159000,
                'stok' => 60,
                'kategori' => 'Celana',
            ],
            [
                'nama_produk' => 'Tunik Modern',
                'deskripsi' => 'Tunik wanita modern dengan motif geometris',
                'harga' => 219000,
                'stok' => 25,
                'kategori' => 'Tunik',
            ],
            [
                'nama_produk' => 'Gamis Syari',
                'deskripsi' => 'Gamis syari dengan bahan premium',
                'harga' => 399000,
                'stok' => 20,
                'kategori' => 'Gamis',
            ],
            [
                'nama_produk' => 'Hodie Unisex',
                'deskripsi' => 'Hoodie unisex model oversized',
                'harga' => 279000,
                'stok' => 45,
                'kategori' => 'Hoodie',
            ],
        ];

        foreach ($produks as $produk) {
            Produk::create($produk);
        }
    }
}
