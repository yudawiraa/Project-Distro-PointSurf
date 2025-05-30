<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengguna;

class PenggunaController extends Controller
{
    public function index()
    {
        return view('pengguna.index', [
            'penggunas' => Pengguna::paginate(10)
        ]);
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

        Pengguna::create([
            'nama_pengguna' => $request->input('nama_pengguna'),
            'username' => $request->input('username'),
            'password' => $request->input('password'),
            'role' => $request->input('role'),
        ]);

        return redirect()->route('pengguna.index')
            ->with('success', 'Data pengguna berhasil ditambahkan!');
    }

    public function show($id)
    {
        $pengguna = Pengguna::findOrFail($id);
        return view('pengguna.show', compact('pengguna'));
    }

    public function edit($id)
    {
        $pengguna = Pengguna::findOrFail($id);
        return view('pengguna.edit', compact('pengguna'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pengguna' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'password' => 'required|string|max:255',
            'role' => 'required|in:admin,karyawan',
        ]);

        $pengguna = Pengguna::findOrFail($id);

        $pengguna->update([
            'nama_pengguna' => $request->input('nama_pengguna'),
            'username' => $request->input('username'),
            'password' => $request->input('password'),
            'role' => $request->input('role'),
        ]);

        return redirect()->route('pengguna.show', $id);
    }

    public function delete($id)
    {
        $pengguna = Pengguna::findOrFail($id);
        return view('pengguna.delete', compact('pengguna'));
    }

    public function destroy($id)
    {
        $pengguna = Pengguna::findOrFail($id);
        $pengguna->delete();

        return redirect()->route('pengguna.index');
    }
}
