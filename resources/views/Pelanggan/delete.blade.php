@extends('layouts.app')

@section('title', 'Konfirmasi Hapus')

@section('content')
    <h1>Yakin ingin menghapus pelanggan ini?</h1>

    <p><strong>ID Pelanggan:</strong> {{ $pelanggan->id }}</p>
    <p><strong>Nama Pelanggan:</strong> {{ $pelanggan->nama_pelanggan }}</p>

    <form action="{{ route('pelanggan.destroy', $pelanggan->id) }}" method="POST" style="display: inline;">
        @csrf
        @method('DELETE')
        <button style="margin-right: 10px;">Ya, hapus</button>
    </form>

    <a href="{{ route('pelanggan.show', $pelanggan->id) }}">Batal</a>
@endsection