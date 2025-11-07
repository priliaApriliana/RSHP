<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemilik;
use App\Models\User;

class PemilikController extends Controller
{
    // Tampilkan data
    public function index()
    {
        $pemilik = Pemilik::with('user')->get();
        return view('admin.pemilik.index', compact('pemilik'));
    }

    // Form tambah data
    public function create()
    {
        $users = User::all();
        return view('admin.pemilik.create', compact('users'));
    }

    // Simpan data baru
    public function store(Request $request)
    {
        // validasi input
        $validatedData = $this->validatePemilik($request);

        // helper untuk menyimpan data
        $pemilik = $this->createPemilik($validatedData);

        return redirect()->route('admin.pemilik.index')
                        ->with('success', 'Data pemilik berhasil ditambahkan.');
    }

    // validation -> untuk memvalidasi data-data yg kita inputkan 
    protected function validatePemilik(Request $request, $id = null)
    {
        // data yg bersifat unik
        $uniqueRule = $id ?
            'unique:pemilik,no_wa' . $id . ',idpemilik' :
            'unique:pemilik,no_wa';

        //validasi data input
        return $request->validate([
            'no_wa'   => ['required', 'string', 'max:20', $uniqueRule],
            'alamat'  => ['required', 'string', 'max:255'],
            'iduser'  => ['required', 'exists:user,iduser'],
        ], [
            'no_wa.required'  => 'Nomor WhatsApp wajib diisi.',
            'no_wa.unique'    => 'Nomor WhatsApp ini sudah terdaftar.',
            'alamat.required' => 'Alamat wajib diisi.',
            'iduser.required' => 'User wajib dipilih.',
            'iduser.exists'   => 'User tidak ditemukan di tabel user.',
        ]);  
    }

    // helper untuk membuat data baru (mengeksekusi data kedatabase)
    protected function createPemilik(array $data)
    {
        try {

            // get last ID
            $lastPemilik = Pemilik::orderBy('idpemilik', 'desc')->first();
            $newId = $lastPemilik ? $lastPemilik->idpemilik + 1 : 1;

            return Pemilik::create([
                'idpemilik' => $newId,
                'no_wa'  => $this->formatNoWa($data['no_wa']),
                'alamat' => trim(ucwords(strtolower($data['alamat']))),
                'iduser' => $data['iduser'],
            ]);
        } catch (\Exception $e) {
            throw new \Exception('Gagal menyimpan data Pemilik: ' . $e->getMessage());
        }
    }

    // format helper 
    protected function formatNoWa($noWa)
    {
        // Format no WA jadi standar: 08xxx atau +62xxx
        $noWa = preg_replace('/[^0-9]/', '', $noWa);
        if (str_starts_with($noWa, '62')) {
            return '+' . $noWa;
        } elseif (str_starts_with($noWa, '0')) {
            return '+62' . substr($noWa, 1);
        }
        return $noWa;
    }


    
    // Form edit
    public function edit($id)
    {
        $data = Pemilik::findOrFail($id);
        $users = User::all();
        return view('admin.pemilik.edit', compact('data', 'users'));
    }

    // Update data
    public function update(Request $request, $id)
    {
        $data = Pemilik::findOrFail($id);
        $data->update($request->all());
        return redirect()->route('admin.pemilik.index')->with('success', 'Data pemilik berhasil diperbarui!');
    }

    // Hapus data
    public function destroy($id)
    {
        Pemilik::findOrFail($id)->delete();
        return redirect()->route('admin.pemilik.index')->with('success', 'Data pemilik berhasil dihapus!');
    }
}
