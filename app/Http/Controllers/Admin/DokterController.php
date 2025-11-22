<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use App\Models\User;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    /**
     * Tampilkan semua dokter
     */
    public function index()
    {
        $dokter = Dokter::with('user')->get();
        return view('admin.dokter.index', compact('dokter'));
    }

    /**
     * Form tambah dokter
     */
    public function create()
    {
        // ambil semua akun user agar bisa dipilih sebagai dokter
        $user = User::all();

        return view('admin.dokter.create', compact('user'));
    }

    /**
     * Simpan data dokter baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'alamat' => 'required|max:100',
            'no_hp' => 'required|max:45',
            'bidang_dokter' => 'required|max:100',
            'jenis_kelamin' => 'required|max:1',
            'id_user' => 'required'
        ]);

        Dokter::create([
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'bidang_dokter' => $request->bidang_dokter,
            'jenis_kelamin' => $request->jenis_kelamin,
            'id_user' => $request->id_user
        ]);

        return redirect()->route('admin.dokter.index')
            ->with('success', 'Data dokter berhasil ditambahkan.');
    }

    /**
     * Form edit dokter
     */
    public function edit($id)
    {
        $dokter = Dokter::findOrFail($id);
        $user = User::all();

        return view('admin.dokter.edit', compact('dokter', 'user'));
    }

    /**
     * Update dokter
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'alamat' => 'required|max:100',
            'no_hp' => 'required|max:45',
            'bidang_dokter' => 'required|max:100',
            'jenis_kelamin' => 'required|max:1',
            'id_user' => 'required'
        ]);

        Dokter::findOrFail($id)->update([
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'bidang_dokter' => $request->bidang_dokter,
            'jenis_kelamin' => $request->jenis_kelamin,
            'id_user' => $request->id_user
        ]);

        return redirect()->route('admin.dokter.index')
            ->with('success', 'Data dokter berhasil diupdate.');
    }

    /**
     * Hapus dokter
     */
    public function destroy($id)
    {
        Dokter::destroy($id);

        return redirect()->route('admin.dokter.index')
            ->with('success', 'Data dokter berhasil dihapus.');
    }
}
