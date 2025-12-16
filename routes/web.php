<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\BerandaController;
use App\Http\Controllers\User\BeritaController;

Route::get('/', [BerandaController::class, 'dashboard']);

Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.show');

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/publikasi', function () {
        return view('admin.publikasi');
    })->name('admin.publikasi');

});
