<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PerawatController extends Controller
{
    /**
     * List Perawat
     */
    public function index()
    {
        $perawats = DB::table('perawat')
            ->join('user', 'perawat.id_user', '=', 'user.iduser')
            ->select(
                'perawat.*',
                'user.nama',
                'user.email'
            )
            ->get();

        return view('admin.perawat.index', compact('perawats'));
    }

    /**
     * Form Tambah Perawat
     */
    public function create()
    {
        // Hanya user yang berrole Perawat dan belum masuk tabel perawat
        $user = DB::table('user')
            ->join('role_user', 'user.iduser', '=', 'role_user.iduser')
            ->join('role', 'role_user.idrole', '=', 'role.idrole')
            ->where('role.nama_role', 'Perawat')
            ->whereNotIn('user.iduser', function ($q) {
                $q->select('id_user')->from('perawat');
            })
            ->select('user.iduser', 'user.nama', 'user.email')
            ->get();

        return view('admin.perawat.create', compact('user'));
    }

    /**
     * Simpan Perawat
     */
    public function store(Request $request)
    {
        $request->validate([
            'alamat' => 'required|max:100',
            'no_hp' => 'required|max:45',
            'jenis_kelamin' => 'required|in:L,P',
            'pendidikan' => 'required|max:100',
            'id_user' => 'required|exists:user,iduser',
        ]);

        DB::table('perawat')->insert([
            'alamat' => trim($request->alamat),
            'no_hp' => trim($request->no_hp),
            'jenis_kelamin' => $request->jenis_kelamin,
            'pendidikan' => trim($request->pendidikan),
            'id_user' => $request->id_user,
        ]);

        return redirect()->route('admin.perawat.index')
            ->with('success', 'Data perawat berhasil ditambahkan!');
    }


    /**
     * Show
     */
    public function show($id)
    {
        $perawat = DB::table('perawat')
            ->join('user', 'perawat.id_user', '=', 'user.iduser')
            ->where('perawat.id_perawat', $id)
            ->select('perawat.*', 'user.nama', 'user.email')
            ->first();

        return view('admin.perawat.show', compact('perawat'));
    }

    /**
     * Edit
     */
    public function edit($id)
    {
        $data = DB::table('perawat')->where('id_perawat', $id)->first();

        if (!$data) {
            return redirect()->route('admin.perawat.index')
                ->with('error', 'Data perawat tidak ditemukan.');
        }

        $user = DB::table('user')
            ->join('role_user', 'user.iduser', '=', 'role_user.iduser')
            ->join('role', 'role_user.idrole', '=', 'role.idrole')
            ->where('role.nama_role', 'Perawat')
            ->select('user.iduser', 'user.nama', 'user.email')
            ->get();

        return view('admin.perawat.edit', compact('data', 'user'));
    } 

    /**
     * Update
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'alamat' => 'required|max:100',
            'no_hp' => 'required|max:45',
            'jenis_kelamin' => 'required|in:L,P',
            'pendidikan' => 'required|max:100',
        ]);

        DB::table('perawat')
            ->where('id_perawat', $id)
            ->update([
                'alamat' => trim($request->alamat),
                'no_hp' => trim($request->no_hp),
                'jenis_kelamin' => $request->jenis_kelamin,
                'pendidikan' => trim($request->pendidikan),
            ]);

        return redirect()->route('admin.perawat.index')
            ->with('success', 'Data perawat berhasil diperbarui!');
    }

    /**
     * Hapus
     */
    public function destroy($id)
    {
        $perawat = DB::table('perawat')->where('id_perawat', $id)->first();

        if (!$perawat) {
            return redirect()->route('admin.perawat.index')
                ->with('error', 'Data perawat tidak ditemukan.');
        }

        DB::table('perawat')->where('id_perawat', $id)->delete();

        return redirect()->route('admin.perawat.index')
            ->with('success', 'Data perawat berhasil dihapus!');
    }

}
