@extends('layouts.app')

@section('title', 'Detail Transaksi')

@section('content')
    <h2>Detail Transaksi</h2>

    <p><strong>ID Transaksi:</strong> {{ $transaksi->id }}</p>
    <p><strong>ID Pelanggan:</strong> {{ $transaksi->id_pelanggan }}</p>
    <p><strong>ID Produk:</strong> {{ $transaksi->id_produk }}</p>
    <p><strong>ID Pengguna:</strong> {{ $transaksi->id_pengguna }}</p>
    <p><strong>Harga Satuan:</strong> {{ $transaksi->harga_satuan }}</p>
    <p><strong>Jumlah Beli:</strong> {{ $transaksi->jumlah_beli }}<p>
    <p><strong>Tanggal Transaksi:</strong> {{ $transaksi->tanggal_transaksi }}<p>
    <p><strong>Total Harga:</strong> {{ $transaksi->total_harga }}</p>
    <p><strong>Status Pembayaran:</strong> {{ $transaksi->status_pembayaran }}<p>

    <br>

    <a href="{{ route('transaksi.edit', $transaksi->id) }}">✏ Edit</a> |
    <a href="{{ route('transaksi.delete', $transaksi->id) }}">🗑 Hapus</a>

    <br><br>

    <a href="{{ route('transaksi.index') }}">← Kembali ke daftar</a>
@endsection