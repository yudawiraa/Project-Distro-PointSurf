<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    use HasFactory;

    protected $table = 'penggunas'; 
    protected $fillable = [
        'nama_pengguna', 
        'username', 
        'email',
        'password', 
        'role', 
    ];

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'id_pengguna');
    }
}