@extends('layouts.app')

@section('title', 'Detail Transaksi')

@section('content')
<div class="container py-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Detail Transaksi</h5>
            <div>
                <a href="{{ route('transaksi.edit', $transaksi->id) }}" class="btn btn-warning btn-sm">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <a href="{{ route('transaksi.delete', $transaksi->id) }}" class="btn btn-danger btn-sm">
                    <i class="fas fa-trash"></i> Hapus
                </a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-borderless">
                <tr>
                    <th width="200">ID Transaksi</th>
                    <td>{{ $transaksi->id }}</td>
                </tr>
                <tr>
                    <th>Tanggal Transaksi</th>
                    <td>{{ $transaksi->tanggal_transaksi }}</td>
                </tr>
                <tr>
                    <th>Pelanggan</th>
                    <td>{{ $transaksi->pelanggan->nama_pelanggan }}</td>
                </tr>
                <tr>
                    <th>Produk</th>
                    <td>{{ $transaksi->produk->nama_produk }}</td>
                </tr>
                <tr>
                    <th>Jumlah</th>
                    <td>{{ $transaksi->jumlah }}</td>
                </tr>
                <tr>
                    <th>Total Harga</th>
                    <td>Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        <span class="badge bg-{{ $transaksi->status == 'selesai' ? 'success' : ($transaksi->status == 'proses' ? 'warning' : 'danger') }}">
                            {{ ucfirst($transaksi->status) }}
                        </span>
                    </td>
                </tr>
            </table>
        </div>
        <div class="card-footer">
            <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali ke daftar
            </a>
        </div>
    </div>
</div>
@endsection