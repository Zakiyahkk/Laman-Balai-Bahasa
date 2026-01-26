<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class PengumumanController extends Controller
{
    /**
     * Client Supabase
     */
    private function supabase()
    {
        $key = env('SUPABASE_ANON_KEY');

        if (!$key) {
            abort(500, 'SUPABASE_ANON_KEY belum diatur di .env');
        }

        return Http::withHeaders([
            'apikey' => $key,
            'Authorization' => 'Bearer ' . $key,
            'Accept' => 'application/json',
        ]);
    }

    /**
     * URL public file (PDF/DOC)
     */
    private function publicFileUrl(?string $file): ?string
    {
        if (!$file) return null;

        // sudah URL lengkap
        if (preg_match('/^https?:\/\//i', $file)) return $file;

        return rtrim(env('SUPABASE_URL'), '/')
            . '/storage/v1/object/public/file/'
            . ltrim($file, '/');
    }

    /**
     * URL public gambar (poster)
     */
    private function publicImageUrl(?string $gambar): ?string
    {
        if (!$gambar) return null;

        if (preg_match('/^https?:\/\//i', $gambar)) return $gambar;

        return rtrim(env('SUPABASE_URL'), '/')
            . '/storage/v1/object/public/gambar/'
            . ltrim($gambar, '/');
    }

    /**
     * SECTION Pengumuman (Beranda)
     */
    public function index()
    {
        $params = [
            'select' => 'publikasi_id,judul,tanggal,file,file_type,gambar,kategori,status,created_at',
            'kategori' => 'eq.pengumuman',
            'status'   => 'eq.terbit',
            'order'    => 'tanggal.desc,created_at.desc,publikasi_id.desc',
            'limit'    => 3, // sesuai desain
        ];

        $response = $this->supabase()->get(
            rtrim(env('SUPABASE_URL'), '/') . '/rest/v1/publikasi',
            $params
        )->throw();

        $items = array_map(function ($row) {
            return [
                'judul'      => $row['judul'],
                'tanggal'    => $row['tanggal'],
                'file_url'   => $this->publicFileUrl($row['file'] ?? null),
                'gambar_url' => $this->publicImageUrl($row['gambar'] ?? null),
                // logic type untuk JS (PDF / IMAGE)
                'type'       => !empty($row['file']) ? 'pdf' : 'image',
            ];
        }, $response->json());

        return view('user.beranda.pengumuman', compact('items'));
    }
}
