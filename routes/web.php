<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// SITE + AUTH
use App\Http\Controllers\Site\SiteController;
use App\Http\Controllers\Auth\LoginController;

// ADMIN
use App\Http\Controllers\Admin\{
    AdminProfilController,
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
    ProfilResepsionisController,
    TemuDokterController,
    PetController as ResepsionisPetController,
    PemilikController as ResepsionisPemilikController
};

// PERAWAT 
use App\Http\Controllers\Perawat\{
    PerawatDashboardController,
    PerawatPasienController,
    PerawatRekamMedisController,
    PerawatProfilController
};


// DOKTER
use App\Http\Controllers\Dokter\{
    DashboardDokterController,
    RekamMedisController as DokterRekamMedisController,
    DetailRekamMedisController,
    ProfilDokterController
};

// PEMILIK
use App\Http\Controllers\Pemilik\DashboardPemilikController;
use App\Models\Perawat;

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

    // ========================================
    // MASTER DATA - JENIS HEWAN
    // ========================================
    Route::prefix('jenishewan')->name('jenishewan.')->group(function () {
        Route::get('/', [JenisHewanController::class, 'index'])->name('index');
        Route::get('/create', [JenisHewanController::class, 'create'])->name('create');
        Route::post('/', [JenisHewanController::class, 'store'])->name('store');
        Route::get('/{jenishewan}', [JenisHewanController::class, 'show'])->name('show');
        Route::get('/{jenishewan}/edit', [JenisHewanController::class, 'edit'])->name('edit');
        Route::put('/{jenishewan}', [JenisHewanController::class, 'update'])->name('update');
        Route::delete('/{jenishewan}', [JenisHewanController::class, 'destroy'])->name('destroy');
    });

    // ========================================
    // MASTER DATA - PEMILIK
    // ========================================
    Route::prefix('pemilik')->name('pemilik.')->group(function () {
        Route::get('/', [AdminPemilikController::class, 'index'])->name('index');
        Route::get('/create', [AdminPemilikController::class, 'create'])->name('create');
        Route::post('/', [AdminPemilikController::class, 'store'])->name('store');
        Route::get('/{pemilik}', [AdminPemilikController::class, 'show'])->name('show');
        Route::get('/{pemilik}/edit', [AdminPemilikController::class, 'edit'])->name('edit');
        Route::put('/{pemilik}', [AdminPemilikController::class, 'update'])->name('update');
        Route::delete('/{pemilik}', [AdminPemilikController::class, 'destroy'])->name('destroy');
    });

    // ========================================
    // MASTER DATA - RAS HEWAN
    // ========================================
    Route::prefix('rashewan')->name('rashewan.')->group(function () {
        Route::get('/', [RasHewanController::class, 'index'])->name('index');
        Route::get('/create', [RasHewanController::class, 'create'])->name('create');
        Route::post('/', [RasHewanController::class, 'store'])->name('store');
        Route::get('/{rashewan}', [RasHewanController::class, 'show'])->name('show');
        Route::get('/{rashewan}/edit', [RasHewanController::class, 'edit'])->name('edit');
        Route::put('/{rashewan}', [RasHewanController::class, 'update'])->name('update');
        Route::delete('/{rashewan}', [RasHewanController::class, 'destroy'])->name('destroy');
    });

    // ========================================
    // MASTER DATA - KATEGORI
    // ========================================
    Route::prefix('kategori')->name('kategori.')->group(function () {
        Route::get('/', [KategoriController::class, 'index'])->name('index');
        Route::get('/create', [KategoriController::class, 'create'])->name('create');
        Route::post('/', [KategoriController::class, 'store'])->name('store');
        Route::get('/{kategori}', [KategoriController::class, 'show'])->name('show');
        Route::get('/{kategori}/edit', [KategoriController::class, 'edit'])->name('edit');
        Route::put('/{kategori}', [KategoriController::class, 'update'])->name('update');
        Route::delete('/{kategori}', [KategoriController::class, 'destroy'])->name('destroy');
    });

    // ========================================
    // MASTER DATA - KATEGORI KLINIS
    // ========================================
    Route::prefix('kategoriklinis')->name('kategoriklinis.')->group(function () {
        Route::get('/', [KategoriKlinisController::class, 'index'])->name('index');
        Route::get('/create', [KategoriKlinisController::class, 'create'])->name('create');
        Route::post('/', [KategoriKlinisController::class, 'store'])->name('store');
        Route::get('/{kategoriklinis}', [KategoriKlinisController::class, 'show'])->name('show');
        Route::get('/{kategoriklinis}/edit', [KategoriKlinisController::class, 'edit'])->name('edit');
        Route::put('/{kategoriklinis}', [KategoriKlinisController::class, 'update'])->name('update');
        Route::delete('/{kategoriklinis}', [KategoriKlinisController::class, 'destroy'])->name('destroy');
    });

    // ========================================
    // MASTER DATA - KODE TINDAKAN TERAPI
    // ========================================
    Route::prefix('kodetindakanterapi')->name('kodetindakanterapi.')->group(function () {
        Route::get('/', [KodeTindakanTerapiController::class, 'index'])->name('index');
        Route::get('/create', [KodeTindakanTerapiController::class, 'create'])->name('create');
        Route::post('/', [KodeTindakanTerapiController::class, 'store'])->name('store');
        Route::get('/{kodetindakanterapi}', [KodeTindakanTerapiController::class, 'show'])->name('show');
        Route::get('/{kodetindakanterapi}/edit', [KodeTindakanTerapiController::class, 'edit'])->name('edit');
        Route::put('/{kodetindakanterapi}', [KodeTindakanTerapiController::class, 'update'])->name('update');
        Route::delete('/{kodetindakanterapi}', [KodeTindakanTerapiController::class, 'destroy'])->name('destroy');
    });

    // ========================================
    // MASTER DATA - PET
    // ========================================
    Route::prefix('pet')->name('pet.')->group(function () {
        Route::get('/', [AdminPetController::class, 'index'])->name('index');
        Route::get('/create', [AdminPetController::class, 'create'])->name('create');
        Route::post('/', [AdminPetController::class, 'store'])->name('store');
        Route::get('/{pet}', [AdminPetController::class, 'show'])->name('show');
        Route::get('/{pet}/edit', [AdminPetController::class, 'edit'])->name('edit');
        Route::put('/{pet}', [AdminPetController::class, 'update'])->name('update');
        Route::delete('/{pet}', [AdminPetController::class, 'destroy'])->name('destroy');
    });

    // ========================================
    // ROLE
    // ========================================
    Route::prefix('role')->name('role.')->group(function () {
        Route::get('/', [RoleController::class, 'index'])->name('index');
        Route::get('/create', [RoleController::class, 'create'])->name('create');
        Route::post('/', [RoleController::class, 'store'])->name('store');
        Route::get('/{role}', [RoleController::class, 'show'])->name('show');
        Route::get('/{role}/edit', [RoleController::class, 'edit'])->name('edit');
        Route::put('/{role}', [RoleController::class, 'update'])->name('update');
        Route::delete('/{role}', [RoleController::class, 'destroy'])->name('destroy');
    });

    // ========================================
    // ROLE USER
    // ========================================
    Route::prefix('roleuser')->name('roleuser.')->group(function () {
        Route::get('/', [RoleUserController::class, 'index'])->name('index');
        Route::get('/create', [RoleUserController::class, 'create'])->name('create');
        Route::post('/', [RoleUserController::class, 'store'])->name('store');
        Route::get('/{roleuser}', [RoleUserController::class, 'show'])->name('show');
        Route::get('/{roleuser}/edit', [RoleUserController::class, 'edit'])->name('edit');
        Route::put('/{roleuser}', [RoleUserController::class, 'update'])->name('update');
        Route::delete('/{roleuser}', [RoleUserController::class, 'destroy'])->name('destroy');
    });

    // ========================================
    // DATA PEGAWAI - DOKTER
    // ========================================
    Route::prefix('dokter')->name('dokter.')->group(function () {
        Route::get('/', [DokterController::class, 'index'])->name('index');
        Route::get('/create', [DokterController::class, 'create'])->name('create');
        Route::post('/', [DokterController::class, 'store'])->name('store');
        Route::get('/{dokter}', [DokterController::class, 'show'])->name('show');
        Route::get('/{dokter}/edit', [DokterController::class, 'edit'])->name('edit');
        Route::put('/{dokter}', [DokterController::class, 'update'])->name('update');
        Route::delete('/{dokter}', [DokterController::class, 'destroy'])->name('destroy');
    });

    // ========================================
    // DATA PEGAWAI - PERAWAT
    // ========================================
    Route::prefix('perawat')->name('perawat.')->group(function () {
        Route::get('/', [PerawatController::class, 'index'])->name('index');
        Route::get('/create', [PerawatController::class, 'create'])->name('create');
        Route::post('/', [PerawatController::class, 'store'])->name('store');
        Route::get('/{perawat}', [PerawatController::class, 'show'])->name('show');
        Route::get('/{perawat}/edit', [PerawatController::class, 'edit'])->name('edit');
        Route::put('/{perawat}', [PerawatController::class, 'update'])->name('update');
        Route::delete('/{perawat}', [PerawatController::class, 'destroy'])->name('destroy');
    });

     // ========================================
    // DATA PEGAWAI - PERAWAT
    // ========================================
    Route::get('/profil', [AdminProfilController::class, 'index'])->name('profil');
    Route::put('/profil/update', [AdminProfilController::class, 'update'])->name('profil.update');
});



