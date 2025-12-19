<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

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

            return view('admin.kategoriklinis.index', compact('kategoriKlinis'));

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
        $data = DB::table('kategori_klinis')
            ->where('idkategori_klinis', $id)
            ->first();

        if (!$data) {
            return redirect()->route('admin.kategoriklinis.index')
                ->with('error', 'Data kategori klinis tidak ditemukan.');
        }

        return view('admin.kategoriklinis.edit', compact('data'));
    }

    // -------------------------------
    // UPDATE: Simpan perubahan
    // -------------------------------
    public function update(Request $request, $id)
    {
        $validatedData = $this->validateKategoriKlinis($request, $id);

        DB::table('kategori_klinis')
            ->where('idkategori_klinis', $id)
            ->update([
                'nama_kategori_klinis' => $this->formatNamaKategoriKlinis(
                    $validatedData['nama_kategori_klinis']
                ),
            ]);

        return redirect()->route('admin.kategoriklinis.index')
            ->with('success', 'Kategori Klinis berhasil diperbarui.');
    }

    // -------------------------------
    // DESTROY: Hapus data
    // -------------------------------
    public function destroy($id)
    {
        try {
            // Ambil data kategori klinis
            $kategori = DB::table('kategori_klinis')
                ->where('idkategori_klinis', $id)
                ->first();

            if (!$kategori) {
                return redirect()
                    ->route('admin.kategoriklinis.index')
                    ->with('error', 'Data kategori klinis tidak ditemukan.');
            }

            // CEK: apakah dipakai di kode tindakan terapi
            $dipakai = DB::table('kode_tindakan_terapi')
                ->where('idkategori_klinis', $id)
                ->count();

            if ($dipakai > 0) {
                return redirect()
                    ->route('admin.kategoriklinis.index')
                    ->with(
                        'error',
                        "Kategori Klinis <b>{$kategori->nama_kategori_klinis}</b> tidak dapat dihapus karena masih digunakan oleh {$dipakai} data kode tindakan terapi."
                    );
            }

            // Hapus aman
            DB::table('kategori_klinis')
                ->where('idkategori_klinis', $id)
                ->delete();

            return redirect()
                ->route('admin.kategoriklinis.index')
                ->with(
                    'success',
                    "Kategori Klinis <b>{$kategori->nama_kategori_klinis}</b> berhasil dihapus."
                );

        } catch (QueryException $e) {
            return redirect()
                ->route('admin.kategoriklinis.index')
                ->with('error', 'Kategori klinis tidak dapat dihapus karena masih terhubung dengan data lain.');
        }
    }

}
