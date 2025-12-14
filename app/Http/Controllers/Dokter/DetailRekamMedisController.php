<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetailRekamMedisController extends Controller
{
    /**
     * FORM TAMBAH DETAIL REKAM MEDIS
     */
    public function create($idrekam_medis)
    {
        $rekamMedis = DB::table('rekam_medis')
            ->where('idrekam_medis', $idrekam_medis)
            ->firstOrFail();

        $kodeTindakan = DB::table('kode_tindakan_terapi')->get();

        return view('dokter.rekammedis.detail-create', compact('rekamMedis', 'kodeTindakan'));
    }

    /**
     * SIMPAN DETAIL REKAM MEDIS
     */
    public function store(Request $request, $idrekam_medis)
    {
        $request->validate([
            'idkode_tindakan_terapi' => 'required',
            'detail' => 'nullable|string'
        ]);

        DB::table('detail_rekam_medis')->insert([
            'idrekam_medis' => $idrekam_medis,
            'idkode_tindakan_terapi' => $request->idkode_tindakan_terapi,
            'detail' => $request->detail
        ]);

        return redirect()->route('dokter.rekammedis.show', $idrekam_medis)
                         ->with('success', 'Detail rekam medis berhasil ditambahkan.');
    }

    /**
     * FORM EDIT DETAIL REKAM MEDIS
     */
    public function edit($idrekam_medis, $iddetail)
    {
        $rekamMedis = DB::table('rekam_medis')
            ->where('idrekam_medis', $idrekam_medis)
            ->firstOrFail();

        $detailRekamMedis = DB::table('detail_rekam_medis')
            ->where('iddetail_rekam_medis', $iddetail)
            ->firstOrFail();

        $kodeTindakan = DB::table('kode_tindakan_terapi')->get();

        return view('dokter.rekammedis.detail-edit', compact('rekamMedis', 'detailRekamMedis', 'kodeTindakan'));
    }

    /**
     * UPDATE DETAIL REKAM MEDIS
     */
    public function update(Request $request, $idrekam_medis, $iddetail)
    {
        $request->validate([
            'idkode_tindakan_terapi' => 'required',
            'detail' => 'nullable|string'
        ]);

        DB::table('detail_rekam_medis')
            ->where('iddetail_rekam_medis', $iddetail)
            ->update([
                'idkode_tindakan_terapi' => $request->idkode_tindakan_terapi,
                'detail' => $request->detail
            ]);

        return redirect()->route('dokter.rekammedis.show', $idrekam_medis)
                         ->with('success', 'Detail rekam medis berhasil diupdate.');
    }

    /**
     * HAPUS DETAIL REKAM MEDIS
     */
    public function destroy($idrekam_medis, $iddetail)
    {
        DB::table('detail_rekam_medis')
            ->where('iddetail_rekam_medis', $iddetail)
            ->delete();

        return redirect()->route('dokter.rekammedis.show', $idrekam_medis)
                         ->with('success', 'Detail rekam medis berhasil dihapus.');
    }
}
