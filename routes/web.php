<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\SiteController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\RoleUserController;
use App\Http\Controllers\Resepsionis\{
    DashboardResepsionisController, TemuDokterController, PetController as ResepsionisPetController, 
    PemilikController as ResepsionisPemilikController
};
use App\Http\Controllers\Admin\{
    PetController as AdminPetController, RoleController, PemilikController as AdminPemilikController,
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
Route::middleware('isAdministrator')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardAdminController::class, 'index'])->name('dashboard');
    
    // jenis hewan
    Route::get('/jenishewan', [App\Http\Controllers\Admin\JenisHewanController::class, 'index'])->name('jenishewan.index');
    Route::get('/jenishewan/create', [App\Http\Controllers\Admin\JenisHewanController::class, 'create'])->name('jenishewan.create');
    Route::post('/jenishewan/store', [App\Http\Controllers\Admin\JenisHewanController::class, 'store'])->name('jenishewan.store');
    Route::get('/jenishewan/{id}/edit', [App\Http\Controllers\Admin\JenisHewanController::class, 'edit'])->name('jenishewan.edit');
    Route::put('/jenishewan/{id}', [App\Http\Controllers\Admin\JenisHewanController::class, 'update'])->name('jenishewan.update');    
    Route::delete('/jenishewan/{id}', [App\Http\Controllers\Admin\JenisHewanController::class, 'destroy'])->name('jenishewan.destroy');

    // pemilik
    Route::resource('pemilik', AdminPemilikController::class);
    Route::resource('rashewan', RasHewanController::class);
    Route::resource('kategori', KategoriController::class);
    Route::resource('kategoriklinis', KategoriKlinisController::class);
    Route::resource('kodetindakanterapi', KodeTindakanTerapiController::class);
    
    // pet
    Route::resource('pet', AdminPetController::class);


    // role 
    Route::get('/role', [RoleController::class, 'index'])->name('role.index');
    Route::get('/role/create', [RoleController::class, 'create'])->name('role.create');
    Route::post('/role', [RoleController::class, 'store'])->name('role.store');
    Route::get('/role/{id}/edit', [RoleController::class, 'edit'])->name('role.edit');
    Route::put('/role/{id}', [RoleController::class, 'update'])->name('role.update');
    Route::delete('/role/{id}', [RoleController::class, 'destroy'])->name('role.destroy');


    // role_user
    Route::get('/roleuser', [RoleUserController::class, 'index'])->name('roleuser.index');
    Route::get('/roleuser/create', [RoleUserController::class, 'create'])->name('roleuser.create');
    Route::post('/roleuser/store', [RoleUserController::class, 'store'])->name('roleuser.store');
    Route::get('/roleuser/{id}/edit', [RoleUserController::class, 'edit'])->name('roleuser.edit');
    Route::put('/roleuser/{id}', [RoleUserController::class, 'update'])->name('roleuser.update');
    Route::delete('/roleuser/{id}', [RoleUserController::class, 'destroy'])->name('roleuser.destroy');

    
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