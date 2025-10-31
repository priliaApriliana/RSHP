<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    //menampilkan daftar semua role
    public function index()
    {
        $role = Role::all();
        return view('admin.role.index', compact('role'));
    }
    
    // menampilkan form tambah role
    public function create()
    {
        return view('admin.role.create');
    }

    //menyimpan role baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'nama_role' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
        ]);

        Role::create($request->all());

        return redirect()->route('role.index')
                         ->with('success', 'Role berhasil ditambahkan!');
    }

    //menampilkan form edit role
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('admin.role.edit', compact('role'));
    }

    //memperbarui data role
    Public function update(Request $request, $id)
    {
        $request->validate([
            'nama_role' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
        ]);

        $role = Role::findOrFail($id);
        $role->update($request->all());

        return redirect()->route('role.index')
                         ->with('success', 'Role berhasil diperbarui!');
    }
    
    //menghapus role dari database
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('role.index')
                         ->with('success', 'Role berhasil dihapus!');
    }
}
