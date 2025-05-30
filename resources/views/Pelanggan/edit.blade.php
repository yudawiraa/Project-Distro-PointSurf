@extends('layouts.app')

@section('title', 'Edit Pelanggan')

@section('content')
<div class="container py-4">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Edit Pelanggan</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('pelanggan.update', $pelanggan->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
                    <input type="text" class="form-control @error('nama_pelanggan') is-invalid @enderror" 
                           id="nama_pelanggan" name="nama_pelanggan" 
                           value="{{ old('nama_pelanggan', $pelanggan->nama_pelanggan) }}">
                    @error('nama_pelanggan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea class="form-control @error('alamat') is-invalid @enderror" 
                              id="alamat" name="alamat" rows="3">{{ old('alamat', $pelanggan->alamat) }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="no_telepon" class="form-label">Nomor Telepon</label>
                    <input type="text" class="form-control @error('no_telepon') is-invalid @enderror" 
                           id="no_telepon" name="no_telepon" 
                           value="{{ old('no_telepon', $pelanggan->no_telepon) }}">
                    @error('no_telepon')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                           id="email" name="email" 
                           value="{{ old('email', $pelanggan->email) }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('pelanggan.show', $pelanggan->id) }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection