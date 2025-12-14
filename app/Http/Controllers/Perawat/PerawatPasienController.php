<?php

namespace App\Http\Controllers\Perawat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PerawatPasienController extends Controller
{
    public function index(Request $request)
    {
       // Query builder dengan JOIN
       $query = DB::table('pet as p')
       ->leftJoin('ras_hewan as r', 'p.idras_hewan', '=', 'r.idras_hewan')
       ->leftJoin('jenis_hewan as j', 'r.idjenis_hewan', '=', 'j.idjenis_hewan')
       ->leftJoin('pemilik as pm', 'p.idpemilik', '=', 'pm.idpemilik')
       ->leftJoin('user as u', 'pm.iduser', '=', 'u.iduser')
       ->select(
           'p.idpet',
           'p.nama',
           'p.jenis_kelamin',
           'r.nama_ras',
           'j.nama_jenis_hewan',
           'u.nama as nama_pemilik',
           'pm.no_wa'
       );

        // Filter pencarian
        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function($q) use ($search) {
                $q->where('p.nama', 'LIKE', "%{$search}%")
                  ->orWhere('u.nama', 'LIKE', "%{$search}%");
            });
        }

        // FILTER Jenis Hewan
        if (request()->filled('jenis_hewan')) {
            $query->where('j.idjenis_hewan', request()->jenis_hewan);
        }

        // Pagination
        $pasien = $query->orderBy('p.idpet', 'DESC')
            ->paginate(10)
            ->appends($request->all());

        // Get jenis hewan untuk dropdown
        $jenisHewan = DB::table('jenis_hewan')->get();

        return view('perawat.pasien.index', compact('pasien', 'jenisHewan'));
    }

    public function show($id)
    {
        // Query detail pet dengan JOIN
        $pet = DB::table('pet as p')
            ->leftJoin('ras_hewan as r', 'p.idras_hewan', '=', 'r.idras_hewan')
            ->leftJoin('jenis_hewan as j', 'r.idjenis_hewan', '=', 'j.idjenis_hewan')
            ->leftJoin('pemilik as pm', 'p.idpemilik', '=', 'pm.idpemilik')
            ->leftJoin('user as u', 'pm.iduser', '=', 'u.iduser')
            ->select(
                'p.*',
                'r.nama_ras',
                'j.nama_jenis_hewan',
                'u.nama as nama_pemilik',
                'pm.no_wa',
                'pm.alamat'
            )
            ->where('p.idpet', $id)
            ->first();

        if (!$pet) {
            return redirect()->route('perawat.pasien.index')
                ->with('error', 'Data pasien tidak ditemukan');
        }

        // Query riwayat rekam medis
        $riwayatRekam = DB::table('temu_dokter as td')
            ->leftJoin('rekam_medis as rm', 'td.idreservasi_dokter', '=', 'rm.idreservasi_dokter')
            ->leftJoin('role_user as ru', 'td.idrole_user', '=', 'ru.idrole_user')
            ->leftJoin('user as u', 'ru.iduser', '=', 'u.iduser')
            ->select(
                'td.waktu_daftar',
                'td.status',
                'rm.idrekam_medis',
                'rm.diagnosa',
                'u.nama as nama_dokter'
            )
            ->where('td.idpet', $id)
            ->whereNotNull('rm.idrekam_medis')
            ->orderBy('td.waktu_daftar', 'DESC')
            ->get();

    return view('perawat.pasien.show', compact('pet', 'riwayatRekam'));
    }
}