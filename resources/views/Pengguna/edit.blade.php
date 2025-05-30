@extends('layouts.app')

@section('title', 'Edit Pengguna')

@section('content')
<div class="container py-4">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Edit Pengguna</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('pengguna.update', $pengguna->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nama_pengguna" class="form-label">Nama Pengguna</label>
                    <input type="text" class="form-control @error('nama_pengguna') is-invalid @enderror" 
                           id="nama_pengguna" name="nama_pengguna" 
                           value="{{ old('nama_pengguna', $pengguna->nama_pengguna) }}">
                    @error('nama_pengguna')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                           id="email" name="email" 
                           value="{{ old('email', $pengguna->email) }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-select @error('role') is-invalid @enderror" 
                            id="role" name="role">
                        <option value="admin" {{ old('role', $pengguna->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="user" {{ old('role', $pengguna->role) == 'user' ? 'selected' : '' }}>User</option>
                    </select>
                    @error('role')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('pengguna.show', $pengguna->id) }}" class="btn btn-secondary">
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