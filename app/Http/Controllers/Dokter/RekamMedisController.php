<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\RekamMedis;
use App\Models\TemuDokter;
use Illuminate\Http\Request;

class RekamMedisController extends Controller
{
    public function index()
    {
        $rekamMedis = RekamMedis::with(['temuDokter.pet.pemilik.user'])->paginate(10);
        return view('dokter.rekammedis.index', compact('rekamMedis'));
    }

    public function create()
    {
        $temuDokter = TemuDokter::with(['pet.pemilik.user'])
            ->where('status', '1') // misal hanya yang aktif
            ->get();

        return view('dokter.rekammedis.create', compact('temuDokter'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idreservasi_dokter' => 'required',
            'anamnesa' => 'required|string',
            'temuan_klinis' => 'required|string',
            'diagnosa' => 'required|string',
        ]);

        RekamMedis::create([
            'idreservasi_dokter' => $request->idreservasi_dokter,
            'anamnesa' => $request->anamnesa,
            'temuan_klinis' => $request->temuan_klinis,
            'diagnosa' => $request->diagnosa,
            'dokter_pemeriksa' => auth()->user()->roleUser->idrole_user,
            'created_at' => now(),
        ]);

        return redirect()->route('dokter.rekammedis.index')->with('success', 'Rekam Medis berhasil ditambahkan!');
    }
}
