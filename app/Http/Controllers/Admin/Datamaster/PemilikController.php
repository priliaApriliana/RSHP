<?php

namespace App\Http\Controllers\Admin\Datamaster;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemilik;
use App\Models\User;

class PemilikController extends Controller
{
    // Tampilkan data
    public function pemilik()
    {
        $pemilik = Pemilik::with('user')->get();
        return view('admin.datamaster.pemilik.pemilik', compact('pemilik'));
    }

    // Form tambah data
    public function create()
    {
        $users = User::all();
        return view('admin.datamaster.pemilik.create', compact('users'));
    }

    // Simpan data
    public function store(Request $request)
    {
        $request->validate([
            'no_wa' => 'required',
            'alamat' => 'required',
            'iduser' => 'required|exists:user,iduser',
        ]);

        Pemilik::create($request->all());
        return redirect()->route('pemilik.index')->with('success', 'Data pemilik berhasil ditambahkan!');
    }

    // Form edit
    public function edit($id)
    {
        $data = Pemilik::findOrFail($id);
        $users = User::all();
        return view('admin.datamaster.pemilik.edit', compact('data', 'users'));
    }

    // Update data
    public function update(Request $request, $id)
    {
        $data = Pemilik::findOrFail($id);
        $data->update($request->all());
        return redirect()->route('pemilik.index')->with('success', 'Data pemilik berhasil diperbarui!');
    }

    // Hapus data
    public function destroy($id)
    {
        Pemilik::findOrFail($id)->delete();
        return redirect()->route('pemilik.index')->with('success', 'Data pemilik berhasil dihapus!');
    }
}
