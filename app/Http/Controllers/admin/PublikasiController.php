<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PublikasiController extends Controller
{
   public function index(Request $request)
{
    $query = DB::table('publikasi')
        ->orderBy('publikasi_id', 'desc');

    // 🔎 Filter teks search (case-insensitive untuk MariaDB)
    if ($request->filled('search')) {
        $q = strtolower($request->search);

        $query->where(function ($dbq) use ($q) {
            $dbq->whereRaw('LOWER(judul) LIKE ?', ["%{$q}%"])
                ->orWhereRaw('LOWER(penulis) LIKE ?', ["%{$q}%"])
                ->orWhereRaw('LOWER(isi) LIKE ?', ["%{$q}%"]);
        });
    }

    // 🏷️ Filter kategori
    if ($request->filled('kategori')) {
        $query->where('kategori', $request->kategori);
    }

    $list = $query->get();
    $total = $list->count();

    return view('admin.publikasi.index', compact('list', 'total'));
}


    public function create()
    {
        return view('admin.publikasi.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'tanggal'  => 'nullable|date',
        'kategori' => 'required|string',
        'judul'    => 'required|string',
        'penulis'  => 'required|string',
        'isi'      => 'nullable|string',
        'gambar'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'file'     => 'nullable|mimes:pdf,doc,docx,xls,xlsx,zip,rar|max:5120'
    ]);

    $gambarPath = null;
    $filePath   = null;
    $fileType   = null;

    // ===== UPLOAD GAMBAR =====
   if ($request->hasFile('gambar')) {
        $gambarPath = $this->uploadGambarPublikasi(
            $request->file('gambar')
        );
    }


    // ===== UPLOAD FILE =====
    if ($request->hasFile('file')) {
        $file = $request->file('file');
        $namaFile = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
        $file->move(public_path('img/publikasi'), $namaFile);
        $filePath = 'img/publikasi/'.$namaFile;
        $fileType = $file->getClientOriginalExtension();
    }

    // Tambahkan Limit PHP untuk handle upload besar / teks panjang
    ini_set('memory_limit', '512M');
    ini_set('max_execution_time', 300); // 5 menit

    try {
        $id = DB::table('publikasi')->insertGetId([
            'judul'     => $request->judul,
            'tanggal'   => $request->tanggal,
            'kategori'  => $request->kategori,
            'penulis'   => $request->penulis,
            'isi' => $request->isi,
            'email'     => Session::get('admin_email'),
            'gambar'    => $gambarPath,
            'file'      => $filePath,
            'file_type' => $fileType,
            'status'    => 'draf',
            'pembaca'   => 0,
            'slug' => Str::slug($request->judul) . '-' . time(),
            'allow_download' => $request->has('allow_download') ? 1 : 0,
        ]); // Hapus parameter sequence 'publikasi_id' karena biasanya auto-detect di MySQL

        return redirect()->route('admin.publikasi.show', $id)
            ->with('success', 'Publikasi berhasil disimpan');

    } catch (\Exception $e) {
        Log::error('Gagal Simpan Publikasi: ' . $e->getMessage());
        return back()->withInput()->with('error', 'Gagal menyimpan: ' . $e->getMessage());
    }
}

    public function show($id)
    {
        $data = DB::table('publikasi')
            ->where('publikasi_id', $id)
            ->first();

        if (!$data) abort(404);

        return view('admin.publikasi.show', compact('data'));
    }

    public function edit($id)
    {
        $data = DB::table('publikasi')->where('publikasi_id', $id)->first();
        if (!$data) abort(404, 'Data publikasi tidak ditemukan.');

        return view('admin.publikasi.edit', compact('data'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'tanggal'  => 'nullable|date',
        'kategori' => 'required|string',
        'judul'    => 'required|string',
        'penulis'  => 'required|string',
        'isi'      => 'nullable|string',
        'gambar'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'file'     => 'nullable|mimes:pdf,doc,docx,xls,xlsx,zip,rar|max:5120'
    ]);

    $data = DB::table('publikasi')->where('publikasi_id', $id)->first();
    if (!$data) abort(404);
    
    // =======================
    // 🔥 LOGIKA SLUG (WAJIB)
    // =======================
    $slug = $data->slug;
    
    // jika judul diubah → slug ikut berubah
    if ($data->judul !== $request->judul) {
        $slug = Str::slug($request->judul) . '-' . time();
    }

    $gambarPath = $data->gambar;
    $filePath   = $data->file;
    $fileType   = $data->file_type;

    // ... (kode upload gambar/file tetap sama, saya skip tampilkan disini untuk hemat token) ...
    // ===== HAPUS GAMBAR =====
    if ($request->remove_image == 1 && $data->gambar) {
        $old = '/home/aajxwzdj/public_html/bbpr/' . $data->gambar;
        if (file_exists($old)) {
            unlink($old);
        }
        $gambarPath = null;
    }


    // ===== GANTI GAMBAR =====
    if ($request->hasFile('gambar')) {
    
        // hapus gambar lama di public_html
        if ($data->gambar) {
            $old = '/home/aajxwzdj/public_html/bbpr/' . $data->gambar;
            if (file_exists($old)) {
                unlink($old);
            }
        }
    
        // upload gambar baru (PAKAI HELPER)
        $gambarPath = $this->uploadGambarPublikasi(
            $request->file('gambar')
        );
    }


    // ===== HAPUS FILE =====
    if ($request->remove_file == 1 && $data->file) {
        if (file_exists(public_path($data->file))) {
            unlink(public_path($data->file));
        }
        $filePath = null;
        $fileType = null;
    }

    // ===== GANTI FILE =====
    if ($request->hasFile('file')) {
        if ($data->file && file_exists(public_path($data->file))) {
            unlink(public_path($data->file));
        }

        $file = $request->file('file');
        $namaFile = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
        $file->move(public_path('img/publikasi'), $namaFile);
        $filePath = 'img/publikasi/'.$namaFile;
        $fileType = $file->getClientOriginalExtension();
    }

    DB::table('publikasi')->where('publikasi_id', $id)->update([
        'tanggal'   => $request->tanggal,
        'kategori'  => $request->kategori,
        'judul'     => $request->judul,
        'slug'      => $slug,
        'penulis'   => $request->penulis,
        'isi' => $request->isi,
        'gambar'    => $gambarPath,
        'file'      => $filePath,
        'file_type' => $fileType,
        'allow_download' => $request->has('allow_download') ? 1 : 0,
    ]);

    return redirect()->route('admin.publikasi.show', $id)
        ->with('success', 'Publikasi berhasil diperbarui');
}

    public function destroy($id)
{
    $data = DB::table('publikasi')->where('publikasi_id', $id)->first();
    if (!$data) abort(404);

    if ($data->gambar) {
        $file = '/home/aajxwzdj/public_html/bbpr/' . $data->gambar;
        if (file_exists($file)) {
            unlink($file);
        }
    }

    if ($data->file && file_exists(public_path($data->file))) {
        unlink(public_path($data->file));
    }

    DB::table('publikasi')->where('publikasi_id', $id)->delete();

    return back()->with('success', 'Publikasi berhasil dihapus');
}

    public function download($id)
{
    $data = DB::table('publikasi')->where('publikasi_id', $id)->first();
    if (!$data || !$data->file) abort(404);

    return response()->download(public_path($data->file));
}

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:draf,terbit'
        ]);

        try {
            DB::table('publikasi')->where('publikasi_id', $id)->update([
                'status' => $request->status
            ]);

            if ($request->status === 'terbit') {
                return redirect()->route('admin.publikasi')
                    ->with('success', 'Publikasi berhasil diterbitkan.');
            }

            return redirect()->route('admin.publikasi')
                ->with('success', 'Publikasi berhasil disimpan ke draf.');

        } catch (\Exception $e) {
            return redirect()->route('admin.publikasi.show', $id)
                ->with('error', 'Terjadi kesalahan pada database saat update status.');
        }
}

private function uploadGambarPublikasi($file)
{
    // 1️⃣ simpan ke public Laravel
    $laravelPath = public_path('img/publikasi');

    if (!is_dir($laravelPath)) {
        mkdir($laravelPath, 0755, true);
    }

    if (!is_writable($laravelPath)) {
        abort(500, 'Folder Laravel img/publikasi tidak bisa ditulis');
    }

    $name = Str::uuid() . '.' . $file->getClientOriginalExtension();
    $file->move($laravelPath, $name);

    // 2️⃣ copy ke public_html (WEB ROOT)
    $targetPath = '/home/aajxwzdj/public_html/bbpr/img/publikasi';

    if (!is_dir($targetPath)) {
        mkdir($targetPath, 0755, true);
    }

    if (!is_writable($targetPath)) {
        abort(500, 'Folder public_html img/publikasi tidak bisa ditulis');
    }

    copy(
        $laravelPath . '/' . $name,
        $targetPath . '/' . $name
    );

    // 3️⃣ simpan path relatif ke database
    return 'img/publikasi/' . $name;
}


}
