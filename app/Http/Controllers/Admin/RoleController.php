<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use App\Models\Role;

class RoleController extends Controller
{
    //menampilkan daftar semua role
    public function index()
    {
        $role = DB::table('role')->orderBy('idrole')->get();
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
        // cari id terakhir
        $last = DB::table('role')->orderBy('idrole', 'desc')->first();
        $newId = $last ? $last->idrole + 1 : 1;

        DB::table('role')->insert([
            'idrole'    => $newId,
            'nama_role' => $this->formatTitleCase($data['nama_role']),
        ]);
    }

    // HELPER: Format teks jadi Title Case
    protected function formatTitleCase($string)
    {
        return trim(ucwords(strtolower($string)));
    }


    //menampilkan form edit role
    public function edit($id)
    {
        $role = DB::table('role')->where('idrole', $id)->first();
        return view('admin.role.edit', compact('role'));
    }

    //memperbarui data role
    Public function update(Request $request, $id)
    {
        $request->validate([
            'nama_role' => 'required|string|max:100',
        ]);

        DB::table('role')
            ->where('idrole', $id)
            ->update([
                'nama_role' => $this->formatTitleCase($request->nama_role),
            ]);

        return redirect()->route('admin.role.index')
                         ->with('success', 'Role berhasil diperbarui!');
    }
    
    //menghapus role dari database
    public function destroy($id)
    {
        DB::table('role')->where('idrole', $id)->delete();

        return redirect()->route('admin.role.index')
                         ->with('success', 'Role berhasil dihapus!');
    }
}
