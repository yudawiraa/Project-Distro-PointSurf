@extends('layouts.app')

@section('title', 'Edit Pelanggan')

@section('content')
    <h1>Edit Pelanggan</h1>

<form method="POST" action="{{ route('pelanggan.update', $pelanggan->id) }}">
    @csrf
    @method('PUT')

    <p><strong>Nama Pelanggan:</strong> <input type="text" name="nama_pelanggan" value="{{ $pelanggan->nama_pelanggan }}"><br><br></p>
    <p><strong>Alamat:</strong> <input type="text" name="alamat" value="{{ $pelanggan->alamat }}"><br><br></p>
    <p><strong>Nomor Telepon:</strong> <input type="text" name="no_telepon" value="{{ $pelanggan->no_telepon }}"><br><br></p>
    <p><strong>Email:</strong> <input type="text" name="email" value="{{ $pelanggan->email }}"><br><br></p>

    <button type="submit">Update</button>
</form>

    <br>
    <a href="{{ route('pelanggan.show', $pelanggan->id) }}">← Kembali ke detail</a>
@endsection