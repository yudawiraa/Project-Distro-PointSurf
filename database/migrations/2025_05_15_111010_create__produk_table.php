<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->string('nama_produk'); 
            $table->string('deskripsi'); 
            $table->decimal('harga', 10, 2);
            $table->integer('stok');
            $table->string('kategori');
            $table->timestamps(); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};