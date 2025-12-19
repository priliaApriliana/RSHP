<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class RasHewanController extends Controller
{
    public function index()
    {
        $rasHewan = DB::table('ras_hewan')
        ->leftJoin('jenis_hewan', 'ras_hewan.idjenis_hewan', '=', 'jenis_hewan.idjenis_hewan')
        ->select(
            'ras_hewan.*',
            'jenis_hewan.nama_jenis_hewan'
        )
        ->orderBy('ras_hewan.idras_hewan')
        ->get();

        return view('admin.rashewan.index', compact('rasHewan'));
    }

    public function create()
    {
        $jenisHewan = DB::table('jenis_hewan')->get();
        return view('admin.rashewan.create', compact('jenisHewan'));
    }

    // store - simpan data baru
    public function store(Request $request)
    {
        // validasi input
        $validatedData = $this->validateRasHewan($request);

        // helper untuk menyimpan data
        $this->createRasHewan($validatedData);

        return redirect()->route('admin.rashewan.index')->with('success', 'Data berhasil ditambahkan!');
    }

    // VALIDATION
    protected function validateRasHewan(Request $request, $id = null)
    {
        // data unik: nama_ras per jenis_hewan
        $uniqueRule = $id
            ? 'unique:ras_hewan,nama_ras,' . $id . ',idras_hewan,idjenis_hewan,' . $request->idjenis_hewan
            : 'unique:ras_hewan,nama_ras,NULL,idras_hewan,idjenis_hewan,' . $request->idjenis_hewan;

        return $request->validate([
            'nama_ras'       => ['required', 'string', 'max:100', $uniqueRule],
            'idjenis_hewan'  => ['required', 'exists:jenis_hewan,idjenis_hewan'],
        ], [
            'nama_ras.required'      => 'Nama ras wajib diisi.',
            'nama_ras.string'        => 'Nama ras harus berupa teks.',
            'nama_ras.max'           => 'Nama ras maksimal 100 karakter.',
            'nama_ras.unique'        => 'Nama ras ini sudah terdaftar untuk jenis hewan yang dipilih.',
            'idjenis_hewan.required' => 'Jenis hewan wajib dipilih.',
            'idjenis_hewan.exists'   => 'Jenis hewan tidak ditemukan di database.',
        ]);
    }

    
    // HELPER: Simpan ke database
    protected function createRasHewan(array $data)
    {
        $lastId = DB::table('ras_hewan')
            ->orderBy('idras_hewan', 'desc')
            ->first();

        $newId = $lastId ? $lastId->idras_hewan + 1 : 1;

        DB::table('ras_hewan')->insert([
            'idras_hewan'   => $newId,
            'nama_ras'      => $this->formatTitleCase($data['nama_ras']),
            'idjenis_hewan' => $data['idjenis_hewan'],
        ]);
    }

    // HELPER: Format Title Case
    protected function formatTitleCase($string)
    {
        return trim(ucwords(strtolower($string)));
    }


    public function edit($id)
    {
        $ras = DB::table('ras_hewan')->where('idras_hewan', $id)->first();

        if (!$ras) {
            abort(404);
        }

        $jenisHewan = DB::table('jenis_hewan')->get();
        return view('admin.rashewan.edit', compact('ras', 'jenisHewan'));
    }


    public function update(Request $request, $id)
    {
        $this->validateRasHewan($request, $id);

        DB::table('ras_hewan')
            ->where('idras_hewan', $id)
            ->update([
                'nama_ras'      => $this->formatTitleCase($request->nama_ras),
                'idjenis_hewan' => $request->idjenis_hewan,
            ]);

        return redirect()->route('admin.rashewan.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        try {
            // Ambil data ras
            $ras = DB::table('ras_hewan')
                ->where('idras_hewan', $id)
                ->first();

            if (!$ras) {
                return redirect()
                    ->route('admin.rashewan.index')
                    ->with('error', 'Data ras hewan tidak ditemukan.');
            }

            // Cek apakah ras masih dipakai di tabel pet
            $petCount = DB::table('pet')
                ->where('idras_hewan', $id)
                ->count();

            if ($petCount > 0) {
                return redirect()
                    ->route('admin.rashewan.index')
                    ->with(
                        'error',
                        "Ras hewan '{$ras->nama_ras}' tidak dapat dihapus karena masih digunakan oleh {$petCount} data Pet."
                    );
            }

            // Jika aman → hapus
            DB::table('ras_hewan')
                ->where('idras_hewan', $id)
                ->delete();

            return redirect()
                ->route('admin.rashewan.index')
                ->with('success', "Ras hewan '{$ras->nama_ras}' berhasil dihapus.");

        } catch (QueryException $e) {

            // FK constraint (23000)
            if ($e->getCode() == 23000) {
                return redirect()
                    ->route('admin.rashewan.index')
                    ->with(
                        'error',
                        'Ras hewan tidak dapat dihapus karena masih terhubung dengan data lain.'
                    );
            }

            return redirect()
                ->route('admin.rashewan.index')
                ->with('error', 'Terjadi kesalahan saat menghapus data.');

        } catch (\Exception $e) {

            return redirect()
                ->route('admin.rashewan.index')
                ->with('error', 'Terjadi kesalahan yang tidak terduga.');
        }
    }
}
