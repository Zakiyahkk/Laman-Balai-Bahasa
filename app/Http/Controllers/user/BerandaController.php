<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class BerandaController extends Controller
{
    private function supabase()
    {
        $key = env('SUPABASE_ANON_KEY');

        if (!$key) {
            abort(500, 'SUPABASE_ANON_KEY tidak ditemukan di .env');
        }

        return Http::withHeaders([
            'apikey' => $key,
            'Authorization' => 'Bearer ' . $key,
            'Accept' => 'application/json',
        ]);
    }

    private function publicImageUrl(?string $gambar): ?string
    {
        if (!$gambar) return null;

        // kalau sudah URL lengkap
        if (preg_match('/^https?:\/\//i', $gambar)) return $gambar;

        // kalau masih path/nama file -> bucket "gambar"
        return rtrim(env('SUPABASE_URL'), '/')
            . '/storage/v1/object/public/gambar/'
            . ltrim($gambar, '/');
    }

    public function dashboard()
    {
        $baseUrl = rtrim(env('SUPABASE_URL'), '/') . '/rest/v1/publikasi';

        // 1) Berita terbaru (preview)
        $berita = $this->supabase()->get($baseUrl, [
            'select' => 'publikasi_id,judul,tanggal,penulis,gambar,isi,pembaca,status,kategori,created_at',
            'kategori' => 'eq.berita',
            'status' => 'eq.terbit',
            'order' => 'tanggal.desc,created_at.desc,publikasi_id.desc',
            'limit' => 4,
        ])->throw()->json();

        $berita = array_map(function ($row) {
            $row['gambar_url'] = $this->publicImageUrl($row['gambar'] ?? null);
            return $row;
        }, $berita);

        // 2) Artikel + Alinea (slider preview)
        $artikelAlinea = $this->supabase()->get($baseUrl, [
            'select' => 'publikasi_id,judul,tanggal,penulis,gambar,isi,pembaca,status,kategori,created_at',
            'kategori' => 'in.(artikel,alinea)',
            'status' => 'eq.terbit',
            'order' => 'tanggal.desc,created_at.desc,publikasi_id.desc',
            'limit' => 12,
        ])->throw()->json();

        $artikelAlinea = array_map(function ($row) {
            $row['gambar_url'] = $this->publicImageUrl($row['gambar'] ?? null);
            return $row;
        }, $artikelAlinea);

        return view('user.beranda.dashboard', compact('berita', 'artikelAlinea'));
    }
}
