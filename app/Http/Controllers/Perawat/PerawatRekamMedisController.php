<?php

namespace App\Http\Controllers\Perawat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PerawatRekamMedisController extends Controller
{
    /**
     * LIST REKAM MEDIS
     */
    public function index(Request $request)
    {
        $query = DB::table('rekam_medis')
            ->join('temu_dokter', 'rekam_medis.idreservasi_dokter', '=', 'temu_dokter.idreservasi_dokter')
            ->join('pet', 'temu_dokter.idpet', '=', 'pet.idpet')
            ->join('pemilik', 'pet.idpemilik', '=', 'pemilik.idpemilik')
            ->join('user', 'pemilik.iduser', '=', 'user.iduser')
            ->leftJoin('role_user', 'rekam_medis.dokter_pemeriksa', '=', 'role_user.idrole_user')
            ->leftJoin('user as dokter', 'role_user.iduser', '=', 'dokter.iduser')
            ->select(
                'rekam_medis.*',
                'pet.nama as nama_hewan',
                'user.nama as nama_pemilik',
                'dokter.nama as nama_dokter',
                'temu_dokter.waktu_daftar',
                'temu_dokter.status'
            );

        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('pet.nama', 'like', "%{$search}%")
                  ->orWhere('user.nama', 'like', "%{$search}%")
                  ->orWhere('rekam_medis.diagnosa', 'like', "%{$search}%")
                  ->orWhere('rekam_medis.anamnesa', 'like', "%{$search}%")
                  ->orWhere('rekam_medis.temuan_klinis', 'like', "%{$search}%");
            });
        }

        $rekam = $query->orderByDesc('rekam_medis.created_at')->paginate(10);
        return view('perawat.rekammedis.index', compact('rekam'));
    }

    /**
     * FORM CREATE
     */
    public function create()
    {
        $temuDokter = DB::table('temu_dokter')
            ->leftJoin('rekam_medis', 'temu_dokter.idreservasi_dokter', '=', 'rekam_medis.idreservasi_dokter')
            ->join('pet', 'temu_dokter.idpet', '=', 'pet.idpet')
            ->join('pemilik', 'pet.idpemilik', '=', 'pemilik.idpemilik')
            ->join('user', 'pemilik.iduser', '=', 'user.iduser')
            ->join('ras_hewan', 'pet.idras_hewan', '=', 'ras_hewan.idras_hewan')
            ->join('jenis_hewan', 'ras_hewan.idjenis_hewan', '=', 'jenis_hewan.idjenis_hewan')
            ->whereNull('rekam_medis.idrekam_medis')
            ->where('temu_dokter.status', 'A') // ✅ Hanya status Antri
            ->select(
                'temu_dokter.idreservasi_dokter',
                'temu_dokter.no_urut',
                'temu_dokter.waktu_daftar',
                'pet.nama as nama_hewan',
                'jenis_hewan.nama_jenis_hewan',
                'ras_hewan.nama_ras',
                'user.nama as nama_pemilik'
            )
            ->orderByDesc('temu_dokter.waktu_daftar')
            ->get();

        return view('perawat.rekammedis.create', compact('temuDokter'));
    }

    /**
     * STORE - INI YANG DIPERBAIKI!
     */
    public function store(Request $request)
    {
        $request->validate([
            'idreservasi_dokter' => 'required|exists:temu_dokter,idreservasi_dokter',
            'anamnesa'           => 'required|string|max:1000',
            'temuan_klinis'      => 'required|string|max:1000',
            'diagnosa'           => 'required|string|max:1000',
        ], [
            'idreservasi_dokter.required' => 'Pilih reservasi pasien terlebih dahulu',
            'anamnesa.required'           => 'Anamnesa (keluhan) wajib diisi',
            'temuan_klinis.required'      => 'Temuan klinis wajib diisi',
            'diagnosa.required'           => 'Diagnosa wajib diisi',
        ]);

        DB::beginTransaction();

        try {
            // ✅ CEK APAKAH SUDAH ADA REKAM MEDIS
            if (DB::table('rekam_medis')
                ->where('idreservasi_dokter', $request->idreservasi_dokter)
                ->exists()) {
                throw new \Exception('Reservasi ini sudah memiliki rekam medis.');
            }

            // ✅ AMBIL DATA TEMU DOKTER
            $temuDokter = DB::table('temu_dokter')
                ->where('idreservasi_dokter', $request->idreservasi_dokter)
                ->first();

            if (!$temuDokter) {
                throw new \Exception('Data temu dokter tidak ditemukan.');
            }

            // ✅ AMBIL ROLE_USER PERAWAT YANG LOGIN
            $roleUserPerawat = DB::table('role_user')
                ->where('iduser', Auth::id())
                ->where('idrole', 3) // 3 = Perawat
                ->first();

            if (!$roleUserPerawat) {
                throw new \Exception('Role perawat tidak valid. Anda harus login sebagai Perawat.');
            }

            // ✅ INSERT REKAM MEDIS
            // dokter_pemeriksa TIDAK BOLEH NULL!
            // Kita isi dengan role_user perawat dulu, nanti diganti dokter kalau dokter sudah periksa
            DB::table('rekam_medis')->insert([
                'idreservasi_dokter' => $request->idreservasi_dokter,
                'anamnesa'           => $request->anamnesa,
                'temuan_klinis'      => $request->temuan_klinis,
                'diagnosa'           => $request->diagnosa,
                'dokter_pemeriksa'   => $roleUserPerawat->idrole_user, // ✅ ISI DENGAN ROLE_USER PERAWAT
                'created_at'         => now(),
            ]);

            // ✅ UPDATE STATUS TEMU DOKTER → 'P' (PROSES)
            DB::table('temu_dokter')
                ->where('idreservasi_dokter', $request->idreservasi_dokter)
                ->update(['status' => 'P']);

            DB::commit();

            return redirect()
                ->route('perawat.rekammedis.index')
                ->with('success', 'Rekam medis berhasil disimpan. Menunggu pemeriksaan dokter.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('STORE REKAM MEDIS ERROR', [
                'msg' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ]);

            return back()->withInput()
                ->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    /**
     * SHOW DETAIL REKAM MEDIS (READ ONLY)
     */
    public function show($id)
    {
        $rekamMedis = DB::table('rekam_medis')
            ->where('idrekam_medis', $id)
            ->first();

        if (!$rekamMedis) {
            return redirect()->route('perawat.rekammedis.index')
                ->with('error', 'Rekam medis tidak ditemukan');
        }

        // Ambil data temu dokter, pet & pemilik
        $temu = DB::table('temu_dokter')
            ->join('pet', 'temu_dokter.idpet', '=', 'pet.idpet')
            ->join('pemilik', 'pet.idpemilik', '=', 'pemilik.idpemilik')
            ->join('user', 'pemilik.iduser', '=', 'user.iduser')
            ->join('ras_hewan', 'pet.idras_hewan', '=', 'ras_hewan.idras_hewan')
            ->join('jenis_hewan', 'ras_hewan.idjenis_hewan', '=', 'jenis_hewan.idjenis_hewan')
            ->select(
                'temu_dokter.*',
                'pet.nama as nama_hewan',
                'pet.tanggal_lahir',
                'pet.jenis_kelamin',
                'pet.warna_tanda',
                'pemilik.no_wa',
                'pemilik.alamat',
                'user.nama as nama_pemilik',
                'jenis_hewan.nama_jenis_hewan',
                'ras_hewan.nama_ras'
            )
            ->where('temu_dokter.idreservasi_dokter', $rekamMedis->idreservasi_dokter)
            ->first();

        // Ambil data dokter pemeriksa
        $dokter = DB::table('role_user')
            ->join('user', 'role_user.iduser', '=', 'user.iduser')
            ->where('role_user.idrole_user', $rekamMedis->dokter_pemeriksa)
            ->select('user.nama')
            ->first();

        // Ambil detail tindakan
        $detail = DB::table('detail_rekam_medis')
            ->join('kode_tindakan_terapi', 'detail_rekam_medis.idkode_tindakan_terapi', '=', 'kode_tindakan_terapi.idkode_tindakan_terapi')
            ->join('kategori', 'kode_tindakan_terapi.idkategori', '=', 'kategori.idkategori')
            ->select(
                'detail_rekam_medis.*',
                'kode_tindakan_terapi.kode',
                'kode_tindakan_terapi.deskripsi_tindakan_terapi',
                'kategori.nama_kategori'
            )
            ->where('detail_rekam_medis.idrekam_medis', $id)
            ->get();

        return view('perawat.rekammedis.show', compact('rekamMedis', 'temu', 'dokter', 'detail'));
    }

    /**
     * FORM EDIT REKAM MEDIS
     */
    public function edit($id)
    {
        $rekamMedis = DB::table('rekam_medis')
            ->where('idrekam_medis', $id)
            ->first();

        if (!$rekamMedis) {
            return redirect()->route('perawat.rekammedis.index')
                ->with('error', 'Rekam medis tidak ditemukan');
        }

        // Ambil data temu dokter, pet & pemilik
        $temu = DB::table('temu_dokter')
            ->join('pet', 'temu_dokter.idpet', '=', 'pet.idpet')
            ->join('pemilik', 'pet.idpemilik', '=', 'pemilik.idpemilik')
            ->join('user', 'pemilik.iduser', '=', 'user.iduser')
            ->join('ras_hewan', 'pet.idras_hewan', '=', 'ras_hewan.idras_hewan')
            ->join('jenis_hewan', 'ras_hewan.idjenis_hewan', '=', 'jenis_hewan.idjenis_hewan')
            ->select(
                'temu_dokter.*',
                'pet.nama as nama_hewan',
                'pet.jenis_kelamin',
                'pemilik.no_wa',
                'user.nama as nama_pemilik',
                'ras_hewan.nama_ras'
            )
            ->where('temu_dokter.idreservasi_dokter', $rekamMedis->idreservasi_dokter)
            ->first();

        // Ambil detail tindakan yang sudah ada (read only)
        $detail = DB::table('detail_rekam_medis')
            ->join('kode_tindakan_terapi', 'detail_rekam_medis.idkode_tindakan_terapi', '=', 'kode_tindakan_terapi.idkode_tindakan_terapi')
            ->select(
                'detail_rekam_medis.*',
                'kode_tindakan_terapi.deskripsi_tindakan_terapi'
            )
            ->where('detail_rekam_medis.idrekam_medis', $id)
            ->get();

        // Ambil daftar tindakan untuk tambah tindakan baru
        $tindakanTerapi = DB::table('kode_tindakan_terapi')
            ->orderBy('kode')
            ->get();

        return view('perawat.rekammedis.edit', compact('rekamMedis', 'temu', 'detail', 'tindakanTerapi'));
    }

    /**
     * UPDATE REKAM MEDIS
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'anamnesa'       => 'required|string|max:1000',
            'temuan_klinis'  => 'required|string|max:1000',
            'diagnosa'       => 'required|string|max:1000',
            'tindakan'       => 'nullable|array',
            'tindakan.*'     => 'nullable|exists:kode_tindakan_terapi,idkode_tindakan_terapi',
            'detail'         => 'nullable|array',
        ], [
            'anamnesa.required'      => 'Anamnesa (keluhan) wajib diisi',
            'temuan_klinis.required' => 'Temuan klinis wajib diisi',
            'diagnosa.required'      => 'Diagnosa wajib diisi',
        ]);

        DB::beginTransaction();

        try {
            $rekamMedis = DB::table('rekam_medis')
                ->where('idrekam_medis', $id)
                ->first();

            if (!$rekamMedis) {
                throw new \Exception('Rekam medis tidak ditemukan.');
            }

            // UPDATE REKAM MEDIS
            DB::table('rekam_medis')
                ->where('idrekam_medis', $id)
                ->update([
                    'anamnesa'      => $request->anamnesa,
                    'temuan_klinis' => $request->temuan_klinis,
                    'diagnosa'      => $request->diagnosa,
                ]);

            // TAMBAH TINDAKAN BARU (tidak hapus yang lama)
            if (!empty($request->tindakan)) {
                foreach ($request->tindakan as $i => $idTindakan) {
                    if ($idTindakan) {
                        DB::table('detail_rekam_medis')->insert([
                            'idrekam_medis'           => $id,
                            'idkode_tindakan_terapi'  => $idTindakan,
                            'detail'                  => $request->detail[$i] ?? null,
                        ]);
                    }
                }
            }

            DB::commit();

            return redirect()
                ->route('perawat.rekammedis.show', $id)
                ->with('success', 'Rekam medis berhasil diupdate.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('UPDATE REKAM MEDIS ERROR', [
                'msg' => $e->getMessage(),
                'line' => $e->getLine()
            ]);

            return back()->withInput()
                ->with('error', 'Gagal mengupdate data: ' . $e->getMessage());
        }
    }

    /**
     * DELETE REKAM MEDIS
     */
    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $rekam = DB::table('rekam_medis')->where('idrekam_medis', $id)->first();
            if (!$rekam) {
                throw new \Exception('Rekam medis tidak ditemukan.');
            }

            // Hapus detail rekam medis dulu
            DB::table('detail_rekam_medis')->where('idrekam_medis', $id)->delete();
            
            // Hapus rekam medis
            DB::table('rekam_medis')->where('idrekam_medis', $id)->delete();

            // ✅ Update status temu dokter kembali ke Antri
            DB::table('temu_dokter')
                ->where('idreservasi_dokter', $rekam->idreservasi_dokter)
                ->update(['status' => 'A']);

            DB::commit();

            return redirect()->route('perawat.rekammedis.index')
                ->with('success', 'Rekam medis berhasil dihapus.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('DELETE ERROR', ['msg' => $e->getMessage()]);
            return back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}