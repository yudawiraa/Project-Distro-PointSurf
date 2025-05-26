@extends('layouts.app')

@section('title', 'Daftar Pelanggan')

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <h1>Daftar Pelanggan</h1>

    <ul>
        @forelse($pelanggans as $p)
            <li>
                <a href="/pelanggan/{{ $p['id'] }}">{{ $p['nama_pelanggan'] }}</a>
            </li>
        @empty
            <p>Tidak ada pelanggan.</p>
        @endforelse
    </ul>

    <a href="/pelanggan/create" style="display: inline-block; margin-top: 20px;">+ Tambah Pelanggan</a>
    <br><br>
@endsection