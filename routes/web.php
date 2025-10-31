<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\SiteController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Resepsionis\DashboardResepsionisController;
use App\Http\Controllers\Admin\{
    PetController, RoleController, UserController, PemilikController,
    KategoriController, RasHewanController, JenisHewanController,
    KategoriKlinisController, KodeTindakanTerapiController,
    DashboardAdminController
};

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
    Route::resource('pemilik', PemilikController::class);
    Route::resource('rashewan', RasHewanController::class);
    Route::resource('kategori', KategoriController::class);
    Route::resource('kategoriklinis', KategoriKlinisController::class);
    Route::resource('kodetindakanterapi', KodeTindakanTerapiController::class);
    Route::resource('pet', PetController::class);
    Route::resource('role', RoleController::class);
    Route::resource('user', UserController::class);
});

// Resepsionis Routes
Route::middleware('isResepsionis')->prefix('resepsionis')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Resepsionis\DashboardResepsionisController::class, 'index'])
        ->name('resepsionis.dashboard');
});
