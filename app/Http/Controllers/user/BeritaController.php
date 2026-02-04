<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class BeritaController extends Controller
{
    private function publicImageUrl(?string $gambar): string
    {
        if (!$gambar) {
            return asset('img/default.jpg');
        }

        if (preg_match('/^https?:\/\//i', $gambar)) {
            return $gambar;
        }

        return asset(ltrim($gambar, '/'));
    }

    public function index()
    {
        $berita = DB::table('publikasi')
            ->where('kategori', 'berita')
            ->where('status', 'terbit')
            ->orderByDesc('tanggal')
            ->get()
            ->map(function ($item) {
                $item->gambar_url = $this->publicImageUrl($item->gambar ?? null);
                return $item;
            });

        return view('user.berita.index', compact('berita'));
    }

    public function show($slug)
    {
        $berita = DB::table('publikasi')
            ->where('slug', $slug)
            ->where('status', 'terbit')
            ->first();
    
        abort_if(!$berita, 404);
    
        $berita->gambar_url = $this->publicImageUrl($berita->gambar ?? null);
    
        DB::table('publikasi')
            ->where('slug', $slug)
            ->increment('pembaca');
    
        $berita->pembaca++;
    
        return view('user.berita.show', compact('berita'));
    }


}
