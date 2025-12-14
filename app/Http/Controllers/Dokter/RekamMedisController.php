<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RekamMedisController extends Controller
{
    /**
     * LIST PASIEN DARI TEMU_DOKTER
     */
    public function index()
    {
        $idDokter = Auth::user()->iduser;

        $roleUser = DB::table('role_user')
                        ->where('iduser', $idDokter)
                        ->where('idrole', 2)
                        ->first();

        // Ambil pasien antrian (status A)
        $antrian = DB::table('temu_dokter')
            ->join('pet', 'temu_dokter.idpet', '=', 'pet.idpet')
            ->join('pemilik', 'pet.idpemilik', '=', 'pemilik.idpemilik')
            ->join('user', 'pemilik.iduser', '=', 'user.iduser')
            ->join('ras_hewan', 'pet.idras_hewan', '=', 'ras_hewan.idras_hewan')
            ->join('jenis_hewan', 'ras_hewan.idjenis_hewan', '=', 'jenis_hewan.idjenis_hewan')
            ->select('temu_dokter.*', 'pet.nama', 'user.nama as nama_pemilik', 'jenis_hewan.nama_jenis_hewan')
            ->where('temu_dokter.idrole_user', $roleUser->idrole_user)
            ->where('temu_dokter.status', 'A')
            ->get();

        // Ambil rekam medis selesai (status S)
        $rekamMedisSelesai = DB::table('rekam_medis')
            ->join('temu_dokter', 'rekam_medis.idreservasi_dokter', '=', 'temu_dokter.idreservasi_dokter')
            ->join('pet', 'temu_dokter.idpet', '=', 'pet.idpet')
            ->join('pemilik', 'pet.idpemilik', '=', 'pemilik.idpemilik')
            ->join('user', 'pemilik.iduser', '=', 'user.iduser')
            ->select('rekam_medis.*', 'pet.nama', 'user.nama as nama_pemilik')
            ->where('temu_dokter.idrole_user', $roleUser->idrole_user)
            ->where('temu_dokter.status', 'S')
            ->orderBy('rekam_medis.idrekam_medis', 'DESC')
            ->get();

        return view('dokter.rekammedis.index', compact('antrian', 'rekamMedisSelesai'));
    }

    /**
     * FORM UNTUK MENGISI REKAM MEDIS
     */
    public function create(Request $request)
    {
        $id = $request->idreservasi_dokter;

        $pasien = DB::table('temu_dokter')
            ->join('pet', 'temu_dokter.idpet', '=', 'pet.idpet')
            ->join('pemilik', 'pet.idpemilik', '=', 'pemilik.idpemilik')
            ->join('user', 'pemilik.iduser', '=', 'user.iduser')
            ->select('temu_dokter.*', 'pet.nama', 'user.nama as nama_pemilik', 'user.nama as user_nama')
            ->where('temu_dokter.idreservasi_dokter', $id)
            ->firstOrFail();

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

        $roleUser = DB::table('role_user')
                        ->where('iduser', Auth::user()->iduser)
                        ->where('idrole', 2)
                        ->first();

        DB::table('rekam_medis')->insert([
            'anamnesa' => $request->anamnesa,
            'temuan_klinis' => $request->temuan_klinis,
            'diagnosa' => $request->diagnosa,
            'idreservasi_dokter' => $request->idreservasi_dokter,
            'dokter_pemeriksa' => $roleUser->idrole_user,
            'created_at' => now()
        ]);

        // ubah status temu_dokter → selesai (S)
        DB::table('temu_dokter')
            ->where('idreservasi_dokter', $request->idreservasi_dokter)
            ->update(['status' => 'S']);

        return redirect()->route('dokter.rekammedis.index')
                         ->with('success', 'Rekam medis berhasil disimpan.');
    }

    /**
     * VIEW DETAIL REKAM MEDIS & DETAIL TINDAKAN
     */
    public function show($id)
    {
        $rekamMedis = DB::table('rekam_medis')
            ->where('idrekam_medis', $id)
            ->first();

        if (!$rekamMedis) {
            abort(404, 'Rekam medis tidak ditemukan');
        }

        // Ambil temu_dokter, pet, pemilik untuk sidebar
        $temuDokter = DB::table('temu_dokter')
            ->join('pet', 'temu_dokter.idpet', '=', 'pet.idpet')
            ->join('pemilik', 'pet.idpemilik', '=', 'pemilik.idpemilik')
            ->join('user', 'pemilik.iduser', '=', 'user.iduser')
            ->join('ras_hewan', 'pet.idras_hewan', '=', 'ras_hewan.idras_hewan')
            ->join('jenis_hewan', 'ras_hewan.idjenis_hewan', '=', 'jenis_hewan.idjenis_hewan')
            ->select('temu_dokter.*', 'pet.*', 'pemilik.*', 'user.email', 'user.nama as user_nama', 'jenis_hewan.nama_jenis_hewan', 'ras_hewan.nama_ras')
            ->where('temu_dokter.idreservasi_dokter', $rekamMedis->idreservasi_dokter)
            ->first();

        // Ambil detail rekam medis dengan kode tindakan
        $detailRekamMedis = DB::table('detail_rekam_medis')
            ->join('kode_tindakan_terapi', 'detail_rekam_medis.idkode_tindakan_terapi', '=', 'kode_tindakan_terapi.idkode_tindakan_terapi')
            ->select('detail_rekam_medis.*', 'kode_tindakan_terapi.kode', 'kode_tindakan_terapi.deskripsi_tindakan_terapi')
            ->where('detail_rekam_medis.idrekam_medis', $id)
            ->get();

        return view('dokter.rekammedis.show', compact('rekamMedis', 'temuDokter', 'detailRekamMedis'));
    }

    /**
     * FORM EDIT DETAIL REKAM MEDIS
     */
    public function edit($id, $detailId)
    {
        $rekamMedis = DB::table('rekam_medis')
            ->where('idrekam_medis', $id)
            ->firstOrFail();

        $detailRekamMedis = DB::table('detail_rekam_medis')
            ->where('iddetail_rekam_medis', $detailId)
            ->firstOrFail();

        $kodeTindakan = DB::table('kode_tindakan_terapi')->get();

        return view('dokter.rekammedis.edit-detail', compact('rekamMedis', 'detailRekamMedis', 'kodeTindakan'));
    }

    /**
     * UPDATE DETAIL REKAM MEDIS
     */
    public function update(Request $request, $id, $detailId)
    {
        $request->validate([
            'idkode_tindakan' => 'required',
            'detail' => 'nullable'
        ]);

        DB::table('detail_rekam_medis')
            ->where('iddetail_rekam_medis', $detailId)
            ->update([
                'idkode_tindakan' => $request->idkode_tindakan,
                'detail' => $request->detail
            ]);

        return redirect()->route('dokter.rekammedis.show', $id)
                         ->with('success', 'Detail rekam medis berhasil diupdate.');
    }

    /**
     * HAPUS DETAIL REKAM MEDIS
     */
    public function destroy($id, $detailId)
    {
        DB::table('detail_rekam_medis')
            ->where('iddetail_rekam_medis', $detailId)
            ->delete();

        return redirect()->route('dokter.rekammedis.show', $id)
                         ->with('success', 'Detail rekam medis berhasil dihapus.');
    }
}
