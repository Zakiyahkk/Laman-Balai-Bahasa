<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Artikel;

class ArtikelController extends Controller
{
    /**
     * Halaman daftar semua artikel
     */
    public function index(Request $request)
    {
        $q = $request->get('q');

        $articles = Artikel::query()
            ->when($q, function ($query) use ($q) {
                $query->where('title', 'like', "%{$q}%");
            })
            ->orderByDesc('created_at')
            ->paginate(12)
            ->withQueryString();

        return view('user.artikel.index', compact('articles', 'q'));
    }

    /**
     * Halaman detail artikel (berdasarkan slug)
     */
    public function show($slug)
    {
        $article = Artikel::where('slug', $slug)->firstOrFail();

        // Naikkan view counter (opsional)
        // Pastikan ada kolom `views` di tabel
        if (schema_has_column('artikels', 'views')) {
            $article->increment('views');
        } else {
            // kalau tabel kamu bukan "artikels" / tidak ada kolom views, aman diabaikan
            // atau hapus bagian ini
        }

        return view('user.artikel.show', compact('article'));
    }

    /**
     * Untuk section "Artikel Terbaru" di Beranda
     * (kalau kamu butuh route khusus untuk AJAX/partial, opsional)
     */
    public function terbaru()
    {
        $articles = Artikel::orderByDesc('created_at')->take(6)->get();

        return view('user.beranda.artikel', compact('articles'));
    }
}

/**
 * Helper kecil untuk cek kolom (biar gak error kalau kolom/tabel beda)
 */
if (!function_exists('schema_has_column')) {
    function schema_has_column($table, $column): bool
    {
        try {
            return \Illuminate\Support\Facades\Schema::hasColumn($table, $column);
        } catch (\Throwable $e) {
            return false;
        }
    }
}
