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
     * Tampilkan daftar semua temu dokter
     */
    public function index()
    {
        $temuDokter = DB::table('temu_dokter')
            ->join('pet', 'temu_dokter.idpet', '=', 'pet.idpet')
            ->join('pemilik', 'pet.idpemilik', '=', 'pemilik.idpemilik')
            ->join('user as pemilik_user', 'pemilik.iduser', '=', 'pemilik_user.iduser')
            ->join('role_user', 'temu_dokter.idrole_user', '=', 'role_user.idrole_user')
            ->join('user as dokter_user', 'role_user.iduser', '=', 'dokter_user.iduser')
            ->select(
                'temu_dokter.*',
                'pet.nama as nama_hewan',
                'pemilik_user.nama as nama_pemilik',
                'dokter_user.nama as nama_dokter'
            )
            ->orderBy('temu_dokter.waktu_daftar', 'desc')
            ->paginate(10);

        return view('resepsionis.temudokter.index', compact('temuDokter'));
    }

    /**
     * FORM DAFTAR TEMU DOKTER
     */
    public function create()
    {
        // semua hewan beserta pemilik
        $pet = Pet::with('pemilik')->get();

        // ambil semua role_user yang role nya adalah dokter (idrole = 2)
        $dokter = RoleUser::where('idrole', 2)->with('user')->get();

        return view('resepsionis.temudokter.create', compact('pet', 'dokter'));
    }

    /**
     * PROSES SIMPAN KE DB
     */
    public function store(Request $request)
    {
        $request->validate([
            'idpet' => 'required|integer',
            'idrole_user' => 'required|integer'
        ]);

        // Tentukan no_urut per hari
        $no_urut = TemuDokter::whereDate('waktu_daftar', now())->count() + 1;

        // Simpan data temu_dokter
        TemuDokter::create([
            'no_urut' => $no_urut,
            'waktu_daftar' => now()->toDateString(),
            'status' => 'A', // A = aktif / menunggu
            'idpet' => $request->idpet,
            'idrole_user' => $request->idrole_user,
        ]);

        return redirect()->route('resepsionis.temudokter.index')
                ->with('success', 'Pasien berhasil didaftarkan ke antrian dokter.');
    }

    /**
     * Tampilkan detail temu dokter
     */
    public function show($id)
    {
        $temuDokter = DB::table('temu_dokter')
            ->join('pet', 'temu_dokter.idpet', '=', 'pet.idpet')
            ->join('pemilik', 'pet.idpemilik', '=', 'pemilik.idpemilik')
            ->join('user as pemilik_user', 'pemilik.iduser', '=', 'pemilik_user.iduser')
            ->join('role_user', 'temu_dokter.idrole_user', '=', 'role_user.idrole_user')
            ->join('user as dokter_user', 'role_user.iduser', '=', 'dokter_user.iduser')
            ->where('temu_dokter.idreservasi_dokter', $id)
            ->select(
                'temu_dokter.*',
                'pet.nama as nama_hewan',
                'pemilik_user.nama as nama_pemilik',
                'dokter_user.nama as nama_dokter'
            )
            ->first();

        if (!$temuDokter) {
            return redirect()->route('resepsionis.temudokter.index')
                            ->with('error', 'Data temu dokter tidak ditemukan!');
        }

        return view('resepsionis.temudokter.show', compact('temuDokter'));
    }

    /**
     * Tampilkan form edit temu dokter
     */
    public function edit($id)
    {
        $temuDokter = TemuDokter::find($id);
        
        if (!$temuDokter) {
            return redirect()->route('resepsionis.temudokter.index')
                            ->with('error', 'Data temu dokter tidak ditemukan!');
        }

        $pet = Pet::with('pemilik')->get();
        $dokter = RoleUser::where('idrole', 2)->with('user')->get();

        return view('resepsionis.temudokter.edit', compact('temuDokter', 'pet', 'dokter'));
    }

    /**
     * Update data temu dokter
     */
    public function update(Request $request, $id)
    {
        $temuDokter = TemuDokter::find($id);
        
        if (!$temuDokter) {
            return redirect()->route('resepsionis.temudokter.index')
                            ->with('error', 'Data temu dokter tidak ditemukan!');
        }

        $request->validate([
            'idpet' => 'required|integer|exists:pet,idpet',
            'idrole_user' => 'required|integer|exists:role_user,idrole_user',
            'status' => 'required|in:A,S,B' // A=Aktif, S=Selesai, B=Batal
        ]);

        $temuDokter->update([
            'idpet' => $request->idpet,
            'idrole_user' => $request->idrole_user,
            'status' => $request->status,
        ]);

        return redirect()->route('resepsionis.temudokter.show', $id)
                        ->with('success', 'Data temu dokter berhasil diperbarui!');
    }

    /**
     * Hapus data temu dokter
     */
    public function destroy($id)
    {
        $temuDokter = TemuDokter::find($id);
        
        if (!$temuDokter) {
            return redirect()->route('resepsionis.temudokter.index')
                            ->with('error', 'Data temu dokter tidak ditemukan!');
        }

        $temuDokter->delete();

        return redirect()->route('resepsionis.temudokter.index')
                        ->with('success', 'Data temu dokter berhasil dihapus!');
    }
}
