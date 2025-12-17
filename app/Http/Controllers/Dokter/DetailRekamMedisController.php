<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DetailRekamMedisController extends Controller
{
    /**
     * FORM TAMBAH DETAIL REKAM MEDIS (TINDAKAN/TERAPI)
     */
    public function create($idrekam_medis)
    {
        $idDokter = Auth::user()->iduser;
        
        $roleUser = DB::table('role_user')
            ->where('iduser', $idDokter)
            ->where('idrole', 2)
            ->first();

        if (!$roleUser) {
            abort(403, 'Anda tidak memiliki akses sebagai dokter');
        }

        // ✅ CEK APAKAH REKAM MEDIS INI MILIK DOKTER YANG LOGIN
        $rekamMedis = DB::table('rekam_medis')
            ->where('idrekam_medis', $idrekam_medis)
            ->where('dokter_pemeriksa', $roleUser->idrole_user)
            ->firstOrFail();

        // ✅ CEK APAKAH REKAM MEDIS SUDAH DIISI (anamnesa, temuan_klinis, diagnosa)
        if (empty($rekamMedis->anamnesa) || empty($rekamMedis->temuan_klinis) || empty($rekamMedis->diagnosa)) {
            return redirect()->route('dokter.rekammedis.show', $idrekam_medis)
                ->with('error', 'Mohon lengkapi data rekam medis terlebih dahulu (Anamnesa, Temuan Klinis, Diagnosa).');
        }

        $kodeTindakan = DB::table('kode_tindakan_terapi')
            ->join('kategori', 'kode_tindakan_terapi.idkategori', '=', 'kategori.idkategori')
            ->join('kategori_klinis', 'kode_tindakan_terapi.idkategori_klinis', '=', 'kategori_klinis.idkategori_klinis')
            ->select(
                'kode_tindakan_terapi.*',
                'kategori.nama_kategori',
                'kategori_klinis.nama_kategori_klinis'
            )
            ->orderBy('kode_tindakan_terapi.kode', 'ASC')
            ->get();

        return view('dokter.rekammedis.detail-create', compact('rekamMedis', 'kodeTindakan'));
    }

    /**
     * SIMPAN DETAIL REKAM MEDIS (TINDAKAN/TERAPI)
     */
    public function store(Request $request, $idrekam_medis)
    {
        $request->validate([
            'idkode_tindakan_terapi' => 'required|integer|exists:kode_tindakan_terapi,idkode_tindakan_terapi',
            'detail' => 'nullable|string|max:1000'
        ]);

        DB::beginTransaction();
        
        try {
            $idDokter = Auth::user()->iduser;
            
            $roleUser = DB::table('role_user')
                ->where('iduser', $idDokter)
                ->where('idrole', 2)
                ->first();

            if (!$roleUser) {
                abort(403, 'Anda tidak memiliki akses sebagai dokter');
            }

            // ✅ CEK APAKAH REKAM MEDIS INI MILIK DOKTER YANG LOGIN
            $rekamMedis = DB::table('rekam_medis')
                ->where('idrekam_medis', $idrekam_medis)
                ->where('dokter_pemeriksa', $roleUser->idrole_user)
                ->first();

            if (!$rekamMedis) {
                abort(403, 'Anda tidak memiliki akses untuk menambahkan detail rekam medis ini');
            }

            // ✅ TAMBAH DETAIL TINDAKAN
            DB::table('detail_rekam_medis')->insert([
                'idrekam_medis' => $idrekam_medis,
                'idkode_tindakan_terapi' => $request->idkode_tindakan_terapi,
                'detail' => $request->detail
            ]);

            // 🔥 PENTING: UPDATE STATUS TEMU_DOKTER JADI 'S' (SELESAI)
            // Karena dokter sudah mengisi anamnesa, diagnosa, temuan klinis, DAN minimal 1 tindakan
            DB::table('temu_dokter')
                ->where('idreservasi_dokter', $rekamMedis->idreservasi_dokter)
                ->update([
                    'status' => 'S'  // ✅ UPDATE STATUS JADI SELESAI
                ]);

            DB::commit();

            return redirect()->route('dokter.rekammedis.show', $idrekam_medis)
                ->with('success', 'Detail tindakan/terapi berhasil ditambahkan. Status pemeriksaan diubah menjadi Selesai.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * FORM EDIT DETAIL REKAM MEDIS (TINDAKAN/TERAPI)
     */
    public function edit($idrekam_medis, $iddetail)
    {
        $idDokter = Auth::user()->iduser;
        
        $roleUser = DB::table('role_user')
            ->where('iduser', $idDokter)
            ->where('idrole', 2)
            ->first();

        if (!$roleUser) {
            abort(403, 'Anda tidak memiliki akses sebagai dokter');
        }

        // ✅ CEK APAKAH REKAM MEDIS INI MILIK DOKTER YANG LOGIN
        $rekamMedis = DB::table('rekam_medis')
            ->where('idrekam_medis', $idrekam_medis)
            ->where('dokter_pemeriksa', $roleUser->idrole_user)
            ->firstOrFail();

        $detailRekamMedis = DB::table('detail_rekam_medis')
            ->where('iddetail_rekam_medis', $iddetail)
            ->where('idrekam_medis', $idrekam_medis)
            ->firstOrFail();

        $kodeTindakan = DB::table('kode_tindakan_terapi')
            ->join('kategori', 'kode_tindakan_terapi.idkategori', '=', 'kategori.idkategori')
            ->join('kategori_klinis', 'kode_tindakan_terapi.idkategori_klinis', '=', 'kategori_klinis.idkategori_klinis')
            ->select(
                'kode_tindakan_terapi.*',
                'kategori.nama_kategori',
                'kategori_klinis.nama_kategori_klinis'
            )
            ->orderBy('kode_tindakan_terapi.kode', 'ASC')
            ->get();

        return view('dokter.rekammedis.detail-edit', compact('rekamMedis', 'detailRekamMedis', 'kodeTindakan'));
    }

    /**
     * UPDATE DETAIL REKAM MEDIS (TINDAKAN/TERAPI)
     */
    public function update(Request $request, $idrekam_medis, $iddetail)
    {
        $request->validate([
            'idkode_tindakan_terapi' => 'required|integer|exists:kode_tindakan_terapi,idkode_tindakan_terapi',
            'detail' => 'nullable|string|max:1000'
        ]);

        $idDokter = Auth::user()->iduser;
        
        $roleUser = DB::table('role_user')
            ->where('iduser', $idDokter)
            ->where('idrole', 2)
            ->first();

        if (!$roleUser) {
            abort(403, 'Anda tidak memiliki akses sebagai dokter');
        }

        // ✅ CEK APAKAH REKAM MEDIS INI MILIK DOKTER YANG LOGIN
        $rekamMedis = DB::table('rekam_medis')
            ->where('idrekam_medis', $idrekam_medis)
            ->where('dokter_pemeriksa', $roleUser->idrole_user)
            ->first();

        if (!$rekamMedis) {
            abort(403, 'Anda tidak memiliki akses untuk mengupdate detail rekam medis ini');
        }

        DB::table('detail_rekam_medis')
            ->where('iddetail_rekam_medis', $iddetail)
            ->where('idrekam_medis', $idrekam_medis)
            ->update([
                'idkode_tindakan_terapi' => $request->idkode_tindakan_terapi,
                'detail' => $request->detail
            ]);

        return redirect()->route('dokter.rekammedis.show', $idrekam_medis)
            ->with('success', 'Detail tindakan/terapi berhasil diupdate.');
    }

    /**
     * HAPUS DETAIL REKAM MEDIS (TINDAKAN/TERAPI)
     */
    public function destroy($idrekam_medis, $iddetail)
    {
        DB::beginTransaction();
        
        try {
            $idDokter = Auth::user()->iduser;
            
            $roleUser = DB::table('role_user')
                ->where('iduser', $idDokter)
                ->where('idrole', 2)
                ->first();

            if (!$roleUser) {
                abort(403, 'Anda tidak memiliki akses sebagai dokter');
            }

            // ✅ CEK APAKAH REKAM MEDIS INI MILIK DOKTER YANG LOGIN
            $rekamMedis = DB::table('rekam_medis')
                ->where('idrekam_medis', $idrekam_medis)
                ->where('dokter_pemeriksa', $roleUser->idrole_user)
                ->first();

            if (!$rekamMedis) {
                abort(403, 'Anda tidak memiliki akses untuk menghapus detail rekam medis ini');
            }

            // ✅ HAPUS DETAIL
            DB::table('detail_rekam_medis')
                ->where('iddetail_rekam_medis', $iddetail)
                ->where('idrekam_medis', $idrekam_medis)
                ->delete();

            // 🔥 CEK: JIKA TIDAK ADA DETAIL LAGI, KEMBALIKAN STATUS KE 'P'
            $jumlahDetail = DB::table('detail_rekam_medis')
                ->where('idrekam_medis', $idrekam_medis)
                ->count();

            if ($jumlahDetail == 0) {
                DB::table('temu_dokter')
                    ->where('idreservasi_dokter', $rekamMedis->idreservasi_dokter)
                    ->update([
                        'status' => 'P'  // ✅ KEMBALI KE STATUS PROSES
                    ]);
            }

            DB::commit();

            return redirect()->route('dokter.rekammedis.show', $idrekam_medis)
                ->with('success', 'Detail tindakan/terapi berhasil dihapus.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}