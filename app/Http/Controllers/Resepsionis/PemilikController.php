<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pemilik;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class PemilikController extends Controller
{
    public function create()
    {
        return view('resepsionis.pemilik.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:user,email',
            'password' => 'required|min:6',
            'no_wa' => 'required|string|max:20',
            'alamat' => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {

            // 1️⃣ Simpan user terlebih dahulu
            $user = User::create([
                'nama'     => $request->nama,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // 2️⃣ Generate idpemilik manual (menggunakan max + 1)
            $nextId = Pemilik::max('idpemilik') + 1;

            // 3️⃣ Simpan pemilik
            Pemilik::create([
                'idpemilik' => $nextId,
                'no_wa'     => $request->no_wa,
                'alamat'    => $request->alamat,
                'iduser'    => $user->iduser,
            ]);

            DB::commit();
            return redirect()->route('resepsionis.dashboard')
                            ->with('success', 'Data pemilik berhasil ditambahkan!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

}
