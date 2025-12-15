<?php

use App\Http\Controllers\User\BerandaController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BerandaController::class, 'dashboard']);
