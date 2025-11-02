<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\Pemilik;
use App\Models\RasHewan;

class PetController extends Controller
{
    /**
     * Tampilkan form registrasi pet.
     */
    public function create()
    {
        // Ambil semua pemilik untuk dropdown
        $pemilik = Pemilik::with('user')->get();

        // Ambil semua ras hewan
        $rasHewan = RasHewan::with('jenisHewan')->get();

        return view('resepsionis.pet.create', compact('pemilik', 'rasHewan'));
    }

    /**
     * Simpan data pet baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'warna_tanda' => 'nullable|string|max:45',
            'jenis_kelamin' => 'required|in:J,B', // J=Jantan, B=Betina
            'idpemilik' => 'required|exists:pemilik,idpemilik',
            'idras_hewan' => 'required|exists:ras_hewan,idras_hewan',
        ]);

        // Simpan data
        Pet::create($validated);

        return redirect()->back()->with('success', 'Registrasi Pet berhasil disimpan!');
    }
}
