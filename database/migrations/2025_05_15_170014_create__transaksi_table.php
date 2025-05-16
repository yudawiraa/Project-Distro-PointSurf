<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pelanggan');
            $table->unsignedBigInteger('id_produk');
            $table->unsignedBigInteger('id_pengguna');
            $table->decimal('harga_satuan'); 
            $table->decimal('jumlah_beli');
            $table->date('tanggal_transaksi');
            $table->decimal('total_harga');
            $table->string('status_pembayaran');
            $table->timestamps();

            $table->foreign('id_pelanggan')->references('id')->on('pelanggans')->onDelete('cascade');
            $table->foreign('id_produk')->references('id')->on('produks')->onDelete('cascade');
            $table->foreign('id_pengguna')->references('id')->on('penggunas')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('transaksis');
    }
};