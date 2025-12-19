<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class PetController extends Controller
{
     // index- Tampilkan semua data Pet
     public function index()
     {
        $pet = DB::table('pet')
        ->leftJoin('ras_hewan', 'pet.idras_hewan', '=', 'ras_hewan.idras_hewan')
        ->leftJoin('jenis_hewan', 'ras_hewan.idjenis_hewan', '=', 'jenis_hewan.idjenis_hewan')
        ->leftJoin('pemilik', 'pet.idpemilik', '=', 'pemilik.idpemilik')
        ->leftJoin('user', 'pemilik.iduser', '=', 'user.iduser')
        ->select(
            'pet.*',
            'ras_hewan.nama_ras',
            'jenis_hewan.nama_jenis_hewan',
            'user.nama as nama_pemilik'
        )
        ->orderBy('pet.idpet', 'ASC')
        ->get();

         return view('admin.pet.index', compact('pet'));
     }
 
     // create- Tampilkan form tambah data
     public function create()
     {
        // pake ini kalo kita gamau nampilin jenis hewannya
        $ras = DB::table('ras_hewan')
            ->join('jenis_hewan', 'ras_hewan.idjenis_hewan', '=', 'jenis_hewan.idjenis_hewan')
            ->select('ras_hewan.*', 'jenis_hewan.nama_jenis_hewan')        
            ->get();

        $pemilik = DB::table('pemilik')
            ->join('user', 'pemilik.iduser', '=', 'user.iduser')
            ->select(
                'pemilik.idpemilik',
                'pemilik.no_wa',
                'user.nama as nama_pemilik')
            ->get();
        

         return view('admin.pet.create', compact('ras', 'pemilik'));
     }
     
     // store- Simpan data baru
     public function store(Request $request)
     {
        // validasi input 
        $validatedData = $this->validatePet($request);
        
        //helper untuk menyimpan data
        $pet = $this->createPet($validatedData);
 
         return redirect()->route('admin.pet.index')
                ->with('success', 'Data pet berhasil ditambahkan.');
     }

     // validation -> untuk memvalidasi data-data yg kita inputkan 
     protected function validatePet(Request $request, $id = null)
    {
        // Data yang bersifat unik (nama pet per pemilik)
        $uniqueRule = $id ?
            'unique:pet,nama,' . $id . ',idpet,idpemilik,' . $request->idpemilik :
            'unique:pet,nama,NULL,idpet,idpemilik,' . $request->idpemilik;

        // Validasi data input
        return $request->validate([
            'nama'           => ['required', 'string', 'max:100', $uniqueRule],
            'tanggal_lahir'  => ['required', 'date', 'before_or_equal:today'],
            'warna_tanda'    => ['required', 'string', 'max:45'],
            'jenis_kelamin'  => ['required', 'in:J,B'], // J = Jantan, B = Betina
            'idpemilik'      => ['required', 'exists:pemilik,idpemilik'],
            'idras_hewan'    => ['required', 'exists:ras_hewan,idras_hewan'],
        ], [
            'nama.required'          => 'Nama pet wajib diisi.',
            'nama.unique'            => 'Nama pet ini sudah terdaftar untuk pemilik yang sama.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'tanggal_lahir.date'     => 'Format tanggal tidak valid.',
            'tanggal_lahir.before_or_equal' => 'Tanggal lahir tidak boleh di masa depan.',
            'warna_tanda.required'   => 'Warna/tanda khusus wajib diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'jenis_kelamin.in'       => 'Jenis kelamin hanya boleh Jantan (J) atau Betina (B).',
            'idpemilik.required'     => 'Pemilik wajib dipilih.',
            'idpemilik.exists'       => 'Pemilik tidak ditemukan.',
            'idras_hewan.required'   => 'Ras hewan wajib dipilih.',
            'idras_hewan.exists'     => 'Ras hewan tidak ditemukan.',
        ]);
    }

    // helper - create data, simpan ke database 
    protected function createPet(array $data)
    {
        // get last ID
        $lastId =  DB::table('pet')->orderBy('idpet', 'desc')->first();
        $newId = $lastId ? $lastId->idpet + 1 : 1;

        DB::table('pet')->insert([
            'idpet'         => $newId,
            'nama'          => $this->formatNamaPet($data['nama']),
            'tanggal_lahir' => $data['tanggal_lahir'],
            'warna_tanda'   => $this->formatNamaPet($data['warna_tanda']),
            'jenis_kelamin' => $data['jenis_kelamin'],
            'idpemilik'     => $data['idpemilik'],
            'idras_hewan'   => $data['idras_hewan'],        
        ]);

        return $newId;
    }

    // Helper untuk format nama menjadi Title Case (merubah format hurufnya)
    protected function formatNamaPet($nama)
    {
        return trim(ucwords(strtolower($nama)));
    }

     // Tampilkan form edit/update data
     public function edit($id)
     {
         $pet = DB::table('pet')->where('idpet', $id)->first();
     
         $ras = DB::table('ras_hewan')
             ->join('jenis_hewan', 'ras_hewan.idjenis_hewan', '=', 'jenis_hewan.idjenis_hewan')
             ->select('ras_hewan.*', 'jenis_hewan.nama_jenis_hewan')
             ->get();
     
         $pemilik = DB::table('pemilik')
             ->join('user', 'pemilik.iduser', '=', 'user.iduser')
             ->select(
                 'pemilik.idpemilik',
                 'pemilik.no_wa',
                 'user.nama as nama_pemilik'
             )
             ->get();
     
         return view('admin.pet.edit', compact('pet', 'ras', 'pemilik'));
     }
     
 
     // Update data
     public function update(Request $request, $id)
     {
        $validated = $this->validatePet($request, $id);

        DB::table('pet')->where('idpet', $id)->update([
            'nama'           => $this->formatNamaPet($validated['nama']),
            'tanggal_lahir'  => $validated['tanggal_lahir'],
            'warna_tanda'    => $this->formatNamaPet($validated['warna_tanda']),
            'jenis_kelamin'  => $validated['jenis_kelamin'],
            'idpemilik'      => $validated['idpemilik'],
            'idras_hewan'    => $validated['idras_hewan'],
         ]);
 
         return redirect()->route('admin.pet.index')->with('success', 'Data hewan berhasil diperbarui!');
     }
 
     // Hapus data
    public function destroy($id)
    {
        try {
            $pet = DB::table('pet')->where('idpet', $id)->first();

            if (!$pet) {
                return redirect()->route('admin.pet.index')
                    ->with('error', 'Data pet tidak ditemukan.');
            }

            // CEK FK (contoh: rekam medis)
            $dipakai = DB::table('temu_dokter')
                ->where('idpet', $id)
                ->count();

            if ($dipakai > 0) {
                return redirect()->route('admin.pet.index')
                    ->with(
                        'error',
                        "Pet <b>{$pet->nama}</b> tidak dapat dihapus karena masih digunakan pada {$dipakai} data rekam medis."
                    );
            }

            DB::table('pet')->where('idpet', $id)->delete();

            return redirect()->route('admin.pet.index')
                ->with('success', "Pet <b>{$pet->nama}</b> berhasil dihapus.");

        } catch (QueryException $e) {
            return redirect()->route('admin.pet.index')
                ->with('error', 'Pet tidak dapat dihapus karena masih terhubung dengan data lain.');
        }
    }


     // ajax buat nampilin idjenis hewan soalnya kan di tabel pemilik tidak ada kolom untuk jenis hewan
    //  public function getRasByJenis($id)
    // {
    // $ras = DB::table('ras_hewan')
    //     ->where('idjenis_hewan', $id)
    //     ->get();

    // return response()->json($ras);
    // }

}
