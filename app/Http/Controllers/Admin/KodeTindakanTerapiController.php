<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KodeTindakanTerapi;
use App\Models\Kategori;
use App\Models\KategoriKlinis;

class KodeTindakanTerapiController extends Controller
{
    public function index()
    {
        $kode_tindakan = KodeTindakanTerapi::with(['kategori', 'kategoriKlinis'])->get();
        return view('admin.kodetindakanterapi.index', compact('kode_tindakan'));
    }

    public function create()
    {
        $kategori = Kategori::all();
        $kategori_klinis = KategoriKlinis::all();
        return view('admin.kodetindakanterapi.create', compact('kategori', 'kategori_klinis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idkode_tindakan_terapi' => 'required',
            'deskripsi_tindakan_terapi' => 'required',
            'idkategori' => 'required',
            'idkategori_klinis' => 'required'
        ]);

        KodeTindakanTerapi::create($request->all());
        return redirect()->route('kodetindakanterapi.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $kode = KodeTindakanTerapi::findOrFail($id);
        $kategori = Kategori::all();
        $kategori_klinis = KategoriKlinis::all();
        return view('admin.kodetindakanterapi.edit', compact('kode', 'kategori', 'kategori_klinis'));
    }

    public function update(Request $request, $id)
    {
        $kode = KodeTindakanTerapi::findOrFail($id);
        $kode->update($request->all());
        return redirect()->route('kodetindakanterapi.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        KodeTindakanTerapi::findOrFail($id)->delete();
        return redirect()->route('kodetindakanterapi.index')->with('success', 'Data berhasil dihapus!');
    }
}
