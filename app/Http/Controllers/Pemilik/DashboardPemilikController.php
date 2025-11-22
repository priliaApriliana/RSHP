<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemilik;
use App\Models\Pet;
use App\Models\TemuDokter;
use App\Models\RekamMedis;
use Illuminate\Support\Facades\Auth;

class DashboardPemilikController extends Controller
{
    /**
     * Dashboard Pemilik
     */
    public function index()
    {
        $userID = Auth::user()->iduser;

        $pemilik = Pemilik::where('iduser', $userID)->firstOrFail();

        // Hitung total hewan
        $totalPet = Pet::where('idpemilik', $pemilik->idpemilik)->count();

        // ambil semua idpet milik pemilik
        $petIDs = Pet::where('idpemilik', $pemilik->idpemilik)->pluck('idpet');

        // total kunjungan temu dokter
        $totalTemuDokter = TemuDokter::whereIn('idpet', $petIDs)->count();

        // janji temu pending
        $temuDokterPending = TemuDokter::whereIn('idpet', $petIDs)
                                ->where('status', 'A')
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

        $pemilik = Pemilik::where('iduser', $userID)->firstOrFail();

        $pet = Pet::with(['rasHewan.jenisHewan'])
                ->where('idpemilik', $pemilik->idpemilik)
                ->get();

        return view('pemilik.pet.index', compact('pet'));
    }

    /**
     * Riwayat rekam medis
     */
    public function riwayat()
    {
        $userID = Auth::user()->iduser;

        $pemilik = Pemilik::where('iduser', $userID)->firstOrFail();

        $petIDs = Pet::where('idpemilik', $pemilik->idpemilik)->pluck('idpet');

        $rekam = RekamMedis::with(['temu.pet'])
            ->whereIn('idreservasi_dokter', function ($q) use ($petIDs) {
                $q->select('idreservasi_dokter')
                  ->from('temu_dokter')
                  ->whereIn('idpet', $petIDs);
            })
            ->get();

        return view('pemilik.riwayat.index', compact('rekam'));
    }
}
