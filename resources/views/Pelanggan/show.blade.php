@extends('layouts.app')

@section('title', 'Detail Pelanggan')

@section('content')
<div class="container py-4">
    {{-- Notifikasi sukses --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif (session('errors'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('errors') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Detail Pelanggan</h5>
            <div>
                <a href="{{ route('pelanggan.edit', $pelanggan->id) }}" class="btn btn-warning btn-sm">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <a href="{{ route('pelanggan.delete', $pelanggan->id) }}" class="btn btn-danger btn-sm">
                    <i class="fas fa-trash"></i> Hapus
                </a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-borderless">
                <tr>
                    <th width="200">ID Pelanggan</th>
                    <td>{{ $pelanggan->id }}</td>
                </tr>
                <tr>
                    <th>Nama Pelanggan</th>
                    <td>{{ $pelanggan->nama_pelanggan }}</td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td>{{ $pelanggan->alamat }}</td>
                </tr>
                <tr>
                    <th>Nomor Telepon</th>
                    <td>{{ $pelanggan->no_telepon }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $pelanggan->email }}</td>
                </tr>
            </table>
        </div>
        <div class="card-footer">
            <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali ke daftar
            </a>
        </div>
    </div>
</div>
@endsection
