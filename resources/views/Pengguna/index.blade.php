@extends('layouts.app')

@section('title', 'Daftar Pengguna')

@section('content')
<div class="container py-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Pengguna</h5>
            <a href="{{ route('pengguna.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Pengguna
            </a>
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

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Pengguna</th>
                        
                            <th>--></th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($penggunas as $index => $pengguna)
                        <tr>
                            <td>{{ $penggunas->firstItem() + $index }}</td>
                            <td>{{ $pengguna->nama_pengguna }}</td>
                            <td>{{ $pengguna->email }}</td>
                            <td>
                                <span class="badge bg-{{ $pengguna->role == 'admin' ? 'primary' : 'secondary' }}">
                                    {{ ucfirst($pengguna->role) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('pengguna.show', $pengguna->id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('pengguna.edit', $pengguna->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ route('pengguna.delete', $pengguna->id) }}" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>            

            <div class="mt-4">
                {{ $penggunas->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
