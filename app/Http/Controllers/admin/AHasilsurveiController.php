<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HasilSurvei;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class AHasilsurveiController extends Controller
{
    // lokasi public_html
    private $publicHtml = '/home/balaibahasariau/public_html/';

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
            'file'         => 'required|file|mimes:png,jpg,jpeg,pdf|max:51200',
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
            // SIMPAN KE PUBLIC LARAVEL
            // ===============================
            $laravelFolder = public_path('img/survei');
            if (!is_dir($laravelFolder)) {
                mkdir($laravelFolder, 0755, true);
            }

            $file->move($laravelFolder, $name);

            // ===============================
            // COPY KE PUBLIC_HTML
            // ===============================
            $targetFolder = $this->publicHtml . 'img/survei';
            if (!is_dir($targetFolder)) {
                mkdir($targetFolder, 0755, true);
            }

            copy(
                $laravelFolder . '/' . $name,
                $targetFolder . '/' . $name
            );

            $filePath = 'img/survei/' . $name;
            $tipeFile = $ext;
        }

        HasilSurvei::create([
            'judul_survei' => $request->judul_survei,
            'tanggal'      => $request->tanggal,
            'status'       => $request->status,
            'file_path'    => $filePath,
            'tipe_file'    => $tipeFile,
        ]);

        return redirect()->route('admin.hasilsurvei.index')
            ->with('success', 'Hasil survei berhasil disimpan');
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
    
        if ($request->hasFile('file')) {

            // ===============================
            // HAPUS FILE LAMA DI DUA LOKASI
            // ===============================
            if ($data->file_path) {

                // public_html
                $oldPublicHtml = $this->publicHtml . $data->file_path;
                if (file_exists($oldPublicHtml)) {
                    unlink($oldPublicHtml);
                }

                // public laravel
                $oldLaravel = public_path($data->file_path);
                if (file_exists($oldLaravel)) {
                    unlink($oldLaravel);
                }
            }

            $file = $request->file('file');
            $ext  = $file->getClientOriginalExtension();
            $name = time() . '_' .
                    Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME))
                    . '.' . $ext;

            // simpan ke public laravel
            $laravelFolder = public_path('img/survei');
            if (!is_dir($laravelFolder)) {
                mkdir($laravelFolder, 0755, true);
            }

            $file->move($laravelFolder, $name);

            // copy ke public_html
            $targetFolder = $this->publicHtml . 'img/survei';
            if (!is_dir($targetFolder)) {
                mkdir($targetFolder, 0755, true);
            }

            copy(
                $laravelFolder . '/' . $name,
                $targetFolder . '/' . $name
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
    
        if ($data->file_path) {

            // hapus di public_html
            $filePublicHtml = $this->publicHtml . $data->file_path;
            if (file_exists($filePublicHtml)) {
                unlink($filePublicHtml);
            }

            // hapus di public laravel
            $fileLaravel = public_path($data->file_path);
            if (file_exists($fileLaravel)) {
                unlink($fileLaravel);
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

        $file = $this->publicHtml . $data->file_path;

        if (!file_exists($file)) {
            abort(404);
        }

        return response()->download(
            $file,
            Str::slug($data->judul_survei) . '-hasil-survei.' . $data->tipe_file
        );
    }
}
