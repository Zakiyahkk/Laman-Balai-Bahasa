<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HasilSurvei;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

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
        ->get()
        ->map(function ($item) {
            // Generate file URL dengan Laravel Storage
            if ($item->file_path) {
                // Strip prefix lama
                $file = preg_replace(
                    '#^(storage/|/storage/|img/survei/|/img/survei/|survei/|/survei/)#',
                    '',
                    ltrim($item->file_path, '/')
                );
                $item->file_url = asset('storage/survei/' . $file);
            } else {
                $item->file_url = null;
            }
            
            return $item;
        });
    
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
     * STORE (LARAVEL STORAGE)
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
            $filePath = $request->file('file')->store('survei', 'public');
            $tipeFile = $request->file('file')->getClientOriginalExtension();
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
        
        if ($hasilsurvei->file_path) {
            $file = preg_replace(
                '#^(storage/|/storage/|img/survei/|/img/survei/|survei/|/survei/)#',
                '',
                ltrim($hasilsurvei->file_path, '/')
            );
            $hasilsurvei->file_url = asset('storage/survei/' . $file);
        } else {
            $hasilsurvei->file_url = null;
        }

        return view('admin.hasilsurvei.edit', compact('hasilsurvei'));
    }

    /**
     * ===============================
     * UPDATE (LARAVEL STORAGE)
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
            // Hapus file lama jika ada
            if ($data->file_path) {
                Storage::disk('public')->delete($data->file_path);
            }

            // Simpan file baru
            $data->file_path = $request->file('file')->store('survei', 'public');
            $data->tipe_file = $request->file('file')->getClientOriginalExtension();
        }
    
        $data->save();
    
        return redirect()->route('admin.hasilsurvei.index')
            ->with('success', 'Hasil survei berhasil diperbarui');
    }

    /**
     * ===============================
     * DESTROY (LARAVEL STORAGE)
     * ===============================
     */
    public function destroy($id)
    {
        $data = HasilSurvei::findOrFail($id);
    
        if ($data->file_path) {
            Storage::disk('public')->delete($data->file_path);
        }
    
        $data->delete();
    
        return redirect()
            ->route('admin.hasilsurvei.index')
            ->with('success', 'Hasil survei berhasil dihapus');
    }

    /**
     * ===============================
     * DOWNLOAD (LARAVEL STORAGE)
     * ===============================
     */
    public function download($id)
    {
        $data = HasilSurvei::findOrFail($id);

        if (!$data->file_path) {
            abort(404);
        }

        $file = storage_path('app/public/' . $data->file_path);

        if (!file_exists($file)) {
            abort(404);
        }

        return response()->download(
            $file,
            Str::slug($data->judul_survei) . '-hasil-survei.' . $data->tipe_file
        );
    }
}
