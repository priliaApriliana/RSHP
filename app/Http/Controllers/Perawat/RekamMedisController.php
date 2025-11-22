<?php

namespace App\Http\Controllers\Perawat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RekamMedis;
use App\Models\DetailRekamMedis;
use App\Models\KodeTindakanTerapi;

class RekamMedisController extends Controller
{
    /**
     * LIST REKAM MEDIS + FILTER PENCARIAN
     */
    public function index(Request $request)
    {
        $query = RekamMedis::with(['temu.pet.pemilik']);

        // Filter Search (nama pet, pemilik, diagnosa)
        if ($request->q) {
            $q = $request->q;

            $query->whereHas('temu.pet', function ($pet) use ($q) {
                $pet->where('nama', 'like', "%$q%");
            })
            ->orWhereHas('temu.pet.pemilik', function ($owner) use ($q) {
                $owner->where('nama', 'like', "%$q%");
            })
            ->orWhere('diagnosa', 'like', "%$q%");
        }

        // Filter tanggal dari
        if ($request->from) {
            $query->whereDate('created_at', '>=', $request->from);
        }

        // Filter tanggal sampai
        if ($request->to) {
            $query->whereDate('created_at', '<=', $request->to);
        }

        // Urutkan terbaru
        $rekammedis = $query->orderBy('created_at', 'desc')->get();

        return view('perawat.rekammedis.index', compact('rekammedis'));
    }


    /**
     * DETAIL REKAM MEDIS + DETAIL TINDAKAN
     */
    public function show($id)
    {
        $rekammedis = RekamMedis::with(['temu.pet.pemilik'])->findOrFail($id);

        // semua kode tindakan terapi
        $tindakan = KodeTindakanTerapi::all();

        // detail tindakan yang sudah diinput sebelumnya
        $detail = DetailRekamMedis::with('kodeTindakan')
                    ->where('idrekam_medis', $id)
                    ->get();

        return view('perawat.rekammedis.show', compact('rekammedis', 'detail', 'tindakan'));
    }


    /**
     * TAMBAH DETAIL TINDAKAN KE REKAM MEDIS
     */
    public function store(Request $request)
    {
        $request->validate([
            'idrekam_medis' => 'required|exists:rekam_medis,idrekam_medis',
            'idkode_tindakan_terapi' => 'required|exists:kode_tindakan_terapi,idkode_tindakan_terapi',
            'detail' => 'required|string'
        ]);

        DetailRekamMedis::create([
            'idrekam_medis' => $request->idrekam_medis,
            'idkode_tindakan_terapi' => $request->idkode_tindakan_terapi,
            'detail' => $request->detail,
        ]);

        return back()->with('success', 'Tindakan berhasil ditambahkan.');
    }
}

