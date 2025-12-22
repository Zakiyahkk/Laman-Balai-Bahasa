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
}
