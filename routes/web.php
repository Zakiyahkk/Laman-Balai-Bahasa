<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\BerandaController;
use App\Http\Controllers\User\BeritaController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\ProdukController;
use App\Http\Controllers\User\AkuntabilitasController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\GaleriController;

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
    Route::get('/kontak-kami', [ProfileController::class, 'kontakKami']);
    Route::get('/tugas-dan-fungsi', [ProfileController::class, 'tugasDanFungsi']);
    Route::get('/struktur-organisasi', [ProfileController::class, 'strukturOrganisasi']);
    Route::get('/pegawai', [ProfileController::class, 'pegawai']);
    Route::get('/logo-bpp-riau', [ProfileController::class, 'logobppriau']);
});

Route::prefix('akuntabilitas')->group(function () {
    Route::get('/perjanjian-kinerja', [AkuntabilitasController::class, 'perjanjianKinerja']);
    Route::get('/renstra', [AkuntabilitasController::class, 'renstra']);
    Route::get('/lakip', [AkuntabilitasController::class, 'lakip']);
    Route::get('/lakin', [AkuntabilitasController::class, 'lakin']);
    Route::get('/rencana-aksi', [AkuntabilitasController::class, 'rencanaAksi']);
});

Route::prefix('produk')->group(function () {
    Route::get('/bahan-bacaan-literasi', [ProdukController::class, 'bahanBacaan']);
    Route::get('/jurnal-madah', [ProdukController::class, 'jurnalMadah']);
    Route::get('/majalah', [ProdukController::class, 'majalah']);
    Route::get('/penerjemahan-sembari', [ProdukController::class, 'penerjemahanSembari']);
    Route::get('/peta-pembinaan-bahasa', [ProdukController::class, 'petaPembinaanBahasa']);
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

        Route::get('/artikel', fn () => view('admin.artikel.index'))->name('admin.artikel');
        Route::get('/artikel/create', fn () => view('admin.artikel.create'))->name('admin.artikel.create');
        Route::get('/artikel/edit', fn () => view('admin.artikel.edit'))->name('admin.artikel.edit');
        Route::get('/artikel/show', fn () => view('admin.artikel.show'))->name('admin.artikel.show');

        Route::get('/kegiatan', fn () => view('admin.kegiatan.index'))->name('admin.kegiatan');
        Route::get('/kegiatan/create', fn () => view('admin.kegiatan.create'))->name('admin.kegiatan.create');
        Route::get('/kegiatan/edit', fn () => view('admin.kegiatan.edit'))->name('admin.kegiatan.edit');
        Route::get('/kegiatan/show', fn () => view('admin.kegiatan.show'))->name('admin.kegiatan.show');

        Route::get('/publikasi', fn () => view('admin.publikasi.index'))->name('admin.publikasi');
        Route::get('/publikasi/create', fn () => view('admin.publikasi.create'))->name('admin.publikasi.create');
        Route::get('/publikasi/show', fn () => view('admin.publikasi.show'))->name('admin.publikasi.show');
        Route::get('/publikasi/{id}/edit', fn () => view('admin.publikasi.edit')) ->name('admin.publikasi.edit');


        Route::get('/pendaftaran', fn () => view('admin.pendaftaran'))->name('admin.pendaftaran');

        Route::get('/galeri', [GaleriController::class, 'index'])->name('admin.galeri');
        Route::get('/galeri/create', [GaleriController::class, 'create'])->name('admin.galeri.create');
        Route::post('/galeri', [GaleriController::class, 'store'])->name('admin.galeri.store');
        Route::get('/galeri/show', function () { return view('admin.galeri.show');  })->name('admin.galeri.show');
        Route::resource('admin/galeri', GaleriController::class)->names('admin.galeri');   
        Route::get('/galeri/show', [GaleriController::class, 'show'])->name('admin.galeri.');     

        Route::get('/halamanweb', fn () => view('admin.halamanweb'))->name('admin.halamanweb');
        Route::get('/pengaturan', fn () => view('admin.pengaturan'))->name('admin.pengaturan');

    });

