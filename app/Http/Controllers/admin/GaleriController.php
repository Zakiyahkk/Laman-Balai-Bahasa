<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    /**
     * Menampilkan daftar galeri
     */
    public function index(Request $request)
    {
        // ================= DATA DUMMY =================
        $data = collect([
            (object)[
                'id'         => 1,
                'judul'      => 'Seminar Bahasa Indonesia 2024',
                'kategori'   => 'kegiatan',
                'tipe'       => 'foto',
                'file_media' => [
                    'https://picsum.photos/800/500?1',
                    'https://picsum.photos/800/200?11',
                    'https://picsum.photos/800/600?111'
                ],
                'ukuran'     => '2.4 MB',
                'created_at' => '2024-12-10'
            ],
            (object)[
                'id'         => 2,
                'judul'      => 'Majalah Serindit Kebanggaan Riau',
                'kategori'   => 'publikasi',
                'tipe'       => 'foto',
                'file_media' => [
                    'https://picsum.photos/800/600?8',
                    'https://picsum.photos/500/600?11',
                    'https://picsum.photos/800/601?331'
                ],
                'ukuran'     => '2.4 MB',
                'created_at' => '2024-12-10'
            ],
            (object)[
                'id'         => 3,
                'judul'      => 'Pelaksanaan Rapat dengan Gubernur Riau',
                'kategori'   => 'dokumentasi',
                'tipe'       => 'video',
                'file_media' => [
                    'https://picsum.photos/500/600?1',
                    'https://picsum.photos/700/600?31',
                    'https://picsum.photos/800/602?121'
                ],
                'ukuran'     => '15.4 MB',
                'created_at' => '2024-11-10'
            ],
        ]);

        // ================= FILTER =================
        $galeri = $data
            ->when($request->kategori, function ($collection, $kategori) {
                return $collection->where('kategori', strtolower($kategori));
            })
            ->when($request->tipe, function ($collection, $tipe) {
                return $collection->where('tipe', strtolower($tipe));
            })
            ->when($request->search, function ($collection, $search) {
                return $collection->filter(function ($item) use ($search) {
                    return stripos($item->judul, $search) !== false;
                });
            })
            ->map(function ($item) {
                // ================= NORMALISASI DATA =================
                // Simpan semua media
                $item->file_media_all = $item->file_media;

                // Thumbnail untuk grid (STRING)
                $item->file_media = is_array($item->file_media)
                    ? $item->file_media[0]
                    : $item->file_media;

                return $item;
            });

        return view('admin.galeri.index', compact('galeri'));
    }

    /**
     * Form tambah galeri
     */
    public function create()
    {
        return view('admin.galeri.create');
    }

    /**
     * Simpan galeri (simulasi)
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul'   => 'required|string|max:255',
            'files'   => 'required|array|max:10',
            'files.*' => 'file|mimes:jpg,jpeg,png,mp4,mov,avi|max:51200',
            'kategori'=> 'required',
        ]);

        return redirect()
            ->route('admin.galeri.index')
            ->with('success', 'Simulasi: Media berhasil diunggah!');
    }

    /**
     * Detail galeri
     */
    public function show($id)
    {
        $is_video = ($id % 2 === 0);

        $galeri = (object)[
            'id'         => $id,
            'judul'      => 'Detail Media ' . $id,
            'kategori'   => 'kegiatan',
            'tipe'       => $is_video ? 'video' : 'foto',
            'file_media' => $is_video
                ? 'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/BigBuckBunny.mp4'
                : 'https://picsum.photos/800/600?' . $id,
            'created_at' => now()->format('d M Y')
        ];

        return view('admin.galeri.show', compact('galeri'));
    }

    /**
     * Form edit galeri
     */
    public function edit($id)
    {
        $item = (object)[
            'id'         => $id,
            'judul'      => 'Seminar Bahasa Indonesia 2024',
            'kategori'   => 'kegiatan',
            'tipe'       => 'foto',
            'file_media' => 'https://picsum.photos/400/300?1',
        ];

        return view('admin.galeri.edit', compact('item'));
    }

    /**
     * Update galeri (simulasi)
     */
    public function update(Request $request, $id)
    {
        return redirect()
            ->route('admin.galeri.index')
            ->with('success', 'Simulasi: Detail diperbarui!');
    }

    /**
     * Hapus galeri (simulasi)
     */
    public function destroy($id)
    {
        return redirect()
            ->route('admin.galeri.index')
            ->with('success', 'Simulasi: Media dihapus!');
    }
}
