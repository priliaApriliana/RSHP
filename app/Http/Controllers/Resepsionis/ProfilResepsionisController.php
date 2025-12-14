<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfilResepsionisController extends Controller
{
    /**
     * VIEW PROFIL RESEPSIONIS
     */
    public function index()
    {
        $user = Auth::user();
        
        $roleUser = DB::table('role_user')
                        ->join('role', 'role_user.idrole', '=', 'role.idrole')
                        ->where('role_user.iduser', $user->iduser)
                        ->where('role_user.idrole', 3)
                        ->select('role_user.*', 'role.nama_role')
                        ->first();

        return view('resepsionis.profil', compact('user', 'roleUser'));
    }
}
