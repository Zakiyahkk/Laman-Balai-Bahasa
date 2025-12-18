<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\BerandaController;
use App\Http\Controllers\User\BeritaController;
use App\Http\Controllers\user\ProfileController;

/*
|--------------------------------------------------------------------------
| USER / PUBLIK
|--------------------------------------------------------------------------
*/

Route::get('/', [BerandaController::class, 'dashboard']);

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

    Route::get('/artikel-berita', function () {
        return view('admin.artikel.index');
    })->name('admin.artikel');

    Route::get('/kegiatan', function () {
        return view('admin.kegiatan.index');
    })->name('admin.kegiatan');

    Route::get('/publikasi', function () {
        return view('admin.publikasi.index');
    })->name('admin.publikasi');

    Route::get('/pendaftaran', function () {
        return view('admin.pendaftaran');
    })->name('admin.pendaftaran');

    Route::get('/galeri', function () {
        return view('admin.galeri.index');
    })->name('admin.galeri');

    Route::get('/halamanweb', function () {
        return view('admin.halamanweb');
    })->name('admin.halamanweb');

    Route::get('/pengaturan', function () {
        return view('admin.pengaturan');
    })->name('admin.pengaturan');

});
