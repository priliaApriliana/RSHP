<?php

namespace App\Http\Controllers\Perawat;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PerawatDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        // Total pasien - quary builder
        $totalPasien = DB::table('pet')->count();

        // Total rekam medis
        $totalRekamMedis = DB::table('rekam_medis')->count();

        // Rekam medis bulan ini
        $rekamMedisBulanIni = DB::table('rekam_medis')
            ->whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->count();

        return view('perawat.dashboard-perawat', [
            'totalPasien' => $totalPasien,
            'totalRekamMedis' => $totalRekamMedis,
            'rekamMedisBulanIni' => $rekamMedisBulanIni,
        ]);
    }
}