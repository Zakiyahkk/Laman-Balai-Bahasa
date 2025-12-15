<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class BerandaController extends Controller
{
    public function dashboard()
    {
        return view('user.beranda.dashboard');
    }
}
