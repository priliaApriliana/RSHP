<?php

namespace App\Http\Controllers\Perawat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PerawatRekamMedisController extends Controller
{
    public function index()
    {
        $rekam = DB::table('rekam_medis')
            ->join('temu_dokter', 'rekam_medis.idreservasi_dokter', '=', 'temu_dokter.idreservasi_dokter')
            ->join('pet', 'temu_dokter.idpet', '=', 'pet.idpet')
            ->join('pemilik', 'pet.idpemilik', '=', 'pemilik.idpemilik')
            ->join('user', 'pemilik.iduser', '=', 'user.iduser')
            ->select(
                'rekam_medis.*',
                'pet.nama as nama_hewan',
                'user.nama as nama_pemilik',
                'temu_dokter.waktu_daftar'
            )
            ->orderBy('rekam_medis.created_at', 'desc')
            ->paginate(10);
    
        return view('perawat.rekammedis.index', compact('rekam'));
    }    

    public function create()
    {
        // Ambil data hewan yang sudah terdaftar untuk dropdown
        $hewan = DB::table('pet')
            ->join('pemilik', 'pet.idpemilik', '=', 'pemilik.idpemilik')
            ->join('user', 'pemilik.iduser', '=', 'user.iduser')
            ->select(
                'pet.idpet',
                'pet.nama as nama_hewan',
                'user.nama as nama_pemilik'
            )
            ->get();

        // List tindakan untuk dropdown
        $tindakan = DB::table('kode_tindakan_terapi')
            ->join('kategori', 'kode_tindakan_terapi.idkategori', '=', 'kategori.idkategori')
            ->select(
                'kode_tindakan_terapi.idkode_tindakan_terapi',
                'kode_tindakan_terapi.kode',
                'kode_tindakan_terapi.deskripsi_tindakan_terapi',
                'kategori.nama_kategori'
            )
            ->orderBy('kategori.nama_kategori')
            ->orderBy('kode_tindakan_terapi.kode')
            ->get();

        return view('perawat.rekammedis.create', compact('hewan', 'tindakan'));
    }

