<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Pemilik;
use App\Models\User;
use Illuminate\Database\QueryException;

class PemilikController extends Controller
{
    // Tampilkan data
    public function index()
    {
        $pemilik = DB::table('pemilik')
            ->join('user', 'pemilik.iduser', '=', 'user.iduser')
            ->select(
                'pemilik.*',
                'user.nama as user_nama',
                'user.email as user_email'
            )
            ->orderBy('idpemilik', 'ASC')
            ->get();

        return view('Admin.Pemilik.index', compact('pemilik'));
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
            // get last ID, lalu +1
            $lastId = DB::table('pemilik')->orderBy('idpemilik', 'desc')->first();
            if ($lastId) {
                $newId = $lastId->idpemilik +1;
            } else {
                $newId = 1;
            }

            DB::table('pemilik')->insert([
                'idpemilik' => $newId,
                'no_wa'  => $this->formatNoWa($data['no_wa']),
                'alamat' => trim(ucwords(strtolower($data['alamat']))),
                'iduser' => $data['iduser'],
            ]);
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
        // ambil data pemilik
        $pemilik = DB::table('pemilik')
            ->where('idpemilik', $id)
            ->first();
    
        // jika tidak ada → tampilkan 404
        if (!$pemilik) {
            abort(404, 'Data Pemilik tidak ditemukan');
        }
    
        // ambil semua user
        $users = DB::table('user')->get();
    
        // kirim ke view
        return view('admin.pemilik.edit', compact('pemilik', 'users'));
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
        try {
            $pemilik = DB::table('pemilik')
                ->where('idpemilik', $id)
                ->first();

            if (!$pemilik) {
                return redirect()->route('admin.pemilik.index')
                    ->with('error', 'Data pemilik tidak ditemukan.');
            }

            // CEK apakah punya pet
            $punyaPet = DB::table('pet')
                ->where('idpemilik', $id)
                ->count();

            if ($punyaPet > 0) {
                return redirect()->route('admin.pemilik.index')
                    ->with(
                        'error',
                        "Pemilik tidak dapat dihapus karena masih memiliki {$punyaPet} data pet."
                    );
            }

            DB::table('pemilik')->where('idpemilik', $id)->delete();

            return redirect()->route('admin.pemilik.index')
                ->with('success', 'Data pemilik berhasil dihapus.');

        } catch (QueryException $e) {
            return redirect()->route('admin.pemilik.index')
                ->with('error', 'Pemilik tidak dapat dihapus karena masih terhubung dengan data lain.');
        }
    }


}