<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\BerandaController;
use App\Http\Controllers\User\BeritaController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\ProdukController;
use App\Http\Controllers\User\PpidController;
use App\Http\Controllers\User\SurveiController;
use App\Http\Controllers\User\AkuntabilitasController;
use App\Http\Controllers\User\ZiwbkController;
use App\Http\Controllers\User\WbsController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\GaleriController;
use App\Http\Controllers\Admin\PublikasiController;
use App\Http\Controllers\User\ArtikelController;

/*
|--------------------------------------------------------------------------
| PUBLIK / USER
|--------------------------------------------------------------------------
*/

Route::get('/', [BerandaController::class, 'dashboard']);

Route::get('/berita', [BeritaController::class, 'index'])
    ->name('berita.index');

Route::get('/berita/{slug}', [BeritaController::class, 'show'])
    ->name('berita.show');

Route::prefix('profil')->group(function () {
    Route::get('/visi-misi', [ProfileController::class, 'visiMisi']);
    Route::get('/sejarah-singkat', [ProfileController::class, 'sejarahSingkat']);
    Route::get('/tugas-dan-fungsi', [ProfileController::class, 'tugasDanFungsi']);
    Route::get('/struktur-organisasi', [ProfileController::class, 'strukturOrganisasi']);
    Route::get('/pegawai', [ProfileController::class, 'pegawai']);
    Route::get('/logo-bpp-riau', [ProfileController::class, 'logobppriau']);
});

Route::prefix('artikel')->name('artikel.')->group(function () {
    Route::get('/', [ArtikelController::class, 'index'])->name('index');
    Route::get('/{slug}', [ArtikelController::class, 'show'])->name('show');
});


Route::prefix('akuntabilitas')->group(function () {
    Route::get('/perjanjian-kinerja', [AkuntabilitasController::class, 'perjanjianKinerja']);
    Route::get('/renstra', [AkuntabilitasController::class, 'renstra']);
    Route::get('/dipa', [AkuntabilitasController::class, 'dipa']);
    Route::get('/lakin', [AkuntabilitasController::class, 'lakin']);
    Route::get('/rencana-aksi', [AkuntabilitasController::class, 'rencanaAksi']);
    Route::get('/sakai', [AkuntabilitasController::class, 'sakai']);
});

Route::prefix('produk')->group(function () {
    Route::get('/terbitan-bbpr', [ProdukController::class, 'terbitanbbpr']);
    Route::get('/jurnal', [ProdukController::class, 'jurnal']);
    Route::get('/majalah', [ProdukController::class, 'majalah']);
    Route::get('/sembari', [ProdukController::class, 'Sembari']);
    Route::get('/peta-pembinaan-bahasa', [ProdukController::class, 'petaPembinaanBahasa']);
    Route::get('/peta-pembinaan-sastra', [ProdukController::class, 'petaPembinaanSastra']);
    Route::get('/bipa', [ProdukController::class, 'bipa']);
    Route::get('/kemala', [ProdukController::class, 'kemala']);
});

Route::prefix('ppid')->group(function () {
    Route::get('/ppid', [PpidController::class, 'ppid']);
});

Route::prefix('survei')->group(function () {
    Route::get('/survei', [SurveiController::class, 'survei']);
});

Route::prefix('wbs')->group(function () {
    Route::get('/wbs', [WbsController::class, 'wbs']);
});

Route::prefix('ziwbk')->group(function () {
    Route::get('/ziwbk', [ZiwbkController::class, 'ziwbk']);
});

/*
|--------------------------------------------------------------------------
| AUTH ADMIN
|--------------------------------------------------------------------------
*/

Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])
    ->name('admin.login');

Route::post('/admin/login', [AdminAuthController::class, 'login'])
    ->name('admin.login.submit');

Route::post('/admin/logout', [AdminAuthController::class, 'logout'])
    ->name('admin.logout');

/*
|--------------------------------------------------------------------------
| ADMIN (WAJIB LOGIN)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->middleware('admin.auth')
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');

        Route::get('/kegiatan', fn () => view('admin.kegiatan.index'))->name('admin.kegiatan');
        Route::get('/kegiatan/create', fn () => view('admin.kegiatan.create'))->name('admin.kegiatan.create');
        Route::get('/kegiatan/edit', fn () => view('admin.kegiatan.edit'))->name('admin.kegiatan.edit');
        Route::get('/kegiatan/show', fn () => view('admin.kegiatan.show'))->name('admin.kegiatan.show');

        Route::get('/publikasi', [PublikasiController::class, 'index'])->name('admin.publikasi');
        Route::get('/publikasi/create', [PublikasiController::class, 'create'])->name('admin.publikasi.create');
        Route::get('/publikasi/{id}', [PublikasiController::class, 'show'])->name('admin.publikasi.show');
        Route::get('/publikasi/{id}/edit', [PublikasiController::class, 'edit'])->name('admin.publikasi.edit');
        Route::put('/publikasi/{id}', [PublikasiController::class, 'update'])->name('admin.publikasi.update');
        Route::post('/publikasi', [PublikasiController::class, 'store'])->name('admin.publikasi.store');
        Route::delete('/publikasi/{id}', [PublikasiController::class, 'destroy'])->name('admin.publikasi.delete');
        Route::put('/publikasi/{id}/status', [PublikasiController::class, 'updateStatus']) ->name('admin.publikasi.status');
        Route::get('/admin/publikasi/download/{id}', [PublikasiController::class, 'download']) ->name('admin.publikasi.download');

        Route::get('/pendaftaran', fn () => view('admin.pendaftaran'))->name('admin.pendaftaran');

        Route::get('/galeri', [GaleriController::class, 'index'])->name('admin.galeri');
        Route::get('/galeri/create', [GaleriController::class, 'create'])->name('admin.galeri.create');
        Route::post('/galeri', [GaleriController::class, 'store'])->name('admin.galeri.store');
        Route::get('/galeri/show', function () { return view('admin.galeri.show');  })->name('admin.galeri.show');
        Route::resource('admin/galeri', GaleriController::class)->names('admin.galeri');
        Route::get('/galeri/show', [GaleriController::class, 'show'])->name('admin.galeri.');

        Route::prefix('profil')->group(function () {
            Route::get('/visimisi', function () {
                return view('admin.profil.visimisi');
            })->name('admin.profil.visimisi');
        });

        Route::prefix('profil')->group(function () {
            Route::get('/tugasfungsi', function () {
                return view('admin.profil.tugasfungsi');
            })->name('admin.profil.tugasfungsi');
        });


        Route::get('/halamanweb', fn () => view('admin.halamanweb'))->name('admin.halamanweb');
        Route::get('/pengaturan', fn () => view('admin.pengaturan'))->name('admin.pengaturan');

    });

