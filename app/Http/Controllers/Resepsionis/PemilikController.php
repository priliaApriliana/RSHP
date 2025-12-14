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
    public function index()
    {
        $pemilik = DB::table('pemilik')
            ->join('user', 'pemilik.iduser', '=', 'user.iduser')
            ->select('pemilik.*', 'user.nama', 'user.email')
            ->paginate(10);
        
        return view('resepsionis.pemilik.index', compact('pemilik'));
    }

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
            return redirect()->route('resepsionis.pemilik.index')
                            ->with('success', 'Data pemilik berhasil ditambahkan!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $pemilik = DB::table('pemilik')
            ->join('user', 'pemilik.iduser', '=', 'user.iduser')
            ->where('pemilik.idpemilik', $id)
            ->select('pemilik.*', 'user.nama', 'user.email')
            ->first();
        
        if (!$pemilik) {
            return redirect()->route('resepsionis.pemilik.index')
                            ->with('error', 'Data pemilik tidak ditemukan!');
        }

        return view('resepsionis.pemilik.show', compact('pemilik'));
    }

    public function edit($id)
    {
        $pemilik = DB::table('pemilik')
            ->join('user', 'pemilik.iduser', '=', 'user.iduser')
            ->where('pemilik.idpemilik', $id)
            ->select('pemilik.*', 'user.nama', 'user.email')
            ->first();
        
        if (!$pemilik) {
            return redirect()->route('resepsionis.pemilik.index')
                            ->with('error', 'Data pemilik tidak ditemukan!');
        }

        return view('resepsionis.pemilik.edit', compact('pemilik'));
    }

    public function update(Request $request, $id)
    {
        $pemilik = Pemilik::find($id);
        
        if (!$pemilik) {
            return redirect()->route('resepsionis.pemilik.index')
                            ->with('error', 'Data pemilik tidak ditemukan!');
        }

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:user,email,' . $pemilik->iduser . ',iduser',
            'no_wa' => 'required|string|max:20',
            'alamat' => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            // Update user
            User::where('iduser', $pemilik->iduser)->update([
                'nama'  => $request->nama,
                'email' => $request->email,
            ]);

            // Update pemilik
            $pemilik->update([
                'no_wa'  => $request->no_wa,
                'alamat' => $request->alamat,
            ]);

            DB::commit();
            return redirect()->route('resepsionis.pemilik.show', $id)
                            ->with('success', 'Data pemilik berhasil diperbarui!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $pemilik = Pemilik::find($id);
        
        if (!$pemilik) {
            return redirect()->route('resepsionis.pemilik.index')
                            ->with('error', 'Data pemilik tidak ditemukan!');
        }

        DB::beginTransaction();
        try {
            // Hapus user terlebih dahulu
            User::destroy($pemilik->iduser);
            
            // Hapus pemilik
            $pemilik->delete();

            DB::commit();
            return redirect()->route('resepsionis.pemilik.index')
                            ->with('success', 'Data pemilik berhasil dihapus!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
