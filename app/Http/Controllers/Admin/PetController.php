<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\RasHewan;
use App\Models\Pemilik;

class PetController extends Controller
{
     // index- Tampilkan semua data Pet
     public function index()
     {
         $pet = Pet::with(['jenisHewan', 'pemilik'])->get();
         return view('admin.pet.index', compact('pet'));
     }
 
     // create- Tampilkan form tambah data
     public function create()
     {
         $ras = RasHewan::all();
         $pemilik = Pemilik::all();
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

    // helper - simpan ke database 
    protected function createPet(array $data)
    {
        try {
            // get last ID
            $lastPet = Pet::orderBy('idpet', 'desc')->first();
            $newId = $lastPet ? $lastPet->idpet + 1 : 1;

            return Pet::create([
                'idpet'          => $newId,
                'nama'           => $this->formatNamaPet($data['nama']),
                'tanggal_lahir'  => $data['tanggal_lahir'] ?? null,
                'warna_tanda'    => $this->formatNamaPet($data['warna_tanda'] ?? ''),
                'jenis_kelamin'  => $data['jenis_kelamin'],
                'idpemilik'      => $data['idpemilik'],
                'idras_hewan'    => $data['idras_hewan'],
            ]);
        } catch (\Exception $e) {
            throw new \Exception('Gagal menyimpan data Pet: ' . $e->getMessage());
        }
    }

    // Helper untuk format nama menjadi Title Case (merubah format hurufnya)
    protected function formatNamaPet($nama)
    {
        return trim(ucwords(strtolower($nama)));
    }
 



     // Tampilkan form edit data
     public function edit($id)
     {
         $pet = Pet::findOrFail($id);
         $jenis = RasHewan::all();
         $pemilik = Pemilik::all();
         return view('admin.pet.edit', compact('pet', 'jenis', 'pemilik'));
     }
 
     // Update data
     public function update(Request $request, $id)
     {
         $request->validate([
             'nama_pet' => 'required',
             'idjenishewan' => 'required',
             'umur' => 'required|numeric',
             'jenis_kelamin' => 'required',
             'berat' => 'required|numeric',
             'idpemilik' => 'required'
         ]);
 
         $pet = Pet::findOrFail($id);
         $pet->update($request->all());
 
         return redirect()->route('pet.index')->with('success', 'Data hewan berhasil diperbarui!');
     }
 
     // Hapus data
     public function destroy($id)
     {
         Pet::findOrFail($id)->delete();
         return redirect()->route('pet.index')->with('success', 'Data hewan berhasil dihapus!');
     }
}
