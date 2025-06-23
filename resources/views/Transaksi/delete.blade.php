@extends('layouts.app')

@section('title', 'Konfirmasi Hapus')

@section('content')
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
    <h1>Yakin ingin menghapus transaksi ini?</h1>

    <p><strong>ID Transaksi:</strong> {{ $transaksi->id }}</p>
    <p><strong>Tanggal Transaksi:</strong> {{ $transaksi->tanggal_transaksi }}</p>

    <form action="{{ route('transaksi.destroy', $transaksi->id) }}" method="POST" style="display: inline;">
        @csrf
        @method('DELETE')
        <button style="margin-right: 10px;">Ya, hapus</button>
    </form>

    <a href="{{ route('transaksi.show', $transaksi->id) }}">Batal</a>
@endsection