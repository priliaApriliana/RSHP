<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// SITE + AUTH
use App\Http\Controllers\Site\SiteController;
use App\Http\Controllers\Auth\LoginController;

// ADMIN
use App\Http\Controllers\Admin\{
    DashboardAdminController,
    PetController as AdminPetController,
    PemilikController as AdminPemilikController,
    RoleUserController, RoleController,
    KategoriController, RasHewanController, JenisHewanController,
    KategoriKlinisController, KodeTindakanTerapiController,
    PerawatController, DokterController
};

// RESEPSIONIS
use App\Http\Controllers\Resepsionis\{
    DashboardResepsionisController,
    TemuDokterController,
    PetController as ResepsionisPetController,
    PemilikController as ResepsionisPemilikController
};

// PERAWAT
use App\Http\Controllers\Perawat\{
    DashboardPerawatController,
    RekamMedisController as PerawatRekamMedisController,
    KodeTindakanTerapiController as PerawatTindakanController
};


// DOKTER
use App\Http\Controllers\Dokter\{
    DashboardDokterController,
    RekamMedisController as DokterRekamMedisController
};

// PEMILIK
use App\Http\Controllers\Pemilik\DashboardPemilikController;


/*
|--------------------------------------------------------------------------
| WEBSITE UMUM
|--------------------------------------------------------------------------
*/

Route::get('/', [SiteController::class, 'home'])->name('site.home');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');

Auth::routes();

Route::get('/home', [SiteController::class, 'home'])->name('home');
Route::get('/layanan', [SiteController::class, 'layanan'])->name('layanan');
Route::get('/struktur', [SiteController::class, 'struktur'])->name('struktur');
Route::get('/kontak', [SiteController::class, 'kontak'])->name('kontak');
Route::get('/cek-koneksi', [SiteController::class, 'cekKoneksi'])->name('site.cek-koneksi');



/*
|--------------------------------------------------------------------------
| ADMINISTRATOR
|--------------------------------------------------------------------------
*/

Route::middleware('isAdministrator')->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [DashboardAdminController::class, 'index'])->name('dashboard');

    // MASTER DATA
    Route::resource('jenishewan', JenisHewanController::class);
    Route::resource('pemilik', AdminPemilikController::class);
    Route::resource('rashewan', RasHewanController::class);
    Route::resource('kategori', KategoriController::class);
    Route::resource('kategoriklinis', KategoriKlinisController::class);
    Route::resource('kodetindakanterapi', KodeTindakanTerapiController::class);
    Route::resource('pet', AdminPetController::class);

    // ROLE
    Route::resource('role', RoleController::class);
    Route::resource('roleuser', RoleUserController::class);

    // DATA PEGAWAI
    Route::resource('dokter', DokterController::class);
    Route::resource('perawat', PerawatController::class);
});



/*
|--------------------------------------------------------------------------
| RESEPSIONIS
|--------------------------------------------------------------------------
*/

Route::middleware('isResepsionis')->prefix('resepsionis')->group(function () {

    Route::get('/dashboard', [DashboardResepsionisController::class, 'index'])
        ->name('resepsionis.dashboard');

    // Redirect agar klik open langsung ke form
    Route::redirect('/pet', '/resepsionis/pet/create');
    Route::redirect('/temudokter', '/resepsionis/temudokter/create');
    Route::redirect('/pemilik', '/resepsionis/pemilik/create');

    // Registrasi Pemilik
    Route::get('/pemilik/create', [ResepsionisPemilikController::class, 'create'])
        ->name('resepsionis.pemilik.create');
    Route::post('/pemilik/store', [ResepsionisPemilikController::class, 'store'])
        ->name('resepsionis.pemilik.store');

    // Registrasi Pet
    Route::get('/pet/create', [ResepsionisPetController::class, 'create'])
        ->name('resepsionis.pet.create');
    Route::post('/pet/store', [ResepsionisPetController::class, 'store'])
        ->name('resepsionis.pet.store');

    // Form Temu Dokter
    Route::get('/temudokter/create', [TemuDokterController::class, 'create'])
        ->name('resepsionis.temudokter.create');
    Route::post('/temudokter/store', [TemuDokterController::class, 'store'])
        ->name('resepsionis.temudokter.store');
});

    
/*
|--------------------------------------------------------------------------
| PERAWAT
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'isPerawat'])
    ->prefix('perawat')
    ->name('perawat.')
    ->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardPerawatController::class, 'index'])
        ->name('dashboard');

    // Rekam Medis
    Route::get('/rekammedis', [PerawatRekamMedisController::class, 'index'])
        ->name('rekammedis.index');

    Route::get('/rekammedis/create', [PerawatRekamMedisController::class, 'create'])
        ->name('rekammedis.create');

    Route::post('/rekammedis/store', [PerawatRekamMedisController::class, 'store'])
        ->name('rekammedis.store');

    Route::get('/rekammedis/{id}', [PerawatRekamMedisController::class, 'show'])
        ->name('rekammedis.show');

    // TINDAKAN TERAPI (PERAWAT)
    Route::get('/tindakan', [PerawatTindakanController::class, 'index'])
        ->name('tindakan.index');

    Route::get('/tindakan/create', [PerawatTindakanController::class, 'create'])
        ->name('tindakan.create');

    Route::post('/tindakan/store', [PerawatTindakanController::class, 'store'])
        ->name('tindakan.store');

    Route::get('/tindakan/{id}/edit', [PerawatTindakanController::class, 'edit'])
        ->name('tindakan.edit');
    
    Route::delete('/tindakan/{id}', [PerawatTindakanController::class, 'destroy'])
        ->name('tindakan.destroy');
    
});







/*
|--------------------------------------------------------------------------
| DOKTER
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'isDokter'])->prefix('dokter')->name('dokter.')->group(function () {

    Route::get('/dashboard', [DashboardDokterController::class, 'index'])
        ->name('dashboard');

    Route::get('/rekammedis', [DokterRekamMedisController::class, 'index'])
        ->name('rekammedis.index');

    Route::get('/rekammedis/create', [DokterRekamMedisController::class, 'create'])
        ->name('rekammedis.create');

    Route::post('/rekammedis/store', [DokterRekamMedisController::class, 'store'])
        ->name('rekammedis.store');
});



/*
|--------------------------------------------------------------------------
| PEMILIK
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'isPemilik'])->prefix('pemilik')->name('pemilik.')->group(function () {

    Route::get('/dashboard', [DashboardPemilikController::class, 'index'])->name('dashboard');
    Route::get('/pet', [DashboardPemilikController::class, 'pet'])->name('pet');
    Route::get('/riwayat', [DashboardPemilikController::class, 'riwayat'])->name('riwayat');
});
