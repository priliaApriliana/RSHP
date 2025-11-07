<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    // -------------------------------
    // INDEX: Tampilkan semua data
    // -------------------------------
    public function index()
    {
        $kategori = Kategori::all();
        return view('admin.kategori.index', compact('kategori'));
    }

    // -------------------------------
    // CREATE: Form tambah data
    // -------------------------------
    public function create()
    {
        return view('admin.kategori.create');
    }

    // -------------------------------
    // STORE: Simpan data baru
    // -------------------------------
    public function store(Request $request)
    {
        // validasi input
        $validatedData = $this->validateKategori($request);

        // helper untuk menyimpan data
        $this->createKategori($validatedData);

        return redirect()->route('admin.kategori.index')
                        ->with('success', 'Kategori berhasil ditambahkan.');
    }

    // -------------------------------
    // VALIDATION
    // -------------------------------
    protected function validateKategori(Request $request, $id = null)
    {
        // aturan unique tergantung apakah create atau update
        $uniqueRule = $id
            ? 'unique:kategori,nama_kategori,' . $id . ',idkategori'
            : 'unique:kategori,nama_kategori';

        return $request->validate([
            'nama_kategori' => ['required', 'string', 'min:3', 'max:100', $uniqueRule],
            'deskripsi'     => ['nullable', 'string', 'max:255'],
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.string'   => 'Nama kategori harus berupa teks.',
            'nama_kategori.min'      => 'Nama kategori minimal 3 karakter.',
            'nama_kategori.max'      => 'Nama kategori maksimal 100 karakter.',
            'nama_kategori.unique'   => 'Nama kategori sudah terdaftar.',
            'deskripsi.string'       => 'Deskripsi harus berupa teks.',
            'deskripsi.max'          => 'Deskripsi maksimal 255 karakter.',
        ]);
    }

    // -------------------------------
    // HELPER: Simpan ke database
    // -------------------------------
    protected function createKategori(array $data)
    {
        try {
            // get last id
            $lastKategori = Kategori::orderBy('idkategori', 'desc')->first();
            $newId = $lastKategori ? $lastKategori->idkategori + 1 : 1;

            return Kategori::create([
                'idkategori'     => $newId,
                'nama_kategori'  => $this->formatTitleCase($data['nama_kategori']),
                'deskripsi'      => $data['deskripsi'] ?? null,
            ]);
        } catch (\Exception $e) {
            throw new \Exception('Gagal menyimpan data Kategori: ' . $e->getMessage());
        }
    }

    // -------------------------------
    // HELPER: Format Title Case
    // -------------------------------
    protected function formatTitleCase($nama_kategori)
    {
        return trim(ucwords(strtolower($nama_kategori)));
    }

    // -------------------------------
    // EDIT: Form edit data
    // -------------------------------
    public function edit($id)
    {
        $data = Kategori::findOrFail($id);
        return view('admin.kategori.edit', compact('data'));
    }

    // -------------------------------
    // UPDATE: Simpan perubahan
    // -------------------------------
    public function update(Request $request, $id)
    {
        $validatedData = $this->validateKategori($request, $id);

        $data = Kategori::findOrFail($id);
        $data->update([
            'nama_kategori' => $this->formatTitleCase($validatedData['nama_kategori']),
            'deskripsi'     => $validatedData['deskripsi'] ?? null,
        ]);

        return redirect()->route('admin.kategori.index')
                        ->with('success', 'Kategori berhasil diperbarui.');
    }

    // -------------------------------
    // DESTROY: Hapus data
    // -------------------------------
    public function destroy($id)
    {
        Kategori::findOrFail($id)->delete();
        return redirect()->route('admin.kategori.index')
                        ->with('success', 'Kategori berhasil dihapus.');
    }
}
