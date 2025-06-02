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

    /**
     * Transaksi-transaksi yang dimiliki oleh Produk ini.
     */
    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'produk_id');
    }

    /**
     * Tag-tag yang dimiliki oleh Produk ini.
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'produk_tag');
    }
}