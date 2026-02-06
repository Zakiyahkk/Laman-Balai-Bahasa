<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HasilSurvei;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class AHasilsurveiController extends Controller
{
    /**
     * ===============================
     * INDEX
     * ===============================
     */
    public function index(Request $request)
    {
        $hasilsurvei = HasilSurvei::when($request->search, function ($query) use ($request) {
            $query->where(function ($q) use ($request) {
                $q->where('judul_survei', 'like', '%' . $request->search . '%')
                  ->orWhere('tipe_file', 'like', '%' . $request->search . '%')
                  ->orWhere('status', 'like', '%' . $request->search . '%');
            });
        })
        ->orderByDesc('id')
        ->get();
    
        return view('admin.hasilsurvei.index', compact('hasilsurvei'));
    }


    /**
     * ===============================
     * CREATE
     * ===============================
     */
    public function create()
    {
        return view('admin.hasilsurvei.create');
    }

    /**
     * ===============================
     * STORE
     * ===============================
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul_survei' => 'required|string|max:255',
            'tanggal'      => 'required|date',
            'status'       => 'required|in:terbit,draf',
            'file'         => 'required|file|mimes:png,jpg,jpeg,pdf|max:51200', // 50MB
        ]);

        $filePath = null;
        $tipeFile = null;

        if ($request->hasFile('file')) {
            $file = $request->file('file');

            $ext  = $file->getClientOriginalExtension();
            $name = time() . '_' .
                    Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME))
                    . '.' . $ext;

            // ===============================
            // 1️⃣ SIMPAN KE PUBLIC LARAVEL
            // ===============================
            $laravelPath = public_path('img/survei');
            if (!is_dir($laravelPath)) {
                mkdir($laravelPath, 0755, true);
            }

            if (!is_writable($laravelPath)) {
                abort(500, 'Folder img/survei tidak bisa ditulis');
            }

            $file->move($laravelPath, $name);

            // ===============================
            // 2️⃣ COPY KE PUBLIC_HTML
            // ===============================
            $targetPath = '/home/aajxwzdj/public_html/bbpr/img/survei';
            if (!is_dir($targetPath)) {
                mkdir($targetPath, 0755, true);
            }

            if (!is_writable($targetPath)) {
                abort(500, 'Folder public_html/img/survei tidak bisa ditulis');
            }

            copy(
                $laravelPath . '/' . $name,
                $targetPath . '/' . $name
            );

            // ===============================
            // 3️⃣ SIMPAN PATH RELATIF
            // ===============================
            $filePath = 'img/survei/' . $name;
            $tipeFile = $ext;
        }

        try {
            HasilSurvei::create([
                'judul_survei' => $request->judul_survei,
                'tanggal'      => $request->tanggal,
                'status'       => $request->status,
                'file_path'    => $filePath,
                'tipe_file'    => $tipeFile,
            ]);

            return redirect()->route('admin.hasilsurvei.index')
                ->with('success', 'Hasil survei berhasil disimpan');

        } catch (\Exception $e) {
            Log::error('Gagal simpan hasil survei: ' . $e->getMessage());
            return back()->withInput()
                ->with('error', 'Gagal menyimpan data');
        }
    }

    /**
     * ===============================
     * EDIT
     * ===============================
     */
    public function edit($id)
    {
        $hasilsurvei = HasilSurvei::findOrFail($id);
        return view('admin.hasilsurvei.edit', compact('hasilsurvei'));
    }

    /**
     * ===============================
     * UPDATE
     * ===============================
     */
    public function update(Request $request, $id)
    {
        $data = HasilSurvei::findOrFail($id);

        $request->validate([
            'judul_survei' => 'required|string|max:255',
            'tanggal'      => 'required|date',
            'status'       => 'required|in:terbit,draf',
            'file'         => 'nullable|file|mimes:png,jpg,jpeg,pdf|max:51200',
        ]);

        $data->judul_survei = $request->judul_survei;
        $data->tanggal      = $request->tanggal;
        $data->status       = $request->status;

        // ===============================
        // GANTI FILE JIKA ADA
        // ===============================
        if ($request->hasFile('file')) {

            // hapus file lama
            if ($data->file_path) {
                $old = '/home/aajxwzdj/public_html/bbpr/' . $data->file_path;
                if (file_exists($old)) {
                    unlink($old);
                }
            }

            $file = $request->file('file');
            $ext  = $file->getClientOriginalExtension();
            $name = time() . '_' .
                    Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME))
                    . '.' . $ext;

            $laravelPath = public_path('img/survei');
            if (!is_dir($laravelPath)) {
                mkdir($laravelPath, 0755, true);
            }

            $file->move($laravelPath, $name);

            copy(
                $laravelPath . '/' . $name,
                '/home/aajxwzdj/public_html/bbpr/img/survei/' . $name
            );

            $data->file_path = 'img/survei/' . $name;
            $data->tipe_file = $ext;
        }

        $data->save();

        return redirect()->route('admin.hasilsurvei.index')
            ->with('success', 'Hasil survei berhasil diperbarui');
    }

    /**
     * ===============================
     * DESTROY
     * ===============================
     */
    public function destroy($id)
    {
        $data = HasilSurvei::findOrFail($id);
    
        // hapus file fisik
        if ($data->file_path) {
            $file = '/home/aajxwzdj/public_html/bbpr/' . $data->file_path;
            if (file_exists($file)) {
                unlink($file);
            }
        }
    
        $data->delete();
    
        return redirect()
            ->route('admin.hasilsurvei.index')
            ->with('success', 'Hasil survei berhasil dihapus');
    }

    /**
     * ===============================
     * DOWNLOAD
     * ===============================
     */
    public function download($id)
    {
        $data = HasilSurvei::findOrFail($id);

        if (!$data->file_path) {
            abort(404);
        }

        $file = '/home/aajxwzdj/public_html/bbpr/' . $data->file_path;

        if (!file_exists($file)) {
            abort(404);
        }

        return response()->download(
            $file,
            Str::slug($data->judul_survei) . '-hasil-survei.' . $data->tipe_file
        );
    }
}
