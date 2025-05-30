<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Pelanggan;
use App\Models\Produk;
use App\Models\Pengguna;

class TransaksiController extends Controller
{
    public function index()
    {
        return view('transaksi.index', [
            'transaksis' => Transaksi::with(['pelanggan', 'produk'])->paginate(10)
        ]);
    }

    public function create()
    {
        $pelanggans = Pelanggan::all();
        $produks = Produk::all();
        $penggunas = Pengguna::all();
        
        return view('transaksi.create', compact('pelanggans', 'produks', 'penggunas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'produk_id' => 'required|exists:produks,id',
            'jumlah' => 'required|numeric|min:1',
            'tanggal_transaksi' => 'required|date',
            'status' => 'required|in:pending,proses,selesai'
        ]);

        $produk = Produk::findOrFail($request->produk_id);
        
        // Calculate total_harga
        $total_harga = $produk->harga * $request->jumlah;

        Transaksi::create([
            'pelanggan_id' => $request->pelanggan_id,
            'produk_id' => $request->produk_id,
            'jumlah' => $request->jumlah,
            'tanggal_transaksi' => $request->tanggal_transaksi,
            'total_harga' => $total_harga,
            'status' => $request->status
        ]);

        return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi berhasil ditambahkan!');
    }

    public function show($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        return view('transaksi.show', compact('transaksi'));
    }

    public function edit($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $pelanggans = Pelanggan::all();
        $produks = Produk::all();
        $penggunas = Pengguna::all();
        
        return view('transaksi.edit', compact('transaksi', 'pelanggans', 'produks', 'penggunas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'produk_id' => 'required|exists:produks,id',
            'jumlah' => 'required|numeric|min:1',
            'tanggal_transaksi' => 'required|date',
            'status' => 'required|in:pending,proses,selesai'
        ]);

        $transaksi = Transaksi::findOrFail($id);
        $produk = Produk::findOrFail($request->produk_id);
        
        // Calculate total_harga
        $total_harga = $produk->harga * $request->jumlah;

        $transaksi->update([
            'pelanggan_id' => $request->pelanggan_id,
            'produk_id' => $request->produk_id,
            'jumlah' => $request->jumlah,
            'tanggal_transaksi' => $request->tanggal_transaksi,
            'total_harga' => $total_harga,
            'status' => $request->status
        ]);

        return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi berhasil diupdate!');
    }

    public function delete($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        return view('transaksi.delete', compact('transaksi'));
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();

        return redirect()->route('transaksi.index');
    }
}