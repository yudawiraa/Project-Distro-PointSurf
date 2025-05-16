@extends('layouts.app')

@section('title', 'Konfirmasi Hapus')

@section('content')
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