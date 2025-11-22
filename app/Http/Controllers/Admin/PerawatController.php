<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Perawat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PerawatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $perawats = DB::table('perawat')
            ->join('user', 'perawat.iduser', '=', 'user.iduser')
            ->select(
                'perawat.*',
                'user.nama_lengkap',
                'user.email'
            )
            ->get();

        return view('admin.perawat.index', compact('perawats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil user yang belum terdaftar sebagai perawat dan memiliki role perawat
        $users = DB::table('user')
            ->join('role_user', 'user.iduser', '=', 'role_user.iduser')
            ->join('role', 'role_user.idrole', '=', 'role.idrole')
            ->whereNotIn('user.iduser', function($query) {
                $query->select('iduser')->from('perawat');
            })
            ->where('role.nama_role', 'Perawat')
            ->select('user.iduser', 'user.nama_lengkap', 'user.email')
            ->get();

        return view('admin.perawat.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'iduser' => 'required|exists:user,iduser',
            'no_str' => 'required|string|max:50|unique:perawat,no_str',
            'alamat' => 'nullable|string',
            'no_telepon' => 'required|string|max:20',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'nullable|date',
            'pendidikan_terakhir' => 'nullable|string|max:100',
            'tahun_pengalaman' => 'required|integer|min:0',
            'shift' => 'required|in:pagi,siang,malam',
            'status' => 'required|in:aktif,nonaktif'
        ]);

        Perawat::create($request->all());

        return redirect()->route('admin.perawat.index')
            ->with('success', 'Data perawat berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $perawat = DB::table('perawat')
            ->join('user', 'perawat.iduser', '=', 'user.iduser')
            ->where('perawat.idperawat', $id)
            ->select('perawat.*', 'user.nama_lengkap', 'user.email')
            ->first();

        return view('admin.perawat.show', compact('perawat'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $perawat = Perawat::findOrFail($id);
        
        return view('admin.perawat.edit', compact('perawat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $perawat = Perawat::findOrFail($id);

        $request->validate([
            'no_str' => 'required|string|max:50|unique:perawat,no_str,' . $id . ',idperawat',
            'alamat' => 'nullable|string',
            'no_telepon' => 'required|string|max:20',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'nullable|date',
            'pendidikan_terakhir' => 'nullable|string|max:100',
            'tahun_pengalaman' => 'required|integer|min:0',
            'shift' => 'required|in:pagi,siang,malam',
            'status' => 'required|in:aktif,nonaktif'
        ]);

        $perawat->update($request->all());

        return redirect()->route('admin.perawat.index')
            ->with('success', 'Data perawat berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $perawat = Perawat::findOrFail($id);
        $perawat->delete();

        return redirect()->route('admin.perawat.index')
            ->with('success', 'Data perawat berhasil dihapus!');
    }
}