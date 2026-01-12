<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function terbitanbbpr()
    {
        return view('user.produk.terbitan-bbpr');
    }

    public function jurnal()
    {
        return view('user.produk.jurnal');
    }

    public function majalah()
    {
        return view('user.produk.majalah');
    }

    public function Sembari()
    {
        return view('user.produk.sembari');
    }

    public function petaPembinaanBahasa()
    {
        return view('user.produk.peta-pembinaan-bahasa');
    }
    public function petaPembinaanSastra()
    {
        return view('user.produk.peta-pembinaan-sastra');
    }
    public function bipa()
    {
        return view('user.produk.bipa');
    }
    public function kemala()
    {
        return view('user.produk.kemala');
    }
    
}
