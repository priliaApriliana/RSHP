<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemilik;
use App\Models\Pet;
use App\Models\RekamMedis;

class DashboardPemilikController extends Controller
{
    /**
     * Dashboard pemilik
     */
    public function index()
    {
        $userID = auth()->user()->iduser;

        $pemilik = Pemilik::where('iduser', $userID)->first();

        return view('pemilik.dashboard', compact('pemilik'));
    }

    /**
     * Daftar hewan milik pemilik
     */
    public function pet()
    {
        $userID = auth()->user()->iduser;

        $pemilik = Pemilik::where('iduser', $userID)->first();

        $pet = Pet::where('idpemilik', $pemilik->idpemilik)->get();

        return view('pemilik.pet.index', compact('pet'));
    }

    /**
     * Riwayat rekam medis hewan milik pemilik
     */
    public function riwayat()
    {
        $userID = auth()->user()->iduser;

        $pemilik = Pemilik::where('iduser', $userID)->first();

        $pet = Pet::where('idpemilik', $pemilik->idpemilik)->get();

        // Ambil semua rekam medis via temu_dokter
        $rekam = RekamMedis::with(['temu.pet'])
                ->whereIn(
                    'idreservasi_dokter',
                    function($q) use ($pet) {
                        $q->select('idreservasi_dokter')
                          ->from('temu_dokter')
                          ->whereIn('idpet', $pet->pluck('idpet'));
                    }
                )
                ->get();

        return view('pemilik.riwayat.index', compact('rekam'));
    }
}
