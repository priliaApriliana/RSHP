<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KodeTindakanTerapi;
use App\Models\Kategori;
use App\Models\KategoriKlinis;

class KodeTindakanTerapiController extends Controller
{
    // INDEX: tampilkan semua data
    public function index()
    {
        $kodeTindakan = KodeTindakanTerapi::with(['kategori', 'kategoriKlinis'])->get();
        return view('admin.kodetindakanterapi.index', compact('kodeTindakan'));
    }

    // CREATE: tampilkan form tambah data
    public function create()
    {
        $kategori = Kategori::all();
        $kategoriKlinis = KategoriKlinis::all();
        return view('admin.kodetindakanterapi.create', compact('kategori', 'kategoriKlinis'));
    }

    // STORE: simpan data baru
    public function store(Request $request)
    {
        $validatedData = $this->validateKodeTindakan($request);
        $this->createKodeTindakan($validatedData);

        return redirect()->route('admin.kodetindakanterapi.index')
                         ->with('success', 'Kode Tindakan Terapi berhasil ditambahkan.');
    }

    // VALIDATION
    protected function validateKodeTindakan(Request $request, $id = null)
    {
        $uniqueRule = $id
            ? 'unique:kode_tindakan_terapi,kode,' . $id . ',idkode_tindakan_terapi'
            : 'unique:kode_tindakan_terapi,kode';

        return $request->validate([
            'kode'                      => ['required', 'string', 'max:5', $uniqueRule],
            'deskripsi_tindakan_terapi' => ['required', 'string', 'max:1000'],
            'idkategori'                => ['required', 'exists:kategori,idkategori'],
            'idkategori_klinis'         => ['required', 'exists:kategori_klinis,idkategori_klinis'],
        ], [
            'kode.required'                      => 'Kode wajib diisi.',
            'kode.unique'                        => 'Kode sudah digunakan.',
            'kode.max'                           => 'Kode maksimal 5 karakter.',
            'deskripsi_tindakan_terapi.required' => 'Deskripsi wajib diisi.',
            'deskripsi_tindakan_terapi.max'      => 'Deskripsi maksimal 1000 karakter.',
            'idkategori.required'                => 'Kategori wajib dipilih.',
            'idkategori.exists'                  => 'Kategori tidak ditemukan.',
            'idkategori_klinis.required'         => 'Kategori klinis wajib dipilih.',
            'idkategori_klinis.exists'           => 'Kategori klinis tidak ditemukan.',
        ]);
    }

    // HELPER: simpan ke database
    protected function createKodeTindakan(array $data)
    {
        try {
            $last = KodeTindakanTerapi::orderBy('idkode_tindakan_terapi', 'desc')->first();
            $newId = $last ? $last->idkode_tindakan_terapi + 1 : 1;

            return KodeTindakanTerapi::create([
                'idkode_tindakan_terapi'     => $newId,
                'kode'                       => strtoupper(trim($data['kode'])),
                'deskripsi_tindakan_terapi'  => $this->formatSentence($data['deskripsi_tindakan_terapi']),
                'idkategori'                 => $data['idkategori'],
                'idkategori_klinis'          => $data['idkategori_klinis'],
            ]);
        } catch (\Exception $e) {
            throw new \Exception('Gagal menyimpan data Kode Tindakan Terapi: ' . $e->getMessage());
        }
    }

    // FORMAT DESKRIPSI
    protected function formatSentence($text)
    {
        return trim(ucfirst(strtolower($text)));
    }

    // EDIT: form edit
    public function edit($id)
    {
        $data = KodeTindakanTerapi::findOrFail($id);
        $kategori = Kategori::all();
        $kategoriKlinis = KategoriKlinis::all();

        return view('admin.kodetindakanterapi.edit', compact('data', 'kategori', 'kategoriKlinis'));
    }

    // UPDATE: simpan perubahan
    public function update(Request $request, $id)
    {
        $validatedData = $this->validateKodeTindakan($request, $id);

        $data = KodeTindakanTerapi::findOrFail($id);
        $data->update([
            'kode'                      => strtoupper(trim($validatedData['kode'])),
            'deskripsi_tindakan_terapi' => $this->formatSentence($validatedData['deskripsi_tindakan_terapi']),
            'idkategori'                => $validatedData['idkategori'],
            'idkategori_klinis'         => $validatedData['idkategori_klinis'],
        ]);

        return redirect()->route('admin.kodetindakanterapi.index')
                         ->with('success', 'Data Kode Tindakan Terapi berhasil diperbarui.');
    }

    // DESTROY: hapus data
    public function destroy($id)
    {
        KodeTindakanTerapi::findOrFail($id)->delete();
        return redirect()->route('admin.kodetindakanterapi.index')
                         ->with('success', 'Data Kode Tindakan Terapi berhasil dihapus.');
    }
}
