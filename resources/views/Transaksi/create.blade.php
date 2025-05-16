@extends('layouts.app')

@section('title', 'Tambah Transaksi')

@section('content')
    <h2 style="margin-bottom: 16px;">Tambah Transaksi Baru</h2>

<form method="POST" action="{{ route('transaksi.store') }}">
    @csrf

    <label>ID Pelanggan:</label>
    <input type="text" name="id_pelanggan"><br><br>

    <label>ID Produk:</label>
    <input type="text" name="id_produk"><br><br>

    <label>ID Pengguna:</label>
    <input type="text" name="id_pengguna"><br><br>

    <label>Harga Satuan:</label>
    <input type="text" name="harga_satuan"><br><br>

    <label>Jumlah Beli:</label>
    <input type="text" name="jumlah_beli"><br><br>

    <label>Tanggal Transaksi:</label>
    <input type="date" name="tanggal_transaksi"><br><br>

    <label>Total Harga:</label>
    <input type="text" name="total_harga"><br><br>

    <label>Status Pembayaran:</label>
    <input type="text" name="status_pembayaran"><br><br>

    <button type="submit">Tambah</button>
</form>


    <a href="{{ route('transaksi.index') }}" style="display: inline-block; margin-top: 20px;">← Kembali ke daftar</a>
@endsection