/*
|--------------------------------------------------------------------------
| RESEPSIONIS
|--------------------------------------------------------------------------
*/

Route::middleware('isResepsionis')->prefix('resepsionis')->group(function () {

    Route::get('/dashboard', [DashboardResepsionisController::class, 'index'])
        ->name('resepsionis.dashboard');

    // Profil Resepsionis
    Route::get('/profil', [ProfilResepsionisController::class, 'index'])
        ->name('resepsionis.profil');

    // ========================================
    // PEMILIK (CRUD)
    // ========================================
    Route::prefix('pemilik')->name('resepsionis.pemilik.')->group(function () {
        Route::get('/', [ResepsionisPemilikController::class, 'index'])->name('index');
        Route::get('/create', [ResepsionisPemilikController::class, 'create'])->name('create');
        Route::post('/', [ResepsionisPemilikController::class, 'store'])->name('store');
        Route::get('/{pemilik}', [ResepsionisPemilikController::class, 'show'])->name('show');
        Route::get('/{pemilik}/edit', [ResepsionisPemilikController::class, 'edit'])->name('edit');
        Route::put('/{pemilik}', [ResepsionisPemilikController::class, 'update'])->name('update');
        Route::delete('/{pemilik}', [ResepsionisPemilikController::class, 'destroy'])->name('destroy');
    });

    // ========================================
    // PET (CRUD)
    // ========================================
    Route::prefix('pet')->name('resepsionis.pet.')->group(function () {
        Route::get('/', [ResepsionisPetController::class, 'index'])->name('index');
        Route::get('/create', [ResepsionisPetController::class, 'create'])->name('create');
        Route::post('/', [ResepsionisPetController::class, 'store'])->name('store');
        Route::get('/{pet}', [ResepsionisPetController::class, 'show'])->name('show');
        Route::get('/{pet}/edit', [ResepsionisPetController::class, 'edit'])->name('edit');
        Route::put('/{pet}', [ResepsionisPetController::class, 'update'])->name('update');
        Route::delete('/{pet}', [ResepsionisPetController::class, 'destroy'])->name('destroy');
    });

    // ========================================
    // TEMU DOKTER (CRUD)
    // ========================================
    Route::prefix('temudokter')->name('resepsionis.temudokter.')->group(function () {
        Route::get('/', [TemuDokterController::class, 'index'])->name('index');
        Route::get('/create', [TemuDokterController::class, 'create'])->name('create');
        Route::post('/', [TemuDokterController::class, 'store'])->name('store');
        Route::get('/{temudokter}', [TemuDokterController::class, 'show'])->name('show');
        Route::get('/{temudokter}/edit', [TemuDokterController::class, 'edit'])->name('edit');
        Route::put('/{temudokter}', [TemuDokterController::class, 'update'])->name('update');
        Route::delete('/{temudokter}', [TemuDokterController::class, 'destroy'])->name('destroy');
    });
});

    
/*
|--------------------------------------------------------------------------
| PERAWAT ROUTES
|--------------------------------------------------------------------------
*/

