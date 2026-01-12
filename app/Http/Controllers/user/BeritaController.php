<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class BeritaController extends Controller
{
    /**
     * Client Supabase (PASTI ada API key)
     */
    private function supabase()
    {
        $key = env('SUPABASE_ANON_KEY'); // 🔥 LANGSUNG dari env (tanpa config)

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

        if (preg_match('/^https?:\/\//i', $gambar)) {
            return $gambar;
        }

        return rtrim(env('SUPABASE_URL'), '/')
            . '/storage/v1/object/public/gambar/'
            . ltrim($gambar, '/');
    }

    public function index()
    {
        $response = $this->supabase()->get(
            rtrim(env('SUPABASE_URL'), '/') . '/rest/v1/publikasi',
            [
                'select' => 'publikasi_id,judul,tanggal,penulis,gambar,isi,pembaca,status,kategori',
                'kategori' => 'eq.berita',
                'status' => 'eq.terbit',
                'order' => 'tanggal.desc,created_at.desc,publikasi_id.desc',
            ]
        )->throw();

        $berita = $response->json();

        $berita = array_map(function ($item) {
            $item['gambar_url'] = $this->publicImageUrl($item['gambar'] ?? null);
            return $item;
        }, $berita);

        return view('user.berita.index', compact('berita'));
    }

    // route: /berita/{slug} -> slug = publikasi_id
    public function show($slug)
    {
        $response = $this->supabase()->get(
            rtrim(env('SUPABASE_URL'), '/') . '/rest/v1/publikasi',
            [
                'select' => '*',
                'publikasi_id' => 'eq.' . $slug,
                'kategori' => 'eq.berita',
                'status' => 'eq.terbit',
                'limit' => 1,
            ]
        )->throw();

        $data = $response->json();
        abort_if(empty($data), 404);

        $berita = $data[0];
        $berita['gambar_url'] = $this->publicImageUrl($berita['gambar'] ?? null);

        return view('user.berita.show', compact('berita'));
    }
}
