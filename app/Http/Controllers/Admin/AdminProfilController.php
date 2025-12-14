<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminProfilController extends Controller
{
    /**
     * Display admin profile
     */
    public function index()
    {
        $user = Auth::user();

        return view('admin.profil.index', compact('user'));
    }

    /**
     * Update admin profile
     */
    public function update(Request $request)
    {
        $userID = Auth::user()->iduser;

        // Validasi
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:user,email,' . $userID . ',iduser',
            'password' => 'nullable|min:6|confirmed',
        ]);

        // Update user table
        $userData = [
            'nama' => $request->nama,
            'email' => $request->email,
        ];

        // Jika password diisi, update password
        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        DB::table('user')
            ->where('iduser', $userID)
            ->update($userData);

        return redirect()->route('admin.profil')
            ->with('success', 'Profil berhasil diperbarui!');
    }
}