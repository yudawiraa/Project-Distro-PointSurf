@extends('layouts.app')

@section('title', 'Detail Pengguna')

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
            <h5 class="mb-0">Detail Pengguna</h5>
            <div>
                <a href="{{ route('pengguna.edit', $pengguna->id) }}" class="btn btn-warning btn-sm">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <a href="{{ route('pengguna.delete', $pengguna->id) }}" class="btn btn-danger btn-sm">
                    <i class="fas fa-trash"></i> Hapus
                </a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-borderless">
                <tr>
                    <th width="200">ID Pengguna</th>
                    <td>{{ $pengguna->id }}</td>
                </tr>
                <tr>
                    <th>Nama Pengguna</th>
                    <td>{{ $pengguna->nama_pengguna }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $pengguna->email }}</td>
                </tr>
                <tr>
                    <th>Role</th>
                    <td>{{ $pengguna->role }}</td>
                </tr>
            </table>
        </div>
        <div class="card-footer">
            <a href="{{ route('pengguna.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali ke daftar
            </a>
        </div>
    </div>
</div>
@endsection
