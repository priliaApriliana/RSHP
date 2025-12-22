<?php

namespace App\Http\Controllers\Perawat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class PerawatProfilController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Ambil data perawat menggunakan Query Builder
        $perawat = DB::table('perawat')
            ->where('id_user', $user->iduser)
            ->first();

        return view('perawat.profil.index', compact('user', 'perawat'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // Validasi input
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:500'],
            'email' => ['required', 'email', 'unique:user,email,' . $user->iduser . ',iduser'],
            'password' => ['nullable', 'min:6', 'confirmed'],
            'jenis_kelamin' => ['nullable', 'in:J,B'],
            'alamat' => ['nullable', 'string', 'max:100'],
            'no_hp' => ['nullable', 'string', 'max:45', 'regex:/^[0-9+\-\s()]*$/'],
            'pendidikan' => ['nullable', 'string', 'max:100'],
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'nama.max' => 'Nama maksimal 500 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan oleh pengguna lain.',
            'password.min' => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'jenis_kelamin.in' => 'Jenis kelamin harus J (Jantan) atau B (Betina).',
            'alamat.max' => 'Alamat maksimal 100 karakter.',
            'no_hp.max' => 'Nomor HP maksimal 45 karakter.',
            'no_hp.regex' => 'Format nomor HP tidak valid.',
            'pendidikan.max' => 'Pendidikan maksimal 100 karakter.',
        ]);

        try {
            // Update tabel user
            $updateUser = [
                'nama' => $this->formatNama($validated['nama']),
                'email' => strtolower($validated['email']),
            ];

            // Jika password diisi, tambahkan ke update
            if ($request->filled('password')) {
                $updateUser['password'] = Hash::make($validated['password']);
            }

            DB::table('user')
                ->where('iduser', $user->iduser)
                ->update($updateUser);

            // Update tabel perawat
            DB::table('perawat')
                ->where('id_user', $user->iduser)
                ->update([
                    'alamat' => $validated['alamat'] ? $this->formatText($validated['alamat']) : null,
                    'no_hp' => $validated['no_hp'] ? trim($validated['no_hp']) : null,
                    'jenis_kelamin' => $validated['jenis_kelamin'],
                    'pendidikan' => $validated['pendidikan'] ? $this->formatText($validated['pendidikan']) : null,
                ]);

            return redirect()->route('perawat.profil')
                ->with('success', 'Profil berhasil diperbarui.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat memperbarui profil: ' . $e->getMessage())
                ->withInput();
        }
    }

    // Helper: Format nama menjadi Title Case
    protected function formatNama($nama)
    {
        return trim(ucwords(strtolower($nama)));
    }

    // Helper: Format text umum (untuk alamat, pendidikan, dll)
    protected function formatText($text)
    {
        return trim(ucfirst(strtolower($text)));
    }
}