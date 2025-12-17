<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TemuDokter;
use App\Models\Pet;
use App\Models\RoleUser;
use Illuminate\Support\Facades\DB;

class TemuDokterController extends Controller
{
    /**
     * ✅ DAFTAR TEMU DOKTER - dengan STATUS DINAMIS dan SORTING PRIORITAS
     */
    public function index()
    {
        $temuDokter = DB::table('temu_dokter')
            ->join('pet', 'temu_dokter.idpet', '=', 'pet.idpet')
            ->join('pemilik', 'pet.idpemilik', '=', 'pemilik.idpemilik')
            ->join('user as pemilik_user', 'pemilik.iduser', '=', 'pemilik_user.iduser')
            ->join('role_user', 'temu_dokter.idrole_user', '=', 'role_user.idrole_user')
            ->join('user as dokter_user', 'role_user.iduser', '=', 'dokter_user.iduser')
            ->leftJoin('rekam_medis', 'temu_dokter.idreservasi_dokter', '=', 'rekam_medis.idreservasi_dokter')
            ->select(
                'temu_dokter.*',
                'pet.nama as nama_hewan',
                'pemilik_user.nama as nama_pemilik',
                'dokter_user.nama as nama_dokter',
                'rekam_medis.idrekam_medis'
            )
            // ✅ SORTING PRIORITAS:
            // 1. Status ANTRI & PROSES di atas (berdasarkan no_urut ASC)
            // 2. Status SELESAI & BATAL di bawah (waktu_daftar DESC)
            ->orderByRaw("
                CASE 
                    WHEN temu_dokter.status IN ('A', 'P') THEN 0
                    ELSE 1
                END ASC
            ")
            ->orderBy('temu_dokter.no_urut', 'ASC')  // Untuk ANTRI/PROSES
            ->orderBy('temu_dokter.waktu_daftar', 'DESC')  // Untuk SELESAI/BATAL
            ->paginate(10);

        // ✅ TAMBAHKAN STATUS DINAMIS
        $temuDokter->getCollection()->transform(function($item) {
            if ($item->status == 'B') {
                $item->status_display = 'B'; // Batal
            } elseif ($item->status == 'S') {
                $item->status_display = 'S'; // Selesai
            } elseif ($item->idrekam_medis) {
                $item->status_display = 'P'; // Ada rekam medis = PROSES
            } else {
                $item->status_display = 'A'; // Belum ada rekam medis = ANTRI
            }
            return $item;
        });

        return view('resepsionis.temudokter.index', compact('temuDokter'));
    }

    /**
     * FORM TAMBAH TEMU DOKTER
     */
    public function create()
    {
        $pet = Pet::with('pemilik')->get();
        $dokter = RoleUser::where('idrole', 2)->with('user')->get();

        return view('resepsionis.temudokter.create', compact('pet', 'dokter'));
    }

    /**
     * ✅ SIMPAN TEMU DOKTER (SELALU ANTRI)
     */
    public function store(Request $request)
    {
        $request->validate([
            'idpet' => 'required|exists:pet,idpet',
            'idrole_user' => 'required|exists:role_user,idrole_user',
        ]);

        // ✅ HITUNG NO URUT BERDASARKAN HARI INI (yang belum selesai/batal)
        $no_urut = TemuDokter::whereDate('waktu_daftar', today())
            ->whereNotIn('status', ['S', 'B'])
            ->count() + 1;

        TemuDokter::create([
            'no_urut' => $no_urut,
            'waktu_daftar' => now(),
            'status' => 'A', // ✅ Selalu ANTRI
            'idpet' => $request->idpet,
            'idrole_user' => $request->idrole_user,
        ]);

        return redirect()
            ->route('resepsionis.temudokter.index')
            ->with('success', 'Pasien berhasil dimasukkan ke antrian dokter.');
    }

    /**
     * DETAIL TEMU DOKTER
     */
    public function show($id)
    {
        $temuDokter = DB::table('temu_dokter')
            ->join('pet', 'temu_dokter.idpet', '=', 'pet.idpet')
            ->join('pemilik', 'pet.idpemilik', '=', 'pemilik.idpemilik')
            ->join('user as pemilik_user', 'pemilik.iduser', '=', 'pemilik_user.iduser')
            ->join('role_user', 'temu_dokter.idrole_user', '=', 'role_user.idrole_user')
            ->join('user as dokter_user', 'role_user.iduser', '=', 'dokter_user.iduser')
            ->leftJoin('rekam_medis', 'temu_dokter.idreservasi_dokter', '=', 'rekam_medis.idreservasi_dokter')
            ->where('temu_dokter.idreservasi_dokter', $id)
            ->select(
                'temu_dokter.*',
                'pet.nama as nama_hewan',
                'pemilik_user.nama as nama_pemilik',
                'dokter_user.nama as nama_dokter',
                'rekam_medis.idrekam_medis'
            )
            ->first();

        if (!$temuDokter) {
            return redirect()->route('resepsionis.temudokter.index')
                ->with('error', 'Data temu dokter tidak ditemukan');
        }

        // ✅ STATUS DINAMIS
        if ($temuDokter->status == 'B') {
            $temuDokter->status_display = 'B';
        } elseif ($temuDokter->status == 'S') {
            $temuDokter->status_display = 'S';
        } elseif ($temuDokter->idrekam_medis) {
            $temuDokter->status_display = 'P';
        } else {
            $temuDokter->status_display = 'A';
        }

        return view('resepsionis.temudokter.show', compact('temuDokter'));
    }

    /**
     * FORM EDIT (RESEPSIONIS)
     */
    public function edit($id)
    {
        $temuDokter = TemuDokter::findOrFail($id);
        $pet = Pet::with('pemilik')->get();
        $dokter = RoleUser::where('idrole', 2)->with('user')->get();

        return view('resepsionis.temudokter.edit', compact('temuDokter', 'pet', 'dokter'));
    }

    /**
     * ✅ UPDATE (HANYA ANTRI / BATAL)
     */
    public function update(Request $request, $id)
    {
        $temuDokter = TemuDokter::findOrFail($id);

        $request->validate([
            'idpet' => 'required|exists:pet,idpet',
            'idrole_user' => 'required|exists:role_user,idrole_user',
            'status' => 'required|in:A,B', // ✅ Hanya A atau B
        ]);

        $temuDokter->update([
            'idpet' => $request->idpet,
            'idrole_user' => $request->idrole_user,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('resepsionis.temudokter.show', $id)
            ->with('success', 'Data temu dokter berhasil diperbarui');
    }

    /**
     * ✅ BATALKAN TEMU DOKTER
     */
    public function batal($id)
    {
        TemuDokter::where('idreservasi_dokter', $id)
            ->update(['status' => 'B']);

        return redirect()
            ->route('resepsionis.temudokter.index')
            ->with('success', 'Temu dokter berhasil dibatalkan');
    }
}