<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BerandaController extends Controller
{
    /**
     * Client Supabase
     */
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

        // ðŸ”¥ BUANG SEMUA PREFIX PATH
        $value = preg_replace(
            '#^(public/|/public/|img/publikasi/|/img/publikasi/|publikasi/|/publikasi/)#',
            '',
            $value
        );

        return asset('img/publikasi/' . $value);
    }

    private function publicLocalImage(?string $gambar): string
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
     * ðŸ”¥ KHUSUS BERITA
     * Ambil gambar dari public Laravel (public/img/...)
     */
    private function beritaImageUrl(?string $gambar): string
    {
        if (!$gambar) {
            return asset('img/default.jpg');
        }

        // kalau sudah URL
        if (preg_match('/^https?:\/\//i', $gambar)) {
            return $gambar;
        }

        // path relatif ke folder public
        return asset(ltrim($gambar, '/'));
    }

    /**
     * Untuk ARTIKEL / ALINEA / PENGUMUMAN (Supabase Storage)
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
     * File pengumuman (PDF, dll)
     */
    private function publicFileUrl(?string $file): ?string
    {
        if (!$file) return null;

        if (preg_match('/^https?:\/\//i', $file)) return $file;

        return rtrim(env('SUPABASE_URL'), '/')
            . '/storage/v1/object/public/file/'
            . ltrim($file, '/');
    }

    /**
     * BERANDA DASHBOARD
     */
    public function dashboard()
    {
        // ===============================
        // CATAT PENGUNJUNG (WAJIB ADA)
        // ===============================
        // Bagian ini tetap di sini untuk MEREKAM data saat user membuka beranda.
        // Tapi untuk MENAMPILKAN data, sudah dihandle AppServiceProvider.
        $ip = request()->ip();
        $today = Carbon::today()->toDateString();
        
        DB::table('visitor_stats')->updateOrInsert(
            [
                'ip_address' => $ip,
                'visit_date' => $today,
            ],
            [
                'created_at' => now()
            ]
        );

        // ==================================================
        // 1) BERITA TERBARU (MYSQL)
        // ==================================================
        $berita = DB::table('publikasi')
            ->select(
                'publikasi_id',
                'judul',
                'tanggal',
                'penulis',
                'gambar',
                'isi',
                'pembaca',
                'slug'
            )
            ->where('kategori', 'berita')
            ->where('status', 'terbit')
            ->orderByDesc('tanggal')
            ->orderByDesc('publikasi_id')
            ->limit(4)
            ->get()
            ->map(function ($row) {
                return (object) [
                    'publikasi_id' => $row->publikasi_id,
                    'slug'         => $row->slug, 
                    'judul'        => $row->judul,
                    'tanggal'      => $row->tanggal,
                    'penulis'      => $row->penulis,
                    'isi'          => $row->isi,
                    'pembaca'      => $row->pembaca ?? 0,
                    'gambar_url'   => $this->beritaImageUrl($row->gambar),
                ];
            });


        // ==================================================
        // 2) ARTIKEL TERBARU (MYSQL)
        // ==================================================
        $kontenTerbaru = DB::table('publikasi')
            ->select(
                'publikasi_id',
                'judul',
                'tanggal',
                'penulis',
                'gambar',
                'isi',
                'pembaca',
                'kategori',
                'slug'
            )
            ->whereIn('kategori', ['artikel', 'alinea', 'ragam', 'lensa'])
            ->where('status', 'terbit')
            ->orderByDesc('tanggal')
            ->orderByDesc('publikasi_id')
            ->limit(12)
            ->get()
            ->map(function ($row) {
                return (object) [
                    'publikasi_id' => $row->publikasi_id,
                    'slug'         => $row->slug, 
                    'judul'        => $row->judul,
                    'tanggal'      => $row->tanggal,
                    'penulis'      => $row->penulis,
                    'isi'          => $row->isi,
                    'kategori'     => $row->kategori,
                    'pembaca'      => $row->pembaca ?? 0,
                    'gambar_url'   => $this->publicLocalImage($row->gambar),
                ];
            });


        // ==================================================
        // 3) PENGUMUMAN TERBARU (MYSQL)
        // ==================================================
        $items = DB::table('publikasi')
            ->select('publikasi_id', 'judul', 'tanggal', 'file', 'gambar', 'slug')
            ->where('kategori', 'pengumuman')
            ->where('status', 'terbit')
            ->orderByDesc('tanggal')
            ->orderByDesc('publikasi_id')
            ->limit(3)
            ->get()
            ->map(function ($row) {
        
                $type = !empty($row->file) ? 'pdf' : 'image';
        
                return (object) [
                    'publikasi_id' => $row->publikasi_id,
                    'slug'         => $row->slug, 
                    'judul'        => $row->judul,
                    'tanggal'      => $row->tanggal,
                    'type'         => $type,
                    'file_url'     => $this->publikasiUrl($row->file),
                    'gambar_url'   => $this->publikasiUrl($row->gambar),
                ];
            });

        // ==================================================
        // 4) TOKOH BAHASA & SASTRA (MYSQL)
        // ==================================================
        $tokoh = DB::table('tokoh')
            ->select(
                'tokoh_id',
                'nama',
                'foto_tokoh',
                'deskripsi',
                'kategori'
            )
            ->where('kategori', 'Tokoh Bahasa dan Sastra')
            ->orderByDesc('tokoh_id')
            ->limit(8)
            ->get()
            ->map(function ($row) {
                return (object) [
                    'tokoh_id'  => $row->tokoh_id,
                    'nama'      => $row->nama,
                    'deskripsi' => $row->deskripsi,
                    'kategori'  => $row->kategori,
                    'foto_url'  => $row->foto_tokoh
                        ? asset(ltrim($row->foto_tokoh, '/'))
                        : asset('img/default-user.png'),
                ];
            });


        // ==================================================
        // 5) TOKOH SASTRA LISAN (MYSQL)
        // ==================================================
        $tokohSastra = DB::table('tokoh')
            ->select(
                'tokoh_id',
                'nama',
                'foto_tokoh',
                'deskripsi',
                'kategori'
            )
            ->where('kategori', 'LIKE', '%Sastra Lisan%')
            ->orderByDesc('tokoh_id')
            ->limit(8)
            ->get()
            ->map(function ($row) {
                return (object) [
                    'nama'      => $row->nama,
                    'deskripsi' => $row->deskripsi,
                    'kategori'  => $row->kategori,
                    'foto_url'  => $row->foto_tokoh
                        ? asset(ltrim($row->foto_tokoh, '/'))
                        : asset('img/default-user.png'),
                ];
            });


        // ==================================================
        // 6) KOMUNITAS LITERASI (MYSQL)
        // ==================================================
        $komunitasLiterasi = DB::table('tokoh')
            ->select(
                'tokoh_id',
                'nama',
                'foto_tokoh',
                'deskripsi',
                'kategori'
            )
            ->where('kategori', 'Komunitas Literasi')
            ->orderByDesc('tokoh_id')
            ->limit(8)
            ->get()
            ->map(function ($row) {
                return (object) [
                    'nama'      => $row->nama,
                    'deskripsi' => $row->deskripsi,
                    'kategori'  => $row->kategori,
                    'foto_url'  => $row->foto_tokoh
                        ? asset(ltrim($row->foto_tokoh, '/'))
                        : asset('img/default-user.png'),
                ];
            });

        
        // ==================================================
        // 7) KOMUNITAS SASTRA (MYSQL)
        // ==================================================
        $komunitasSastra = DB::table('tokoh')
            ->select(
                'tokoh_id',
                'nama',
                'foto_tokoh',
                'deskripsi',
                'kategori'
            )
            ->where('kategori', 'Komunitas Sastra')
            ->orderByDesc('tokoh_id')
            ->limit(8)
            ->get()
            ->map(function ($row) {
                return (object) [
                    'nama'      => $row->nama,
                    'deskripsi' => $row->deskripsi,
                    'kategori'  => $row->kategori,
                    'foto_url'  => $row->foto_tokoh
                        ? asset(ltrim($row->foto_tokoh, '/'))
                        : asset('img/default-user.png'),
                ];
            });
    
        // ==================================================
        // RETURN VIEW
        // ==================================================
        return view('user.beranda.dashboard', compact(
            'berita',
            'kontenTerbaru',
            'items',
            'tokoh',
            'tokohSastra',
            'komunitasLiterasi',
            'komunitasSastra'
        ));
    }
}