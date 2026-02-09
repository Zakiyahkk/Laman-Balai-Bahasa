<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PublikasiController extends Controller
{

    public function index(Request $request)
    {
        $query = DB::table('publikasi')
            ->orderBy('publikasi_id', 'desc');

        if ($request->filled('search')) {
            $q = strtolower($request->search);

            $query->where(function ($dbq) use ($q) {
                $dbq->whereRaw('LOWER(judul) LIKE ?', ["%{$q}%"])
                    ->orWhereRaw('LOWER(penulis) LIKE ?', ["%{$q}%"])
                    ->orWhereRaw('LOWER(isi) LIKE ?', ["%{$q}%"]);
            });
        }

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
            'gambar'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'file'     => 'nullable|mimes:pdf,doc,docx,xls,xlsx,zip,rar|max:5120'
        ]);

        $gambarPath = null;
        $filePath   = null;
        $fileType   = null;

        // ===== UPLOAD GAMBAR =====
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('publikasi', 'public');
        }

        // ===== UPLOAD FILE =====
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filePath = $file->store('publikasi', 'public');
            $fileType = $file->getClientOriginalExtension();
        }

        $id = DB::table('publikasi')->insertGetId([
            'judul'     => $request->judul,
            'tanggal'   => $request->tanggal,
            'kategori'  => $request->kategori,
            'penulis'   => $request->penulis,
            'isi'       => $request->isi,
            'email'     => Session::get('admin_email'),
            'gambar'    => $gambarPath,
            'file'      => $filePath,
            'file_type' => $fileType,
            'status'    => 'draf',
            'pembaca'   => 0,
            'slug'      => Str::slug($request->judul) . '-' . time(),
            'allow_download' => $request->has('allow_download') ? 1 : 0,
        ]);

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
        $data = DB::table('publikasi')
            ->where('publikasi_id', $id)
            ->first();

        if (!$data) {
            abort(404, 'Data publikasi tidak ditemukan.');
        }

        return view('admin.publikasi.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = DB::table('publikasi')->where('publikasi_id', $id)->first();
        if (!$data) abort(404);

        $slug = $data->slug;
        if ($data->judul !== $request->judul) {
            $slug = Str::slug($request->judul) . '-' . time();
        }

        $gambarPath = $data->gambar;
        $filePath   = $data->file;
        $fileType   = $data->file_type;

        // ===== HAPUS GAMBAR =====
        if ($request->remove_image == 1 && $data->gambar) {
            Storage::disk('public')->delete($data->gambar);
            $gambarPath = null;
        }

        // ===== GANTI GAMBAR =====
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($data->gambar) {
                Storage::disk('public')->delete($data->gambar);
            }
            
            $gambarPath = $request->file('gambar')->store('publikasi', 'public');
        }

        // ===== HAPUS FILE =====
        if ($request->remove_file == 1 && $data->file) {
            Storage::disk('public')->delete($data->file);
            $filePath = null;
            $fileType = null;
        }

        // ===== GANTI FILE =====
        if ($request->hasFile('file')) {
            // Hapus file lama jika ada
            if ($data->file) {
                Storage::disk('public')->delete($data->file);
            }
            
            $file = $request->file('file');
            $filePath = $file->store('publikasi', 'public');
            $fileType = $file->getClientOriginalExtension();
        }

        DB::table('publikasi')->where('publikasi_id', $id)->update([
            'tanggal'   => $request->tanggal,
            'kategori'  => $request->kategori,
            'judul'     => $request->judul,
            'slug'      => $slug,
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

        // Hapus file gambar jika ada
        if ($data->gambar) {
            Storage::disk('public')->delete($data->gambar);
        }

        // Hapus file dokumen jika ada
        if ($data->file) {
            Storage::disk('public')->delete($data->file);
        }

        DB::table('publikasi')->where('publikasi_id', $id)->delete();

        return back()->with('success', 'Publikasi berhasil dihapus');
    }

    public function download($id)
    {
        $data = DB::table('publikasi')->where('publikasi_id', $id)->first();
        if (!$data || !$data->file) abort(404);

        $filePath = storage_path('app/public/' . $data->file);

        if (!file_exists($filePath)) abort(404);

        return response()->download($filePath);
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:draf,terbit'
        ]);

        DB::table('publikasi')->where('publikasi_id', $id)->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Status publikasi berhasil diperbarui');
    }


}
