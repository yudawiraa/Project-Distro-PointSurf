<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pelanggans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pelanggan'); 
            $table->string('alamat'); 
            $table->string('no_telepon');
            $table->string('email')->unique();
            $table->timestamps(); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pelanggans');
    }
};