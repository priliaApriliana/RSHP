<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = DB::table('user')
            ->orderBy('iduser', 'ASC')
            ->get();

        return view('admin.user.index', compact('users'));
    }

    // CREATE - Form tambah user
    public function create()
    {
        return view('admin.user.create');
    }

    // STORE - Simpan user baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|min:3|max:100',
            'email' => 'required|email|unique:user,email',
            'password' => 'nullable|min:6',
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'nama.min' => 'Nama minimal 3 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'password.min' => 'Password minimal 6 karakter.',
        ]);

        // Jika password kosong, gunakan default 123456
        $password = !empty($validated['password']) ? $validated['password'] : '123456';

        DB::table('user')->insert([
            'nama' => ucwords(strtolower(trim($validated['nama']))),
            'email' => strtolower(trim($validated['email'])),
            'password' => Hash::make($password),
        ]);

        return redirect()->route('admin.user.index')
            ->with('success', 'User berhasil ditambahkan!');
    }

    // EDIT - Form edit user
    public function edit($id)
    {
        $user = DB::table('user')->where('iduser', $id)->first();

        if (!$user) {
            return redirect()->route('admin.user.index')
                ->with('error', 'User tidak ditemukan.');
        }

        return view('admin.user.edit', compact('user'));
    }

    // UPDATE - Update user
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|min:3|max:100',
            'email' => 'required|email|unique:user,email,' . $id . ',iduser',
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'nama.min' => 'Nama minimal 3 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
        ]);

        DB::table('user')
            ->where('iduser', $id)
            ->update([
                'nama' => ucwords(strtolower(trim($validated['nama']))),
                'email' => strtolower(trim($validated['email'])),
            ]);

        return redirect()->route('admin.user.index')
            ->with('success', 'User berhasil diperbarui!');
    }

    // DESTROY - Hapus user
    public function destroy($id)
    {
        // Cek apakah user punya relasi di role_user
        $hasRoles = DB::table('role_user')->where('iduser', $id)->exists();

        if ($hasRoles) {
            return back()->with('error', 'User tidak dapat dihapus karena masih memiliki role.');
        }

        DB::table('user')->where('iduser', $id)->delete();

        return redirect()->route('admin.user.index')
            ->with('success', 'User berhasil dihapus!');
    }

    // RESET PASSWORD
    public function resetPassword($id)
    {
        DB::table('user')
            ->where('iduser', $id)
            ->update([
                'password' => Hash::make('123456')
            ]);

        return back()->with('success', 'Password berhasil direset menjadi 123456');
    }
}