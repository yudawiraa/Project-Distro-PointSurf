@extends('layouts.app')

@section('title', 'Daftar Transaksi')

@section('content')
    <h1>Daftar Transaksi</h1>

    <ul>
        @forelse($transaksis as $t)
            <li>
                <a href="/transaksi/{{ $t['id'] }}">{{ $t['id'] }} - {{ $t['tanggal_transaksi'] }}</a>

            </li>
        @empty
            <p>Tidak ada transaksi.</p>
        @endforelse
    </ul>

    <a href="/transaksi/create" style="display: inline-block; margin-top: 20px;">+ Tambah Transaksi</a>
    <br><br>
@endsection