<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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

        DB::table('dokter')->insert([
            'alamat' => trim($request->alamat),
            'no_hp' => trim($request->no_hp),
            'bidang_dokter' => trim($request->bidang_dokter),
            'jenis_kelamin' => $request->jenis_kelamin,
            'id_user' => $request->id_user,
        ]);

        return redirect()->route('admin.dokter.index')
            ->with('success', 'Data dokter berhasil ditambahkan!');
    }

    /**
     * Edit Dokter
     */
    public function edit($id)
    {
        $dokter = DB::table('dokter')
            ->where('id_dokter', $id)
            ->first();

        if (!$dokter) {
            return redirect()->route('admin.dokter.index')
                ->with('error', 'Data dokter tidak ditemukan.');
        }

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

        DB::table('dokter')
            ->where('id_dokter', $id)
            ->update([
                'alamat' => trim($request->alamat),
                'no_hp' => trim($request->no_hp),
                'bidang_dokter' => trim($request->bidang_dokter),
                'jenis_kelamin' => $request->jenis_kelamin,
            ]);

        return redirect()->route('admin.dokter.index')
            ->with('success', 'Data dokter berhasil diperbarui!');
    }

    /**
     * Hapus Dokter
     */
    public function destroy($id)
    {
        $dokter = DB::table('dokter')
            ->where('id_dokter', $id)
            ->first();

        if (!$dokter) {
            return redirect()->route('admin.dokter.index')
                ->with('error', 'Data dokter tidak ditemukan.');
        }

        // CEK RELASI - PERBAIKI: Cek ke temu_dokter (bukan langsung ke rekam_medis)
        $dipakai = DB::table('temu_dokter')  // ← UBAH KE TEMU_DOKTER
            ->join('role_user', 'temu_dokter.idrole_user', '=', 'role_user.idrole_user')
            ->where('role_user.iduser', $dokter->id_user)
            ->where('role_user.idrole', 2)  // 2 = role Dokter
            ->count();

        if ($dipakai > 0) {
            return redirect()->route('admin.dokter.index')
                ->with('error', 'Data dokter tidak dapat dihapus karena sedang digunakan di temu dokter.');
        }

        // BARU DIHAPUS
        DB::table('dokter')
            ->where('id_dokter', $id)
            ->delete();

        return redirect()->route('admin.dokter.index')
            ->with('success', 'Data dokter berhasil dihapus!');
    }

}
