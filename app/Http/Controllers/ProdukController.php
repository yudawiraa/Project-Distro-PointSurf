<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class ProdukController extends Controller
{
    public function index()
    {
        try {
            // Log informasi sukses saat menampilkan data produk
            Log::info('Menampilkan daftar produk');
            $produks = Produk::orderBy('id', 'desc')->paginate(10); // Angka 10 adalah contoh jumlah item per halaman
            return view('produk.index', compact('produks'));
        } catch (\Exception $e) {
            // Log error jika terjadi kesalahan
            Log::error("Error mengambil data produk: " . $e->getMessage(), [
                'request' => request()->all(),
                'trace' => $e->getTraceAsString(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            return redirect()->route('produk.index')->withErrors('Terjadi kesalahan saat mengambil data produk.');
        }
    }

    public function create()
    {
        // Log informasi sukses saat menampilkan form untuk menambah produk
        Log::info('Menampilkan form pembuatan produk');
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
            // Log informasi saat menyimpan produk baru
            Log::info('Menyimpan data produk', ['data' => $request->all()]);
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
            // Log error jika terjadi kesalahan saat menyimpan produk
            Log::error("Error menyimpan data produk: " . $e->getMessage(), [
                'request' => request()->all(),
                'trace' => $e->getTraceAsString(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            return redirect()->route('produk.create')->withErrors('Terjadi kesalahan saat menyimpan data produk.');
        }
    }

    public function show($id)
    {
        try {
            // Log informasi saat menampilkan detail produk
            Log::info('Menampilkan detail produk', ['id' => $id]);
            $produk = Produk::findOrFail($id);
            return view('produk.show', compact('produk'));
        } catch (ModelNotFoundException $e) {
            // Log error jika produk tidak ditemukan
            Log::error("Data produk tidak ditemukan: " . $e->getMessage(), [
                'id' => $id,
                'request' => request()->all(),
                'trace' => $e->getTraceAsString(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            return redirect()->route('produk.index')->withErrors('Data produk tidak ditemukan.');
        } catch (\Exception $e) {
            // Log error jika terjadi kesalahan lain
            Log::error("Error mengambil data produk: " . $e->getMessage(), [
                'id' => $id,
                'request' => request()->all(),
                'trace' => $e->getTraceAsString(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            return redirect()->route('produk.index')->withErrors('Terjadi kesalahan saat mengambil data produk.');
        }
    }

    public function edit($id)
    {
        try {
            // Log informasi saat menampilkan form edit produk
            Log::info('Menampilkan form edit produk', ['id' => $id]);
            $produk = Produk::findOrFail($id);
            return view('produk.edit', compact('produk'));
        } catch (ModelNotFoundException $e) {
            // Log error jika produk tidak ditemukan untuk diedit
            Log::error("Data produk tidak ditemukan untuk diedit: " . $e->getMessage(), [
                'id' => $id,
                'request' => request()->all(),
                'trace' => $e->getTraceAsString(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            return redirect()->route('produk.index')->withErrors('Data produk tidak ditemukan.');
        } catch (\Exception $e) {
            // Log error jika terjadi kesalahan lain saat mengambil produk untuk edit
            Log::error("Error mengambil data produk untuk edit: " . $e->getMessage(), [
                'id' => $id,
                'request' => request()->all(),
                'trace' => $e->getTraceAsString(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
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
            // Log informasi saat memperbarui produk
            Log::info('Memperbarui data produk', ['id' => $id, 'data' => $request->all()]);
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
            // Log error jika produk tidak ditemukan untuk update
            Log::error("Data produk tidak ditemukan untuk diupdate: " . $e->getMessage(), [
                'id' => $id,
                'request' => request()->all(),
                'trace' => $e->getTraceAsString(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            return redirect()->route('produk.index')->withErrors('Data produk tidak ditemukan.');
        } catch (\Exception $e) {
            // Log error jika terjadi kesalahan saat memperbarui produk
            Log::error("Error memperbarui data produk: " . $e->getMessage(), [
                'id' => $id,
                'request' => request()->all(),
                'trace' => $e->getTraceAsString(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            return redirect()->route('produk.index')->withErrors('Terjadi kesalahan saat memperbarui data produk.');
        }
    }

    public function delete($id)
    {
        try {
            // Log informasi saat menampilkan konfirmasi penghapusan produk
            Log::info('Menampilkan form konfirmasi penghapusan produk', ['id' => $id]);
            $produk = Produk::findOrFail($id);
            return view('produk.delete', compact('produk'));
        } catch (ModelNotFoundException $e) {
            // Log error jika produk tidak ditemukan untuk dihapus
            Log::error("Data produk tidak ditemukan untuk dihapus: " . $e->getMessage(), [
                'id' => $id,
                'request' => request()->all(),
                'trace' => $e->getTraceAsString(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            return redirect()->route('produk.index')->withErrors('Data produk tidak ditemukan.');
        } catch (\Exception $e) {
            // Log error jika terjadi kesalahan saat mengambil produk untuk penghapusan
            Log::error("Error mengambil data produk untuk penghapusan: " . $e->getMessage(), [
                'id' => $id,
                'request' => request()->all(),
                'trace' => $e->getTraceAsString(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            return redirect()->route('produk.index')->withErrors('Terjadi kesalahan saat mengambil data produk.');
        }
    }

    public function destroy($id)
    {
        try {
            // Log informasi saat menghapus produk
            Log::info('Menghapus produk', ['id' => $id]);
            $produk = Produk::findOrFail($id);
            $produk->delete();

            return redirect()->route('produk.index');
        } catch (ModelNotFoundException $e) {
            // Log error jika produk tidak ditemukan saat penghapusan
            Log::error("Data produk tidak ditemukan untuk dihapus: " . $e->getMessage(), [
                'id' => $id,
                'request' => request()->all(),
                'trace' => $e->getTraceAsString(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            return redirect()->route('produk.index')->withErrors('Data produk tidak ditemukan.');
        } catch (\Exception $e) {
            // Log error jika terjadi kesalahan saat menghapus produk
            Log::error("Error menghapus data produk: " . $e->getMessage(), [
                'id' => $id,
                'request' => request()->all(),
                'trace' => $e->getTraceAsString(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            return redirect()->route('produk.index')->withErrors('Terjadi kesalahan saat menghapus data produk.');
        }
    }
}
