<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PublikasiController extends Controller
{
    public function index(Request $request)
{
    $query = DB::table('publikasi')
        ->orderBy('publikasi_id', 'desc');

    // Filter teks search (sudah ada, kita pertahankan)
    if ($request->filled('search')) {
        $q = $request->search;
        $query->where(function($dbq) use ($q) {
            $dbq->where('judul', 'ILIKE', "%$q%")
                ->orWhere('penulis', 'ILIKE', "%$q%")
                ->orWhere('isi', 'ILIKE', "%$q%");
        });
    }

    // Filter kategori (baru kita tambahkan)
    if ($request->filled('kategori')) {
        $query->where('kategori', '=', $request->kategori);
    }

    $list = $query->get();
    $total = $list->count();

    return view('admin.publikasi.index', compact('list','total'));
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
        $gambar = $request->file('gambar');
        $namaGambar = time().'_'.uniqid().'.'.$gambar->getClientOriginalExtension();
        $gambar->move(public_path('img/publikasi'), $namaGambar);
        $gambarPath = 'img/publikasi/'.$namaGambar;
    }

    // ===== UPLOAD FILE =====
    if ($request->hasFile('file')) {
        $file = $request->file('file');
        $namaFile = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
        $file->move(public_path('img/publikasi'), $namaFile);
        $filePath = 'img/publikasi/'.$namaFile;
        $fileType = $file->getClientOriginalExtension();
    }

    $id = DB::table('publikasi')->insertGetId(
    [
        'tanggal'   => $request->tanggal,
        'kategori'  => $request->kategori,
        'judul'     => $request->judul,
        'penulis'   => $request->penulis,
        'isi'       => $request->isi,
        'email'     => Session::get('admin_email'),
        'gambar'    => $gambarPath,
        'file'      => $filePath,
        'file_type' => $fileType,
        'status'    => 'draf',
        'pembaca'   => 0,
        'allow_download' => $request->has('allow_download') ? 1 : 0,
    ],
    'publikasi_id' // ⬅️ INI KUNCINYA
    );

    return redirect()->route('admin.publikasi.show', $id)
        ->with('success', 'Publikasi berhasil disimpan');
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

    $gambarPath = $data->gambar;
    $filePath   = $data->file;
    $fileType   = $data->file_type;

    // ===== HAPUS GAMBAR =====
    if ($request->remove_image == 1 && $data->gambar) {
        if (file_exists(public_path($data->gambar))) {
            unlink(public_path($data->gambar));
        }
        $gambarPath = null;
    }

    // ===== GANTI GAMBAR =====
    if ($request->hasFile('gambar')) {
        if ($data->gambar && file_exists(public_path($data->gambar))) {
            unlink(public_path($data->gambar));
        }

        $gambar = $request->file('gambar');
        $namaGambar = time().'_'.uniqid().'.'.$gambar->getClientOriginalExtension();
        $gambar->move(public_path('img/publikasi'), $namaGambar);
        $gambarPath = 'img/publikasi/'.$namaGambar;
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
        'penulis'   => $request->penulis,
        'isi'       => $request->isi,
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

    if ($data->gambar && file_exists(public_path($data->gambar))) {
        unlink(public_path($data->gambar));
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


}
