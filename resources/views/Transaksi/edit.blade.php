@extends('layouts.app')

@section('title', 'Edit Transaksi')

@section('content')
<div class="container py-4">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Edit Transaksi</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('transaksi.update', $transaksi->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="tanggal_transaksi" class="form-label">Tanggal Transaksi</label>
                    <input type="date" class="form-control @error('tanggal_transaksi') is-invalid @enderror" 
                           id="tanggal_transaksi" name="tanggal_transaksi" 
                           value="{{ old('tanggal_transaksi', $transaksi->tanggal_transaksi) }}">
                    @error('tanggal_transaksi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="pelanggan_id" class="form-label">Pelanggan</label>
                    <select class="form-select @error('pelanggan_id') is-invalid @enderror" 
                            id="pelanggan_id" name="pelanggan_id">
                        @foreach($pelanggans as $pelanggan)
                            <option value="{{ $pelanggan->id }}" 
                                {{ old('pelanggan_id', $transaksi->pelanggan_id) == $pelanggan->id ? 'selected' : '' }}>
                                {{ $pelanggan->nama_pelanggan }}
                            </option>
                        @endforeach
                    </select>
                    @error('pelanggan_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="produk_id" class="form-label">Produk</label>
                    <select class="form-select @error('produk_id') is-invalid @enderror" 
                            id="produk_id" name="produk_id">
                        @foreach($produks as $produk)
                            <option value="{{ $produk->id }}" 
                                {{ old('produk_id', $transaksi->produk_id) == $produk->id ? 'selected' : '' }}>
                                {{ $produk->nama_produk }} - Rp {{ number_format($produk->harga, 0, ',', '.') }}
                            </option>
                        @endforeach
                    </select>
                    @error('produk_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah</label>
                    <input type="number" class="form-control @error('jumlah') is-invalid @enderror" 
                           id="jumlah" name="jumlah" 
                           value="{{ old('jumlah', $transaksi->jumlah) }}">
                    @error('jumlah')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select @error('status') is-invalid @enderror" 
                            id="status" name="status">
                        <option value="pending" {{ old('status', $transaksi->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="proses" {{ old('status', $transaksi->status) == 'proses' ? 'selected' : '' }}>Proses</option>
                        <option value="selesai" {{ old('status', $transaksi->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('transaksi.show', $transaksi->id) }}" class="btn btn-secondary">
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