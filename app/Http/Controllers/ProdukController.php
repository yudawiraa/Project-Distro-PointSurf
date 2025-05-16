<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class ProdukController extends Controller
{
    public function index()
    {
        return view('produk.index', [
            'produks' => Produk::all()
        ]);
    }

    public function create()
    {
        return view('produk.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'kategori' => 'required|string|max:255',
        ]);

        Produk::create([
            'nama_produk' => $request->input('nama_produk'),
            'deskripsi' => $request->input('deskripsi'),
            'harga' => $request->input('harga'),
            'stok' => $request->input('stok'),
            'kategori' => $request->input('kategori'),
        ]);

        return redirect()->route('produk.index');
    }

    public function show($id)
    {
        $produk = Produk::findOrFail($id);
        return view('produk.show', compact('produk'));
    }

    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        return view('produk.edit', compact('produk'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'kategori' => 'required|string|max:255',
        ]);

        $produk = Produk::findOrFail($id);

        $produk->update([
            'nama_produk' => $request->input('nama_produk'),
            'deskripsi' => $request->input('deskripsi'),
            'harga' => $request->input('harga'),
            'stok' => $request->input('stok'),
            'kategori' => $request->input('kategori'),
        ]);

        return redirect()->route('produk.show', $id);
    }

    public function delete($id)
    {
        $produk = Produk::findOrFail($id);
        return view('produk.delete', compact('produk'));
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();

        return redirect()->route('produk.index');
    }
}
