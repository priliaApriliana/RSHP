<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DokterController extends Controller
{
    /**
     * List Dokter
     */
    public function index()
    {
        $dokter = DB::table('dokter')
            ->join('user', 'dokter.id_user', '=', 'user.iduser')
            ->select('dokter.*', 'user.nama', 'user.email')
            ->get();

        return view('admin.dokter.index', compact('dokter'));
    }

    /**
     * Form Tambah Dokter
     */
    public function create()
    {
        // Ambil user yg role = Dokter dan belum masuk tabel dokter
        $user = DB::table('user')
            ->join('role_user', 'user.iduser', '=', 'role_user.iduser')
            ->join('role', 'role_user.idrole', '=', 'role.idrole')
            ->where('role.nama_role', 'Dokter')
            ->whereNotIn('user.iduser', function ($q) {
                $q->select('id_user')->from('dokter');
            })
            ->select('user.iduser', 'user.nama', 'user.email')
            ->get();

        return view('admin.dokter.create', compact('user'));
    }

    /**
     * Simpan Dokter
     */
    public function store(Request $request)
    {
        $request->validate([
            'alamat' => 'required|max:100',
            'no_hp' => 'required|max:45',
            'bidang_dokter' => 'required|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'id_user' => 'required|exists:user,iduser',
        ]);

        Dokter::create($request->all());

        return redirect()->route('admin.dokter.index')
            ->with('success', 'Data dokter berhasil ditambahkan!');
    }

    /**
     * Edit Dokter
     */
    public function edit($id)
    {
        $dokter = Dokter::findOrFail($id);

        // AMBIL DATA USER untuk dropdown
        $user = DB::table('user')->get();

        return view('admin.dokter.edit', compact('dokter', 'user'));
    }

    /**
     * Update Dokter
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'alamat' => 'required|max:100',
            'no_hp' => 'required|max:45',
            'bidang_dokter' => 'required|max:100',
            'jenis_kelamin' => 'required|in:L,P',
        ]);

        Dokter::findOrFail($id)->update($request->all());

        return redirect()->route('admin.dokter.index')
            ->with('success', 'Data dokter berhasil diperbarui!');
    }

    /**
     * Hapus Dokter
     */
    public function destroy($id)
    {
        Dokter::findOrFail($id)->delete();

        return redirect()->route('admin.dokter.index')
            ->with('success', 'Data dokter berhasil dihapus!');
    }
}
