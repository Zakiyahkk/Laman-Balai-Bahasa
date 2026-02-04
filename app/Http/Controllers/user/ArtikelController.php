<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArtikelController extends Controller
{
    /**
     * Gambar artikel / alinea / ragam / lensa
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
     * =========================
     */
    public function index(Request $request)
    {
        $q = trim((string) $request->get('q', ''));

        $items = DB::table('publikasi')
            ->whereIn('kategori', ['artikel', 'alinea', 'ragam', 'lensa'])
            ->where('status', 'terbit')
            ->when($q !== '', function ($query) use ($q) {
                $query->where('judul', 'like', '%' . $q . '%');
            })
            ->orderByDesc('tanggal')
            ->orderByDesc('publikasi_id')
            ->get()
            ->map(function ($item) {
                $item->gambar_url = $this->artikelImageUrl($item->gambar ?? null);
                return $item;
            });

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
    public function show($slug)
{
    $sessionKey = 'artikel_read_' . $slug;

    // ðŸ”¥ tambah pembaca (1x per session)
    if (!session()->has($sessionKey)) {
        DB::table('publikasi')
            ->where('slug', $slug)
            ->increment('pembaca');

        session()->put($sessionKey, true);
    }

    $item = DB::table('publikasi')
        ->where('slug', $slug)
        ->whereIn('kategori', ['artikel', 'alinea', 'ragam', 'lensa'])
        ->where('status', 'terbit')
        ->first();

    abort_if(!$item, 404);

    $item->gambar_url = $this->artikelImageUrl($item->gambar ?? null);

    return view('user.artikel.show', compact('item'));
}

}
