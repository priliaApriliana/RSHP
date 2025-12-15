<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class KodeTindakanTerapiController extends Controller
{
    // INDEX: tampilkan semua data
    public function index()
    {
        $kodeTindakan = DB::table('kode_tindakan_terapi')
            ->join('kategori', 'kode_tindakan_terapi.idkategori', '=', 'kategori.idkategori')
            ->join('kategori_klinis', 'kode_tindakan_terapi.idkategori_klinis', '=', 'kategori_klinis.idkategori_klinis')
            ->select(
                'kode_tindakan_terapi.*',
                'kategori.nama_kategori',
                'kategori_klinis.nama_kategori_klinis'
            )   
            ->orderBy('idkode_tindakan_terapi', 'ASC')
            ->get();
        return view('admin.kodetindakanterapi.index', compact('kodeTindakan'));
    }

    // CREATE: tampilkan form tambah data
    public function create()
    {
        $kategori = DB::table('kategori')->get();
        $kategoriKlinis = DB::table('kategori_klinis')->get();
        
        // Generate kode otomatis untuk preview
        $nextCode = $this->generateNextCode();

        return view('admin.kodetindakanterapi.create', compact('kategori', 'kategoriKlinis', 'nextCode'));
    }

    // STORE: simpan data baru
    public function store(Request $request)
    {
        $validatedData = $this->validateKodeTindakan($request);
        $this->createKodeTindakan($validatedData);

        return redirect()->route('admin.kodetindakanterapi.index')
                         ->with('success', 'Kode Tindakan Terapi berhasil ditambahkan.');
    }

    // VALIDATOR
    protected function validateKodeTindakan(Request $request, $id = null)
    {
        return $request->validate([
            'deskripsi_tindakan_terapi' => ['required', 'string', 'max:1000'],
            'idkategori'                => ['required', 'exists:kategori,idkategori'],
            'idkategori_klinis'         => ['required', 'exists:kategori_klinis,idkategori_klinis'],
        ], [
            'deskripsi_tindakan_terapi.required' => 'Deskripsi wajib diisi.',
            'deskripsi_tindakan_terapi.max'      => 'Deskripsi maksimal 1000 karakter.',
            'idkategori.required'                => 'Kategori wajib dipilih.',
            'idkategori.exists'                  => 'Kategori tidak ditemukan.',
            'idkategori_klinis.required'         => 'Kategori klinis wajib dipilih.',
            'idkategori_klinis.exists'           => 'Kategori klinis tidak ditemukan.',
        ]);
    }

    // GENERATE NEXT CODE
    protected function generateNextCode()
    {
        $last = DB::table('kode_tindakan_terapi')
            ->orderBy('idkode_tindakan_terapi', 'desc')
            ->first();

        if (!$last) {
            return 'T01';
        }

        $lastNumber = intval(substr($last->kode, 1));
        $newNumber = $lastNumber + 1;
        return 'T' . str_pad($newNumber, 2, '0', STR_PAD_LEFT);
    }

    // HELPER: simpan ke database
    protected function createKodeTindakan(array $data)
    {
        $newCode = $this->generateNextCode();

        DB::table('kode_tindakan_terapi')->insert([
            'kode' => $newCode,
            'deskripsi_tindakan_terapi' => $this->formatDeskripsi($data['deskripsi_tindakan_terapi']),
            'idkategori' => $data['idkategori'],
            'idkategori_klinis' => $data['idkategori_klinis'],
        ]);
    }

    // FORMAT DESKRIPSI
    protected function formatDeskripsi($text)
    {
        return trim(ucfirst(strtolower($text)));
    }

    // EDIT: form edit
    public function edit($id)
    {
        $kode = DB::table('kode_tindakan_terapi')->where('idkode_tindakan_terapi', $id)->first();
        $kategori = DB::table('kategori')->get();
        $kategoriKlinis = DB::table('kategori_klinis')->get();

        return view('admin.kodetindakanterapi.edit', compact('kode', 'kategori', 'kategoriKlinis'));
    }

    // UPDATE: simpan perubahan
    public function update(Request $request, $id)
    {
        $validatedData = $this->validateKodeTindakan($request, $id);

        DB::table('kode_tindakan_terapi')
            ->where('idkode_tindakan_terapi', $id)
            ->update([
                // kode tidak diupdate karena otomatis
                'deskripsi_tindakan_terapi' => $this->formatDeskripsi($validatedData['deskripsi_tindakan_terapi']),
                'idkategori' => $validatedData['idkategori'],
                'idkategori_klinis' => $validatedData['idkategori_klinis'],
        ]);

        return redirect()->route('admin.kodetindakanterapi.index')
                         ->with('success', 'Data Kode Tindakan Terapi berhasil diperbarui.');
    }

    // DESTROY: hapus data
    public function destroy($id)
    {
        DB::table('kode_tindakan_terapi')->where('idkode_tindakan_terapi', $id)->delete();

        return redirect()->route('admin.kodetindakanterapi.index')
            ->with('success', 'Data berhasil dihapus.');
    }
}