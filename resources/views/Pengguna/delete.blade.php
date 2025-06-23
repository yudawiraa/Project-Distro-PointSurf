@extends('layouts.app')

@section('title', 'Konfirmasi Hapus')

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

        <h1>Yakin ingin menghapus pengguna ini?</h1>

        <p><strong>ID Pengguna:</strong> {{ $pengguna->id }}</p>
        <p><strong>Nama Pengguna:</strong> {{ $pengguna->nama_pengguna }}</p>

        <form action="{{ route('pengguna.destroy', $pengguna->id) }}" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger" style="margin-right: 10px;">Ya, hapus</button>
        </form>

        <a href="{{ route('pengguna.show', $pengguna->id) }}" class="btn btn-secondary">Batal</a>
    </div>
@endsection
