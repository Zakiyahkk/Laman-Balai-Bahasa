<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PublikasiController extends Controller
{
    private $publicHtml = '/home/balaibahasariau/public_html/';

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
            $gambarPath = $this->uploadGambarPublikasi(
                $request->file('gambar')
            );
        }

        // ===== UPLOAD FILE =====
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $namaFile = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();

            $laravelFolder = public_path('img/publikasi');
            if (!is_dir($laravelFolder)) {
                mkdir($laravelFolder, 0755, true);
            }

            $file->move($laravelFolder, $namaFile);

            // copy ke public_html
            $targetFolder = $this->publicHtml . 'img/publikasi';
            if (!is_dir($targetFolder)) {
                mkdir($targetFolder, 0755, true);
            }

            copy(
                $laravelFolder . '/' . $namaFile,
                $targetFolder . '/' . $namaFile
            );

            $filePath = 'img/publikasi/' . $namaFile;
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

            $oldPublicHtml = $this->publicHtml . $data->gambar;
            if (file_exists($oldPublicHtml)) {
                unlink($oldPublicHtml);
            }

            $oldLaravel = public_path($data->gambar);
            if (file_exists($oldLaravel)) {
                unlink($oldLaravel);
            }

            $gambarPath = null;
        }

        // ===== GANTI GAMBAR =====
        if ($request->hasFile('gambar')) {

            if ($data->gambar) {
                $oldPublicHtml = $this->publicHtml . $data->gambar;
                if (file_exists($oldPublicHtml)) {
                    unlink($oldPublicHtml);
                }

                $oldLaravel = public_path($data->gambar);
                if (file_exists($oldLaravel)) {
                    unlink($oldLaravel);
                }
            }

            $gambarPath = $this->uploadGambarPublikasi(
                $request->file('gambar')
            );
        }

        // ===== HAPUS FILE =====
        if ($request->remove_file == 1 && $data->file) {

            $oldPublicHtml = $this->publicHtml . $data->file;
            if (file_exists($oldPublicHtml)) {
                unlink($oldPublicHtml);
            }

            $oldLaravel = public_path($data->file);
            if (file_exists($oldLaravel)) {
                unlink($oldLaravel);
            }

            $filePath = null;
            $fileType = null;
        }

        // ===== GANTI FILE =====
        if ($request->hasFile('file')) {

            if ($data->file) {
                $oldPublicHtml = $this->publicHtml . $data->file;
                if (file_exists($oldPublicHtml)) {
                    unlink($oldPublicHtml);
                }

                $oldLaravel = public_path($data->file);
                if (file_exists($oldLaravel)) {
                    unlink($oldLaravel);
                }
            }

            $file = $request->file('file');
            $namaFile = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();

            $laravelFolder = public_path('img/publikasi');
            if (!is_dir($laravelFolder)) {
                mkdir($laravelFolder, 0755, true);
            }

            $file->move($laravelFolder, $namaFile);

            $targetFolder = $this->publicHtml . 'img/publikasi';
            if (!is_dir($targetFolder)) {
                mkdir($targetFolder, 0755, true);
            }

            copy(
                $laravelFolder . '/' . $namaFile,
                $targetFolder . '/' . $namaFile
            );

            $filePath = 'img/publikasi/' . $namaFile;
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

        if ($data->gambar) {
            $filePublicHtml = $this->publicHtml . $data->gambar;
            if (file_exists($filePublicHtml)) {
                unlink($filePublicHtml);
            }

            $fileLaravel = public_path($data->gambar);
            if (file_exists($fileLaravel)) {
                unlink($fileLaravel);
            }
        }

        if ($data->file) {
            $filePublicHtml = $this->publicHtml . $data->file;
            if (file_exists($filePublicHtml)) {
                unlink($filePublicHtml);
            }

            $fileLaravel = public_path($data->file);
            if (file_exists($fileLaravel)) {
                unlink($fileLaravel);
            }
        }

        DB::table('publikasi')->where('publikasi_id', $id)->delete();

        return back()->with('success', 'Publikasi berhasil dihapus');
    }

    public function download($id)
    {
        $data = DB::table('publikasi')->where('publikasi_id', $id)->first();
        if (!$data || !$data->file) abort(404);

        $file = $this->publicHtml . $data->file;

        if (!file_exists($file)) abort(404);

        return response()->download($file);
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

    private function uploadGambarPublikasi($file)
    {
        $laravelPath = public_path('img/publikasi');

        if (!is_dir($laravelPath)) {
            mkdir($laravelPath, 0755, true);
        }

        $name = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $file->move($laravelPath, $name);

        $targetPath = $this->publicHtml . 'img/publikasi';
        if (!is_dir($targetPath)) {
            mkdir($targetPath, 0755, true);
        }

        copy(
            $laravelPath . '/' . $name,
            $targetPath . '/' . $name
        );

        return 'img/publikasi/' . $name;
    }
}
