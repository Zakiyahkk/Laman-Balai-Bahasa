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
            'apikey'        => $key,
            'Authorization' => 'Bearer ' . $key,
            'Accept'        => 'application/json',
        ]);
    }

/**
 * Normalisasi file publikasi (AMAN TANPA UBAH DB)
 */
private function publikasiUrl(?string $value): ?string
{
    if (!$value) {
        return null;
    }

    // kalau sudah URL penuh
    if (preg_match('/^https?:\/\//i', $value)) {
        return $value;
    }

    // 🔥 BUANG SEMUA PREFIX PATH
    $value = preg_replace(
        '#^(public/|/public/|img/publikasi/|/img/publikasi/|publikasi/|/publikasi/)#',
        '',
        $value
    );

    return asset('img/publikasi/' . $value);
}
    /**
     * HALAMAN DAFTAR PENGUMUMAN
     */
    public function index()
    {
        $response = $this->supabase()->get(
            rtrim(env('SUPABASE_URL'), '/') . '/rest/v1/publikasi',
            [
                'select'   => 'publikasi_id,judul,tanggal,file,gambar,kategori,status,created_at',
                'kategori' => 'eq.pengumuman',
                'status'   => 'eq.terbit',
                'order'    => 'tanggal.desc,created_at.desc,publikasi_id.desc',
            ]
        )->throw();

        $items = array_map(function ($row) {
            $type = !empty($row['file']) ? 'pdf' : 'image';

            return [
                'publikasi_id' => $row['publikasi_id'],
                'judul'        => $row['judul'],
                'tanggal'      => $row['tanggal'],
                'type'         => $type,
                'file_url'     => $this->publikasiUrl($row['file'] ?? null),
                'gambar_url'   => $this->publikasiUrl($row['gambar'] ?? null),
            ];
        }, $response->json());

        return view('user.pengumuman.index', compact('items'));
    }

    /**
     * DETAIL / PREVIEW PENGUMUMAN
     */
    public function show($id)
    {
        $data = $this->supabase()->get(
            rtrim(env('SUPABASE_URL'), '/') . '/rest/v1/publikasi',
            [
                'select'       => 'publikasi_id,judul,tanggal,file,gambar,kategori,status',
                'publikasi_id' => 'eq.' . $id,
                'kategori'     => 'eq.pengumuman',
                'status'       => 'eq.terbit',
                'limit'        => 1,
            ]
        )->throw()->json();

        abort_if(empty($data), 404);

        $item = $data[0];
        $item['type']       = !empty($item['file']) ? 'pdf' : 'image';
        $item['file_url']   = $this->publikasiUrl($item['file'] ?? null);
        $item['gambar_url'] = $this->publikasiUrl($item['gambar'] ?? null);

        return view('user.pengumuman.show', compact('item'));
    }
}
