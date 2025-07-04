<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengguna;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class PenggunaController extends Controller
{
    public function index()
    {
        try {
            // Log informasi ketika menampilkan data pengguna
            Log::info('Menampilkan daftar pengguna');
            return view('pengguna.index', [
                'penggunas' => Pengguna::paginate(10)
            ]);
        } catch (\Exception $e) {
            // Log error jika terjadi kesalahan
            Log::error("Error mengambil data pengguna: " . $e->getMessage(), [
                'request' => request()->all(),
                'trace' => $e->getTraceAsString(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            return redirect()->route('pengguna.index')->withErrors('Terjadi kesalahan saat mengambil data pengguna.');
        }
    }

    public function create()
    {
        // Log informasi saat menampilkan form pembuatan pengguna
        Log::info('Menampilkan form pembuatan pengguna');
        return view('pengguna.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pengguna' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'password' => 'required|string|max:255',
            'role' => 'required|in:admin,karyawan',
        ]);

        try {
            // Log informasi saat menyimpan pengguna baru
            Log::info('Menyimpan data pengguna', ['data' => $request->all()]);
            Pengguna::create([
                'nama_pengguna' => $request->input('nama_pengguna'),
                'username' => $request->input('username'),
                'password' => $request->input('password'),
                'role' => $request->input('role'),
            ]);

            return redirect()->route('pengguna.index')
                ->with('success', 'Data pengguna berhasil ditambahkan!');
        } catch (\Exception $e) {
            // Log error saat terjadi kesalahan saat menyimpan pengguna
            Log::error("Error menyimpan data pengguna: " . $e->getMessage(), [
                'request' => request()->all(),
                'trace' => $e->getTraceAsString(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            return redirect()->route('pengguna.create')->withErrors('Terjadi kesalahan saat menyimpan data pengguna.');
        }
    }

    public function show($id)
    {
        try {
            // Log informasi saat menampilkan detail pengguna
            Log::info('Menampilkan detail pengguna', ['id' => $id]);
            $pengguna = Pengguna::findOrFail($id);
            return view('pengguna.show', compact('pengguna'));
        } catch (ModelNotFoundException $e) {
            // Log error saat data pengguna tidak ditemukan
            Log::error("Data pengguna tidak ditemukan: " . $e->getMessage(), [
                'id' => $id,
                'request' => request()->all(),
                'trace' => $e->getTraceAsString(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            return redirect()->route('pengguna.index')->withErrors('Data pengguna tidak ditemukan.');
        } catch (\Exception $e) {
            // Log error untuk kesalahan umum
            Log::error("Error mengambil data pengguna: " . $e->getMessage(), [
                'id' => $id,
                'request' => request()->all(),
                'trace' => $e->getTraceAsString(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            return redirect()->route('pengguna.index')->withErrors('Terjadi kesalahan saat mengambil data pengguna.');
        }
    }

    public function edit($id)
    {
        try {
            // Log informasi saat menampilkan form edit pengguna
            Log::info('Menampilkan form edit pengguna', ['id' => $id]);
            $pengguna = Pengguna::findOrFail($id);
            return view('pengguna.edit', compact('pengguna'));
        } catch (ModelNotFoundException $e) {
            // Log error saat data pengguna tidak ditemukan untuk diedit
            Log::error("Data pengguna tidak ditemukan untuk diedit: " . $e->getMessage(), [
                'id' => $id,
                'request' => request()->all(),
                'trace' => $e->getTraceAsString(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            return redirect()->route('pengguna.index')->withErrors('Data pengguna tidak ditemukan.');
        } catch (\Exception $e) {
            // Log error untuk kesalahan umum saat mengambil data pengguna
            Log::error("Error mengambil data pengguna untuk edit: " . $e->getMessage(), [
                'id' => $id,
                'request' => request()->all(),
                'trace' => $e->getTraceAsString(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            return redirect()->route('pengguna.index')->withErrors('Terjadi kesalahan saat mengambil data pengguna.');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pengguna' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'password' => 'required|string|max:255',
            'role' => 'required|in:admin,karyawan',
        ]);

        try {
            // Log informasi saat memperbarui data pengguna
            Log::info('Memperbarui data pengguna', ['id' => $id, 'data' => $request->all()]);
            $pengguna = Pengguna::findOrFail($id);

            $pengguna->update([
                'nama_pengguna' => $request->input('nama_pengguna'),
                'username' => $request->input('username'),
                'password' => $request->input('password'),
                'role' => $request->input('role'),
            ]);

            return redirect()->route('pengguna.show', $id);
        } catch (ModelNotFoundException $e) {
            // Log error saat pengguna tidak ditemukan untuk update
            Log::error("Data pengguna tidak ditemukan untuk diupdate: " . $e->getMessage(), [
                'id' => $id,
                'request' => request()->all(),
                'trace' => $e->getTraceAsString(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            return redirect()->route('pengguna.index')->withErrors('Data pengguna tidak ditemukan.');
        } catch (\Exception $e) {
            // Log error untuk kesalahan saat memperbarui data pengguna
            Log::error("Error memperbarui data pengguna: " . $e->getMessage(), [
                'id' => $id,
                'request' => request()->all(),
                'trace' => $e->getTraceAsString(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            return redirect()->route('pengguna.index')->withErrors('Terjadi kesalahan saat memperbarui data pengguna.');
        }
    }

    public function delete($id)
    {
        try {
            // Log informasi saat menampilkan konfirmasi penghapusan pengguna
            Log::info('Menampilkan form konfirmasi penghapusan pengguna', ['id' => $id]);
            $pengguna = Pengguna::findOrFail($id);
            return view('pengguna.delete', compact('pengguna'));
        } catch (ModelNotFoundException $e) {
            // Log error saat pengguna tidak ditemukan untuk dihapus
            Log::error("Data pengguna tidak ditemukan untuk dihapus: " . $e->getMessage(), [
                'id' => $id,
                'request' => request()->all(),
                'trace' => $e->getTraceAsString(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            return redirect()->route('pengguna.index')->withErrors('Data pengguna tidak ditemukan.');
        } catch (\Exception $e) {
            // Log error untuk kesalahan saat mengambil data pengguna untuk penghapusan
            Log::error("Error mengambil data pengguna untuk penghapusan: " . $e->getMessage(), [
                'id' => $id,
                'request' => request()->all(),
                'trace' => $e->getTraceAsString(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            return redirect()->route('pengguna.index')->withErrors('Terjadi kesalahan saat mengambil data pengguna.');
        }
    }

    public function destroy($id)
    {
        try {
            // Log informasi saat menghapus data pengguna
            Log::info('Menghapus data pengguna', ['id' => $id]);
            $pengguna = Pengguna::findOrFail($id);
            $pengguna->delete();

            return redirect()->route('pengguna.index')->with('success', 'Data pengguna berhasil dihapus!');
        } catch (ModelNotFoundException $e) {
            // Log error saat pengguna tidak ditemukan untuk dihapus
            Log::error("Data pengguna tidak ditemukan untuk dihapus: " . $e->getMessage(), [
                'id' => $id,
                'request' => request()->all(),
                'trace' => $e->getTraceAsString(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            return redirect()->route('pengguna.index')->withErrors('Data pengguna tidak ditemukan.');
        } catch (\Exception $e) {
            // Log error untuk kesalahan saat menghapus data pengguna
            Log::error("Error menghapus data pengguna: " . $e->getMessage(), [
                'id' => $id,
                'request' => request()->all(),
                'trace' => $e->getTraceAsString(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            return redirect()->route('pengguna.index')->withErrors('Terjadi kesalahan saat menghapus data pengguna.');
        }
    }
}
