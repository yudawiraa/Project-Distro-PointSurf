<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengguna;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PenggunaController extends Controller
{
    public function index()
    {
        try {
            return view('pengguna.index', [
                'penggunas' => Pengguna::paginate(10)
            ]);
        } catch (\Exception $e) {
            return redirect()->route('pengguna.index')->withErrors('Terjadi kesalahan saat mengambil data pengguna.');
        }
    }

    public function create()
    {
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
            Pengguna::create([
                'nama_pengguna' => $request->input('nama_pengguna'),
                'username' => $request->input('username'),
                'password' => $request->input('password'),
                'role' => $request->input('role'),
            ]);

            return redirect()->route('pengguna.index')
                ->with('success', 'Data pengguna berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->route('pengguna.create')->withErrors('Terjadi kesalahan saat menyimpan data pengguna.');
        }
    }

    public function show($id)
    {
        try {
            $pengguna = Pengguna::findOrFail($id);
            return view('pengguna.show', compact('pengguna'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('pengguna.index')->withErrors('Data pengguna tidak ditemukan.');
        } catch (\Exception $e) {
            return redirect()->route('pengguna.index')->withErrors('Terjadi kesalahan saat mengambil data pengguna.');
        }
    }

    public function edit($id)
    {
        try {
            $pengguna = Pengguna::findOrFail($id);
            return view('pengguna.edit', compact('pengguna'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('pengguna.index')->withErrors('Data pengguna tidak ditemukan.');
        } catch (\Exception $e) {
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
            $pengguna = Pengguna::findOrFail($id);

            $pengguna->update([
                'nama_pengguna' => $request->input('nama_pengguna'),
                'username' => $request->input('username'),
                'password' => $request->input('password'),
                'role' => $request->input('role'),
            ]);

            return redirect()->route('pengguna.show', $id);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('pengguna.index')->withErrors('Data pengguna tidak ditemukan.');
        } catch (\Exception $e) {
            return redirect()->route('pengguna.index')->withErrors('Terjadi kesalahan saat memperbarui data pengguna.');
        }
    }

    public function delete($id)
    {
        try {
            $pengguna = Pengguna::findOrFail($id);
            return view('pengguna.delete', compact('pengguna'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('pengguna.index')->withErrors('Data pengguna tidak ditemukan.');
        } catch (\Exception $e) {
            return redirect()->route('pengguna.index')->withErrors('Terjadi kesalahan saat mengambil data pengguna.');
        }
    }

    public function destroy($id)
    {
        try {
            $pengguna = Pengguna::findOrFail($id);
            $pengguna->delete();

            return redirect()->route('pengguna.index')->with('success', 'Data pengguna berhasil dihapus!');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('pengguna.index')->withErrors('Data pengguna tidak ditemukan.');
        } catch (\Exception $e) {
            return redirect()->route('pengguna.index')->withErrors('Terjadi kesalahan saat menghapus data pengguna: ' . $e->getMessage());
        }
    }
}
