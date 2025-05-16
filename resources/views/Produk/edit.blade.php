@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')
    <h1>Edit Produk</h1>

<form method="POST" action="{{ route('produk.update', $produk->id) }}">
    @csrf
    @method('PUT')

    <p><strong>Nama Produk:</strong> <input type="text" name="nama_produk" value="{{ $produk->nama_produk }}"><br><br></p>
    <p><strong>Deskripsi:</strong> <input type="text" name="deskripsi" value="{{ $produk->deskripsi }}"><br><br></p>
    <p><strong>Harga:</strong> <input type="text" name="harga" value="{{ $produk->harga }}"><br><br></p>
    <p><strong>Stok:</strong> <input type="text" name="stok" value="{{ $produk->stok }}"><br><br></p>
    <p><strong>Kategori:</strong> <input type="text" name="kategori" value="{{ $produk->kategori }}"><br><br></p>

    <button type="submit">Update</button>
</form>

    <br>
    <a href="{{ route('produk.show', $produk->id) }}">← Kembali ke detail</a>
@endsection