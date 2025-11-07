<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RasHewan;
use App\Models\JenisHewan;

class RasHewanController extends Controller
{
    public function index()
    {
        $rasHewan = RasHewan::with('jenisHewan')->get();
        return view('admin.rashewan.index', compact('rasHewan'));
    }

    public function create()
    {
        $jenisHewan = JenisHewan::all();
        return view('admin.rashewan.create', compact('jenisHewan'));
    }

    // store - simpan data baru
    public function store(Request $request)
    {
        // validasi input
        $validatedData = $this->validateKategori($request);

        // helper untuk menyimpan data
        $this->createKategori($validatedData);

        return redirect()->route('admin.rashewan.index')->with('success', 'Data berhasil ditambahkan!');
    }

    // VALIDATION
    protected function validateRasHewan(Request $request, $id = null)
    {
        // data unik: nama_ras per jenis_hewan
        $uniqueRule = $id
            ? 'unique:ras_hewan,nama_ras,' . $id . ',idras_hewan,idjenis_hewan,' . $request->idjenis_hewan
            : 'unique:ras_hewan,nama_ras,NULL,idras_hewan,idjenis_hewan,' . $request->idjenis_hewan;

        return $request->validate([
            'nama_ras'       => ['required', 'string', 'max:100', $uniqueRule],
            'idjenis_hewan'  => ['required', 'exists:jenis_hewan,idjenis_hewan'],
        ], [
            'nama_ras.required'      => 'Nama ras wajib diisi.',
            'nama_ras.string'        => 'Nama ras harus berupa teks.',
            'nama_ras.max'           => 'Nama ras maksimal 100 karakter.',
            'nama_ras.unique'        => 'Nama ras ini sudah terdaftar untuk jenis hewan yang dipilih.',
            'idjenis_hewan.required' => 'Jenis hewan wajib dipilih.',
            'idjenis_hewan.exists'   => 'Jenis hewan tidak ditemukan di database.',
        ]);
    }

    
    // HELPER: Simpan ke database
    protected function createRasHewan(array $data)
    {
        try {
            // generate id baru
            $lastRas = RasHewan::orderBy('idras_hewan', 'desc')->first();
            $newId = $lastRas ? $lastRas->idras_hewan + 1 : 1;

            return RasHewan::create([
                'idras_hewan'   => $newId,
                'nama_ras'      => $this->formatTitleCase($data['nama_ras']),
                'idjenis_hewan' => $data['idjenis_hewan'],
            ]);
        } catch (\Exception $e) {
            throw new \Exception('Gagal menyimpan data Ras Hewan: ' . $e->getMessage());
        }
    }

    // HELPER: Format Title Case
    protected function formatTitleCase($string)
    {
        return trim(ucwords(strtolower($string)));
    }





    public function edit($id)
    {
        $ras = RasHewan::findOrFail($id);
        $jenisHewan = JenisHewan::all();
        return view('admin.rashewan.edit', compact('ras', 'jenisHewan'));
    }

    public function update(Request $request, $id)
    {
        $ras = RasHewan::findOrFail($id);
        $ras->update($request->all());
        return redirect()->route('rashewan.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        RasHewan::findOrFail($id)->delete();
        return redirect()->route('rashewan.index')->with('success', 'Data berhasil dihapus!');
    }
}
