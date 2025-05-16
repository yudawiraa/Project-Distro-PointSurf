@extends('layouts.app')

@section('title', 'Detail Pengguna')

@section('content')
    <h2>Detail Pengguna</h2>

    <p><strong>ID Pengguna:</strong> {{ $pengguna->id }}</p>
    <p><strong>Nama Pengguna:</strong> {{ $pengguna->nama_pengguna }}</p>
    <p><strong>Username:</strong> {{ $pengguna->username }}<p>
    <p><strong>Password:</strong> {{ $pengguna->password }}</p>
    <p><strong>Role:</strong> {{ $pengguna->role }}</p>

    <br>

    <a href="{{ route('pengguna.edit', $pengguna->id) }}">✏ Edit</a> |
    <a href="{{ route('pengguna.delete', $pengguna->id) }}">🗑 Hapus</a>

    <br><br>

    <a href="{{ route('pengguna.index') }}">← Kembali ke daftar</a>
@endsection