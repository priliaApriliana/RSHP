<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KategoriKlinis;

class KategoriKlinisController extends Controller
{
    public function index()
    {
        $kategori_klinis = KategoriKlinis::all();
        return view('admin.kategoriklinis.index', compact('kategori_klinis'));
    }

    public function create()
    {
        return view('admin.kategoriklinis.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori_klinis' => 'required'
        ]);

        KategoriKlinis::create($request->all());
        return redirect()->route('kategoriklinis.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $kategori_klinis = KategoriKlinis::findOrFail($id);
        return view('admin.kategoriklinis.edit', compact('kategori_klinis'));
    }

    public function update(Request $request, $id)
    {
        $kategori_klinis = KategoriKlinis::findOrFail($id);
        $kategori_klinis->update($request->all());
        return redirect()->route('kategoriklinis.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        KategoriKlinis::findOrFail($id)->delete();
        return redirect()->route('kategoriklinis.index')->with('success', 'Data berhasil dihapus!');
    }
}
