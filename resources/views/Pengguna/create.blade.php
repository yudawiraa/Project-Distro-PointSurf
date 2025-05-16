@extends('layouts.app')

@section('title', 'Tambah Pengguna')

@section('content')
    <h2 style="margin-bottom: 16px;">Tambah Pengguna Baru</h2>

<form method="POST" action="{{ route('pengguna.store') }}">
    @csrf
    <label>Nama Pengguna:</label>
    <input type="text" name="nama_pengguna"><br><br>

    <label>Username:</label>
    <input type="text" name="username"><br><br>

    <label>Password:</label>
    <input type="text" name="password"><br><br>

    <label>Role:</label>
    <input type="text" name="role"><br><br>

    <button type="submit">Tambah</button>
</form>


    <a href="{{ route('pengguna.index') }}" style="display: inline-block; margin-top: 20px;">← Kembali ke daftar</a>
@endsection