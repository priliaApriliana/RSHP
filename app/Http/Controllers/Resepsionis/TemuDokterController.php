<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TemuDokter;
use App\Models\Pet;
use App\Models\RoleUser;
use Carbon\Carbon;

class TemuDokterController extends Controller
{
    //tampilkan form
    public function create()
    {
        $pet = Pet::with('pemilik.user')->get();
        $dokter = RoleUser::with('user')
                    ->where('idrole', 2) // role dokter
                    ->where('status', 1)
                    ->get();

        return view('resepsionis.temudokter.create', compact('pet', 'dokter'));
    }

    // simpan data ke tabel temu_dokter
    public function store(Request $request)
    {
        $request->validate([
            'idpet' => 'required',
            'idrole_user' => 'required',
        ]);

        $noUrut = TemuDokter::whereDate('waktu_daftar', Carbon::today())->count() + 1;

        TemuDokter::create([
            'no_urut' => $noUrut,
            'waktu_daftar' => Carbon::today(),
            'status' => 'A', // aktif
            'idpet' => $request->idpet,
            'idrole_user' => $request->idrole_user,
        ]);

        return redirect()->back()->with('success', 'Pendaftaran Temu Dokter berhasil dilakukan.');
    }
}
