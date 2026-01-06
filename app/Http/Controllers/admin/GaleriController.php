<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\Models\Galeri; // Kita komentari agar tidak memicu koneksi database
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    /**
     * 1. Menampilkan daftar galeri (DATA DUMMY)
     * Tanpa memanggil database sehingga tidak akan error 500
     */
   public function index(Request $request)
{
    // 1. Data Dummy Lengkap dengan Ukuran File
    $data = collect([
        (object)[
            'id' => 1, 'judul' => 'Seminar Bahasa Indonesia 2024', 'kategori' => 'kegiatan', 
            'tipe' => 'foto', 'file_media' => 'https://picsum.photos/400/300?1', 
            'ukuran' => '2.4 MB', 'created_at' => '2024-12-10'
        ],
        (object)[
            'id' => 2, 'judul' => 'Lomba Menulis Cerpen', 'kategori' => 'kegiatan', 
            'tipe' => 'video', 'file_media' => '#', 'thumbnail' => 'https://picsum.photos/400/300?2',
            'ukuran' => '45 MB', 'created_at' => '2024-12-05'
        ],
        (object)[
            'id' => 3, 'judul' => 'Poster Publikasi Acara', 'kategori' => 'publikasi', 
            'tipe' => 'foto', 'file_media' => 'https://picsum.photos/400/300?3', 
            'ukuran' => '1.8 MB', 'created_at' => '2024-12-08'
        ],
    ]);

    // 2. Simulasi Filter (Hanya bermain dengan Collection)
    $galeri = $data;

    if ($request->has('kategori') && $request->kategori != 'Tipe Kategori') {
        $galeri = $galeri->where('kategori', $request->kategori);
    }

    if ($request->has('tipe') && $request->tipe != 'Tipe File') {
        $galeri = $galeri->where('tipe', $request->tipe);
    }

    if ($request->has('search')) {
        $galeri = $galeri->filter(function($item) use ($request) {
            return stripos($item->judul, $request->search) !== false;
        });
    }

    return view('admin.galeri.index', compact('galeri'));
}
    // 2. Menampilkan form upload (Tetap sama karena hanya View)
    public function create()
    {
        return view('admin.galeri.create');
    }

    /**
     * 3. Proses Simpan (DI-BYPASS)
     * Hanya melakukan validasi dan upload file, tapi TIDAK simpan ke DB
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul'   => 'required|string|max:255',
            'files'   => 'required|array|max:10',
            'files.*' => 'file|mimes:jpg,jpeg,png,mp4,mov,avi|max:51200',
            'kategori'=> 'required',
        ]);

        // Simulasi berhasil tanpa simpan ke database
        return redirect()->route('admin.galeri.index')->with('success', 'Simulasi: Media berhasil diunggah (Data tidak masuk database)!');
    }

    /**
     * 4. Menampilkan Detail (DATA DUMMY)
     */
    public function show($id)
{
    // Simulasi: Jika ID genap jadi Video, jika ganjil jadi Foto
    $is_video = ($id % 2 == 0); 

    $galeri = (object) [
        'id'         => $id,
        'judul'      => 'Seminar Bahasa Indonesia 2024',
        'file_media' => $is_video 
                        ? 'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/BigBuckBunny.mp4' 
                        : 'https://images.unsplash.com/photo-1540575861501-7c0011e7458d?q=80&w=1000',
        'kategori'   => 'Kegiatan',
        'tipe'       => $is_video ? 'video' : 'foto',
        'created_at' => now()->format('d M Y')
    ];
    (object)[
        'id' => 2,
        'judul' => 'Lomba Menulis Cerpen',
        'kategori' => 'kegiatan',
        'tipe' => 'video',
        'file_media' => 'video_url_disini',
        'thumbnail' => 'https://picsum.photos/400/300?2', // INI UNTUK GAMBAR VIDEO
        'created_at' => '2024-12-05'
    ];
    

    return view('admin.galeri.show', compact('galeri'));
}
    public function edit($id)
{
    // Simulasi mencari data berdasarkan ID yang diklik
    // Di dunia nyata, ini nanti pakai: $item = Galeri::findOrFail($id);
    $item = (object)[
        'id' => $id,
        'judul' => 'Seminar Bahasa Indonesia 2024', // Ini contoh data yang akan muncul di form
        'kategori' => 'kegiatan',
        'tipe' => 'foto',
        'file_media' => 'https://picsum.photos/400/300?1',
    ];

    return view('admin.galeri.show', compact('item'));
}

    // 5. Update (Hanya simulasi)
    public function update(Request $request, $id)
    {
        return redirect()->route('admin.galeri.index')->with('success', 'Simulasi: Detail media diperbarui!');
    }

    // 6. Hapus (Hanya simulasi)
    public function destroy($id)
    {
        return redirect()->route('admin.galeri.index')->with('success', 'Simulasi: Media berhasil dihapus!');
    }
}


