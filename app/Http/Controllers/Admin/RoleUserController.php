<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class RoleUserController extends Controller
{
    // ===============================
    // INDEX - Menampilkan semua user dengan roles mereka
    // ===============================
    public function index()
    {
        // Ambil semua user dengan roles mereka (grouped)
        $users = DB::table('user')
            ->select('user.iduser', 'user.nama', 'user.email')
            ->orderBy('iduser', 'ASC')
            ->get();

        // Untuk setiap user, ambil semua roles mereka
        foreach ($users as $user) {
            $userRoles = DB::table('role_user')
                ->join('role', 'role_user.idrole', '=', 'role.idrole')
                ->where('role_user.iduser', $user->iduser)
                ->select(
                    'role_user.idrole_user',
                    'role.nama_role',
                    'role_user.status'
                )
                ->orderBy('role_user.status', 'DESC') // Aktif ditampilkan pertama
                ->get();
            
            $user->roles = $userRoles;
        }

        return view('admin.roleuser.index', compact('users'));
    }

    // ===============================
    // CREATE - Form tambah role untuk user tertentu
    // ===============================
    public function create($iduser)
    {
        $user = DB::table('user')->where('iduser', $iduser)->first();
        
        if (!$user) {
            return redirect()->route('admin.roleuser.index')
                           ->with('error', 'User tidak ditemukan.');
        }

        // Ambil semua role
        $roles = DB::table('role')->orderBy('idrole', 'ASC')->get();

        // Ambil role yang sudah dimiliki user ini
        $existingRoles = DB::table('role_user')
            ->where('iduser', $iduser)
            ->pluck('idrole')
            ->toArray();

        return view('admin.roleuser.create', compact('user', 'roles', 'existingRoles'));
    }

    // ===============================
    // STORE - Simpan role baru untuk user
    // OTOMATIS NONAKTIFKAN SEMUA ROLE LAMA
    // ===============================
    public function store(Request $request, $iduser)
    {
        $request->validate([
            'idrole' => 'required|exists:role,idrole',
        ]);

        // Cek apakah sudah ada role ini untuk user ini
        $exists = DB::table('role_user')
            ->where('iduser', $iduser)
            ->where('idrole', $request->idrole)
            ->exists();

        if ($exists) {
            return redirect()->route('admin.roleuser.create', $iduser)
                           ->with('error', 'User sudah memiliki role ini.');
        }

        DB::transaction(function () use ($iduser, $request) {

            // LANGKAH 1: Nonaktifkan semua role lama
            DB::table('role_user')
                ->where('iduser', $iduser)
                ->update(['status' => 0]);

            // LANGKAH 2: Tambahkan role baru (aktif)
            DB::table('role_user')->insert([
                'iduser' => $iduser,
                'idrole' => $request->idrole,
                'status' => 1, // otomatis Aktif
            ]);
        });

        return redirect()->route('admin.roleuser.index')
                       ->with('success', 'Role berhasil ditambahkan dan diaktifkan! Role lama telah dinonaktifkan.');
    }

    // ===============================
    // EDIT - Form edit status role user
    // ===============================
    public function edit($idrole_user)
    {
        $roleUser = DB::table('role_user')
            ->join('user', 'role_user.iduser', '=', 'user.iduser')
            ->join('role', 'role_user.idrole', '=', 'role.idrole')
            ->select(
                'role_user.idrole_user',
                'role_user.iduser',
                'role_user.status',
                'user.nama as nama_user',
                'role.nama_role'
            )
            ->where('role_user.idrole_user', $idrole_user)
            ->first();

        if (!$roleUser) {
            return redirect()->route('admin.roleuser.index')
                           ->with('error', 'Data tidak ditemukan.');
        }

        return view('admin.roleuser.edit', compact('roleUser'));
    }

    // ===============================
    // UPDATE - Update status role user
    // JIKA DIAKTIFKAN, NONAKTIFKAN ROLE LAIN
    // ===============================
    public function update(Request $request, $idrole_user)
    {
        $request->validate([
            'status' => 'required|in:0,1',
        ]);

        $roleUser = DB::table('role_user')->where('idrole_user', $idrole_user)->first();

        if (!$roleUser) {
            return redirect()->route('admin.roleuser.index')
                           ->with('error', 'Data tidak ditemukan.');
        }

        // Jika mengaktifkan role ini
        if ($request->status == 1) {

            DB::transaction(function () use ($roleUser, $idrole_user) {

                DB::table('role_user')
                    ->where('iduser', $roleUser->iduser)
                    ->update(['status' => 0]);

                DB::table('role_user')
                    ->where('idrole_user', $idrole_user)
                    ->update(['status' => 1]);
            });

            $message = 'Role berhasil diaktifkan! Role lain telah dinonaktifkan.';
        } else {
            // Jika menonaktifkan
            DB::table('role_user')
                ->where('idrole_user', $idrole_user)
                ->update(['status' => 0]);
            
            $message = 'Role berhasil dinonaktifkan.';
        }

        return redirect()->route('admin.roleuser.index')
                       ->with('success', $message);
    }

    // ===============================
    // TOGGLE STATUS - Aktifkan/Nonaktifkan role user
    // JIKA DIAKTIFKAN, NONAKTIFKAN ROLE LAIN
    // ===============================
    public function toggleStatus($idrole_user)
    {
        $roleUser = DB::table('role_user')->where('idrole_user', $idrole_user)->first();

        if (!$roleUser) {
            return redirect()->route('admin.roleuser.index')
                           ->with('error', 'Data tidak ditemukan.');
        }

        // Toggle status (1 -> 0, 0 -> 1)
        $newStatus = $roleUser->status == 1 ? 0 : 1;

        DB::transaction(function () use ($roleUser, $idrole_user, $newStatus) {

            if ($newStatus == 1) {
                DB::table('role_user')
                    ->where('iduser', $roleUser->iduser)
                    ->update(['status' => 0]);
            }

            DB::table('role_user')
                ->where('idrole_user', $idrole_user)
                ->update(['status' => $newStatus]);
        });

        $statusText = $newStatus == 1 
            ? 'diaktifkan. Role lain telah dinonaktifkan' 
            : 'dinonaktifkan';

        return redirect()->route('admin.roleuser.index')
                       ->with('success', "Role berhasil {$statusText}.");
    }

    // ===============================
    // DELETE ROLE - Hapus role tertentu dari user
    // ===============================
    public function destroy($idrole_user)
    {
        $roleUser = DB::table('role_user')->where('idrole_user', $idrole_user)->first();

        if (!$roleUser) {
            return redirect()->route('admin.roleuser.index')
                ->with('error', 'Data tidak ditemukan.');
        }

        DB::table('role_user')
            ->where('idrole_user', $idrole_user)
            ->delete();

        return redirect()->route('admin.roleuser.index')
            ->with('success', 'Role berhasil dihapus dari user.');
    }
}