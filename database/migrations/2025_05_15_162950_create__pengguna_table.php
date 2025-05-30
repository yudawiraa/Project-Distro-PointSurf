<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penggunas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pengguna'); 
            $table->string('username'); 
            $table->string('password');
            $table->enum('role', ['admin', 'karyawan', 'kasir', 'manager', 'supervisor']);
            $table->timestamps(); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penggunas');
    }
};