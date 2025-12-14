<?php

namespace App\Http\Controllers\Perawat;

use App\Http\Controllers\Controller;
use App\Models\Perawat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class PerawatProfilController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $perawat = Perawat::where('id_user', $user->iduser)->first();

        return view('perawat.profil.index', compact('user', 'perawat'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nama' => 'required|string|max:500',
            'email' => 'required|email|unique:user,email,' . $user->iduser . ',iduser',
            'password' => 'nullable|min:6|confirmed',
            'jenis_kelamin' => 'nullable|in:J,B',
            'alamat' => 'nullable|string|max:100',
            'no_hp' => 'nullable|string|max:45',
            'pendidikan' => 'nullable|string|max:100',
        ]);

        // UPDATE USER (QUERY BUILDER)
        DB::table('user')
            ->where('iduser', $user->iduser)
            ->update([
                'nama' => $request->nama,
                'email' => $request->email,
                'password' => $request->filled('password')
                    ? Hash::make($request->password)
                    : $user->password
            ]);

        // UPDATE TABEL PERAWAT
        DB::table('perawat')
            ->where('id_user', $user->iduser)
            ->update([
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
                'jenis_kelamin' => $request->jenis_kelamin,
                'pendidikan' => $request->pendidikan
            ]);

        return redirect()->route('perawat.profil')
            ->with('success', 'Profil berhasil diupdate');
    }

}
