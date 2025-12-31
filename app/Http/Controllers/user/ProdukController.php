<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function bahanBacaan()
    {
        return view('user.produk.bahan-bacaan-literasi');
    }

    public function jurnalMadah()
    {
        return view('user.produk.jurnal-madah');
    }

    public function majalah()
    {
        return view('user.produk.majalah');
    }

    public function penerjemahanSembari()
    {
        return view('user.produk.penerjemahan-sembari');
    }

    public function petaPembinaanBahasa()
    {
        return view('user.produk.peta-pembinaan-bahasa');
    }
}
