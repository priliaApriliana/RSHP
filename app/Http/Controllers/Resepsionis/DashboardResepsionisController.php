<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\Pemilik;
use App\Models\TemuDokter;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardResepsionisController extends Controller
{
    public function index()
    {
        $totalPet = Pet::count();
        $totalPemilik = Pemilik::count();
        $totalTemuDokter = TemuDokter::count();
        $user = Auth::user();

        return view('resepsionis.dashboard-resepsionis', compact('totalPet', 'totalPemilik', 'totalTemuDokter', 'user'));
    }
}