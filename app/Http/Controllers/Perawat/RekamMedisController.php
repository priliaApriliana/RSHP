<?php

namespace App\Http\Controllers\Perawat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RekamMedis;
use App\Models\TemuDokter;
use App\Models\Pet;
use App\Models\RoleUser;
use App\Models\KodeTindakanTerapi;

class RekamMedisController extends Controller
{
    public function index()
    {
        $rekamMedis = RekamMedis::with(['temuDokter.pet.pemilik', 'pet.rasHewan', 'dokter.user'])
        ->orderBy('waktu_daftar', 'desc')
            ->paginate(10);
        
        return view('perawat.rekammedis.index', compact('rekamMedis'));
    }

    //form 
    public function create()
    {
        // Ambil data pasien yang sudah daftar temu dokter
        $temuDokter = TemuDokter::with(['pet', 'dokter'])
            ->orderBy('waktu_daftar', 'desc')
            ->get();

        return view('perawat.rekammedis.create', compact('temuDokter'));

        // Ambil data tindakan/terapi
        $tindakans = KodeTindakanTerapi::with(['kategori', 'kategoriKlinis'])->get();
        
        return view('perawat.rekammedis.create', compact('temuDokter', 'dokters', 'tindakans'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'idreservasi_dokter' => 'required',
            'anamnesa' => 'required|string',
            'temuan_klinis' => 'required|string',
            'diagnosa' => 'required|string',
        ]);

        // pastikan user login dan perannya perawat (idrole = 3)
        if (session('user_role_id') != 3) {
            return redirect()->back()->with('error', 'Akses ditolak! Hanya perawat yang dapat menginput rekam medis.');
        }

        RekamMedis::create([
            'idreservasi_dokter' => $request->idreservasi_dokter,
            'anamnesa' => $request->anamnesa,
            'temuan_klinis' => $request->temuan_klinis,
            'diagnosa' => $request->diagnosa,
            'created_at' => now(),
            // pakai idrole_user (bukan user langsung)
            'dokter_pemeriksa' => session('user_role_id'),
        ]);

        return redirect()->route('perawat.rekammedis.index')
            ->with('success', 'Rekam medis berhasil ditambahkan.');
    }

    public function show($id)
    {
        $rekamMedis = RekamMedis::with([
            'temuDokter.pet.pemilik',
            'temuDokter.pet.rasHewan.jenisHewan',
            'dokter.user',
            'details.kodeTindakanTerapi'
        ])->findOrFail($id);
        
        return view('perawat.rekammedis.show', compact('rekamMedis'));
    }

    public function edit($id)
    {
        $rekamMedis = RekamMedis::with('temuDokter')->findOrFail($id);
        
        $dokters = RoleUser::with('user')
            ->where('idrole', 2)
            ->where('status', 1)
            ->get();
        
        return view('perawat.rekammedis.edit', compact('rekamMedis', 'dokters'));
    }

    public function update(Request $request, $id)
    {
        $rekamMedis = RekamMedis::findOrFail($id);
        
        $validated = $request->validate([
            'dokter_pemeriksa' => 'required|exists:role_user,idrole_user',
            'anamnesa' => 'required|string',
            'temuan_klinis' => 'required|string',
            'diagnosa' => 'required|string',
        ]);

        $rekamMedis->update($validated);
        
        return redirect()->route('perawat.rekammedis.index')
            ->with('success', 'Rekam medis berhasil diupdate');
    }

    public function destroy($id)
    {
        $rekamMedis = RekamMedis::findOrFail($id);
        $rekamMedis->delete();
        
        return redirect()->route('perawat.rekammedis.index')
            ->with('success', 'Rekam medis berhasil dihapus');
    }
    

}