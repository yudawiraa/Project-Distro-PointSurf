@extends('layouts.app')

@section('title', 'Detail Pelanggan')

@section('content')
    <h2>Detail Pelanggan</h2>

    <p><strong>ID Pelanggan:</strong> {{ $pelanggan->id }}</p>
    <p><strong>Nama Pelanggan:</strong> {{ $pelanggan->nama_pelanggan }}</p>
    <p><strong>Alamat:</strong> {{ $pelanggan->alamat }}<p>
    <p><strong>Nomor Telepon:</strong> {{ $pelanggan->no_telepon }}</p>
    <p><strong>Email:</strong> {{ $pelanggan->email }}</p>

    <br>

    <a href="{{ route('pelanggan.edit', $pelanggan->id) }}">✏ Edit</a> |
    <a href="{{ route('pelanggan.delete', $pelanggan->id) }}">🗑 Hapus</a>

    <br><br>

    <a href="{{ route('pelanggan.index') }}">← Kembali ke daftar</a>
@endsection