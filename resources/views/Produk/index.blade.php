@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')
    <h1>Daftar Produk</h1>

    <ul>
        @forelse($produks as $p)
            <li>
                <a href="/produk/{{ $p['id'] }}">{{ $p['nama_produk'] }}</a>
            </li>
        @empty
            <p>Tidak ada produk.</p>
        @endforelse
    </ul>

    <a href="/produk/create" style="display: inline-block; margin-top: 20px;">+ Tambah Produk</a>
    <br><br>
@endsection