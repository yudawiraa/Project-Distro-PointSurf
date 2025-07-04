<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class PelangganController extends Controller
{
    public function index()
    {
        try {
            // Log informasi ketika berhasil mengambil data pelanggan
            Log::info('Menampilkan semua data pelanggan');
            return view('pelanggan.index', [
                'pelanggans' => Pelanggan::all()
            ]);
        } catch (\Exception $e) {
            // Log error jika terjadi kesalahan
            Log::error('Error mengambil data pelanggan', [
                'error' => $e->getMessage(),
            ]);
            return redirect()->route('pelanggan.index')->withErrors('Terjadi kesalahan saat mengambil data pelanggan.');
        }
    }

    public function create()
    {
        Log::info('Menampilkan form pembuatan pelanggan');
        return view('pelanggan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:pelanggans,email,',
        ]);

        try {
            // Log informasi sebelum data disimpan
            Log::info('Menyimpan data pelanggan', ['data' => $request->all()]);

            Pelanggan::create([
                'nama_pelanggan' => $request->input('nama_pelanggan'),
                'alamat' => $request->input('alamat'),
                'no_telepon' => $request->input('no_telepon'),
                'email' => $request->input('email'),
            ]);

            return redirect()->route('pelanggan.index')
                ->with('success', 'Data pelanggan berhasil ditambahkan!');
        } catch (\Exception $e) {
            // Log error jika terjadi kesalahan saat menyimpan data
            Log::error('Error menyimpan data pelanggan', [
                'error' => $e->getMessage(),
                'request' => $request->all(),
            ]);
            return redirect()->route('pelanggan.create')->withErrors('Terjadi kesalahan saat menyimpan data pelanggan.');
        }
    }

    public function show($id)
    {
        try {
            // Log informasi saat mengambil data pelanggan
            Log::info('Menampilkan detail pelanggan', ['id' => $id]);
            $pelanggan = Pelanggan::findOrFail($id);
            return view('pelanggan.show', compact('pelanggan'));
        } catch (ModelNotFoundException $e) {
            // Log warning jika data tidak ditemukan
            Log::warning('Data pelanggan tidak ditemukan', ['id' => $id]);
            return redirect()->route('pelanggan.index')->withErrors('Data pelanggan tidak ditemukan.');
        } catch (\Exception $e) {
            // Log error jika terjadi kesalahan umum
            Log::error('Error mengambil data pelanggan', [
                'error' => $e->getMessage(),
                'id' => $id,
            ]);
            return redirect()->route('pelanggan.index')->withErrors('Terjadi kesalahan saat mengambil data pelanggan.');
        }
    }

    public function edit($id)
    {
        try {
            // Log informasi saat mengambil data pelanggan untuk edit
            Log::info('Menampilkan form edit data pelanggan', ['id' => $id]);
            $pelanggan = Pelanggan::findOrFail($id);
            return view('pelanggan.edit', compact('pelanggan'));
        } catch (ModelNotFoundException $e) {
            // Log warning jika data tidak ditemukan
            Log::warning('Data pelanggan tidak ditemukan untuk edit', ['id' => $id]);
            return redirect()->route('pelanggan.index')->withErrors('Data pelanggan tidak ditemukan.');
        } catch (\Exception $e) {
            // Log error jika terjadi kesalahan umum
            Log::error('Error mengambil data pelanggan untuk edit', [
                'error' => $e->getMessage(),
                'id' => $id,
            ]);
            return redirect()->route('pelanggan.index')->withErrors('Terjadi kesalahan saat mengambil data pelanggan.');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:pelanggans,email,' . $id,
        ]);

        try {
            // Log informasi saat memperbarui data pelanggan
            Log::info('Memperbarui data pelanggan', ['id' => $id, 'data' => $request->all()]);

            $pelanggan = Pelanggan::findOrFail($id);

            $pelanggan->update([
                'nama_pelanggan' => $request->input('nama_pelanggan'),
                'alamat' => $request->input('alamat'),
                'no_telepon' => $request->input('no_telepon'),
                'email' => $request->input('email'),
            ]);

            return redirect()->route('pelanggan.index')->with('success', 'Data pelanggan berhasil diperbarui!');
        } catch (ModelNotFoundException $e) {
            // Log warning jika data tidak ditemukan
            Log::warning('Data pelanggan tidak ditemukan untuk update', ['id' => $id]);
            return redirect()->route('pelanggan.index')->withErrors('Data pelanggan tidak ditemukan.');
        } catch (\Exception $e) {
            // Log error jika terjadi kesalahan saat memperbarui
            Log::error('Error memperbarui data pelanggan', [
                'error' => $e->getMessage(),
                'id' => $id,
                'request' => $request->all(),
            ]);
            return redirect()->route('pelanggan.index')->withErrors('Terjadi kesalahan saat memperbarui data pelanggan.');
        }
    }

    public function delete($id)
    {
        try {
            // Log informasi sebelum penghapusan
            Log::info('Menampilkan konfirmasi penghapusan pelanggan', ['id' => $id]);
            $pelanggan = Pelanggan::findOrFail($id);
            return view('pelanggan.delete', compact('pelanggan'));
        } catch (ModelNotFoundException $e) {
            // Log warning jika data tidak ditemukan
            Log::warning('Data pelanggan tidak ditemukan untuk dihapus', ['id' => $id]);
            return redirect()->route('pelanggan.index')->withErrors('Data pelanggan tidak ditemukan.');
        } catch (\Exception $e) {
            // Log error jika terjadi kesalahan
            Log::error('Error mengambil data pelanggan untuk penghapusan', [
                'error' => $e->getMessage(),
                'id' => $id,
            ]);
            return redirect()->route('pelanggan.index')->withErrors('Terjadi kesalahan saat mengambil data pelanggan.');
        }
    }

    public function destroy($id)
    {
        try {
            // Log informasi sebelum menghapus data pelanggan
            Log::info('Menghapus data pelanggan', ['id' => $id]);
            $pelanggan = Pelanggan::findOrFail($id);
            $pelanggan->delete();

            return redirect()->route('pelanggan.index')->with('success', 'Data pelanggan berhasil dihapus!');
        } catch (ModelNotFoundException $e) {
            // Log warning jika data tidak ditemukan
            Log::warning('Data pelanggan tidak ditemukan untuk dihapus', ['id' => $id]);
            return redirect()->route('pelanggan.index')->withErrors('Data pelanggan tidak ditemukan.');
        } catch (\Exception $e) {
            // Log error jika terjadi kesalahan saat menghapus
            Log::error('Error menghapus data pelanggan', [
                'error' => $e->getMessage(),
                'id' => $id,
            ]);
            return redirect()->route('pelanggan.index')->withErrors('Terjadi kesalahan saat menghapus data pelanggan.');
        }
    }
}
