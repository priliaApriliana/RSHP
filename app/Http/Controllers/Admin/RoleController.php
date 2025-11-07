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
        // validasi input
        $validatedData = $this->validateRole($request);

        // helper untuk menyimpan data
        $this->createRole($validatedData);

        return redirect()->route('admin.role.index')
                         ->with('success', 'Role berhasil ditambahkan!');
    }

    // validation
    protected function validateRole(Request $request, $id = null)
    {
        // aturan unique tergantung apakah create atau update
        $uniqueRule = $id
            ? 'unique:role,nama_role,' . $id . ',idrole'
            : 'unique:role,nama_role';

        return $request->validate([
            'nama_role' => ['required', 'string', 'min:3', 'max:100', $uniqueRule],
            'deskripsi'     => ['nullable', 'string', 'max:255'],
        ], [
            'nama_role.required' => 'Nama role wajib diisi.',
            'nama_role.string'   => 'Nama role harus berupa teks.',
            'nama_role.min'      => 'Nama role minimal 3 karakter.',
            'nama_role.max'      => 'Nama role maksimal 100 karakter.',
            'nama_role.unique'   => 'Nama role sudah terdaftar.',
        ]);
    }

        // HELPER: Simpan ke database
    // -------------------------------
    protected function createRole(array $data)
    {
        try {
            // get last id
            $lastRole = Role::orderBy('idrole', 'desc')->first();
            $newId = $lastRole ? $lastRole->idrole + 1 : 1;

            return Role::create([
                'idrole'     => $newId,
                'nama_role'  => $this->formatTitleCase($data['nama_role']),
                'deskripsi'      => $data['deskripsi'] ?? null,
            ]);
        } catch (\Exception $e) {
            throw new \Exception('Gagal menyimpan data Role: ' . $e->getMessage());
        }
    }

    // HELPER: Format teks jadi Title Case
    protected function formatTitleCase($string)
    {
        return trim(ucwords(strtolower($string)));
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
