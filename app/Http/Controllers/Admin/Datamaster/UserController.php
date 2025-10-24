<?php

namespace App\Http\Controllers\Admin\Datamaster;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Tampilkan daftar user + role
    public function index()
    {
        //ambil semua user beserta relai role-nya
        $users = User::with('roles')->get(); // ambil user + relasi role
        return view('admin.datamaster.user.index', compact('users'));
    }

    // Form tambah user
    public function create()
    {
        $roles = Role::all();
        return view('admin.datamaster.user.create', compact('roles'));
    }

    // Simpan user baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:user,email',
            'password' => 'required|min:6',
            'roles' => 'required|array'
        ]);

        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // simpan relasi ke tabel pivot
        $user->roles()->sync($request->roles);
            return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan');
    }

    // Form edit user
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
            return view('admin.datamaster.user.edit', compact('user', 'roles'));
    }

    // Update data user
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:user,email,' . $id . ',iduser',
            'roles' => 'required|array'
        ]);

        $user->update([
            'nama' => $request->nama,
            'email' => $request->email,
        ]);

        $user->roles()->sync($request->roles);
        return redirect()->route('user.index')->with('success', 'Data user berhasil diperbarui');
    }

    // Hapus user
    public function destroy($id)
    {   
        $user = User::findOrFail($id);
        $user->roles()->detech();
        $user->delete();
        return redirect()->route('user.index')->with('success', 'User berhasil dihapus');
    }
}
