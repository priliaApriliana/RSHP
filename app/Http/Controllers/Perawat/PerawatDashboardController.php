<?php

namespace App\Http\Controllers\Perawat;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PerawatDashboardController extends Controller
{
    public function index()
    {
        // Total Pasien (Pet)
        $totalPasien = DB::table('pet')->count();

        // Total Rekam Medis
        $totalRekamMedis = DB::table('rekam_medis')->count();

        // Rekam Medis Bulan Ini (berdasarkan created_at)
        $rekamMedisBulanIni = DB::table('rekam_medis')
            ->whereYear('created_at', date('Y'))
            ->whereMonth('created_at', date('m'))
            ->count();

        // Rekam Medis Hari Ini
        $rekamMedisHariIni = DB::table('rekam_medis')
            ->whereDate('created_at', date('Y-m-d'))
            ->count();

        // Rekam Medis Terbaru (5 terakhir)
        // Sesuaikan dengan struktur DB: rekam_medis -> temu_dokter -> pet -> pemilik -> user
        $rekamMedisTerbaru = DB::table('rekam_medis')
            ->join('temu_dokter', 'rekam_medis.idreservasi_dokter', '=', 'temu_dokter.idreservasi_dokter')
            ->join('pet', 'temu_dokter.idpet', '=', 'pet.idpet')
            ->join('pemilik', 'pet.idpemilik', '=', 'pemilik.idpemilik')
            ->join('user', 'pemilik.iduser', '=', 'user.iduser')
            ->leftJoin('role_user', 'rekam_medis.dokter_pemeriksa', '=', 'role_user.idrole_user')
            ->leftJoin('dokter', 'role_user.iduser', '=', 'dokter.id_user')
            ->leftJoin('user as dokter_user', 'dokter.id_user', '=', 'dokter_user.iduser')
            ->select(
                'rekam_medis.idrekam_medis',
                'rekam_medis.created_at',
                'rekam_medis.anamnesa',
                'rekam_medis.diagnosa',
                'pet.nama as nama_pet',
                'user.nama as nama_pemilik',
                'dokter_user.nama as nama_dokter',
                'temu_dokter.waktu_daftar'
            )
            ->orderBy('rekam_medis.created_at', 'DESC')
            ->limit(5)
            ->get();

        // Pasien Aktif Bulan Ini (yang punya rekam medis bulan ini)
        $pasienAktifBulanIni = DB::table('pet')
            ->join('temu_dokter', 'pet.idpet', '=', 'temu_dokter.idpet')
            ->join('rekam_medis', 'temu_dokter.idreservasi_dokter', '=', 'rekam_medis.idreservasi_dokter')
            ->whereYear('rekam_medis.created_at', date('Y'))
            ->whereMonth('rekam_medis.created_at', date('m'))
            ->distinct()
            ->count('pet.idpet');

        return view('perawat.dashboard-perawat', compact(
            'totalPasien',
            'totalRekamMedis',
            'rekamMedisBulanIni',
            'rekamMedisHariIni',
            'rekamMedisTerbaru',
            'pasienAktifBulanIni'
        ));
    }
}