<?php

namespace App\Http\Controllers\Perawat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KodeTindakanTerapi;
use App\Models\Kategori;
use App\Models\KategoriKlinis;

class TindakanController extends Controller
{
    /**
     * LIST DATA
     */
    public function index()
    {
        $data = KodeTindakanTerapi::with(['kategori', 'kategoriKlinis'])
                ->orderBy('idkode_tindakan_terapi', 'ASC')
                ->get();

        return view('perawat.tindakan.index', compact('data'));
    }

    /**
     * FORM CREATE
     */
    public function create()
    {
        $kategori       = Kategori::all();
        $kategoriKlinis = KategoriKlinis::all();

        return view('perawat.tindakan.create', compact('kategori', 'kategoriKlinis'));
    }

    /**
     * SIMPAN DATA BARU
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|max:10|unique:kode_tindakan_terapi,kode',
            'deskripsi_tindakan_terapi' => 'required|max:500',
            'idkategori' => 'required|integer',
            'idkategori_klinis' => 'required|integer',
        ]);

        KodeTindakanTerapi::create([
            'kode' => $request->kode,
            'deskripsi_tindakan_terapi' => $request->deskripsi_tindakan_terapi,
            'idkategori' => $request->idkategori,
            'idkategori_klinis' => $request->idkategori_klinis,
        ]);

        return redirect()->route('perawat.tindakan.index')
                         ->with('success', 'Tindakan berhasil ditambahkan.');
    }

    /**
     * FORM EDIT
     */
    public function edit($id)
    {
        $data = KodeTindakanTerapi::findOrFail($id);

        $kategori       = Kategori::all();
        $kategoriKlinis = KategoriKlinis::all();

        return view('perawat.tindakan.edit', compact('data', 'kategori', 'kategoriKlinis'));
    }

    /**
     * UPDATE DATA
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'kode' =>
                'required|max:10|unique:kode_tindakan_terapi,kode,' .
                $id . ',idkode_tindakan_terapi',
            'deskripsi_tindakan_terapi' => 'required|max:500',
            'idkategori' => 'required|integer',
            'idkategori_klinis' => 'required|integer',
        ]);

        $data = KodeTindakanTerapi::findOrFail($id);

        $data->update([
            'kode' => $request->kode,
            'deskripsi_tindakan_terapi' => $request->deskripsi_tindakan_terapi,
            'idkategori' => $request->idkategori,
            'idkategori_klinis' => $request->idkategori_klinis,
        ]);

        return redirect()->route('perawat.tindakan.index')
                         ->with('success', 'Tindakan berhasil diupdate.');
    }

    /**
     * HAPUS DATA
     */
    public function destroy($id)
    {
        $data = KodeTindakanTerapi::findOrFail($id);
        $data->delete();

        return redirect()->route('perawat.tindakan.index')
                         ->with('success', 'Tindakan berhasil dihapus.');
    }
}