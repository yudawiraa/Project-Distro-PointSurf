@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')
    <h2 style="margin-bottom: 16px;">Tambah Produk Baru</h2>

<form method="POST" action="{{ route('produk.store') }}">
    @csrf
    <label>Nama Produk:</label>
    <input type="text" name="nama_produk"><br><br>

    <label>Deskripsi:</label>
    <input type="text" name="deskripsi"><br><br>

    <label>Harga:</label>
    <input type="text" name="harga"><br><br>

    <label>Stok:</label>
    <input type="text" name="stok"><br><br>

    <label>Kategori:</label>
    <input type="text" name="kategori"><br><br>

    <button type="submit">Tambah</button>
</form>


    <a href="{{ route('produk.index') }}" style="display: inline-block; margin-top: 20px;">← Kembali ke daftar</a>
@endsection