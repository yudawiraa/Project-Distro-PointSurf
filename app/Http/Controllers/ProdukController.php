<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProdukController extends Controller
{
    public function index()
    {
        try {
            $produks = Produk::orderBy('id', 'desc')->paginate(10); // Angka 10 adalah contoh jumlah item per halaman
            return view('produk.index', compact('produks'));
        } catch (\Exception $e) {
            return redirect()->route('produk.index')->withErrors('Terjadi kesalahan saat mengambil data produk.');
        }
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

        try {
            Produk::create([
                'nama_produk' => $request->input('nama_produk'),
                'deskripsi' => $request->input('deskripsi'),
                'harga' => $request->input('harga'),
                'stok' => $request->input('stok'),
                'kategori' => $request->input('kategori'),
            ]);

            return redirect()->route('produk.index')
                ->with('success', 'Data produk berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->route('produk.create')->withErrors('Terjadi kesalahan saat menyimpan data produk.');
        }
    }

    public function show($id)
    {
        try {
            $produk = Produk::findOrFail($id);
            return view('produk.show', compact('produk'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('produk.index')->withErrors('Data produk tidak ditemukan.');
        } catch (\Exception $e) {
            return redirect()->route('produk.index')->withErrors('Terjadi kesalahan saat mengambil data produk.');
        }
    }

    public function edit($id)
    {
        try {
            $produk = Produk::findOrFail($id);
            return view('produk.edit', compact('produk'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('produk.index')->withErrors('Data produk tidak ditemukan.');
        } catch (\Exception $e) {
            return redirect()->route('produk.index')->withErrors('Terjadi kesalahan saat mengambil data produk.');
        }
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

        try {
            $produk = Produk::findOrFail($id);

            $produk->update([
                'nama_produk' => $request->input('nama_produk'),
                'deskripsi' => $request->input('deskripsi'),
                'harga' => $request->input('harga'),
                'stok' => $request->input('stok'),
                'kategori' => $request->input('kategori'),
            ]);

            return redirect()->route('produk.show', $id);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('produk.index')->withErrors('Data produk tidak ditemukan.');
        } catch (\Exception $e) {
            return redirect()->route('produk.index')->withErrors('Terjadi kesalahan saat memperbarui data produk.');
        }
    }

    public function delete($id)
    {
        try {
            $produk = Produk::findOrFail($id);
            return view('produk.delete', compact('produk'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('produk.index')->withErrors('Data produk tidak ditemukan.');
        } catch (\Exception $e) {
            return redirect()->route('produk.index')->withErrors('Terjadi kesalahan saat mengambil data produk.');
        }
    }

    public function destroy($id)
    {
        try {
            $produk = Produk::findOrFail($id);
            $produk->delete();

            return redirect()->route('produk.index');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('produk.index')->withErrors('Data produk tidak ditemukan.');
        } catch (\Exception $e) {
            return redirect()->route('produk.index')->withErrors('Terjadi kesalahan saat menghapus data produk.');
        }
    }
}
