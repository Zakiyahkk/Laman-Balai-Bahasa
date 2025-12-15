<?php

use App\Http\Controllers\User\BerandaController;

Route::get('/', [BerandaController::class, 'dashboard']);