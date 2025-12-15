<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class BeritaController extends Controller
{
    public function index()
    {
        return view('user.berita.index');
    }

    public function show($slug)
    {
        return view('user.berita.show');
    }
}
