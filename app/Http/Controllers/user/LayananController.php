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
}
