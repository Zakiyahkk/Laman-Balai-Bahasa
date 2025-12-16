<?php

use App\Http\Controllers\User\BerandaController;
use App\Http\Controllers\User\BeritaController;
use Illuminate\Support\Facades\Route;

Route::get('/admin/artikel-berita', function () { return view('admin.artikel-berita'); });
Route::get('/admin/dashboard', function () {return view('admin.dashboard'); });
Route::get('/', [BerandaController::class, 'dashboard']);
Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.show');
