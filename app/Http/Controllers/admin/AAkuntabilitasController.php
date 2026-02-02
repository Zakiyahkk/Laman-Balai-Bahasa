<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lakin;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AAkuntabilitasController extends Controller
{
    // =========================================================
    // MENU STATIS LAIN (Renstra, Dipa, PK, RA, Sakai)
    // =========================================================
    
    public function renstra() { 
        return view('admin.akuntabilitas.renstra', ['akuntabilitasOpen' => true]); 
    }

    public function dipa() { 
        return view('admin.akuntabilitas.dipa', ['akuntabilitasOpen' => true]); 
    }

    public function pk() { 
        return view('admin.akuntabilitas.perjanjian-kinerja', ['akuntabilitasOpen' => true]); 
    }

    public function ra() { 
        return view('admin.akuntabilitas.rencana-aksi', ['akuntabilitasOpen' => true]); 
    }

    public function sakai() { 
        return view('admin.akuntabilitas.sakai', ['akuntabilitasOpen' => true]); 
    } 

    // =========================================================
    // LAKIN MANAGEMENT (CRUD)
    // =========================================================

    // 1. Index
    public function lakin() { 
        $akuntabilitasOpen = true; 
        $akuntabilitas = Lakin::latest()->get(); 
        return view('admin.akuntabilitas.lakin.index', compact('akuntabilitas', 'akuntabilitasOpen'));
    }

    // 2. Create Form
    public function create() {
        $akuntabilitasOpen = true; 
        return view('admin.akuntabilitas.lakin.create', compact('akuntabilitasOpen'));
    }

    // 3. Store Data
    public function store(Request $request)
    {
        $request->validate([
            'nama_dokumen' => 'required|string|max:255',
            'tanggal'      => 'required|date',
            'deskripsi'    => 'nullable|string',
            'status'       => 'required|in:published,draft,Published,Draft',
            'file_dokumen' => 'required|file|mimes:pdf,docx,doc|max:102400', // Max 100MB
        ]);

        // Proses upload file (Sanitasi Nama)
        $file = $request->file('file_dokumen');
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $cleanName = time() . '_' . Str::slug($originalName) . '.' . $file->getClientOriginalExtension();
            
        // Simpan ke folder 'uploads/lakin' agar rapi dan sesuai ekspektasi user
        $filePath = $file->storeAs('uploads/lakin', $cleanName, 'public');

        Lakin::create([
            'nama_dokumen' => $request->nama_dokumen,
            'tanggal'      => $request->tanggal,
            'deskripsi'    => $request->deskripsi,
            'status'       => strtolower($request->status),
            'file_path'    => $filePath,
        ]);

        return redirect()->route('admin.akuntabilitas.lakin')->with('success', 'Dokumen Lakin berhasil ditambahkan!');
    }

    // 4. Edit Form
    public function edit($id) {
        $akuntabilitasOpen = true;
        $akuntabilitas = Lakin::findOrFail($id); 
        return view('admin.akuntabilitas.lakin.edit', compact('akuntabilitas', 'akuntabilitasOpen'));
    }

    // 5. Update Data
    public function update(Request $request, $id)
    {
        $lakin = Lakin::findOrFail($id);

        $request->validate([
            'nama_dokumen' => 'required|string',
            'tanggal'      => 'required|date',
            'status'       => 'required',
            'file_dokumen' => 'nullable|file|mimes:pdf,docx,doc|max:102400',
        ]);

        $lakin->nama_dokumen = $request->nama_dokumen;
        $lakin->deskripsi    = $request->deskripsi;
        $lakin->tanggal      = $request->tanggal;
        $lakin->status       = strtolower($request->status);
        
        // Jika ada file baru
        if ($request->hasFile('file_dokumen')) {
            // Hapus file lama
            if ($lakin->file_path && Storage::disk('public')->exists($lakin->file_path)) {
                Storage::disk('public')->delete($lakin->file_path);
            }

            // Upload baru
            $file = $request->file('file_dokumen');
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $cleanName = time() . '_' . Str::slug($originalName) . '.' . $file->getClientOriginalExtension();

            $lakin->file_path = $file->storeAs('uploads/lakin', $cleanName, 'public');
        }

        $lakin->save();

        return redirect()->route('admin.akuntabilitas.lakin')->with('success', 'Berhasil update!');
    }

    // 6. Delete
    public function destroy($id)
    {
        try {
            $lakin = Lakin::findOrFail($id);

            // Hapus file fisik
            if ($lakin->file_path && Storage::disk('public')->exists($lakin->file_path)) {
                Storage::disk('public')->delete($lakin->file_path);
            }

            $lakin->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil dihapus!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data.'
            ], 500);
        }
    }

    // 7. Download
    public function download($id)
    {
        $lakin = Lakin::findOrFail($id);
        
        if (!$lakin->file_path || !Storage::disk('public')->exists($lakin->file_path)) {
            return back()->with('error', 'File fisik tidak ditemukan di server.');
        }

        $filePath = Storage::disk('public')->path($lakin->file_path);
        
        // Buat nama custom saat diunduh
        $ext = pathinfo($filePath, PATHINFO_EXTENSION);
        $downloadName = Str::slug($lakin->nama_dokumen) . '-lakin.' . $ext;

        return response()->download($filePath, $downloadName);
    }
}