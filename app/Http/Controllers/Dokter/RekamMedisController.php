<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RekamMedisController extends Controller
{
    /**
     * LIST ANTRIAN & RIWAYAT REKAM MEDIS
     */
    public function index()
    {
        $idDokter = Auth::user()->iduser;

        $roleUser = DB::table('role_user')
            ->where('iduser', $idDokter)
            ->where('idrole', 2)
            ->first();

        if (!$roleUser) {
            abort(403, 'Anda tidak memiliki akses sebagai dokter');
        }

        // ✅ ANTRIAN: Status 'P' (Proses/Menunggu Dokter)
        $antrian = DB::table('temu_dokter')
            ->join('rekam_medis', 'temu_dokter.idreservasi_dokter', '=', 'rekam_medis.idreservasi_dokter')
            ->join('pet', 'temu_dokter.idpet', '=', 'pet.idpet')
            ->join('pemilik', 'pet.idpemilik', '=', 'pemilik.idpemilik')
            ->join('user', 'pemilik.iduser', '=', 'user.iduser')
            ->leftJoin('ras_hewan', 'pet.idras_hewan', '=', 'ras_hewan.idras_hewan')
            ->leftJoin('jenis_hewan', 'ras_hewan.idjenis_hewan', '=', 'jenis_hewan.idjenis_hewan')
            ->select(
                'temu_dokter.*',
                'rekam_medis.idrekam_medis',
                'rekam_medis.anamnesa',
                'rekam_medis.diagnosa',
                'pet.nama as nama_pet',
                'pet.tanggal_lahir',
                'pet.jenis_kelamin',
                'user.nama as nama_pemilik',
                'jenis_hewan.nama_jenis_hewan',
                'ras_hewan.nama_ras'
            )
            ->where('temu_dokter.status', 'P') // ✅ STATUS 'P'
            ->orderBy('temu_dokter.no_urut', 'ASC')
            ->get();

        // ✅ RIWAYAT: Status 'S' (Selesai)
        $rekamMedisSelesai = DB::table('rekam_medis')
            ->join('temu_dokter', 'rekam_medis.idreservasi_dokter', '=', 'temu_dokter.idreservasi_dokter')
            ->join('pet', 'temu_dokter.idpet', '=', 'pet.idpet')
            ->join('pemilik', 'pet.idpemilik', '=', 'pemilik.idpemilik')
            ->join('user', 'pemilik.iduser', '=', 'user.iduser')
            ->select(
                'rekam_medis.*',
                'pet.nama as nama_pet',
                'user.nama as nama_pemilik',
                'temu_dokter.waktu_daftar'
            )
            ->where('temu_dokter.status', 'S')
            ->orderBy('rekam_medis.created_at', 'DESC')
            ->get();

        return view('dokter.rekammedis.index', compact('antrian', 'rekamMedisSelesai'));
    }

    /**
     * SHOW DETAIL REKAM MEDIS
     */
    public function show($id)
    {
        $idUser = Auth::user()->iduser;

        $roleUser = DB::table('role_user')
            ->where('iduser', $idUser)
            ->where('idrole', 2)
            ->first();

        if (!$roleUser) {
            abort(403, 'Akses ditolak');
        }

        $rekamMedis = DB::table('rekam_medis')
            ->where('idrekam_medis', $id)
            ->first();

        if (!$rekamMedis) {
            abort(404, 'Rekam medis tidak ditemukan');
        }

        // ✅ CEK STATUS TEMU DOKTER
        $temuDokter = DB::table('temu_dokter')
            ->where('idreservasi_dokter', $rekamMedis->idreservasi_dokter)
            ->first();

        if (!$temuDokter) {
            abort(404, 'Data temu dokter tidak ditemukan');
        }

        // ✅ LOGIKA AKSES YANG BENAR:
        // 1. Jika status 'P' (Proses) → SEMUA DOKTER BOLEH AKSES
        // 2. Jika status 'S' (Selesai) → HANYA DOKTER YANG SUDAH INPUT DETAIL YANG BISA AKSES

        if ($temuDokter->status === 'P') {
            // ✅ STATUS PROSES → CLAIM OTOMATIS
            // Update dokter_pemeriksa jadi dokter yang login sekarang
            DB::table('rekam_medis')
                ->where('idrekam_medis', $id)
                ->update(['dokter_pemeriksa' => $roleUser->idrole_user]);

            // Refresh data
            $rekamMedis->dokter_pemeriksa = $roleUser->idrole_user;

        } elseif ($temuDokter->status === 'S') {
            // ✅ STATUS SELESAI → CEK APAKAH DOKTER INI YANG PERIKSA
            if ($rekamMedis->dokter_pemeriksa != $roleUser->idrole_user) {
                abort(403, 'Rekam medis ini telah diperiksa oleh dokter lain');
            }
        }

        // ✅ AMBIL DATA LENGKAP
        $temuDokter = DB::table('temu_dokter')
            ->join('pet', 'temu_dokter.idpet', '=', 'pet.idpet')
            ->join('pemilik', 'pet.idpemilik', '=', 'pemilik.idpemilik')
            ->join('user as pemilik_user', 'pemilik.iduser', '=', 'pemilik_user.iduser')
            ->join('ras_hewan', 'pet.idras_hewan', '=', 'ras_hewan.idras_hewan')
            ->join('jenis_hewan', 'ras_hewan.idjenis_hewan', '=', 'jenis_hewan.idjenis_hewan')
            ->select(
                'temu_dokter.*',
                'pet.nama as nama_pet',
                'pet.tanggal_lahir',
                'pet.jenis_kelamin',
                'pet.warna_tanda',
                'pemilik.no_wa',
                'pemilik.alamat',
                'pemilik_user.email',
                'pemilik_user.nama as nama_pemilik',
                'jenis_hewan.nama_jenis_hewan',
                'ras_hewan.nama_ras'
            )
            ->where('temu_dokter.idreservasi_dokter', $rekamMedis->idreservasi_dokter)
            ->first();

        // Ambil detail rekam medis dengan kode tindakan
        $detailRekamMedis = DB::table('detail_rekam_medis')
            ->join('kode_tindakan_terapi', 'detail_rekam_medis.idkode_tindakan_terapi', '=', 'kode_tindakan_terapi.idkode_tindakan_terapi')
            ->join('kategori', 'kode_tindakan_terapi.idkategori', '=', 'kategori.idkategori')
            ->join('kategori_klinis', 'kode_tindakan_terapi.idkategori_klinis', '=', 'kategori_klinis.idkategori_klinis')
            ->select(
                'detail_rekam_medis.*',
                'kode_tindakan_terapi.kode',
                'kode_tindakan_terapi.deskripsi_tindakan_terapi',
                'kategori.nama_kategori',
                'kategori_klinis.nama_kategori_klinis'
            )
            ->where('detail_rekam_medis.idrekam_medis', $id)
            ->orderBy('detail_rekam_medis.iddetail_rekam_medis', 'ASC')
            ->get();

        return view('dokter.rekammedis.show', compact('rekamMedis', 'temuDokter', 'detailRekamMedis'));
    }

    /**
     * ✅ FORM EDIT REKAM MEDIS (TAMBAHAN METHOD INI)
     */
    public function edit($id)
    {
        $idUser = Auth::user()->iduser;

        $roleUser = DB::table('role_user')
            ->where('iduser', $idUser)
            ->where('idrole', 2)
            ->first();

        if (!$roleUser) {
            abort(403, 'Akses ditolak');
        }

        $rekamMedis = DB::table('rekam_medis')
            ->where('idrekam_medis', $id)
            ->first();

        if (!$rekamMedis) {
            abort(404, 'Rekam medis tidak ditemukan');
        }

        // ✅ CEK STATUS TEMU DOKTER
        $temuDokter = DB::table('temu_dokter')
            ->where('idreservasi_dokter', $rekamMedis->idreservasi_dokter)
            ->first();

        if (!$temuDokter) {
            abort(404, 'Data temu dokter tidak ditemukan');
        }

        // ✅ HANYA BOLEH EDIT JIKA STATUS MASIH 'P' (PROSES)
        if ($temuDokter->status === 'S') {
            return redirect()->route('dokter.rekammedis.show', $id)
                ->with('error', 'Rekam medis sudah selesai, tidak dapat diedit.');
        }

        // ✅ CEK APAKAH DOKTER INI YANG PERIKSA (jika sudah ada dokter_pemeriksa)
        if ($rekamMedis->dokter_pemeriksa && $rekamMedis->dokter_pemeriksa != $roleUser->idrole_user) {
            abort(403, 'Rekam medis ini sedang ditangani oleh dokter lain');
        }

        // ✅ Claim dokter_pemeriksa jika belum ada
        if (!$rekamMedis->dokter_pemeriksa) {
            DB::table('rekam_medis')
                ->where('idrekam_medis', $id)
                ->update(['dokter_pemeriksa' => $roleUser->idrole_user]);
            
            $rekamMedis->dokter_pemeriksa = $roleUser->idrole_user;
        }

        // ✅ AMBIL DATA LENGKAP
        $temuDokter = DB::table('temu_dokter')
            ->join('pet', 'temu_dokter.idpet', '=', 'pet.idpet')
            ->join('pemilik', 'pet.idpemilik', '=', 'pemilik.idpemilik')
            ->join('user', 'pemilik.iduser', '=', 'user.iduser')
            ->join('ras_hewan', 'pet.idras_hewan', '=', 'ras_hewan.idras_hewan')
            ->join('jenis_hewan', 'ras_hewan.idjenis_hewan', '=', 'jenis_hewan.idjenis_hewan')
            ->select(
                'temu_dokter.*',
                'pet.nama as nama_pet',
                'pet.tanggal_lahir',
                'pet.jenis_kelamin',
                'pet.warna_tanda',
                'pemilik.no_wa',
                'pemilik.alamat',
                'user.email',
                'user.nama as nama_pemilik',
                'jenis_hewan.nama_jenis_hewan',
                'ras_hewan.nama_ras'
            )
            ->where('temu_dokter.idreservasi_dokter', $rekamMedis->idreservasi_dokter)
            ->first();

        return view('dokter.rekammedis.edit', compact('rekamMedis', 'temuDokter'));
    }

    /**
     * UPDATE REKAM MEDIS (OPSIONAL - JIKA DOKTER BISA EDIT)
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'anamnesa' => 'required|string|max:1000',
            'temuan_klinis' => 'required|string|max:1000',
            'diagnosa' => 'required|string|max:1000',
        ]);

        DB::beginTransaction();

        try {
            $roleUser = DB::table('role_user')
                ->where('iduser', Auth::id())
                ->where('idrole', 2)
                ->first();

            if (!$roleUser) {
                throw new \Exception('Akses ditolak');
            }

            $rekamMedis = DB::table('rekam_medis')
                ->where('idrekam_medis', $id)
                ->where('dokter_pemeriksa', $roleUser->idrole_user)
                ->first();

            if (!$rekamMedis) {
                throw new \Exception('Tidak ada akses untuk mengupdate rekam medis ini');
            }

            // Update rekam medis
            DB::table('rekam_medis')
                ->where('idrekam_medis', $id)
                ->update([
                    'anamnesa' => $request->anamnesa,
                    'temuan_klinis' => $request->temuan_klinis,
                    'diagnosa' => $request->diagnosa,
                ]);

            DB::commit();

            return redirect()->route('dokter.rekammedis.show', $id)
                ->with('success', 'Rekam medis berhasil diupdate.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('UPDATE REKAM MEDIS ERROR', [
                'msg' => $e->getMessage()
            ]);

            return back()->with('error', $e->getMessage());
        }
    }
}