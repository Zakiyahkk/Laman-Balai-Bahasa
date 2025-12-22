<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function visiMisi()
    {
        return view('user.profil.visi-misi');
    }

    public function kontakKami()
    {
        return view('user.profil.kontak-kami');
    }

    public function tugasdanfungsi()
    {
        return view('user.profil.tugas-dan-fungsi');
    }

    public function strukturOrganisasi()
    {
        return view('user.profil.struktur-organisasi');
    }

    public function pegawai()
    {
    return view('user.profil.pegawai');
    }

    public function logobppriau()
    {
    return view('user.profil.logo-bpp-riau');
    }

}
