<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sembari;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ASembariController extends Controller
{
    /**
     * Tampilkan daftar Sembari
     */
    public function index()
    {
        // Ambil data terbaru
        $sembari = Sembari::latest()->get();
        return view('admin.sembari.index', compact('sembari'));
    }

    /**
     * Form Tambah
     */
    public function create()
    {
        return view('admin.sembari.create');
    }

    /**
     * Simpan Data
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_dokumen' => 'required|string|max:255',
            'tanggal'      => 'required|date',
            // Deskripsi opsional saja, jika tidak wajib diisi admin
            'deskripsi'    => 'nullable|string', 
            
            // Validasi Daerah & Jenjang
            'daerah'       => 'required|string',
            'jenjang'      => 'required|string',
            
            'status'       => 'required|in:published,draft',
            'file_dokumen' => 'required|file|mimes:pdf,docx|max:10240', // Max 10MB
        ]);

        // Upload File dengan Sanitasi Nama
        $filePath = null;
        if ($request->hasFile('file_dokumen')) {
            $file = $request->file('file_dokumen');
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $cleanName = time() . '_' . Str::slug($originalName) . '.' . $file->getClientOriginalExtension();
            
            $filePath = $file->storeAs('produk/sembari', $cleanName, 'public');
        }

        // Simpan DB
        Sembari::create([
            'nama_dokumen' => $request->nama_dokumen,
            'tanggal'      => $request->tanggal,
            'daerah'       => $request->daerah,
            'jenjang'      => $request->jenjang,
            'deskripsi'    => $request->deskripsi,
            'status'       => $request->status,
            'file_path'    => $filePath,
        ]);

        return redirect()->route('admin.sembari.index')->with('success', 'Dokumen Sembari berhasil ditambahkan!');
    }

    /**
     * Form Edit
     */
    public function edit($id)
    {
        $sembari = Sembari::findOrFail($id);
        return view('admin.sembari.edit', compact('sembari'));
    }

    /**
     * Update Data
     */
    public function update(Request $request, $id)
    {
        $sembari = Sembari::findOrFail($id);

        $request->validate([
            'nama_dokumen' => 'required|string|max:255',
            'tanggal'      => 'required|date',
            'daerah'       => 'required|string',
            'jenjang'      => 'required|string',
            'status'       => 'required|in:published,draft',
            'file_dokumen' => 'nullable|file|mimes:pdf,docx|max:10240',
        ]);

        // Update Text Fields
        $sembari->nama_dokumen = $request->nama_dokumen;
        $sembari->tanggal      = $request->tanggal;
        $sembari->daerah       = $request->daerah;
        $sembari->jenjang      = $request->jenjang;
        $sembari->deskripsi    = $request->deskripsi;
        $sembari->status       = $request->status;

        // Cek Upload File Baru
        if ($request->hasFile('file_dokumen')) {
            // Hapus file lama jika ada
            if ($sembari->file_path && Storage::disk('public')->exists($sembari->file_path)) {
                Storage::disk('public')->delete($sembari->file_path);
            }
            
            // Simpan file baru (Sanitized)
            $file = $request->file('file_dokumen');
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $cleanName = time() . '_' . Str::slug($originalName) . '.' . $file->getClientOriginalExtension();

            $sembari->file_path = $file->storeAs('produk/sembari', $cleanName, 'public');
        }

        $sembari->save();

        return redirect()->route('admin.sembari.index')->with('success', 'Data Sembari berhasil diperbarui!');
    }

    /**
     * Hapus Data
     */
    public function destroy($id)
    {
        try {
            $sembari = Sembari::findOrFail($id);

            // Hapus File Fisik
            if ($sembari->file_path && Storage::disk('public')->exists($sembari->file_path)) {
                Storage::disk('public')->delete($sembari->file_path);
            }

            // Hapus Record DB
            $sembari->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil dihapus!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Download File
     */
    public function download($id)
    {
        $sembari = Sembari::findOrFail($id);
        
        if (!$sembari->file_path || !Storage::disk('public')->exists($sembari->file_path)) {
            return back()->with('error', 'File tidak ditemukan di server.');
        }

        // Fix Path Logic for Shared Hosting / Custom Symlinks
        $filePath = Storage::disk('public')->path($sembari->file_path);
        
        // Buat nama file cantik (slug)
        $ext = pathinfo($filePath, PATHINFO_EXTENSION);
        $downloadName = Str::slug($sembari->nama_dokumen) . '-sembari.' . $ext;

        return response()->download($filePath, $downloadName);
    }
}
