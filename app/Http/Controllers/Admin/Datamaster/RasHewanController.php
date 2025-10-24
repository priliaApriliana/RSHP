<?php

namespace App\Http\Controllers\Admin\Datamaster;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RasHewan;
use App\Models\JenisHewan;

class RasHewanController extends Controller
{
    public function index()
    {
        $rasHewan = RasHewan::with('jenisHewan')->get();
        return view('admin.datamaster.rashewan.index', compact('rasHewan'));
    }

    public function create()
    {
        $jenisHewan = JenisHewan::all();
        return view('admin.datamaster.rashewan.create', compact('jenisHewan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_ras' => 'required',
            'idjenis_hewan' => 'required'
        ]);

        RasHewan::create($request->all());
        return redirect()->route('rashewan.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $ras = RasHewan::findOrFail($id);
        $jenisHewan = JenisHewan::all();
        return view('admin.datamaster.rashewan.edit', compact('ras', 'jenisHewan'));
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
