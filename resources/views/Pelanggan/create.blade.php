@extends('layouts.app')

@section('title', 'Tambah Pelanggan')

@section('content')
    <h2 style="margin-bottom: 16px;">Tambah Pelanggan Baru</h2>

<form method="POST" action="{{ route('pelanggan.store') }}">
    @csrf
    <label>Nama Pelanggan:</label>
    <input type="text" name="nama_pelanggan"><br><br>

    <label>Alamat:</label>
    <input type="text" name="alamat"><br><br>

    <label>Nomor Telepon:</label>
    <input type="text" name="no_telepon"><br><br>

    <label>Email:</label>
    <input type="text" name="email"><br><br>

    <button type="submit">Tambah</button>
</form>


    <a href="{{ route('pelanggan.index') }}" style="display: inline-block; margin-top: 20px;">← Kembali ke daftar</a>
@endsection