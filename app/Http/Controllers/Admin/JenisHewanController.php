<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JenisHewan;

class JenisHewanController extends Controller
{
    public function index()
    {
        $jenisHewan = JenisHewan::all();
        return view('admin.jenishewan.index', compact('jenisHewan'));
    }

    //form tambah data
    public function create()
    {
        return view('admin.jenishewan.create');
    }

    // Simpan data baru
    public function store(Request $request)
    {
        // validasi input
        $validatedData = $this->validateJenisHewan($request);

        // helper untuk menyimpan data
        $jenisHewan = $this->createJenisHewan($validatedData);

        return redirect()->route('admin.jenishewan.index')
                        ->with('success', 'Jenis Hewan berhasil ditambahkan.');
    }

    //validation ->untuk memvalidasi data-data yg kita inputkan
    protected function validateJenisHewan(Request $request, $id = null)
    {
        // data yang bersifat unik
        $uniqueRule = $id ? 
            'unique:jenis_hewan,nama_jenis_hewan,' . $id . ',idjenis_hewan' : 
            'unique:jenis_hewan,nama_jenis_hewan';

        // validasi data input
        return $request->validate([
            'nama_jenis_hewan' => [
                'required',
                'string',
                'max:255',
                'min:3',
                $uniqueRule
            ],
        ], [
            'nama_jenis_hewan.required' => 'Nama jenis hewan wajib diisi.',
            'nama_jenis_hewan.string'   => 'Nama jenis hewan harus berupa teks.',
            'nama_jenis_hewan.max'      => 'Nama jenis hewan maksimal 255 karakter.',
            'nama_jenis_hewan.min'      => 'Nama jenis hewan minimal 3 karakter.',
            'nama_jenis_hewan.unique'   => 'Nama jenis hewan sudah ada.',
        ]);
    }

    // Helper untuk membuat data baru (mengekseskusi data kedatabase)
    protected function createJenisHewan(array $data)
    {
        try {
            return JenisHewan::create([
                'nama_jenis_hewan' => $this->formatNamaJenisHewan($data['nama_jenis_hewan']),
            ]);
        } catch (\Exception $e) {
            throw new \Exception('Gagal menyimpan data jenis hewan: ' . $e->getMessage());
        }
    }

    // Helper untuk format nama menjadi Title Case (merubah format hurufnya)
    protected function formatNamaJenisHewan($nama)
    {
        return trim(ucwords(strtolower($nama)));
    }




    // Form edit
    public function edit($id)
    {
        $data = JenisHewan::findOrFail($id);
        return view('admin.jenishewan.edit', compact('data'));
    }

    // Update data
    public function update(Request $request, $id)
    {
        $data = JenisHewan::findOrFail($id);
        $data->update($request->all());
        return redirect()->route('admin.jenishewan.index')->with('success', 'Data berhasil diperbarui!');
    }

    // Hapus data
    public function destroy($id)
    {
        JenisHewan::findOrFail($id)->delete();
        return redirect()->route('admin.jenishewan.index')->with('success', 'Data berhasil dihapus!');
    }
}
