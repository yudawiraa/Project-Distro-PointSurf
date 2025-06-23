<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PelangganController extends Controller
{
    public function index()
    {
        try {
            return view('pelanggan.index', [
                'pelanggans' => Pelanggan::all()
            ]);
        } catch (\Exception $e) {
            return redirect()->route('pelanggan.index')->withErrors('Terjadi kesalahan saat mengambil data pelanggan.');
        }
    }

    public function create()
    {
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
            Pelanggan::create([
                'nama_pelanggan' => $request->input('nama_pelanggan'),
                'alamat' => $request->input('alamat'),
                'no_telepon' => $request->input('no_telepon'),
                'email' => $request->input('email'),
            ]);

            return redirect()->route('pelanggan.index')
                ->with('success', 'Data pelanggan berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->route('pelanggan.create')->withErrors('Terjadi kesalahan saat menyimpan data pelanggan.');
        }
    }

    public function show($id)
    {
        try {
            $pelanggan = Pelanggan::findOrFail($id);
            return view('pelanggan.show', compact('pelanggan'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('pelanggan.index')->withErrors('Data pelanggan tidak ditemukan.');
        } catch (\Exception $e) {
            return redirect()->route('pelanggan.index')->withErrors('Terjadi kesalahan saat mengambil data pelanggan.');
        }
    }

    public function edit($id)
    {
        try {
            $pelanggan = Pelanggan::findOrFail($id);
            return view('pelanggan.edit', compact('pelanggan'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('pelanggan.index')->withErrors('Data pelanggan tidak ditemukan.');
        } catch (\Exception $e) {
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
            $pelanggan = Pelanggan::findOrFail($id);

            $pelanggan->update([
                'nama_pelanggan' => $request->input('nama_pelanggan'),
                'alamat' => $request->input('alamat'),
                'no_telepon' => $request->input('no_telepon'),
                'email' => $request->input('email'),
            ]);

            return redirect()->route('pelanggan.index')->with('success', 'Data pelanggan berhasil diperbarui!');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('pelanggan.index')->withErrors('Data pelanggan tidak ditemukan.');
        } catch (\Exception $e) {
            return redirect()->route('pelanggan.index')->withErrors('Terjadi kesalahan saat memperbarui data pelanggan.');
        }
    }

    public function delete($id)
    {
        try {
            $pelanggan = Pelanggan::findOrFail($id);
            return view('pelanggan.delete', compact('pelanggan'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('pelanggan.index')->withErrors('Data pelanggan tidak ditemukan.');
        } catch (\Exception $e) {
            return redirect()->route('pelanggan.index')->withErrors('Terjadi kesalahan saat mengambil data pelanggan.');
        }
    }

    public function destroy($id)
    {
        try {
            $pelanggan = Pelanggan::findOrFail($id);
            $pelanggan->delete();

            return redirect()->route('pelanggan.index')->with('success', 'Data pelanggan berhasil dihapus!');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('pelanggan.index')->withErrors('Data pelanggan tidak ditemukan.');
        } catch (\Exception $e) {
            return redirect()->route('pelanggan.index')->withErrors('Terjadi kesalahan saat menghapus data pelanggan.');
        }
    }
}
