<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

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
    }/**
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
     * 🔥 KHUSUS BERITA
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
     * BERANDA
     */
    public function dashboard()
    {
        $basePublikasi = rtrim(env('SUPABASE_URL'), '/') . '/rest/v1/publikasi';

        // ==================================================
        // 1) BERITA TERBARU (GAMBAR DARI PUBLIC LARAVEL)
        // ==================================================
        $berita = $this->supabase()->get($basePublikasi, [
            'select'   => 'publikasi_id,judul,tanggal,penulis,gambar,isi,pembaca,status,kategori,created_at',
            'kategori' => 'eq.berita',
            'status'   => 'eq.terbit',
            'order'    => 'tanggal.desc,created_at.desc,publikasi_id.desc',
            'limit'    => 4,
        ])->throw()->json();

        $berita = array_map(function ($row) {
            $row['gambar_url'] = $this->beritaImageUrl($row['gambar'] ?? null);
            return $row;
        }, $berita);

        // ==================================================
        // 2) ARTIKEL + (SUPABASE STORAGE)
        // ==================================================
        $kontenTerbaru = $this->supabase()->get($basePublikasi, [
            'select'   => 'publikasi_id,judul,tanggal,penulis,gambar,isi,pembaca,status,kategori,created_at',
            'kategori' => 'in.(artikel,alinea,ragam,lensa)',
            'status'   => 'eq.terbit',
            'order'    => 'tanggal.desc,created_at.desc,publikasi_id.desc',
            'limit'    => 12,
        ])->throw()->json();
        
        $kontenTerbaru = array_map(function ($row) {
            $row['gambar_url'] = $this->publicLocalImage($row['gambar'] ?? null);
            return $row;
        }, $kontenTerbaru);
        // ==================================================
        // 3) PENGUMUMAN TERBARU
        // ==================================================
        $pengumumanRaw = $this->supabase()->get($basePublikasi, [
            'select'   => 'publikasi_id,judul,tanggal,file,gambar,status,kategori,created_at',
            'kategori' => 'eq.pengumuman',
            'status'   => 'eq.terbit',
            'order'    => 'tanggal.desc,created_at.desc,publikasi_id.desc',
            'limit'    => 3,
        ])->throw()->json();
        
        $items = array_map(function ($row) {
        
            // tentukan tipe dokumen
            $type = !empty($row['file']) ? 'pdf' : 'image';
        
            return [
                'publikasi_id' => $row['publikasi_id'],
                'judul'        => $row['judul'],
                'tanggal'      => $row['tanggal'],
                'type'         => $type,
        
                // 🔥 PATH BENAR (SESUIAI STRUKTUR FOLDER)
                'file_url'   => $this->publikasiUrl($row['file'] ?? null),
                'gambar_url' => $this->publikasiUrl($row['gambar'] ?? null),
            ];
        }, $pengumumanRaw);
        
       // ==================================================
// 4) TOKOH BAHASA & SASTRA
// ==================================================
$baseTokoh = rtrim(env('SUPABASE_URL'), '/') . '/rest/v1/tokoh';

$tokoh = $this->supabase()->get($baseTokoh, [
    'select'   => 'tokoh_id,nama,foto_tokoh,deskripsi,kategori,created_at',
    'kategori' => 'eq.Tokoh Bahasa dan Sastra',
    'order'    => 'created_at.desc',
    'limit'    => 8,
])->throw()->json();

$tokoh = array_map(function ($row) {
    $row['foto_url'] = $row['foto_tokoh']
        ? asset(ltrim($row['foto_tokoh'], '/'))
        : asset('img/default-user.png');
    return $row;
}, $tokoh);


// ==================================================
// 5) TOKOH SASTRA LISAN (MAHKOTA KALAM) - FIX FINAL
// ==================================================
$tokohSastra = $this->supabase()->get($baseTokoh, [
    'select'   => 'tokoh_id,nama,foto_tokoh,deskripsi,kategori,created_at',
    'kategori' => 'ilike.*Sastra Lisan*',
    'order'    => 'created_at.desc',
])->throw()->json();

$tokohSastra = array_map(function ($row) {
    return [
        'nama'      => $row['nama'],
        'deskripsi' => $row['deskripsi'],
        'kategori'  => $row['kategori'],
        'foto_url'  => $row['foto_tokoh']
            ? asset(ltrim($row['foto_tokoh'], '/'))
            : asset('img/default-user.png'),
    ];
}, $tokohSastra);

// ==================================================
// KOMUNITAS LITERASI
// ==================================================
$komunitasLiterasi = $this->supabase()->get($baseTokoh, [
    'select'   => 'tokoh_id,nama,foto_tokoh,deskripsi,kategori,created_at',
    'kategori' => 'eq.Komunitas Literasi',
    'order'    => 'created_at.desc',
])->throw()->json();

$komunitasLiterasi = array_map(function ($row) {
    return [
        'nama'      => $row['nama'],
        'deskripsi' => $row['deskripsi'],
        'kategori'  => $row['kategori'],
        'foto_url'  => $row['foto_tokoh']
            ? asset(ltrim($row['foto_tokoh'], '/'))
            : asset('img/default-user.png'),
    ];
}, $komunitasLiterasi);

// ==================================================
// KOMUNITAS SASTRA
// ==================================================
$komunitasSastra = $this->supabase()->get($baseTokoh, [
    'select'   => 'tokoh_id,nama,foto_tokoh,deskripsi,kategori,created_at',
    'kategori' => 'eq.Komunitas Sastra',
    'order'    => 'created_at.desc',
])->throw()->json();

$komunitasSastra = array_map(function ($row) {
    return [
        'nama'      => $row['nama'],
        'deskripsi' => $row['deskripsi'],
        'kategori'  => $row['kategori'],
        'foto_url'  => $row['foto_tokoh']
            ? asset(ltrim($row['foto_tokoh'], '/'))
            : asset('img/default-user.png'),
    ];
}, $komunitasSastra);
    
        
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
