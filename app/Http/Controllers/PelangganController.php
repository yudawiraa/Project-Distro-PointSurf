<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;

class PelangganController extends Controller
{
    public function index()
    {
        return view('pelanggan.index', [
            'pelanggans' => Pelanggan::all()
        ]);
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

        Pelanggan::create([
            'nama_pelanggan' => $request->input('nama_pelanggan'),
            'alamat' => $request->input('alamat'),
            'no_telepon' => $request->input('no_telepon'),
            'email' => $request->input('email'),
        ]);

        return redirect()->route('pelanggan.index');
    }

    public function show($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        return view('pelanggan.show', compact('pelanggan'));
    }

    public function edit($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        return view('pelanggan.edit', compact('pelanggan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:pelanggans,email,' . $id,

        ]);

        $pelanggan = Pelanggan::findOrFail($id);

        $pelanggan->update([
            'nama_pelanggan' => $request->input('nama_pelanggan'),
            'alamat' => $request->input('alamat'),
            'no_telepon' => $request->input('no_telepon'),
            'email' => $request->input('email'),
        ]);

        return redirect()->route('pelanggan.index');
    }

    public function delete($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        return view('pelanggan.delete', compact('pelanggan'));
    }

    public function destroy($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->delete();

        return redirect()->route('pelanggan.index');
    }
}
