<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;

class TransaksiController extends Controller
{
    public function index()
    {
        return view('transaksi.index', [
            'transaksis' => Transaksi::all()
        ]);
    }

    public function create()
    {
        return view('transaksi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_pelanggan' => 'required|exists:pelanggans,id',
            'id_produk' => 'required|exists:produks,id',
            'id_pengguna' => 'required|exists:penggunas,id',
            'harga_satuan' => 'required|numeric',
            'jumlah_beli' => 'required|numeric',
            'tanggal_transaksi' => 'required|date',
            'total_harga' => 'required|numeric',
            'status_pembayaran' => 'required|string|max:255'
        ]);

        Transaksi::create([
            'id_pelanggan' => $request->input('id_pelanggan'),
            'id_produk' => $request->input('id_produk'),
            'id_pengguna' => $request->input('id_pengguna'),
            'harga_satuan' => $request->input('harga_satuan'),
            'jumlah_beli' => $request->input('jumlah_beli'),
            'tanggal_transaksi' => $request->input('tanggal_transaksi'),
            'total_harga' => $request->input('total_harga'),
            'status_pembayaran' => $request->input('status_pembayaran'),
        ]);

        return redirect()->route('transaksi.index');
    }

    public function show($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        return view('transaksi.show', compact('transaksi'));
    }

    public function edit($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        return view('transaksi.edit', compact('transaksi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_pelanggan' => 'required|exists:pelanggans,id',
            'id_produk' => 'required|exists:produks,id',
            'id_pengguna' => 'required|exists:penggunas,id',
            'harga_satuan' => 'required|numeric',
            'jumlah_beli' => 'required|numeric',
            'tanggal_transaksi' => 'required|date',
            'total_harga' => 'required|numeric',
            'status_pembayaran' => 'required|string|max:255'
        ]);

        $transaksi = Transaksi::findOrFail($id);

        $transaksi->update([
            'id_pelanggan' => $request->input('id_pelanggan'),
            'id_produk' => $request->input('id_produk'),
            'id_pengguna' => $request->input('id_pengguna'),
            'harga_satuan' => $request->input('harga_satuan'),
            'jumlah_beli' => $request->input('jumlah_beli'),
            'tanggal_transaksi' => $request->input('tanggal_transaksi'),
            'total_harga' => $request->input('total_harga'),
            'status_pembayaran' => $request->input('status_pembayaran'),
        ]);

        return redirect()->route('transaksi.show', $id);
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