<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produks'; 
    protected $fillable = [
        'nama_produk', 
        'deskripsi', 
        'harga', 
        'stok', 
        'kategori',
    ];

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'id_produk');
    }
}