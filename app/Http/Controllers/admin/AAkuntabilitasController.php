<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lakin; 
use Illuminate\Support\Facades\Storage; 

class AAkuntabilitasController extends Controller
{
    public function renstra()
    {
        $akuntabilitasOpen = true; 
        return view('admin.akuntabilitas.renstra', compact('akuntabilitasOpen'));
    }

    public function dipa() 
    { 
        $akuntabilitasOpen = true; 
        return view('admin.akuntabilitas.dipa', compact('akuntabilitasOpen')); 
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
    
    public function lakin() { 
        $akuntabilitasOpen = true; 
        $akuntabilitas = Lakin::latest()->get(); // Mengurutkan dari yang terbaru
        return view('admin.akuntabilitas.lakin.index', compact('akuntabilitas', 'akuntabilitasOpen'));
    }

    public function create() {
        $akuntabilitasOpen = true; 
        return view('admin.akuntabilitas.lakin.create', compact('akuntabilitasOpen'));
    }

    // FUNGSI SIMPAN DATA BARU (Lengkapi bagian ini)
    public function store(Request $request)
{
    $request->validate([
        'nama_dokumen' => 'required|string|max:255',
        'tanggal'      => 'required|date', // Pastikan hanya pakai string 'date'
        'deskripsi'    => 'nullable|string',
        'status'       => 'required|in:published,draft',
        'file_dokumen' => 'required|file|mimes:pdf,docx|max:2048',
    ]);

    // Proses upload file
    $filePath = $request->file('file_dokumen')->store('akuntabilitas/lakin', 'public');

    // Simpan ke database
    \App\Models\Lakin::create([
        'nama_dokumen' => $request->nama_dokumen,
        'tanggal'      => $request->tanggal,
        'deskripsi'    => $request->deskripsi,
        'status'       => $request->status,
        'file_path'    => $filePath,
    ]);

    return redirect()->route('admin.akuntabilitas.lakin')->with('success', 'Dokumen berhasil ditambahkan!');
}

    public function edit($id) {
        $akuntabilitasOpen = true;
        $akuntabilitas = Lakin::findOrFail($id); 
        return view('admin.akuntabilitas.lakin.edit', compact('akuntabilitas', 'akuntabilitasOpen'));
    }

    public function update(Request $request, $id)
{
    $lakin = Lakin::findOrFail($id);

    $request->validate([
        'nama_dokumen' => 'required',
        'tanggal'      => 'required|date', // Tambahkan validasi ini
        'status'       => 'required',
    ]);

    $lakin->nama_dokumen = $request->nama_dokumen;
    $lakin->deskripsi = $request->deskripsi;
    $lakin->tanggal = $request->tanggal; // Baris ini yang mengubah tanggal di DB
    $lakin->status = $request->status;
    
    // ... sisa kode upload file ...
    $lakin->save();

    return redirect()->route('admin.akuntabilitas.lakin')->with('success', 'Berhasil update!');
}

    // FUNGSI HAPUS DATA
   public function destroy($id)
{
    try {
        $lakin = Lakin::findOrFail($id);

        // Hapus file fisik dari storage agar tidak penuh
        if ($lakin->file_path && Storage::disk('public')->exists($lakin->file_path)) {
            Storage::disk('public')->delete($lakin->file_path);
        }

        // Hapus data dari Supabase
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
public function download($id)
{
    $lakin = \App\Models\Lakin::findOrFail($id);
    
    $filePath = storage_path('app/public/' . $lakin->file_path);

    if (file_exists($filePath)) {
        $extension = pathinfo($filePath, PATHINFO_EXTENSION);
        
        $namaFileDownload = \Illuminate\Support\Str::slug($lakin->nama_dokumen) . '.' . $extension;

        return response()->download($filePath, $namaFileDownload);
    }

    return redirect()->back()->with('error', 'File fisik tidak ditemukan di server.');
}
}