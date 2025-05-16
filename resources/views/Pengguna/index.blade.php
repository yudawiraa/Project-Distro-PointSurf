@extends('layouts.app')

@section('title', 'Daftar Pengguna')

@section('content')
    <h1>Daftar Pengguna</h1>

    <ul>
        @forelse($penggunas as $p)
            <li>
                <a href="/pengguna/{{ $p['id'] }}">{{ $p['nama_pengguna'] }}</a>
            </li>
        @empty
            <p>Tidak ada pengguna.</p>
        @endforelse
    </ul>

    <a href="/pengguna/create" style="display: inline-block; margin-top: 20px;">+ Tambah Pengguna</a>
    <br><br>
@endsection