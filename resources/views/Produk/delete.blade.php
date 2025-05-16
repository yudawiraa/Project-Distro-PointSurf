@extends('layouts.app')

@section('title', 'Konfirmasi Hapus')

@section('content')
    <h1>Yakin ingin menghapus produk ini?</h1>

    <p><strong>ID Produk:</strong> {{ $produk->id }}</p>
    <p><strong>Nama Produk:</strong> {{ $produk->nama_produk }}</p>
    <p><strong>Harga:</strong> Rp{{ number_format($produk->harga, 2, ',', '.') }}</p>
    <p><strong>Stok:</strong> {{ $produk->stok }}</p>

    <form action="{{ route('produk.destroy', $produk->id) }}" method="POST" style="display: inline;">
        @csrf
        @method('DELETE')
        <button style="margin-right: 10px;">Ya, hapus</button>
    </form>

    <a href="{{ route('produk.show', $produk->id) }}">Batal</a>
@endsection