Route::prefix('perawat')->middleware(['auth', 'isPerawat'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [PerawatDashboardController::class, 'index'])
        ->name('perawat.dashboard');

    // Data Pasien
    Route::get('/pasien', [PerawatPasienController::class, 'index'])
        ->name('perawat.pasien.index');
    
    Route::get('/pasien/{id}', [PerawatPasienController::class, 'show'])
        ->name('perawat.pasien.show');
        
    // Rekam Medis
    Route::get('/rekam-medis', [PerawatRekamMedisController::class, 'index'])
        ->name('perawat.rekammedis.index');

    Route::get('/rekam-medis/create', [PerawatRekamMedisController::class, 'create'])
        ->name('perawat.rekammedis.create');

    Route::post('/rekam-medis', [PerawatRekamMedisController::class, 'store'])
        ->name('perawat.rekammedis.store');

    Route::get('/rekam-medis/{id}', [PerawatRekamMedisController::class, 'show'])
        ->name('perawat.rekammedis.show');

    Route::get('/rekam-medis/{id}/edit', [PerawatRekamMedisController::class, 'edit'])
        ->name('perawat.rekammedis.edit');

    Route::post('/rekam-medis/{id}', [PerawatRekamMedisController::class, 'update'])
        ->name('perawat.rekammedis.update');

    Route::delete('/rekam-medis/{id}', [PerawatRekamMedisController::class, 'destroy'])
        ->name('perawat.rekammedis.destroy');

    // Profil Perawat
    Route::get('/profil', [PerawatProfilController::class, 'index'])
        ->name('perawat.profil');
    
    Route::put('/profil/update', [PerawatProfilController::class, 'update'])
        ->name('perawat.profil.update');
});

