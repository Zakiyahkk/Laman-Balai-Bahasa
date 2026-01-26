<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    public function ahliBahasa()
    {
        return view('user.Layanan.ahli-bahasa');
    }
    public function penerjemahan()
    {
        return view('user.Layanan.penerjemahan');
    }
    public function ukbiAdaptif()
    {
    return view('user.Layanan.ukbi-adaptif');
    }
    public function bipa()
    {
    return view('user.Layanan.bipa');
    }
    public function perpustakaan()
    {
    return view('user.Layanan.perpustakaan');
    }
    public function magang()
    {
    return view('user.Layanan.magang');
    }


}
