<?php

use App\Http\Controllers\User\BerandaController;
use App\Http\Controllers\User\BeritaController;

Route::get('/', [BerandaController::class, 'dashboard']);

Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.show');