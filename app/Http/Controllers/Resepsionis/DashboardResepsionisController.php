<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\Pemilik;
use App\Models\TemuDokter;

class DashboardResepsionisController extends Controller
{
    public function index()
    {
        $totalPet = Pet::count();
        $totalPemilik = Pemilik::count();
        $totalTemuDokter = TemuDokter::count();

        return view('resepsionis.dashboard-resepsionis', compact('totalPet', 'totalPemilik', 'totalTemuDokter'));
    }
}