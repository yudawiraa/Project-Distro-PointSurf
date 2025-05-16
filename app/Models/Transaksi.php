<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksis';
    protected $fillable = [
        'id_pelanggan',
        'id_produk',
        'id_pengguna',
        'harga_satuan',
        'jumlah_beli',
        'tanggal_transaksi',
        'total_harga',
        'status_pembayaran'
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class,'id_produk');
    }

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class,'id_pengguna');
    }

}