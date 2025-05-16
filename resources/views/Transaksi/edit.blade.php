@extends('layouts.app')

@section('title', 'Edit Transaksi')

@section('content')
    <h1>Edit Transaksi</h1>

<form method="POST" action="{{ route('transaksi.update', $transaksi->id) }}">
    @csrf
    @method('PUT')

    <p><strong>ID Pelanggan:</strong> <input type="text" name="id_pelanggan" value="{{ $transaksi->id_pelanggan }}"><br><br></p>
    <p><strong>ID Produk:</strong> <input type="text" name="id_produk" value="{{ $transaksi->id_produk }}"><br><br></p>
    <p><strong>ID Pengguna:</strong> <input type="text" name="id_pengguna" value="{{ $transaksi->id_pengguna }}"><br><br></p>
    <p><strong>Harga Satuan:</strong> <input type="text" name="harga_satuan" value="{{ $transaksi->harga_satuan }}"><br><br></p>
    <p><strong>Jumlah Beli:</strong> <input type="text" name="jumlah_beli" value="{{ $transaksi->jumlah_beli }}"><br><br></p>
    <p><strong>Tanggal Transaksi:</strong> <input type="text" name="tanggal_transaksi" value="{{ $transaksi->tanggal_transaksi }}"><br><br></p>
    <p><strong>Total Harga:</strong> <input type="text" name="total_harga" value="{{ $transaksi->total_harga }}"><br><br></p>
    <p><strong>Status Pembayaran:</strong> <input type="text" name="status_pembayaran" value="{{ $transaksi->status_pembayaran }}"><br><br></p>

    <button type="submit">Update</button>
</form>

    <br>
    <a href="{{ route('transaksi.show', $transaksi->id) }}">← Kembali ke detail</a>
@endsection