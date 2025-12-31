<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RuangKonsultasiController extends Controller
{
    public function ruangKonsultasi()
    {
        return view('user.ruangkonsultasi.ruangkonsultasi');
    }
}
