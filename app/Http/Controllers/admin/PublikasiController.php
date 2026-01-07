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
        try {
            $request->validate([
                'tanggal'  => 'nullable|date',
                'kategori' => 'required|string',
                'judul'    => 'required|string',
                'penulis'  => 'required|string',
                'isi'      => 'nullable|string',
                'gambar'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                'file'     => 'nullable|mimes:pdf,doc,docx,xls,xlsx,zip,rar|max:5120'
            ]);

            $gambarUrl = null;
            $fileUrl = null;
            $fileType = null;

            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');
                $fileName = time() . '_' . $file->getClientOriginalName();

                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . env('SUPABASE_SERVICE_ROLE_KEY'),
                ])->attach('file', file_get_contents($file), $fileName)
                ->post(env('SUPABASE_URL') . '/storage/v1/object/' . env('SUPABASE_BUCKET') . '/' . $fileName);

                if ($response->failed()) {
                    return back()->with('error', 'Gagal upload gambar ke storage.')->withInput();
                }

                $gambarUrl = env('SUPABASE_URL') . '/storage/v1/object/public/' . env('SUPABASE_BUCKET') . '/' . $fileName;
            }

            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $fileType = $file->getClientOriginalExtension();

                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . env('SUPABASE_SERVICE_ROLE_KEY'),
                ])->attach('file', file_get_contents($file), $fileName)
                ->post(env('SUPABASE_URL') . '/storage/v1/object/' . env('SUPABASE_BUCKET') . '/' . $fileName);

                if ($response->failed()) {
                    return back()->with('error', 'Gagal upload file ke storage.')->withInput();
                }

                $fileUrl = env('SUPABASE_URL') . '/storage/v1/object/public/' . env('SUPABASE_BUCKET') . '/' . $fileName;
            }

            $allowDownload = $request->has('allow_download') ? 1 : 0;

            $id = DB::table('publikasi')->insertGetId([
                'tanggal'   => $request->tanggal,
                'kategori'  => $request->kategori,
                'penulis'   => $request->penulis,
                'judul'     => $request->judul,
                'isi'       => $request->isi,
                'email'     => Session::get('admin_email'),
                'file'      => $fileUrl,
                'file_type' => $fileType,
                'status'    => 'draf',
                'gambar' => $gambarUrl,
                'pembaca'   => 0,
                'allow_download' => $allowDownload,
            ], 'publikasi_id');

            return redirect()->route('admin.publikasi.show', $id)
                ->with('success', 'Publikasi berhasil disimpan');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->with('error', 'Validasi gagal: ' . $e->getMessage())->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
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
        try {
            $request->validate([
                'tanggal'  => 'nullable|date',
                'kategori' => 'required|string',
                'judul'    => 'required|string',
                'penulis'  => 'required|string',
                'isi'      => 'nullable|string',
                'gambar'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                'file'     => 'nullable|mimes:pdf,doc,docx,xls,xlsx,zip,rar|max:5120'
            ]);

            $dataLama = DB::table('publikasi')->where('publikasi_id', $id)->first();
            if (!$dataLama) abort(404);

            $gambarUrl = $dataLama->gambar;
            $fileUrl = $dataLama->file;
            $fileType = $dataLama->file_type;

            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');
                $fileName = time() . '_' . $file->getClientOriginalName();

                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . env('SUPABASE_SERVICE_ROLE_KEY'),
                ])->attach('file', file_get_contents($file), $fileName)
                ->post(env('SUPABASE_URL') . '/storage/v1/object/' . env('SUPABASE_BUCKET') . '/' . $fileName);

                if ($response->failed()) {
                    return back()->with('error', 'Gagal upload gambar ke storage')->withInput();
                }

                $gambarUrl = env('SUPABASE_URL') . '/storage/v1/object/public/' . env('SUPABASE_BUCKET') . '/' . $fileName;
            }

            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $fileType = $file->getClientOriginalExtension();

                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . env('SUPABASE_SERVICE_ROLE_KEY'),
                ])->attach('file', file_get_contents($file), $fileName)
                ->post(env('SUPABASE_URL') . '/storage/v1/object/' . env('SUPABASE_BUCKET') . '/' . $fileName);

                if ($response->failed()) {
                    return back()->with('error', 'Gagal upload file ke storage')->withInput();
                }

                $fileUrl = env('SUPABASE_URL') . '/storage/v1/object/public/' . env('SUPABASE_BUCKET') . '/' . $fileName;
            }

            $allowDownload = $request->has('allow_download') ? 1 : 0;

            DB::table('publikasi')->where('publikasi_id', $id)->update([
                'tanggal'  => $request->tanggal,
                'kategori' => $request->kategori,
                'judul'    => $request->judul,
                'penulis'  => $request->penulis,
                'isi'      => $request->isi,
                'gambar'   => $gambarUrl,
                'file'     => $fileUrl,
                'file_type'=> $fileType,
                'allow_download' => $allowDownload,
            ]);

            return redirect()->route('admin.publikasi.show', $id)
                ->with('success', 'Publikasi berhasil diperbarui');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->with('error', 'Validasi gagal: ' . $e->getMessage())->withInput();
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

 public function destroy($id)
{
    $data = DB::table('publikasi')->where('publikasi_id', $id)->first();
    if (!$data) abort(404);

    try {
        if ($data->file) {
            $pathFile = str_replace(env('SUPABASE_URL') . '/storage/v1/object/public/' . env('SUPABASE_BUCKET') . '/', '', $data->file);
            Http::withHeaders([
                'Authorization' => 'Bearer ' . env('SUPABASE_SERVICE_ROLE_KEY'),
            ])->delete(env('SUPABASE_URL') . '/storage/v1/object/' . env('SUPABASE_BUCKET') . '/' . $pathFile);
        }

        if ($data->gambar) {
            $pathGambar = str_replace(env('SUPABASE_URL') . '/storage/v1/object/public/' . env('SUPABASE_BUCKET') . '/', '', $data->gambar);
            Http::withHeaders([
                'Authorization' => 'Bearer ' . env('SUPABASE_SERVICE_ROLE_KEY'),
            ])->delete(env('SUPABASE_URL') . '/storage/v1/object/' . env('SUPABASE_BUCKET') . '/' . $pathGambar);
        }

        DB::table('publikasi')->where('publikasi_id', $id)->delete();

        return back()->with('success', 'Publikasi berhasil dihapus.');
    } catch (\Exception $e) {
        return back()->with('error', 'Gagal menghapus dari storage: ' . $e->getMessage());
    }
}

    public function download($id)
    {
        $data = DB::table('publikasi')->where('publikasi_id', $id)->first();
        if (!$data || !$data->file) abort(404);

        $fileName = basename($data->file);

        return response()->streamDownload(function() use ($data) {
            echo Http::get($data->file)->body();
        }, $fileName, [
            'Content-Disposition' => 'attachment; filename="'.$fileName.'"'
        ]);
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