/*
|--------------------------------------------------------------------------
| DOKTER
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'isDokter'])->prefix('dokter')->name('dokter.')->group(function () {

    Route::get('/dashboard', [DashboardDokterController::class, 'index'])
        ->name('dashboard');

    // REKAM MEDIS ROUTES
    Route::get('/rekammedis', [DokterRekamMedisController::class, 'index'])
        ->name('rekammedis.index');

    Route::get('/rekammedis/create', [DokterRekamMedisController::class, 'create'])
        ->name('rekammedis.create');

    Route::post('/rekammedis/store', [DokterRekamMedisController::class, 'store'])
        ->name('rekammedis.store');

    Route::get('/rekammedis/{id}', [DokterRekamMedisController::class, 'show'])
        ->name('rekammedis.show');

    // DETAIL REKAM MEDIS ROUTES
    Route::get('/rekammedis/{idrekam_medis}/detail/create', [DetailRekamMedisController::class, 'create'])
        ->name('detail_rekammedis.create');

    Route::post('/rekammedis/{idrekam_medis}/detail/store', [DetailRekamMedisController::class, 'store'])
        ->name('detail_rekammedis.store');

    Route::get('/rekammedis/{idrekam_medis}/detail/{iddetail}/edit', [DetailRekamMedisController::class, 'edit'])
        ->name('detail_rekammedis.edit');

    Route::put('/rekammedis/{idrekam_medis}/detail/{iddetail}', [DetailRekamMedisController::class, 'update'])
        ->name('detail_rekammedis.update');

    Route::delete('/rekammedis/{idrekam_medis}/detail/{iddetail}', [DetailRekamMedisController::class, 'destroy'])
        ->name('detail_rekammedis.destroy');

    // PROFIL DOKTER ROUTE
    Route::get('/profil', [ProfilDokterController::class, 'index'])
        ->name('profil');
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
    Route::get('/temu-dokter', [DashboardPemilikController::class, 'temuDokter'])->name('temu-dokter');
    Route::get('/profil', [DashboardPemilikController::class, 'profil'])->name('profil');
    Route::put('/profil/update', [DashboardPemilikController::class, 'updateProfil'])->name('profil.update');
});


