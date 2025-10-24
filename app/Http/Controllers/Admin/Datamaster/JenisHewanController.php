<?php

namespace App\Http\Controllers\Admin\Datamaster;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JenisHewan;

class JenisHewanController extends Controller
{
    public function index()
    {
        $jenisHewan = JenisHewan::all();
        return view('admin.datamaster.jenishewan.index', compact('jenisHewan'));
    }

    //form tambah data
    public function create()
    {
        return view('admin.datamaster.jenishewan.create');
    }

    // Simpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_jenis_hewan' => 'required',
            'keterangan' => 'nullable'
        ]);

        JenisHewan::create($request->all());
        return redirect()->route('jenishewan.index')->with('success', 'Data berhasil ditambahkan!');
    }

    // Form edit
    public function edit($id)
    {
        $data = JenisHewan::findOrFail($id);
        return view('admin.datamaster.jenishewan.edit', compact('data'));
    }

    // Update data
    public function update(Request $request, $id)
    {
        $data = JenisHewan::findOrFail($id);
        $data->update($request->all());
        return redirect()->route('jenishewan.index')->with('success', 'Data berhasil diperbarui!');
    }

    // Hapus data
    public function destroy($id)
    {
        JenisHewan::findOrFail($id)->delete();
        return redirect()->route('jenishewan.index')->with('success', 'Data berhasil dihapus!');
    }
}
