<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validasi
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Ambil user dari tabel user
        $user = DB::table('user')
            ->where('email', $request->email)
            ->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan.']);
        }

        // Cek password
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Password salah.']);
        }

        // Ambil role user aktif
        $roleUser = DB::table('role_user')
            ->where('iduser', $user->iduser)
            ->where('status', 1)
            ->first();

        if (!$roleUser) {
            return back()->withErrors(['role' => 'Role tidak aktif.']);
        }

        // Ambil nama role
        $role = DB::table('role')
            ->where('idrole', $roleUser->idrole)
            ->first();

        // Login manual
        Auth::loginUsingId($user->iduser);

        // Simpan session
        session([
            'user_id'        => $user->iduser,
            'user_name'      => $user->nama,
            'user_email'     => $user->email,
            'user_role_id'   => $roleUser->idrole,
            'user_role_name' => $role->nama_role ?? 'User',
        ]);

        // Redirect berdasarkan role
        return match ($roleUser->idrole) {
            1 => redirect()->route('admin.dashboard'),
            2 => redirect()->route('dokter.dashboard'),
            3 => redirect()->route('perawat.dashboard'),
            4 => redirect()->route('resepsionis.dashboard'),
            5 => redirect()->route('pemilik.dashboard'),
        };
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('success', 'Logout berhasil!');
    }
}
