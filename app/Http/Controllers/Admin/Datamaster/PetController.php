<?php

namespace App\Http\Controllers\Admin\Datamaster;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\JenisHewan;
use App\Models\Pemilik;

class PetController extends Controller
{
     // Tampilkan semua data Pet
     public function index()
     {
         $pet = Pet::with(['jenisHewan', 'pemilik'])->get();
         return view('admin.datamaster.pet.index', compact('pet'));
     }
 
     // Tampilkan form tambah data
     public function create()
     {
         $jenis = JenisHewan::all();
         $pemilik = Pemilik::all();
         return view('admin.datamaster.pet.create', compact('jenis', 'pemilik'));
     }
 
     // Simpan data baru
     public function store(Request $request)
     {
         $request->validate([
             'nama_pet' => 'required',
             'idjenishewan' => 'required',
             'umur' => 'required|numeric',
             'jenis_kelamin' => 'required',
             'berat' => 'required|numeric',
             'idpemilik' => 'required'
         ]);
 
         Pet::create($request->all());
         return redirect()->route('pet.index')->with('success', 'Data hewan berhasil ditambahkan!');
     }
 
     // Tampilkan form edit data
     public function edit($id)
     {
         $pet = Pet::findOrFail($id);
         $jenis = JenisHewan::all();
         $pemilik = Pemilik::all();
         return view('admin.datamaster.pet.edit', compact('pet', 'jenis', 'pemilik'));
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
