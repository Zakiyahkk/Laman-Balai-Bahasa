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
            'apikey'        => $key,
            'Authorization' => 'Bearer ' . $key,
            'Accept'        => 'application/json',
        ]);
    }

    /**
     * 🔥 GAMBAR ARTIKEL / RAGAM / LENSA
     * public Laravel
     */
    private function artikelImageUrl(?string $gambar): string
    {
        if (!$gambar) {
            return asset('img/default.jpg');
        }

        if (preg_match('/^https?:\/\//i', $gambar)) {
            return $gambar;
        }

        return asset(ltrim($gambar, '/'));
    }

    /**
     * =========================
     * LIST ARTIKEL
     * (artikel, ragam, lensa)
     * =========================
     */
    public function index(Request $request)
    {
        $q = trim((string) $request->get('q', ''));

        $params = [
            'select'   => 'publikasi_id,judul,tanggal,penulis,gambar,isi,pembaca,status,kategori,created_at',
            'kategori' => 'in.(artikel,alinea,ragam,lensa)',
            'status'   => 'eq.terbit',
            'order'    => 'tanggal.desc,created_at.desc,publikasi_id.desc',
        ];

        if ($q !== '') {
            $params['judul'] = 'ilike.*' . $q . '*';
        }

        $items = $this->supabase()->get(
            rtrim(env('SUPABASE_URL'), '/') . '/rest/v1/publikasi',
            $params
        )->throw()->json();

        $items = array_map(function ($row) {
            $row['gambar_url'] = $this->artikelImageUrl($row['gambar'] ?? null);
            return $row;
        }, $items);

        return view('user.artikel.index', [
            'items' => $items,
            'q'     => $q,
        ]);
    }

    /**
     * =========================
     * DETAIL ARTIKEL
     * =========================
     */
    public function show($id)
    {
        $data = $this->supabase()->get(
            rtrim(env('SUPABASE_URL'), '/') . '/rest/v1/publikasi',
            [
                'select'       => '*',
                'publikasi_id' => 'eq.' . $id,
                'kategori'     => 'in.(artikel,alinea,ragam,lensa)',
                'status'       => 'eq.terbit',
                'limit'        => 1,
            ]
        )->throw()->json();

        abort_if(empty($data), 404);

        $item = $data[0];
        $item['gambar_url'] = $this->artikelImageUrl($item['gambar'] ?? null);

        return view('user.artikel.show', compact('item'));
    }
}
