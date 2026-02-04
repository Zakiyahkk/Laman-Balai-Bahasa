<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\BerandaController;
use App\Http\Controllers\User\BeritaController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\ProdukController;
use App\Http\Controllers\User\PpidController;
use App\Http\Controllers\User\SurveiController;
use App\Http\Controllers\User\AkuntabilitasController;
use App\Http\Controllers\User\LayananController;
use App\Http\Controllers\User\ZiwbkController;
use App\Http\Controllers\User\WbsController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\GaleriController;
use App\Http\Controllers\Admin\PublikasiController;
use App\Http\Controllers\Admin\AProfilController;
use App\Http\Controllers\Admin\AAkuntabilitasController;
use App\Http\Controllers\Admin\ATokohController;
use App\Http\Controllers\User\ArtikelController;
use App\Http\Controllers\Admin\APengaturanController;
use App\Http\Controllers\User\ASembariController;

Route::get('/link-storage', function () {
    Artisan::call('storage:link');
    return 'Simboolic link berhasil dibuat!';
});
/*
|--------------------------------------------------------------------------
| PUBLIK / USER
|--------------------------------------------------------------------------
*/

Route::get('/', [BerandaController::class, 'dashboard']);

Route::get('/berita', [BeritaController::class, 'index'])
    ->name('berita.index');
    
Route::get('/fasilitas/{slug}', function ($slug) {
    return view('user.fasilitas.fasilitas-detail', compact('slug'));
})->name('fasilitas.detail');

Route::get('/berita/{slug}', [BeritaController::class, 'show'])
    ->name('berita.show');

Route::prefix('profil')->group(function () {
    Route::get('/visi-misi', [ProfileController::class, 'visiMisi']);
    Route::get('/sejarah-singkat', [ProfileController::class, 'sejarahSingkat']);
    Route::get('/tugas-dan-fungsi', [ProfileController::class, 'tugasDanFungsi']);
    Route::get('/struktur-organisasi',[ProfileController::class, 'strukturOrganisasi']);
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
    Route::get('/file/{id}', [AkuntabilitasController::class, 'file'])
    ->name('akuntabilitas.file');
});


Route::prefix('layanan')->group(function () {
    Route::get('/ahli-bahasa', [LayananController::class, 'ahliBahasa']);
    Route::get('/penerjemahan', [LayananController::class, 'penerjemahan']);
    Route::get('/ukbi-adaptif', [LayananController::class, 'ukbiAdaptif']);
    Route::get('/bipa', [LayananController::class, 'bipa']);
    Route::get('/perpustakaan', [LayananController::class, 'perpustakaan']);
    Route::get('/magang', [LayananController::class, 'magang']);

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
    Route::get('/hasil', [SurveiController::class, 'survei']);
});

Route::prefix('wbs')->group(function () {
    Route::get('/wbs', [WbsController::class, 'wbs']);
});

Route::get(
    '/zi-wbk/{tahun}/{area}/{sub}',
    [ZiwbkController::class, 'dokumen']
)->name('user.ziwbk.dokumen');



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

Route::get('/bbpr/zi-wbk', [ZiwbkController::class, 'index']);

