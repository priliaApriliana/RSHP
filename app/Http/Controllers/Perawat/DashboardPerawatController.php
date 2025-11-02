<?php

namespace App\Http\Controllers\Perawat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RekamMedis;

class DashboardPerawatController extends Controller
{
    public function index()
    {
        $totalRekamMedis = RekamMedis::count();
        $rekamMedisHariIni = RekamMedis::whereDate('created_at', now()->toDateString())->count();

        return view('perawat.dashboard-perawat', compact('totalRekamMedis', 'rekamMedisHariIni'));
    }
}
