@extends('layouts.app')

@section('title', 'Daftar Pelanggan')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Daftar Pelanggan</h1>
        <a href="{{ route('pelanggan.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Pelanggan
        </a>
    </div>

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
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Pelanggan</th>
                            <th>Email</th>
                            <th>No. Telepon</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pelanggans as $pelanggan)
                            <tr>
                                <td>{{ $pelanggan->id }}</td>
                                <td>{{ $pelanggan->nama_pelanggan }}</td>
                                <td>{{ $pelanggan->email }}</td>
                                <td>{{ $pelanggan->no_telepon }}</td>
                                <td>{{ Str::limit($pelanggan->alamat, 30) }}</td>
                                <td class="action-buttons">
                                    <a href="{{ route('pelanggan.show', $pelanggan->id) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('pelanggan.edit', $pelanggan->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ route('pelanggan.delete', $pelanggan->id) }}" class="btn btn-danger btn-sm" 
                                       onclick="return confirm('Apakah Anda yakin ingin menghapus pelanggan ini?')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada pelanggan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
