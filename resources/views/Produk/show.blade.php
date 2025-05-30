@extends('layouts.app')

@section('title', 'Detail Produk')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title">Detail Produk</h3>
                <div>
                    <a href="{{ route('produk.edit', $produk->id) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <a href="{{ route('produk.delete', $produk->id) }}" class="btn btn-danger" 
                       onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                        <i class="fas fa-trash"></i> Hapus
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <tr>
                    <th style="width: 200px">ID Produk</th>
                    <td>{{ $produk->id }}</td>
                </tr>
                <tr>
                    <th>Nama Produk</th>
                    <td>{{ $produk->nama_produk }}</td>
                </tr>
                <tr>
                    <th>Deskripsi</th>
                    <td>{{ $produk->deskripsi }}</td>
                </tr>
                <tr>
                    <th>Harga</th>
                    <td>Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Stok</th>
                    <td>{{ $produk->stok }}</td>
                </tr>
                <tr>
                    <th>Kategori</th>
                    <td>{{ $produk->kategori }}</td>
                </tr>
            </table>
        </div>
        <div class="card-footer">
            <a href="{{ route('produk.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali ke daftar
            </a>
        </div>
    </div>
@endsection