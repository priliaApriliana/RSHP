<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\Pemilik;
use App\Models\RasHewan;
use Illuminate\Support\Facades\DB;

class PetController extends Controller
{
    /**
     * Tampilkan daftar semua pet (TERBARU DI ATAS)
     */
    public function index()
    {
        $pet = DB::table('pet')
            ->join('pemilik', 'pet.idpemilik', '=', 'pemilik.idpemilik')
            ->join('user', 'pemilik.iduser', '=', 'user.iduser')
            ->join('ras_hewan', 'pet.idras_hewan', '=', 'ras_hewan.idras_hewan')
            ->join('jenis_hewan', 'ras_hewan.idjenis_hewan', '=', 'jenis_hewan.idjenis_hewan')
            ->select(
                'pet.*',
                'user.nama as nama_pemilik',
                'ras_hewan.nama_ras',
                'jenis_hewan.nama_jenis_hewan'
            )
            ->orderBy('pet.idpet', 'DESC')  // ✅ TERBARU DI ATAS (berdasarkan ID)
            ->paginate(10);

        return view('resepsionis.pet.index', compact('pet'));
    }


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

        return redirect()->route('resepsionis.pet.index')
                        ->with('success', 'Registrasi Pet berhasil disimpan!');
    }

    /**
     * Tampilkan detail pet
     */
    public function show($id)
    {
        $pet = DB::table('pet')
            ->join('pemilik', 'pet.idpemilik', '=', 'pemilik.idpemilik')
            ->join('user', 'pemilik.iduser', '=', 'user.iduser')
            ->join('ras_hewan', 'pet.idras_hewan', '=', 'ras_hewan.idras_hewan')
            ->join('jenis_hewan', 'ras_hewan.idjenis_hewan', '=', 'jenis_hewan.idjenis_hewan')
            ->where('pet.idpet', $id)
            ->select('pet.*', 'user.nama as nama_pemilik', 'ras_hewan.nama_ras', 'jenis_hewan.nama_jenis_hewan')
            ->first();

        if (!$pet) {
            return redirect()->route('resepsionis.pet.index')
                            ->with('error', 'Data pet tidak ditemukan!');
        }

        return view('resepsionis.pet.show', compact('pet'));
    }

    /**
     * Tampilkan form edit pet
     */
    public function edit($id)
    {
        $pet = Pet::find($id);
        
        if (!$pet) {
            return redirect()->route('resepsionis.pet.index')
                            ->with('error', 'Data pet tidak ditemukan!');
        }

        $pemilik = Pemilik::with('user')->get();
        $rasHewan = RasHewan::with('jenisHewan')->get();

        return view('resepsionis.pet.edit', compact('pet', 'pemilik', 'rasHewan'));
    }

    /**
     * Update data pet
     */
    public function update(Request $request, $id)
    {
        $pet = Pet::find($id);
        
        if (!$pet) {
            return redirect()->route('resepsionis.pet.index')
                            ->with('error', 'Data pet tidak ditemukan!');
        }

        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'warna_tanda' => 'nullable|string|max:45',
            'jenis_kelamin' => 'required|in:J,B',
            'idpemilik' => 'required|exists:pemilik,idpemilik',
            'idras_hewan' => 'required|exists:ras_hewan,idras_hewan',
        ]);

        $pet->update($validated);

        return redirect()->route('resepsionis.pet.index', $id)
                        ->with('success', 'Data pet berhasil diperbarui!');
    }

    /**
     * Hapus data pet
     */
    public function destroy($id)
    {
        $pet = Pet::find($id);
        
        if (!$pet) {
            return redirect()->route('resepsionis.pet.index')
                            ->with('error', 'Data pet tidak ditemukan!');
        }

        $pet->delete();

        return redirect()->route('resepsionis.pet.index')
                        ->with('success', 'Data pet berhasil dihapus!');
    }
}