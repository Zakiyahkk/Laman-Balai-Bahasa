<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ArtikelController extends Controller
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

        // kalau masih path/nama file -> bucket gambar
        return rtrim(env('SUPABASE_URL'), '/')
            . '/storage/v1/object/public/gambar/'
            . ltrim($gambar, '/');
    }

    /**
     * Halaman daftar semua Artikel + Alinea (Supabase)
     * /artikel?q=keyword
     */
    public function index(Request $request)
    {
        $q = trim((string) $request->get('q', ''));

        $params = [
            'select' => 'publikasi_id,judul,tanggal,penulis,gambar,isi,pembaca,status,kategori,created_at',
            // gabungkan artikel + alinea
            'kategori' => 'in.(artikel,alinea)',
            'status' => 'eq.terbit',
            'order' => 'tanggal.desc,created_at.desc,publikasi_id.desc',
        ];

        if ($q !== '') {
            // cari di judul (case-insensitive)
            $params['judul'] = 'ilike.*' . $q . '*';
        }

        $response = $this->supabase()->get(
            rtrim(env('SUPABASE_URL'), '/') . '/rest/v1/publikasi',
            $params
        )->throw();

        $items = $response->json();

        $items = array_map(function ($row) {
            $row['gambar_url'] = $this->publicImageUrl($row['gambar'] ?? null);
            return $row;
        }, $items);

        // ✅ sesuai blade baru: index pakai $items
        return view('user.artikel.index', [
            'items' => $items,
            'q' => $q,
        ]);
    }

    /**
     * Detail Artikel / Alinea
     * /artikel/{slug} -> sementara {slug} = publikasi_id
     */
    public function show($slug)
    {
        $response = $this->supabase()->get(
            rtrim(env('SUPABASE_URL'), '/') . '/rest/v1/publikasi',
            [
                'select' => '*',
                'publikasi_id' => 'eq.' . $slug,
                // izinkan artikel + alinea
                'kategori' => 'in.(artikel,alinea)',
                'status' => 'eq.terbit',
                'limit' => 1,
            ]
        )->throw();

        $data = $response->json();
        abort_if(empty($data), 404);

        $item = $data[0];
        $item['gambar_url'] = $this->publicImageUrl($item['gambar'] ?? null);

        // ✅ sesuai blade baru: show pakai $item
        return view('user.artikel.show', compact('item'));
    }
}
