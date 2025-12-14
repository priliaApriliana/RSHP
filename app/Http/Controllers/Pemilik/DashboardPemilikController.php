<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DashboardPemilikController extends Controller
{
    /**
     * Dashboard Pemilik
     */
    public function index()
    {
        $userID = Auth::user()->iduser;

        // Get data pemilik
        $pemilik = DB::table('pemilik')
            ->where('iduser', $userID)
            ->first();

        if (!$pemilik) {
            abort(404, 'Data pemilik tidak ditemukan');
        }

        // Hitung total hewan
        $totalPet = DB::table('pet')
            ->where('idpemilik', $pemilik->idpemilik)
            ->count();

        // Ambil semua idpet milik pemilik
        $petIDs = DB::table('pet')
            ->where('idpemilik', $pemilik->idpemilik)
            ->pluck('idpet');

        // Total kunjungan temu dokter
        $totalTemuDokter = DB::table('temu_dokter')
            ->whereIn('idpet', $petIDs)
            ->count();

        // Janji temu pending (status tertentu, sesuaikan dengan nilai status di DB Anda)
        $temuDokterPending = DB::table('temu_dokter')
            ->whereIn('idpet', $petIDs)
            ->where('status', 'A') // atau sesuaikan dengan status pending Anda
            ->count();

        return view('pemilik.dashboard-pemilik', compact(
            'pemilik',
            'totalPet',
            'totalTemuDokter',
            'temuDokterPending'
        ));
    }

    /**
     * Daftar hewan pemilik
     */
    public function pet()
    {
        $userID = Auth::user()->iduser;

        // Get data pemilik
        $pemilik = DB::table('pemilik')
            ->where('iduser', $userID)
            ->first();

        if (!$pemilik) {
            abort(404, 'Data pemilik tidak ditemukan');
        }

        // Get data pet dengan join
        $pet = DB::table('pet')
            ->join('ras_hewan', 'pet.idras_hewan', '=', 'ras_hewan.idras_hewan')
            ->join('jenis_hewan', 'ras_hewan.idjenis_hewan', '=', 'jenis_hewan.idjenis_hewan')
            ->where('pet.idpemilik', $pemilik->idpemilik)
            ->select(
                'pet.*',
                'ras_hewan.nama_ras',
                'jenis_hewan.nama_jenis_hewan'
            )
            ->get();

        return view('pemilik.pet.index', compact('pet'));
    }

    /**
     * Riwayat rekam medis
     */
    public function riwayat()
    {
        $userID = Auth::user()->iduser;

        // Get data pemilik
        $pemilik = DB::table('pemilik')
            ->where('iduser', $userID)
            ->first();

        if (!$pemilik) {
            abort(404, 'Data pemilik tidak ditemukan');
        }

        // Ambil semua idpet milik pemilik
        $petIDs = DB::table('pet')
            ->where('idpemilik', $pemilik->idpemilik)
            ->pluck('idpet');

        // Get rekam medis dengan join
        $rekam = DB::table('rekam_medis')
            ->join('temu_dokter', 'rekam_medis.idreservasi_dokter', '=', 'temu_dokter.idreservasi_dokter')
            ->join('pet', 'temu_dokter.idpet', '=', 'pet.idpet')
            ->whereIn('temu_dokter.idpet', $petIDs)
            ->select(
                'rekam_medis.*',
                'pet.nama as nama_pet'
            )
            ->orderBy('rekam_medis.created_at', 'desc')
            ->get();

        return view('pemilik.riwayat.index', compact('rekam'));
    }

    /**
     * Jadwal Temu Dokter
     */
    public function temuDokter()
    {
        $userID = Auth::user()->iduser;

        // Get data pemilik
        $pemilik = DB::table('pemilik')
            ->where('iduser', $userID)
            ->first();

        if (!$pemilik) {
            abort(404, 'Data pemilik tidak ditemukan');
        }

        // Get jadwal temu dokter
        // Struktur tabel: idreservasi_dokter, no_urut, waktu_daftar, status, idpet, idrole_user
        $temuDokter = DB::table('temu_dokter')
            ->join('pet', 'temu_dokter.idpet', '=', 'pet.idpet')
            ->leftJoin('role_user', 'temu_dokter.idrole_user', '=', 'role_user.idrole_user')
            ->leftJoin('user', 'role_user.iduser', '=', 'user.iduser')
            ->where('pet.idpemilik', $pemilik->idpemilik)
            ->select(
                'temu_dokter.*',
                'pet.nama as nama_pet',
                'user.nama as nama_dokter'
            )
            ->orderBy('temu_dokter.waktu_daftar', 'desc')
            ->get();

        return view('pemilik.temu-dokter.index', compact('temuDokter'));
    }

    /**
     * Tampilkan halaman profil
     */
    public function profil()
    {
        $userID = Auth::user()->iduser;

        // Get data pemilik dengan join ke user
        $pemilik = DB::table('pemilik')
            ->join('user', 'pemilik.iduser', '=', 'user.iduser')
            ->where('pemilik.iduser', $userID)
            ->select('pemilik.*', 'user.nama', 'user.email')
            ->first();

        if (!$pemilik) {
            abort(404, 'Data pemilik tidak ditemukan');
        }

        return view('pemilik.profil.index', compact('pemilik'));
    }

    /**
     * Update profil pemilik
     */
    public function updateProfil(Request $request)
    {
        $userID = Auth::user()->iduser;

        // Validasi
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'no_wa' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'password' => 'nullable|min:6|confirmed',
        ]);

        // Update user table
        $userData = [
            'nama' => $request->nama,
            'email' => $request->email,
        ];

        // Jika password diisi, update password
        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        DB::table('user')
            ->where('iduser', $userID)
            ->update($userData);

        // Update pemilik table
        DB::table('pemilik')
            ->where('iduser', $userID)
            ->update([
                'no_wa' => $request->no_wa,
                'alamat' => $request->alamat,
            ]);

        return redirect()->route('pemilik.profil')
            ->with('success', 'Profil berhasil diperbarui!');
    }
}