<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Perawat;
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

        Perawat::create([
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'jenis_kelamin' => $request->jenis_kelamin,
            'pendidikan' => $request->pendidikan,
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
        $data = Perawat::findOrFail($id);
    
        // ambil user yang punya role perawat
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
        $perawat = Perawat::findOrFail($id);

        $request->validate([
            'alamat' => 'required|max:100',
            'no_hp' => 'required|max:45',
            'jenis_kelamin' => 'required|in:L,P',
            'pendidikan' => 'required|max:100',
        ]);

        $perawat->update($request->all());

        return redirect()->route('admin.perawat.index')
            ->with('success', 'Data perawat berhasil diperbarui!');
    }

    /**
     * Hapus
     */
    public function destroy($id)
    {
        Perawat::findOrFail($id)->delete();
        return redirect()->route('admin.perawat.index')
            ->with('success', 'Data perawat berhasil dihapus!');
    }
}
