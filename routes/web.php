<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\BerandaController;
use App\Http\Controllers\User\BeritaController;
use App\Http\Controllers\Admin\GaleriController;
use App\Http\Controllers\user\ProfileController;

/*
|--------------------------------------------------------------------------
| USER / PUBLIK
|--------------------------------------------------------------------------
*/

Route::get('/', [BerandaController::class, 'dashboard']);
Route::get('/admin/galeri', [GaleriController::class, 'index'])->name('admin.galeri.index');
Route::get('/admin/galeri/create', [GaleriController::class, 'create'])->name('admin.galeri.create');
Route::post('/admin/galeri', [GaleriController::class, 'store'])->name('admin.galeri.store');
Route::get('/berita', [BeritaController::class, 'index'])
    ->name('berita.index');

Route::get('/berita/{slug}', [BeritaController::class, 'show'])
    ->name('berita.show');
    
    Route::prefix('profil')->group(function () {
        Route::get('/visi-misi', [ProfileController::class, 'visiMisi']);
        Route::get('/kontak-kami', [ProfileController::class, 'kontakKami']);
    });
 
/*


|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');


    /*ROUTE MENU ARTIKEL & BERITA*/
    Route::get('/artikel', function () {
        return view('admin.artikel.index');
    })->name('admin.artikel');

    Route::get('/artikel/create', function () {
        return view('admin.artikel.create');
    })->name('admin.artikel.create');

    Route::get('/artikel/edit', function () {
        return view('admin.artikel.edit');
    })->name('admin.artikel.edit');

    Route::get('/artikel/show', function () {
        return view('admin.artikel.show');
    })->name('admin.artikel.show');

    /*ROUTE MENU KEGIATAN*/
    Route::get('/kegiatan', function () {
        return view('admin.kegiatan.index');
    })->name('admin.kegiatan');

    Route::get('/kegiatan/create', function () {
        return view('admin.kegiatan.create');
    })->name('admin.kegiatan.create');

    Route::get('/kegiatan/edit', function () {
        return view('admin.kegiatan.edit');
    })->name('admin.kegiatan.edit');

    Route::get('/kegiatan/show', function () {
        return view('admin.kegiatan.show');
    })->name('admin.kegiatan.show');


    /*ROUTE MENU PUBLIKASI*/
    Route::get('/publikasi', function () {
        return view('admin.publikasi.index');
    })->name('admin.publikasi');

    Route::get('/publikasi/create', function () {
    return view('admin.publikasi.create');
    })->name('admin.publikasi.create');

    Route::get('/admin/publikasi/{id}/edit', function ($id) {
    return view('admin.publikasi.edit');
    })->name('admin.publikasi.edit');

    Route::get('/publikasi/show', function () {
    return view('admin.publikasi.show');
    })->name('admin.publikasi.show');


    /*ROUTE MENU PENDAFTARAN*/
    Route::get('/pendaftaran', function () {
        return view('admin.pendaftaran');
    })->name('admin.pendaftaran');


    /*ROUTE MENU GALERI*/
    Route::get('/galeri', function () {
        return view('admin.galeri.index');
    })->name('admin.galeri');

    Route::get('/galeri/create', function () {
        return view('admin.galeri.create');
    })->name('admin.galeri.create');

    Route::get('/galeri/edit', function () {
        return view('admin.galeri.edit');
    })->name('admin.galeri.edit');

    Route::get('/galeri/show', function () {
        return view('admin.galeri.show');
    })->name('admin.galeri.show');


    /*ROUTE MENU HALAMAN WEB*/
    Route::get('/halamanweb', function () {
        return view('admin.halamanweb');
    })->name('admin.halamanweb');


    /*ROUTE MENU PENGATURAN*/
    Route::get('/pengaturan', function () {
        return view('admin.pengaturan');
    })->name('admin.pengaturan');

});
