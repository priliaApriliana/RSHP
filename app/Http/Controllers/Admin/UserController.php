<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // INDEX: tampilkan semua data user
    public function index()
    {
        $user = User::all();
        return view('admin.user.index', compact('user'));
    }

    // CREATE: tampilkan form tambah user
    public function create()
    {
        return view('admin.user.create');
    }

    // STORE: simpan user baru
    public function store(Request $request)
    {
        // validasi input sesuai kolom tabel
        $validatedData = $request->validate([
            'nama'     => ['required', 'string', 'min:3', 'max:500'],
            'email'    => ['required', 'email', 'unique:user,email'],
            'password' => ['required', 'string', 'min:6'],
        ], [
            'nama.required' => 'Nama user wajib diisi.',
            'nama.min'      => 'Nama minimal 3 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
        ]);

        try {
            // ambil id terakhir
            $lastUser = User::orderBy('iduser', 'desc')->first();
            $newId = $lastUser ? $lastUser->iduser + 1 : 1;

            User::create([
                'iduser'   => $newId,
                'nama'     => trim(ucwords(strtolower($validatedData['nama']))),
                'email'    => strtolower($validatedData['email']),
                'password' => Hash::make($validatedData['password']),
            ]);

            return redirect()->route('admin.user.index')
                ->with('success', 'User berhasil ditambahkan.');
        } catch (\Exception $e) {
            throw new \Exception('Gagal menyimpan data User: ' . $e->getMessage());
        }
    }

    // EDIT: form edit user
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.edit', compact('user'));
    }

    // UPDATE: simpan perubahan
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'nama'     => ['required', 'string', 'min:3', 'max:500'],
            'email'    => ['required', 'email', 'unique:user,email,' . $id . ',iduser'],
            'password' => ['nullable', 'string', 'min:6'],
        ]);

        $updateData = [
            'nama'  => trim(ucwords(strtolower($validatedData['nama']))),
            'email' => strtolower($validatedData['email']),
        ];

        if (!empty($validatedData['password'])) {
            $updateData['password'] = Hash::make($validatedData['password']);
        }

        $user->update($updateData);

        return redirect()->route('admin.user.index')
            ->with('success', 'Data user berhasil diperbarui.');
    }

    // HAPUS
    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('admin.user.index')
            ->with('success', 'User berhasil dihapus.');
    }
}
