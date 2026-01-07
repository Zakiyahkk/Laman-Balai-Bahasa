<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AkuntabilitasController extends Controller
{
    public function perjanjianKinerja()
    {
        return view('user.akuntabilitas.perjanjian-kinerja');
    }

    public function renstra()
    {
        return view('user.akuntabilitas.renstra');
    }

    public function lakip()
    {
        return view('user.akuntabilitas.lakip');
    }

    public function lakin()
    {
        return view('user.akuntabilitas.lakin');
    }

    public function rencanaAksi()
    {
        return view('user.akuntabilitas.rencana-aksi');
    }
}