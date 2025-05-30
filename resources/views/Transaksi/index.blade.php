@extends('layouts.app')

@section('title', 'Daftar Transaksi')

@section('content')
<div class="container py-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h1>Daftar Transaksi</h1>
            <a href="{{ route('transaksi.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Transaksi
            </a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tanggal</th>
                            <th>Pelanggan</th>
                            <th>Produk</th>
                            <th>Jumlah</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transaksis as $transaksi)
                        <tr>
                            <td>{{ $transaksi->id }}</td>
                            <td>{{ $transaksi->tanggal_transaksi }}</td>
                            <td>{{ $transaksi->pelanggan->nama_pelanggan }}</td>
                            <td>{{ $transaksi->produk->nama_produk }}</td>
                            <td>{{ $transaksi->jumlah }}</td>
                            <td>Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
                            <td>
                                <span class="badge bg-{{ $transaksi->status == 'selesai' ? 'success' : ($transaksi->status == 'proses' ? 'warning' : 'danger') }}">
                                    {{ ucfirst($transaksi->status) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('transaksi.show', $transaksi->id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('transaksi.edit', $transaksi->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ route('transaksi.delete', $transaksi->id) }}" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>            <div class="mt-4">
                {{ $transaksis->links() }}
            </div>
        </div>
    </div>
</div>
@endsection