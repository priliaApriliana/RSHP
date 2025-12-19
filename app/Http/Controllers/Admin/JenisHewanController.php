<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class JenisHewanController extends Controller
{
    public function index()
    {
        // Eloquent
        // $jenisHewan = JenisHewan::all();

        // Query Builder
        $jenisHewan = DB::table('jenis_hewan')
            ->select('idjenis_hewan', 'nama_jenis_hewan')
            ->orderBy('idjenis_hewan', 'ASC')
            ->get();

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

        DB::table('jenis_hewan')->insert([
             'nama_jenis_hewan' => $this->formatNamaJenisHewan($validatedData['nama_jenis_hewan']),
        ]);

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
            // Eloquent
            // return JenisHewan::create([
            //     'nama_jenis_hewan' => $this->formatNamaJenisHewan($data['nama_jenis_hewan']),
            // ]);

            // quary builder (data diambil dari database)
            $jenisHewan = DB::table('jenis_hewan')->insert([
                'nama_jenis_hewan' => $this->formatNamaJenisHewan($data['nama_jenis_hewan']),
        ]);

        return $jenisHewan;
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
        $data = DB::table('jenis_hewan')
            ->where('idjenis_hewan', $id)
            ->first();

        if (!$data) {
            abort(404);
        }

        return view('admin.jenishewan.edit', compact('data'));
    }

    // Update data
    public function update(Request $request, $id)
    {
        $validatedData = $this->validateJenisHewan($request, $id);

        DB::table('jenis_hewan')
            ->where('idjenis_hewan', $id)
            ->update([
                'nama_jenis_hewan' => $this->formatNamaJenisHewan($validatedData['nama_jenis_hewan']),
            ]);

        return redirect()
            ->route('admin.jenishewan.index')
            ->with('success', 'Data berhasil diperbarui!');
    }

    // Hapus data
    public function destroy($idjenis_hewan)
    {
        try {
            // ambil data jenis hewan
            $jenisHewan = DB::table('jenis_hewan')
                ->where('idjenis_hewan', $idjenis_hewan)
                ->first();

            if (!$jenisHewan) {
                return redirect()
                    ->route('admin.jenishewan.index')
                    ->with('error', 'Data tidak ditemukan.');
            }

            // cek relasi ke ras_hewan
            $rasHewanCount = DB::table('ras_hewan')
                ->where('idjenis_hewan', $idjenis_hewan)
                ->count();

            if ($rasHewanCount > 0) {
                return redirect()
                    ->route('admin.jenishewan.index')
                    ->with(
                        'error',
                        "Jenis Hewan '{$jenisHewan->nama_jenis_hewan}' tidak dapat dihapus karena masih memiliki {$rasHewanCount} data Ras Hewan yang terkait."
                    );
            }

            // hapus data
            DB::table('jenis_hewan')
                ->where('idjenis_hewan', $idjenis_hewan)
                ->delete();

            return redirect()
                ->route('admin.jenishewan.index')
                ->with(
                    'success',
                    "Data Jenis Hewan '{$jenisHewan->nama_jenis_hewan}' berhasil dihapus!"
                );

        } catch (QueryException $e) {
            return redirect()
                ->route('admin.jenishewan.index')
                ->with('error', 'Data tidak dapat dihapus karena masih digunakan oleh data lain.');
        }
    }
}
