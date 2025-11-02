<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\SiteController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Resepsionis\{
    DashboardResepsionisController, TemuDokterController, PetController as ResepsionisPetController, 
    PemilikController as ResepsionisPemilikController
};
use App\Http\Controllers\Admin\{
    PetController as AdminPetController, RoleController, UserController, PemilikController as AdminPemilikController,
    KategoriController, RasHewanController, JenisHewanController,
    KategoriKlinisController, KodeTindakanTerapiController,
    DashboardAdminController
};
use App\Http\Controllers\Perawat\{
    DashboardPerawatController,
    RekamMedisController as PerawatRekamMedisController,
};

use App\Http\Controllers\Dokter\{
    DashboardDokterController, RekamMedisController as DokterRekamMedisController,
};

use App\Http\Controllers\Pemilik\DashboardPemilikController;

// Halaman depan
Route::get('/', [SiteController::class, 'index'])->name('site.');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');

// Authentication Routes
Auth::routes();


// SiteController
Route::get('/home', [SiteController::class, 'home'])->name('home');
Route::get('/layanan', [SiteController::class, 'layanan'])->name('layanan');
Route::get('/struktur', [SiteController::class, 'struktur'])->name('struktur');
Route::get('/kontak', [SiteController::class, 'kontak'])->name('kontak');
Route::get('/cek-koneksi', [SiteController::class, 'cekKoneksi'])->name('site.cek-koneksi');

// Admin Routes (hanya bisa diakses jika Administrator)
Route::middleware('isAdministrator')->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardAdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('jenishewan', JenisHewanController::class);
    Route::resource('pemilik', AdminPemilikController::class);
    Route::resource('rashewan', RasHewanController::class);
    Route::resource('kategori', KategoriController::class);
    Route::resource('kategoriklinis', KategoriKlinisController::class);
    Route::resource('kodetindakanterapi', KodeTindakanTerapiController::class);
    Route::resource('pet', AdminPetController::class);
    Route::resource('role', RoleController::class);
    Route::resource('user', UserController::class);
});

// Resepsionis Routes
Route::middleware('isResepsionis')->prefix('resepsionis')->group(function () {
    Route::get('/dashboard', [DashboardResepsionisController::class, 'index'])->name('resepsionis.dashboard');
    
    //redirect agar klik menu langsung buka from
    Route::get('/pet', function () {return redirect()->route('resepsionis.pet.create');})->name('resepsionis.pet.index');
    Route::get('/temudokter', function () {return redirect()->route('resepsionis.temudokter.create');})->name('resepsionis.temudokter.index');
    Route::get('/pemilik', function () {return redirect()->route('resepsionis.pemilik.create');})->name('resepsionis.pemilik.index');
    
    //form temu dokter
    Route::get('/temudokter/create', [TemuDokterController::class, 'create'])->name('resepsionis.temudokter.create');
    Route::post('/temudokter/store', [TemuDokterController::class, 'store'])->name('resepsionis.temudokter.store');
    
    //form pet
    Route::get('/pet/create', [ResepsionisPetController::class, 'create'])->name('resepsionis.pet.create');
    Route::post('/pet/store', [ResepsionisPetController::class, 'store'])->name('resepsionis.pet.store');

    //form pemilik
    Route::get('/pemilik/create', [ResepsionispemilikController::class, 'create'])->name('resepsionis.pemilik.create');
    Route::post('/pemilik/store', [ResepsionisPemilikController::class, 'store'])->name('resepsionis.pemilik.store');
});

// Perawat Routes. auth digunakna untuk apakah user sdh login ,kmudian cek apakh user tsb memiliki role perawat
Route::middleware(['auth', 'isPerawat'])->prefix('perawat')->group(function () {
    //dashboard
    Route::get('/dashboard', [DashboardPerawatController::class, 'index'])->name('perawat.dashboard');

    //daftar rekam medis
    Route::get('/rekammedis', [PerawatRekamMedisController::class, 'index'])->name('perawat.rekammedis.index');

    //form tambah rekam medis
    Route::get('/rekammedis/create', [PerawatRekamMedisController::class, 'create'])->name('perawat.rekammedis.create');
    Route::post('/rekammedis/store', [PerawatRekamMedisController::class, 'store'])->name('perawat.rekammedis.store');
    Route::get('/rekammedis/{id}', [PerawatRekamMedisController::class, 'show'])->name('perawat.rekammedis.show');
    Route::get('/rekammedis/{id}/edit', [PerawatRekamMedisController::class, 'edit'])->name('perawat.rekammedis.edit');

    // Routes lainnya (buat nanti)
    Route::get('/jadwal', function() {
        return view('perawat.jadwal');
    })->name('jadwal');
    
    Route::get('/pasien', function() {
        return view('perawat.pasien');
    })->name('pasien');
    
    Route::get('/profil', function() {
        return view('perawat.profil');
    })->name('profil');
});

// Dokter Routes
Route::middleware(['auth', 'isDokter'])->prefix('dokter')->group(function () {
    Route::get('/dashboard', [DashboardDokterController::class, 'index'])
        ->name('dokter.dashboard');

    Route::get('/rekammedis', [DokterRekamMedisController::class, 'index'])
        ->name('dokter.rekammedis.index');

    Route::get('/rekammedis/create', [DokterRekamMedisController::class, 'create'])
        ->name('dokter.rekammedis.create');

    Route::post('/rekammedis/store', [DokterRekamMedisController::class, 'store'])
        ->name('dokter.rekammedis.store');
});

// Route untuk Pemilik
Route::middleware(['auth', 'isPemilik'])->prefix('pemilik')->name('pemilik.')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardPemilikController::class, 'index'])->name('dashboard');
    
    // Pet
    Route::get('/pet', [DashboardPemilikController::class, 'pet'])->name('pet');
    
    // Riwayat
    Route::get('/riwayat', [DashboardPemilikController::class, 'riwayat'])->name('riwayat');
});