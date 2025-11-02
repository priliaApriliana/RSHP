<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\RekamMedis;
use App\Models\Pet;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardDokterController extends Controller
{
    public function index()
    {
        $totalRekamMedis = RekamMedis::count();
        $rekamMedisHariIni = RekamMedis::whereDate('created_at', Carbon::today())->count();
        $totalPasien = Pet::count();

        return view('dokter.dashboard-dokter', compact(
            'totalRekamMedis',
            'rekamMedisHariIni',
            'totalPasien'
        ));
    }
}