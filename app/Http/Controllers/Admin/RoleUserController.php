<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class RoleUserController extends Controller
{
    // ===============================
    // INDEX - Menampilkan semua relasi role-user
    // ===============================
    public function index()
    {
        $roleUsers = DB::table('role_user')
            ->join('user', 'role_user.iduser', '=', 'user.iduser')
            ->join('role', 'role_user.idrole', '=', 'role.idrole')
            ->select(
                'role_user.idrole_user',
                'user.nama as nama_user',
                'user.email as email_user',
                'role.nama_role',
                'role_user.status'
            )
            ->orderBy('idrole_user', 'ASC')
            ->get();

        return view('admin.Roleuser.index', compact('roleUsers'));
    }

    // ===============================
    // CREATE - Form tambah relasi baru
    // ===============================
    public function create()
    {
        $roles = DB::table('role')->orderBy('idrole', 'ASC')->get();
        return view('admin.roleuser.create', compact('roles'));
    }

    // ===============================
    // STORE - Simpan user baru dan relasinya
    // ===============================
    public function store(Request $request)
    {
        $this->validateNewUserRole($request);

        $userId = $this->createUser($request);
        $this->createRoleUser($request, $userId);

        return redirect()->route('admin.roleuser.index')
                         ->with('success', 'User baru dan role berhasil ditambahkan!');
    }

    // ===============================
    // EDIT - Form edit user & role
    // ===============================
    public function edit($id)
    {
        $roleUser = DB::table('role_user')
            ->join('user', 'role_user.iduser', '=', 'user.iduser')
            ->join('role', 'role_user.idrole', '=', 'role.idrole')
            ->select(
                'role_user.*',
                'user.nama as nama_user',
                'user.email as email_user'
            )
            ->where('idrole_user', $id)
            ->first();

        if (!$roleUser) {
            return redirect()->route('admin.roleuser.index')
                             ->with('error', 'Data tidak ditemukan.');
        }

        $roles = DB::table('role')->orderBy('idrole', 'ASC')->get();

        return view('admin.roleuser.edit', compact('roleUser', 'roles'));
    }

    // ===============================
    // UPDATE - Perbarui data user & relasi role
    // ===============================
    public function update(Request $request, $id)
    {
        $this->validateEditUserRole($request, $id);
        $this->updateUserAndRole($request, $id);

        return redirect()->route('admin.roleuser.index')
                         ->with('success', 'Data user dan role berhasil diperbarui!');
    }

    // ===============================
    // DESTROY - Hapus relasi role-user
    public function destroy($id)
    {
        $roleUser = DB::table('role_user')->where('idrole_user', $id)->first();
    
        if ($roleUser) {
            // Hapus role_user
            DB::table('role_user')->where('idrole_user', $id)->delete();
    
            // Hapus user terkait
            DB::table('user')->where('iduser', $roleUser->iduser)->delete();
        }
    
        return redirect()->route('admin.roleuser.index')
                         ->with('success', 'User dan role berhasil dihapus.');
    }
    

    // ======================================================
    // PROTECTED HELPER FUNCTIONS
    // ======================================================

    // Validasi tambah user + role
    protected function validateNewUserRole(Request $request)
    {
        $rules = [
            'nama' => 'required|string|min:3|max:100',
            'email' => 'required|email|unique:user,email',
            'password' => 'required|min:6|confirmed',
            'idrole' => 'required|exists:role,idrole',
            'status' => 'required|in:1,0',
        ];

        $messages = [
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',
            'status.in' => 'Status hanya boleh aktif atau nonaktif.',
        ];

        $request->validate($rules, $messages);
    }

    // Validasi edit user + role
    protected function validateEditUserRole(Request $request, $id)
    {
        $roleUser = DB::table('role_user')->where('idrole_user', $id)->first();

        $rules = [
            'nama' => 'required|string|min:3|max:100',
            'email' => 'required|email|unique:user,email,' . ($roleUser->iduser ?? 'NULL') . ',iduser',
            'password' => 'nullable|min:6',
            'idrole' => 'required|exists:role,idrole',
            'status' => 'required|in:1,0',
        ];

        $messages = [
            'status.in' => 'Status hanya boleh aktif atau nonaktif.',
        ];

        $request->validate($rules, $messages);
    }

    // Simpan user baru
    protected function createUser(Request $request)
    {
        return DB::table('user')->insertGetId([
            'nama' => ucwords(strtolower(trim($request->nama))),
            'email' => strtolower(trim($request->email)),
            'password' => bcrypt($request->password),
        ]);
    }

    // Simpan relasi role-user baru
    protected function createRoleUser(Request $request, $userId)
    {
        DB::table('role_user')->insert([
            'iduser' => $userId,
            'idrole' => $request->idrole,
            'status' => (int) $request->status, // ← perbaikan
        ]);
    }
    

    // Update data user dan relasinya
    protected function updateUserAndRole(Request $request, $id)
    {
        $status = (int) $request->status;
        $roleUser = DB::table('role_user')->where('idrole_user', $id)->first();

        if ($roleUser) {
            $updateUser = [
                'nama' => ucwords(strtolower(trim($request->nama))),
                'email' => strtolower(trim($request->email)),
            ];

            if (!empty($request->password)) {
                $updateUser['password'] = bcrypt($request->password);
            }

            DB::table('user')->where('iduser', $roleUser->iduser)->update($updateUser);

            DB::table('role_user')->where('idrole_user', $id)->update([
                'idrole' => $request->idrole,
                'status' => $status,
            ]);
        }
    }
}