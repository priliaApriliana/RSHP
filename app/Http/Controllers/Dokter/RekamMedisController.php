<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RekamMedis;
use App\Models\TemuDokter;
use App\Models\RoleUser;

class RekamMedisController extends Controller
{
    /**
     * LIST PASIEN DARI TEMU_DOKTER
     */
    public function index()
    {
        // FIX ERROR: gunakan Auth::user()
        $idDokter = Auth::user()->iduser;

        // cari role_user dokter
        $roleUser = RoleUser::where('iduser', $idDokter)
                            ->where('idrole', 2)
                            ->first();

        // Ambil pasien yang mendaftar ke dokter yang login
        $antrian = TemuDokter::with(['pet.pemilik.user'])
            ->where('idrole_user', $roleUser->idrole_user)
            ->where('status', 'A')
            ->get();

        return view('dokter.rekammedis.index', compact('antrian'));
    }

    /**
     * FORM UNTUK MENGISI REKAM MEDIS
     */
    public function create(Request $request)
    {
        $id = $request->idreservasi_dokter;

        $pasien = TemuDokter::with(['pet.pemilik.user'])
            ->findOrFail($id);

        return view('dokter.rekammedis.create', compact('pasien'));
    }

    /**
     * SIMPAN REKAM MEDIS
     */
    public function store(Request $request)
    {
        $request->validate([
            'idreservasi_dokter' => 'required',
            'anamnesa' => 'required',
            'temuan_klinis' => 'required',
            'diagnosa' => 'required',
        ]);

        // FIX ERROR: Auth::user()
        $roleUser = RoleUser::where('iduser', Auth::user()->iduser)
                            ->where('idrole', 2)
                            ->first();

        RekamMedis::create([
            'anamnesa' => $request->anamnesa,
            'temuan_klinis' => $request->temuan_klinis,
            'diagnosa' => $request->diagnosa,
            'idreservasi_dokter' => $request->idreservasi_dokter,
            'dokter_pemeriksa' => $roleUser->idrole_user,
            'created_at' => now()
        ]);

        // ubah status temu_dokter → selesai (S)
        TemuDokter::where('idreservasi_dokter', $request->idreservasi_dokter)
                  ->update(['status' => 'S']);

        return redirect()->route('dokter.rekammedis.index')
                         ->with('success', 'Rekam medis berhasil disimpan.');
    }
}
