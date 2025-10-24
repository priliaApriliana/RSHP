<?php

namespace App\Http\Controllers\Site;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SiteController extends Controller
{
    public function home() {
        return view('site.home');
    }

    public function struktur() {
        return view('site.struktur');
    }

    public function layanan() {
        return view('site.layanan');
    }
    
    public function visi() {
        return view('site.visi');
    }

    public function kontak() {
        return view('site.kontak');
    }

    public function login() {
        return view('site.login');
    }

    public function cekKoneksi()
    {
        try {
            DB::connection()->getPdo();
            return 'Koneksi ke database berhasil!';
        } catch (\Exception $e) {
            return 'koneksi ke datasabe gagal:' . $e->getMessage();
        }
    }
}
