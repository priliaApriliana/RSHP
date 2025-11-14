<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
// use App\Models\KodeTindakanTerapi;
// use App\Models\Kategori;
// use App\Models\KategoriKlinis;

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

        return view('admin.kodetindakanterapi.create', compact('kategori', 'kategoriKlinis'));
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
        $uniqueRule = $id
            ? 'unique:kode_tindakan_terapi,kode,' . $id . ',idkode_tindakan_terapi'
            : 'unique:kode_tindakan_terapi,kode';

        return $request->validate([
            'kode'                      => ['required', 'string', 'max:5', $uniqueRule],
            'deskripsi_tindakan_terapi' => ['required', 'string', 'max:1000'],
            'idkategori'                => ['required', 'exists:kategori,idkategori'],
            'idkategori_klinis'         => ['required', 'exists:kategori_klinis,idkategori_klinis'],
        ], [
            'kode.required'                      => 'Kode wajib diisi.',
            'kode.unique'                        => 'Kode sudah digunakan.',
            'kode.max'                           => 'Kode maksimal 5 karakter.',
            'deskripsi_tindakan_terapi.required' => 'Deskripsi wajib diisi.',
            'deskripsi_tindakan_terapi.max'      => 'Deskripsi maksimal 1000 karakter.',
            'idkategori.required'                => 'Kategori wajib dipilih.',
            'idkategori.exists'                  => 'Kategori tidak ditemukan.',
            'idkategori_klinis.required'         => 'Kategori klinis wajib dipilih.',
            'idkategori_klinis.exists'           => 'Kategori klinis tidak ditemukan.',
        ]);
    }

    // HELPER: simpan ke database
    protected function createKodeTindakan(array $data)
    {
        // ambil kode terakhir
        $last = DB::table('kode_tindakan_terapi')
            ->orderBy('idkode_tindakan_terapi', 'desc')->first();

        if (!$last) {
            $newCode = 'T01';
        } else {
            $lastNumber = intval(substr($last->kode, 1));
            $newNumber = $lastNumber + 1;
            $newCode = 'T' . str_pad($newNumber, 2, '0', STR_PAD_LEFT);
        }

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
        $data = DB::table('kode_tindakan_terapi')->where('idkode_tindakan_terapi', $id)->first();
        $kategori = DB::table('kategori')->get();
        $kategoriKlinis = DB::table('kategori_klinis')->get();

        return view('admin.kodetindakanterapi.edit', compact('data', 'kategori', 'kategoriKlinis'));
    }

    // UPDATE: simpan perubahan
    public function update(Request $request, $id)
    {
        $validatedData = $this->validateKodeTindakan($request, $id);

        DB::table('kode_tindakan_terapi')
            ->where('idkode_tindakan_terapi', $id)
            ->update([
                'kode' => strtoupper(trim($validatedData['kode'])),
                'deskripsi_tindakan_terapi' => $this->formatSentence($validatedData['deskripsi_tindakan_terapi']),
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
