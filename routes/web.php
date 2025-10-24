<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\SiteController;
use App\Http\Controllers\Admin\Datamaster\PetController;
use App\Http\Controllers\Admin\Datamaster\RoleController;
use App\Http\Controllers\Admin\Datamaster\UserController;
use App\Http\Controllers\Admin\Datamaster\PemilikController;
use App\Http\Controllers\Admin\Datamaster\KategoriController;
use App\Http\Controllers\Admin\Datamaster\RasHewanController;
use App\Http\Controllers\Admin\Datamaster\JenisHewanController;
use App\Http\Controllers\Admin\Datamaster\KategoriKlinisController;
use App\Http\Controllers\Admin\Datamaster\KodeTindakanTerapiController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [SiteController::class, 'home'])->name('home');
Route::get('/layanan', [SiteController::class, 'layanan'])->name('layanan');
Route::get('/struktur', [SiteController::class, 'struktur'])->name('struktur');
Route::get('/kontak', [SiteController::class, 'kontak'])->name('kontak');
Route::get('/login', [SiteController::class, 'login'])->name('login');
Route::get('/login', [SiteController::class, 'process'])->name('login');
Route::get('/cek-koneksi', [SiteController::class, 'cekKoneksi'])->name('site.cek-koneksi');

Route::prefix('admin/datamaster')->group(function () {
    Route::get('/jenishewan', [JenisHewanController::class, 'index'])->name('jenishewan.index');
    Route::get('/jenishewan/create', [JenisHewanController::class, 'create'])->name('jenishewan.create');
    Route::post('/jenishewan/store', [JenisHewanController::class, 'store'])->name('jenishewan.store');
    Route::get('/jenishewan/edit/{id}', [JenisHewanController::class, 'edit'])->name('jenishewan.edit');
    Route::put('/jenishewan/update/{id}', [JenisHewanController::class, 'update'])->name('jenishewan.update');
    Route::delete('/jenishewan/delete/{id}', [JenisHewanController::class, 'destroy'])->name('jenishewan.destroy');
});

Route::prefix('admin/datamaster')->group(function () {
    // ... (route jenis hewan)
    Route::get('/pemilik', [PemilikController::class, 'pemilik'])->name('pemilik.index');
    Route::get('/pemilik/create', [PemilikController::class, 'create'])->name('pemilik.create');
    Route::post('/pemilik/store', [PemilikController::class, 'store'])->name('pemilik.store');
    Route::get('/pemilik/edit/{id}', [PemilikController::class, 'edit'])->name('pemilik.edit');
    Route::put('/pemilik/update/{id}', [PemilikController::class, 'update'])->name('pemilik.update');
    Route::delete('/pemilik/delete/{id}', [PemilikController::class, 'destroy'])->name('pemilik.destroy');
});

Route::prefix('admin/datamaster')->group(function () {

    Route::get('/rashewan', [RasHewanController::class, 'index'])->name('rashewan.index');
    Route::get('/rashewan/create', [RasHewanController::class, 'create'])->name('rashewan.create');
    Route::post('/rashewan/store', [RasHewanController::class, 'store'])->name('rashewan.store');
    Route::get('/rashewan/edit/{id}', [RasHewanController::class, 'edit'])->name('rashewan.edit');
    Route::put('/rashewan/update/{id}', [RasHewanController::class, 'update'])->name('rashewan.update');
    Route::delete('/rashewan/delete/{id}', [RasHewanController::class, 'destroy'])->name('rashewan.destroy');
});

Route::prefix('admin/datamaster')->group(function () {
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
    Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
    Route::post('/kategori/store', [KategoriController::class, 'store'])->name('kategori.store');
    Route::get('/kategori/edit/{id}', [KategoriController::class, 'edit'])->name('kategori.edit');
    Route::put('/kategori/update/{id}', [KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('/kategori/delete/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
});

Route::prefix('admin/datamaster')->group(function () {
    Route::get('/kategoriklinis', [KategoriKlinisController::class, 'index'])->name('kategoriklinis.index');
    Route::get('/kategoriklinis/create', [KategoriKlinisController::class, 'create'])->name('kategoriklinis.create');
    Route::post('/kategoriklinis/store', [KategoriKlinisController::class, 'store'])->name('kategoriklinis.store');
    Route::get('/kategoriklinis/edit/{id}', [KategoriKlinisController::class, 'edit'])->name('kategoriklinis.edit');
    Route::put('/kategoriklinis/update/{id}', [KategoriKlinisController::class, 'update'])->name('kategoriklinis.update');
    Route::delete('/kategoriklinis/delete/{id}', [KategoriKlinisController::class, 'destroy'])->name('kategoriklinis.destroy');
});

Route::prefix('/admin/datamaster/kodetindakanterapi', [KodeTindakanTerapiController::class, 'index'])->name('kodetindakanterapi.index');
    Route::get('/kodetindakanterapi', [KodeTindakanTerapiController::class, 'index'])->name('kodetindakanterapi.index');
    Route::get('/kodetindakanterapi/create', [KodeTindakanTerapiController::class, 'create'])->name('kodetindakanterapi.create');
    Route::post('/kodetindakanterapi/store', [KodeTindakanTerapiController::class, 'store'])->name('kodetindakanterapi.store');
    Route::get('/kodetindakanterapi/edit/{id}', [KodeTindakanTerapiController::class, 'edit'])->name('kodetindakanterapi.edit');
    Route::put('/kodetindakanterapi/update/{id}', [KodeTindakanTerapiController::class, 'update'])->name('kodetindakanterapi.update');
    Route::delete('/kodetindakanterapi/delete/{id}', [KodeTindakanTerapiController::class, 'destroy'])->name('kodetindakanterapi.destroy');

Route::prefix('admin/datamaster')->group(function () {
    Route::get('/pet', [PetController::class, 'index'])->name('pet.index');
    Route::get('/pet/create', [PetController::class, 'create'])->name('pet.create');
    Route::post('/pet/store', [PetController::class, 'store'])->name('pet.store');
    Route::get('/pet/edit/{id}', [PetController::class, 'edit'])->name('pet.edit');
    Route::put('/pet/update/{id}', [PetController::class, 'update'])->name('pet.update');
    Route::delete('/pet/delete/{id}', [PetController::class, 'destroy'])->name('pet.destroy');
});

//role
//kalo resource dia sudah ootomatis membuat CRUD (get, post, put, delete)
Route::prefix('admin/datamaster')->group(function () {
    Route::resource('role', RoleController::class); 
});

// user
Route::prefix('admin/datamaster')->group(function () {
    Route::resource('user', UserController::class); 
});
