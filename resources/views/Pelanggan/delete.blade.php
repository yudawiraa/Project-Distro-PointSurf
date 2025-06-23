@extends('layouts.app')

@section('title', 'Konfirmasi Hapus')

@section('content')
    <div class="container">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-danger text-white">
                <h4 class="mb-0">Konfirmasi Hapus Pelanggan</h4>
            </div>

            <div class="card-body">

                {{-- Notifikasi sukses --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @elseif (session('errors'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('errors') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <h5>Yakin ingin menghapus pelanggan ini?</h5>

                <p><strong>ID Pelanggan:</strong> {{ $pelanggan->id }}</p>
                <p><strong>Nama Pelanggan:</strong> {{ $pelanggan->nama_pelanggan }}</p>

                <form action="{{ route('pelanggan.destroy', $pelanggan->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" style="margin-right: 10px;">
                        Ya, hapus
                    </button>
                </form>

                <a href="{{ route('pelanggan.show', $pelanggan->id) }}" class="btn btn-secondary">
                    Batal
                </a>
            </div>
        </div>
    </div>
@endsection