Route::get(
    '/bbpr/zi-wbk/{tahun}/{area}/{sub}',
    [ZiwbkController::class, 'dokumen']
);

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
        
       Route::prefix('zi-wbk')->group(function () {

        Route::get('/', [\App\Http\Controllers\Admin\ZiWbkController::class, 'index'])
            ->name('admin.ziwbk.index');
    
        Route::get('/create', [\App\Http\Controllers\Admin\ZiWbkController::class, 'create'])
            ->name('admin.ziwbk.create');
    
        Route::post('/store', [\App\Http\Controllers\Admin\ZiWbkController::class, 'store'])
            ->name('admin.ziwbk.store');
    
        Route::get('/{id}/edit', [\App\Http\Controllers\Admin\ZiWbkController::class, 'edit'])
            ->name('admin.ziwbk.edit');
    
        Route::put('/{id}', [\App\Http\Controllers\Admin\ZiWbkController::class, 'update'])
            ->name('admin.ziwbk.update');
            
        Route::delete('/ziwbk/{id}', [\App\Http\Controllers\Admin\ZiWbkController::class, 'destroy'])
            ->name('admin.ziwbk.destroy');

    });


        Route::get('/publikasi', [PublikasiController::class, 'index'])->name('admin.publikasi');
        Route::get('/publikasi/create', [PublikasiController::class, 'create'])->name('admin.publikasi.create');
        Route::get('/publikasi/{id}/edit', [PublikasiController::class, 'edit'])->name('admin.publikasi.edit');
        Route::put('/publikasi/{id}', [PublikasiController::class, 'update'])->name('admin.publikasi.update');
        Route::post('/publikasi/store', [PublikasiController::class, 'store'])->name('admin.publikasi.store');
        Route::delete('/publikasi/{id}', [PublikasiController::class, 'destroy'])->name('admin.publikasi.delete');
        Route::put('/publikasi/{id}/status', [PublikasiController::class, 'updateStatus']) ->name('admin.publikasi.status');
        Route::get('/publikasi/download/{id}', [PublikasiController::class, 'download']) ->name('admin.publikasi.download');
        Route::get('/publikasi/{id}', [PublikasiController::class, 'show'])->name('admin.publikasi.show');

        Route::get('/galeri', [GaleriController::class, 'index'])->name('admin.galeri');
        Route::get('/galeri/create', [GaleriController::class, 'create'])->name('admin.galeri.create');
        Route::post('/galeri', [GaleriController::class, 'store'])->name('admin.galeri.store');
        Route::get('/galeri/show', function () { return view('admin.galeri.show');  })->name('admin.galeri.show');
        Route::resource('admin/galeri', GaleriController::class)->names('admin.galeri');
        Route::get('/galeri/show', [GaleriController::class, 'show'])->name('admin.galeri.');

        Route::prefix('profil')->group(function () {
            // ===== VISI & MISI =====
            Route::get('/visimisi', [AProfilController::class, 'visiMisi'])
                ->name('admin.profil.visimisi');
            Route::post('/visimisi', [AProfilController::class, 'updateVisiMisi'])
                ->name('profil.visimisi.update');
            // ===== TUGAS & FUNGSI =====
            Route::get('/tugasfungsi', [AProfilController::class, 'tugasFungsi'])
                ->name('admin.profil.tugasfungsi');
            Route::post('/tugasfungsi', [AProfilController::class, 'updateTugasFungsi'])
                ->name('profil.tugasfungsi.update');
            // ===== STRUKTUR ORGANISASI =====
            Route::get('/strukturorganisasi', [AProfilController::class, 'strukturorganisasi'])
                ->name('admin.profil.strukturorganisasi');
            // ===== PEGAWAI =====
            Route::get('/pegawai', [AProfilController::class, 'pegawai'])
                ->name('admin.profil.pegawai');
            Route::post('/pegawai', [AProfilController::class, 'storePegawai'])
                ->name('admin.profil.pegawai.store');
            Route::put('/pegawai/{id}', [AProfilController::class, 'updatePegawai'])
                ->name('admin.profil.pegawai.update');
            Route::put( '/admin/profil/pegawai/strategis', [AProfilController::class, 'updateStrategis'])
                ->name('admin.profil.pegawai.updateStrategis');
            Route::delete('/pegawai/{id}', [AProfilController::class, 'destroyPegawai'])
                ->name('admin.profil.pegawai.destroy');
        });

        Route::prefix('akuntabilitas')
        ->name('admin.akuntabilitas.')
        ->group(function () {
        // Route Utama untuk semua tipe (renstra, dipa, pk, ra, lakin, sakai)
        Route::get('/{tipe}', [AAkuntabilitasController::class, 'index'])->name('index');
        
        // Route Tambah Data
        Route::get('/{tipe}/create', [AAkuntabilitasController::class, 'create'])->name('create');
        Route::post('/{tipe}/store', [AAkuntabilitasController::class, 'store'])->name('store');
        
        // Route Edit & Update
        Route::get('/{tipe}/edit/{id}', [AAkuntabilitasController::class, 'edit'])->name('edit');
        Route::put('/{tipe}/update/{id}', [AAkuntabilitasController::class, 'update'])->name('update');
        
        // Route Action (Download & Delete) - ID bersifat unik jadi tidak wajib pakai tipe di URL
        Route::get('/download/{id}', [AAkuntabilitasController::class, 'download'])->name('download');
        Route::delete('/delete/{id}', [AAkuntabilitasController::class, 'destroy'])->name('destroy');
         });
         

            Route::get('/tokoh', [ATokohController::class, 'index'])
                ->name('admin.tokoh');
            Route::post('/tokoh', [ATokohController::class, 'store'])
                ->name('admin.tokoh.store');
            Route::put('/tokoh/{id}', [ATokohController::class, 'update'])
                ->name('admin.tokoh.update');
            Route::delete('/tokoh/{id}', [ATokohController::class, 'destroy'])
                ->name('admin.tokoh.destroy');
                
            // ===== SEMBARI (SERIAL TERJEMAHAN) =====
            Route::resource('sembari', \App\Http\Controllers\Admin\ASembariController::class)
                ->names('admin.sembari');
            Route::get('/sembari/download/{id}', [\App\Http\Controllers\Admin\ASembariController::class, 'download'])
                ->name('admin.sembari.download');


        Route::get('/halamanweb', fn () => view('admin.halamanweb'))->name('admin.halamanweb');

        Route::get('/pengaturan', [APengaturanController::class, 'index'])->name('admin.pengaturan');
        Route::post('/pengaturan', [APengaturanController::class, 'store'])->name('admin.pengaturan.store');
       Route::post('/pengaturan/update', [APengaturanController::class, 'update'])
    ->name('admin.pengaturan.update');

Route::post('/pengaturan/delete', [APengaturanController::class, 'destroy'])
    ->name('admin.pengaturan.destroy');




});


// ===== Alternatif ViewClear =====
Route::get('/clear', function() {
    Artisan::call('view:clear'); 
    Artisan::call('cache:clear'); 
    return 'Cache Tampilan sudah dibersihkan! Silakan refresh halaman utama.';
});


