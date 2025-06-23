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

    <h1>Yakin ingin menghapus produk ini?</h1>

    <p><strong>ID Produk:</strong> {{ $produk->id }}</p>
    <p><strong>Nama Produk:</strong> {{ $produk->nama_produk }}</p>
    <p><strong>Harga:</strong> Rp{{ number_format($produk->harga, 2, ',', '.') }}</p>
    <p><strong>Stok:</strong> {{ $produk->stok }}</p>

    <form action="{{ route('produk.destroy', $produk->id) }}" method="POST" style="display: inline;">
        @csrf
        @method('DELETE')
        <button style="margin-right: 10px;">Ya, hapus</button>
    </form>

    <a href="{{ route('produk.show', $produk->id) }}">Batal</a>
@endsection
