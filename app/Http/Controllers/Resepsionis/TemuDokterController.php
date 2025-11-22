<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TemuDokter;
use App\Models\Pet;
use App\Models\RoleUser;

class TemuDokterController extends Controller
{
    /**
     * FORM DAFTAR TEMU DOKTER
     */
    public function create()
    {
        // semua hewan beserta pemilik
        $pet = Pet::with('pemilik')->get();

        // ambil semua role_user yang role nya adalah dokter (idrole = 2)
        $dokter = RoleUser::where('idrole', 2)->with('user')->get();

        return view('resepsionis.temudokter.create', compact('pet', 'dokter'));
    }

    /**
     * PROSES SIMPAN KE DB
     */
    public function store(Request $request)
    {
        $request->validate([
            'idpet' => 'required|integer',
            'idrole_user' => 'required|integer'
        ]);

        // Tentukan no_urut per hari
        $no_urut = TemuDokter::whereDate('waktu_daftar', now())->count() + 1;

        // Simpan data temu_dokter
        TemuDokter::create([
            'no_urut' => $no_urut,
            'waktu_daftar' => now()->toDateString(),
            'status' => 'A', // A = aktif / menunggu
            'idpet' => $request->idpet,
            'idrole_user' => $request->idrole_user,
        ]);

        return redirect()->route('resepsionis.dashboard')
                ->with('success', 'Pasien berhasil didaftarkan ke antrian dokter.');
    }
}