    // simpan ke database
    public function store(Request $request)
    {
        $request->validate([
            'idpet' => 'required|exists:pet,idpet',
            'anamnesa' => 'required|string',
            'temuan_klinis' => 'required|string',
            'diagnosa' => 'required|string',
            'tindakan' => 'nullable|array',
            'tindakan.*' => 'exists:kode_tindakan_terapi,idkode_tindakan_terapi',
            'detail' => 'nullable|array',  
        ]);


        
        DB::beginTransaction();
        try {
            // 1. Buat temu_dokter dulu (karena rekam_medis perlu idreservasi_dokter)
            $nomorUrut = DB::table('temu_dokter')
                ->whereDate('waktu_daftar', now()->toDateString())
                ->max('no_urut') + 1;

            // Ambil role_user perawat yang sedang login
            $roleUser = DB::table('role_user')
                ->where('iduser', Auth::id())
                ->where('idrole', 3) // 3 = Perawat
                ->first();

            $idTemuDokter = DB::table('temu_dokter')->insertGetId([
                'no_urut' => $nomorUrut,
                'waktu_daftar' => now()->toDateString(),
                'status' => 'Selesai', // S = Selesai
                'idpet' => $request->idpet,
                'idrole_user' => $roleUser->idrole_user,
            ]);

            // 2. Insert rekam medis
            $idRekamMedis = DB::table('rekam_medis')->insertGetId([
                'idreservasi_dokter' => $idTemuDokter,
                'anamnesa' => $request->anamnesa,
                'temuan_klinis' => $request->temuan_klinis,
                'diagnosa' => $request->diagnosa,
                'dokter_pemeriksa' => $roleUser->idrole_user,
                'created_at' => now(),
            ]);

            // 3. Insert detail tindakan (jika ada)
            if ($request->has('tindakan') && is_array($request->tindakan)) {
                foreach ($request->tindakan as $index => $idTindakan) {
                    if ($idTindakan) { // Skip jika tidak dipilih
                        // Ambil detail dari array berdasarkan index yang sama
                        $detailCatatan = isset($request->detail[$index]) ? $request->detail[$index] : null;

                        DB::table('detail_rekam_medis')->insert([
                            'idrekam_medis' => $idRekamMedis,
                            'idkode_tindakan_terapi' => $idTindakan,
                            'detail' => $detailCatatan,
                        ]);
                    }
                }
            }

            DB::commit();
            return redirect()->route('perawat.rekammedis.index')
                ->with('success', 'Rekam medis berhasil ditambahkan!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->with('error', 'Gagal menyimpan rekam medis: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        // Rekam medis
        $rekamMedis = DB::table('rekam_medis')
            ->where('idrekam_medis', $id)
            ->first();
        
        if (!$rekamMedis) {
            return redirect()->route('perawat.rekammedis.index')
                ->with('error', 'Data tidak ditemukan');
        }

        // Ambil relasi temu_dokter → pet → pemilik → user
        $temu = DB::table('temu_dokter')
            ->join('pet', 'temu_dokter.idpet', '=', 'pet.idpet')
            ->leftJoin('pemilik', 'pet.idpemilik', '=', 'pemilik.idpemilik')
            ->leftJoin('user', 'pemilik.iduser', '=', 'user.iduser')
            ->where('temu_dokter.idreservasi_dokter', $rekamMedis->idreservasi_dokter)
            ->select(
                'pet.nama as nama_hewan',
                'user.nama as nama_pemilik',
                'temu_dokter.waktu_daftar'
            )
            ->first();

        // List tindakan
        $tindakan = DB::table('kode_tindakan_terapi')
            ->join('kategori', 'kode_tindakan_terapi.idkategori', '=', 'kategori.idkategori')
            ->select(
                'kode_tindakan_terapi.idkode_tindakan_terapi',
                'kode_tindakan_terapi.kode',
                'kode_tindakan_terapi.deskripsi_tindakan_terapi',
                'kategori.nama_kategori'
            )
            ->orderBy('kategori.nama_kategori')
            ->get();

        // Detail tindakan rekam_medis
        $detail = DB::table('detail_rekam_medis')
            ->join('kode_tindakan_terapi', 'detail_rekam_medis.idkode_tindakan_terapi', '=', 'kode_tindakan_terapi.idkode_tindakan_terapi')
            ->select(
                'detail_rekam_medis.iddetail_rekam_medis',
                'detail_rekam_medis.idrekam_medis',
                'detail_rekam_medis.idkode_tindakan_terapi',
                'detail_rekam_medis.detail',
                'kode_tindakan_terapi.kode',
                'kode_tindakan_terapi.deskripsi_tindakan_terapi'
            )
            ->where('detail_rekam_medis.idrekam_medis', $rekamMedis->idrekam_medis)
            ->get();

        return view('perawat.rekammedis.edit', [
            'rekamMedis' => $rekamMedis,
            'temu' => $temu,
            'tindakanTerapi' => $tindakan,
            'detail' => $detail,
        ]);
    }

    // update ke database
    public function update(Request $request, $id)
    {
        // Validasi
        $request->validate([
            'diagnosa' => 'required|string',
            'tindakan' => 'nullable|array',
            'tindakan.*' => 'nullable|exists:kode_tindakan_terapi,idkode_tindakan_terapi',
            'detail' => 'nullable|array',
        ]);

        DB::beginTransaction();
        try {
            // Update diagnosa
            DB::table('rekam_medis')
                ->where('idrekam_medis', $id)
                ->update([
                    'diagnosa' => $request->diagnosa,
                ]);

            // Tambah tindakan baru
            if ($request->has('tindakan') && is_array($request->tindakan) && count($request->tindakan) > 0) {
                foreach ($request->tindakan as $index => $idTindakan) {
                    if (!empty($idTindakan)) {
                        // Ambil detail dari array berdasarkan index yang sama
                        $detailCatatan = $request->detail[$index] ?? null;
                        if (!empty($detailCatatan)) {
                            $detailCatatan = trim($detailCatatan);
                        }

                        // Insert ke database
                        DB::table('detail_rekam_medis')->insert([
                            'idrekam_medis' => $id,
                            'idkode_tindakan_terapi' => $idTindakan,
                            'detail' => $detailCatatan,
                        ]);
                    }
                }
            }

            DB::commit();
            return redirect()->route('perawat.rekammedis.show', $id)
                ->with('success', 'Perubahan berhasil disimpan!');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error update rekam medis ID '.$id.': ' . $e->getMessage() . ' | Trace: ' . $e->getTraceAsString());
            return back()->withInput()
                ->with('error', 'Gagal update: ' . $e->getMessage());
        }
    }


    //delete
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            // Ambil idreservasi_dokter sebelum dihapus
            $rekamMedis = DB::table('rekam_medis')
                ->where('idrekam_medis', $id)
                ->first();

            // Hapus detail terlebih dahulu
            DB::table('detail_rekam_medis')->where('idrekam_medis', $id)->delete();

            // Hapus rekam medis
            DB::table('rekam_medis')->where('idrekam_medis', $id)->delete();

            // Hapus temu_dokter (opsional, sesuaikan dengan kebutuhan bisnis)
            // DB::table('temu_dokter')->where('idreservasi_dokter', $rekamMedis->idreservasi_dokter)->delete();

            DB::commit();
            return redirect()->route('perawat.rekammedis.index')
                ->with('success', 'Rekam medis berhasil dihapus!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal hapus: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        // Rekam medis
        $rekamMedis = DB::table('rekam_medis')
            ->where('idrekam_medis', $id)
            ->first();

        if (!$rekamMedis) {
            return redirect()->route('perawat.rekammedis.index')
                ->with('error', 'Data tidak ditemukan');
        }

        // Ambil relasi temu_dokter → pet → pemilik → user
        $temu = DB::table('temu_dokter')
            ->join('pet', 'temu_dokter.idpet', '=', 'pet.idpet')
            ->join('ras_hewan', 'pet.idras_hewan', '=', 'ras_hewan.idras_hewan')
            ->leftJoin('jenis_hewan', 'ras_hewan.idjenis_hewan', '=', 'jenis_hewan.idjenis_hewan')
            ->leftJoin('pemilik', 'pet.idpemilik', '=', 'pemilik.idpemilik')
            ->leftJoin('user', 'pemilik.iduser', '=', 'user.iduser')
            ->where('temu_dokter.idreservasi_dokter', $rekamMedis->idreservasi_dokter)
            ->select(
                'pet.nama as nama_hewan',
                'pet.jenis_kelamin',
                'pet.tanggal_lahir',
                'pet.warna_tanda',
                'ras_hewan.nama_ras',
                'jenis_hewan.nama_jenis_hewan',
                'user.nama as nama_pemilik',
                'pemilik.no_wa',
                'pemilik.alamat',
                'temu_dokter.waktu_daftar'
            )
            ->first();

        // Detail tindakan rekam_medis
        $detail = DB::table('detail_rekam_medis')
            ->join('kode_tindakan_terapi', 'detail_rekam_medis.idkode_tindakan_terapi', '=', 'kode_tindakan_terapi.idkode_tindakan_terapi')
            ->join('kategori', 'kode_tindakan_terapi.idkategori', '=', 'kategori.idkategori')
            ->where('detail_rekam_medis.idrekam_medis', $rekamMedis->idrekam_medis)
            ->select(
                'detail_rekam_medis.iddetail_rekam_medis',
                'kode_tindakan_terapi.idkode_tindakan_terapi',
                'kode_tindakan_terapi.kode',
                'kode_tindakan_terapi.deskripsi_tindakan_terapi',
                'kategori.nama_kategori',
                'detail_rekam_medis.detail'
            )
            ->get();
                
        // Dokter pemeriksa
        $dokter = DB::table('role_user')
            ->join('user', 'role_user.iduser', '=', 'user.iduser')
            ->where('role_user.idrole_user', $rekamMedis->dokter_pemeriksa)
            ->select('user.nama')
            ->first();

        // GANTI INI: dari 'show' menjadi 'detail'
        return view('perawat.rekammedis.show', [
            'rekamMedis' => $rekamMedis,
            'temu' => $temu,
            'detail' => $detail,
            'dokter' => $dokter,
        ]);
    }
}
