@extends('layouts.app')

@section('title', 'Edit Pengguna')

@section('content')
    <h1>Edit Pengguna</h1>

<form method="POST" action="{{ route('pengguna.update', $pengguna->id) }}">
    @csrf
    @method('PUT')

    <p><strong>Nama Pengguna:</strong> <input type="text" name="nama_pengguna" value="{{ $pengguna->nama_pengguna }}"><br><br></p>
    <p><strong>Username:</strong> <input type="text" name="username" value="{{ $pengguna->username }}"><br><br></p>
    <p><strong>Password:</strong> <input type="text" name="password" value="{{ $pengguna->password }}"><br><br></p>
   <p><strong>Role:</strong> <input type="text" name="role" value="{{ $pengguna->role }}"><br><br></p>

    <button type="submit">Update</button>
</form>

    <br>
    <a href="{{ route('pengguna.show', $pengguna->id) }}">← Kembali ke detail</a>
@endsection