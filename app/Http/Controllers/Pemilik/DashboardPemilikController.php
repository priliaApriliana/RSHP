<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use App\Models\Pemilik;
use App\Models\TemuDokter;
use App\Models\RekamMedis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardPemilikController extends Controller
{
    public function index()
    {
        // Ambil data pemilik dari user yang login
        $user = Auth::user();
        $pemilik = Pemilik::where('iduser', $user->iduser)->first();
        
        if (!$pemilik) {
            return redirect()->route('login')->with('error', 'Data pemilik tidak ditemukan');
        }

        // Statistik
        $totalPet = Pet::where('idpemilik', $pemilik->idpemilik)->count();
        $totalTemuDokter = TemuDokter::whereHas('pet', function($q) use ($pemilik) {
            $q->where('idpemilik', $pemilik->idpemilik);
        })->count();
        
        $temuDokterPending = TemuDokter::whereHas('pet', function($q) use ($pemilik) {
            $q->where('idpemilik', $pemilik->idpemilik);
        })->where('status', 'P')->count();

        return view('pemilik.dashboard-pemilik', compact(
            'pemilik',
            'totalPet',
            'totalTemuDokter',
            'temuDokterPending'
        ));
    }

    public function pet()
    {
        $user = Auth::user();
        $pemilik = Pemilik::where('iduser', $user->iduser)->first();
        
        $pets = Pet::with('rasHewan.jenisHewan')
            ->where('idpemilik', $pemilik->idpemilik)
            ->get();

        return view('pemilik.pet', compact('pets'));
    }

    public function riwayat()
    {
        $user = Auth::user();
        $pemilik = Pemilik::where('iduser', $user->iduser)->first();
        
        $riwayat = TemuDokter::with(['pet', 'dokter.user'])
            ->whereHas('pet', function($q) use ($pemilik) {
                $q->where('idpemilik', $pemilik->idpemilik);
            })
            ->orderBy('waktu_daftar', 'desc')
            ->paginate(10);

        return view('pemilik.riwayat', compact('riwayat'));
    }
}