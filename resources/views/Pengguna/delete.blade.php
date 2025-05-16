@extends('layouts.app')

@section('title', 'Konfirmasi Hapus')

@section('content')
    <h1>Yakin ingin menghapus pengguna ini?</h1>

    <p><strong>ID Pengguna:</strong> {{ $pengguna->id }}</p>
    <p><strong>Nama Pengguna:</strong> {{ $pengguna->nama_pengguna }}</p>

    <form action="{{ route('pengguna.destroy', $pengguna->id) }}" method="POST" style="display: inline;">
        @csrf
        @method('DELETE')
        <button style="margin-right: 10px;">Ya, hapus</button>
    </form>

    <a href="{{ route('pengguna.show', $pengguna->id) }}">Batal</a>
@endsection