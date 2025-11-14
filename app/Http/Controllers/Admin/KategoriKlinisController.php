<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\KategoriKlinis;

class KategoriKlinisController extends Controller
{
    // -------------------------------
    // INDEX: Tampilkan semua data
    // -------------------------------
    public function index()
    {
        $kategoriKlinis = DB::table('kategori_klinis')
            ->select('idkategori_klinis', 'nama_kategori_klinis')
            ->get();

            return view('admin.KategoriKlinis.index', compact('kategoriKlinis'));

        // $kategori_klinis = KategoriKlinis::all();
        // return view('admin.kategoriklinis.index', compact('kategori_klinis'));
    }

    // -------------------------------
    // CREATE: Tampilkan form tambah data
    // -------------------------------
    public function create()
    {
        return view('admin.kategoriklinis.create');
    }

    // -------------------------------
    // STORE: Simpan data baru
    // -------------------------------
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $this->validateKategoriKlinis($request);

        // Helper untuk simpan data
        $this->createKategoriKlinis($validatedData);

        return redirect()->route('admin.kategoriklinis.index')
                        ->with('success', 'Kategori Klinis berhasil ditambahkan.');
    }

    // -------------------------------
    // VALIDATION
    // -------------------------------
    protected function validateKategoriKlinis(Request $request, $id = null)
    {
        // aturan unique (untuk create / update)
        $uniqueRule = $id
            ? 'unique:kategori_klinis,nama_kategori_klinis,' . $id . ',idkategori_klinis'
            : 'unique:kategori_klinis,nama_kategori_klinis';

        return $request->validate([
            'nama_kategori_klinis' => ['required', 'string', 'min:3', 'max:50', $uniqueRule],
        ], [
            'nama_kategori_klinis.required' => 'Nama kategori klinis wajib diisi.',
            'nama_kategori_klinis.string'   => 'Nama kategori klinis harus berupa teks.',
            'nama_kategori_klinis.min'      => 'Nama kategori klinis minimal 3 karakter.',
            'nama_kategori_klinis.max'      => 'Nama kategori klinis maksimal 50 karakter.',
            'nama_kategori_klinis.unique'   => 'Nama kategori klinis sudah terdaftar.',
        ]);
    }

    // -------------------------------
    // HELPER: Simpan ke database
    // -------------------------------
    protected function createKategoriKlinis(array $data)
    {
        try {
            // ambil id terakhir, lalu +1
            $lastId = DB::table('kategori_klinis')->max('idkategori_klinis');
            $newId = $lastId ? $lastId + 1 : 1;

            // quary builder (data diambil dari database)
            $kategoriKlinis = DB::table('kategori_klinis')->insert([
                'idkategori_klinis' => $newId,
                'nama_kategori_klinis' => $this->formatNamaKategoriKlinis($data['nama_kategori_klinis']),
            ]);
        
            return $kategoriKlinis;
        } catch (\Exception $e) {
            throw new \Exception('Gagal menyimpan data Kategori Klinis: ' . $e->getMessage());
        }
    }

    // -------------------------------
    // HELPER: Format Title Case
    // -------------------------------
    protected function formatNamaKategoriKlinis($text)
    {
        return trim(ucwords(strtolower($text)));
    }

    // -------------------------------
    // EDIT: Form edit data
    // -------------------------------
    public function edit($id)
    {
        $data = KategoriKlinis::findOrFail($id);
        return view('admin.kategori_klinis.edit', compact('data'));
    }

    // -------------------------------
    // UPDATE: Simpan perubahan
    // -------------------------------
    public function update(Request $request, $id)
    {
        $validatedData = $this->validateKategoriKlinis($request, $id);

        $data = KategoriKlinis::findOrFail($id);
        $data->update([
            'nama_kategori_klinis' => $this->formatTitleCase($validatedData['nama_kategori_klinis']),
        ]);

        return redirect()->route('admin.kategoriklinis.index')
                        ->with('success', 'Kategori Klinis berhasil diperbarui.');
    }

    // -------------------------------
    // DESTROY: Hapus data
    // -------------------------------
    public function destroy($id)
    {
        KategoriKlinis::findOrFail($id)->delete();
        return redirect()->route('admin.kategoriklinis.index')
                        ->with('success', 'Kategori Klinis berhasil dihapus.');
    }
}
