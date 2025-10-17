<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
}
