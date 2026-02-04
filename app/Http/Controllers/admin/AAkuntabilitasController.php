<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Akuntabilitas;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AAkuntabilitasController extends Controller
{
    // 1. Menampilkan Index (Daftar Data)
    public function index($tipe)    
    {
    $akuntabilitasOpen = true;
    // Ambil hanya 5 data per halaman
    $data = Akuntabilitas::where('tipe', $tipe)->latest()->paginate(10);
    
    // Pastikan path view sesuai folder lakin/renstra/dll
    return view("admin.akuntabilitas.$tipe.index", compact('data', 'tipe', 'akuntabilitasOpen'));
    }

    // 2. Menampilkan Form Tambah
    public function create($tipe)
    {
        $akuntabilitasOpen = true;
        // Mengarahkan ke admin/akuntabilitas/{tipe}/create.blade.php
        return view("admin.akuntabilitas.$tipe.create", compact('tipe', 'akuntabilitasOpen'));
    }

    // 3. Proses Simpan Data
    public function store(Request $request, $tipe)
    {
        try {
            $request->validate([
                'nama_dokumen' => 'required|string|max:255',
                'tanggal'      => 'required|date',
                'status'       => 'required|in:published,draft,Published,Draft',
                'file_dokumen' => 'required|file|mimes:pdf,docx|max:500000',
            ]);

            $filePath = $request->file('file_dokumen')->store("uploads/$tipe", 'public');

            Akuntabilitas::create([
                'tipe'         => $tipe,
                'nama_dokumen' => $request->nama_dokumen,
                'tanggal'      => $request->tanggal,
                'deskripsi'    => $request->deskripsi,
                'status'       => strtolower($request->status),
                'file_path'    => $filePath, 
        ]);

            return redirect()->route('admin.akuntabilitas.index', $tipe)->with('success', 'Data berhasil ditambahkan!');
            
        } catch (\Exception $e) {
            return back()->with('error', "Gagal simpan: " . $e->getMessage());
        }
    }

    // 4. Menampilkan Form Edit
    public function edit($tipe, $id)
    {
        $akuntabilitasOpen = true;
        $item = Akuntabilitas::findOrFail($id);
        // Mengarahkan ke admin/akuntabilitas/{tipe}/edit.blade.php
        return view("admin.akuntabilitas.$tipe.edit", [
            'akuntabilitas' => $item, // Sesuaikan variabel ini dengan yang dipanggil di blade edit kamu
            'tipe' => $tipe,
            'akuntabilitasOpen' => $akuntabilitasOpen
        ]);
    }

    // 5. Proses Update Data
    public function update(Request $request, $tipe, $id)
    {
    $item = Akuntabilitas::findOrFail($id);

    $request->validate([
        'nama_dokumen' => 'required',
        'tanggal'      => 'required|date',
        'status'       => 'required',
        'file_dokumen' => 'nullable|mimes:pdf,doc,docx|max:500000',
    ]);

    // 1. Update data teks
    $item->nama_dokumen = $request->nama_dokumen;
    $item->deskripsi    = $request->deskripsi;
    $item->tanggal      = $request->tanggal;
    $item->status       = strtolower($request->status);

    // 2. Jika ada upload file baru
    if ($request->hasFile('file_dokumen')) {
        
        // HAPUS FILE LAMA SECARA FISIK (PENTING!)
        if ($item->file_path) {
            $oldPath = $item->file_path;
            if (Storage::disk('public')->exists($oldPath)) {
                Storage::disk('public')->delete($oldPath);
            }
        }

        // SIMPAN FILE BARU KE FOLDER UPLOADS
        $file = $request->file('file_dokumen');
        // Buat nama file unik agar tidak bentrok dengan cache browser
        $newFileName = time() . '_' . $file->getClientOriginalName();
        $item->file_path = $file->storeAs("uploads/$tipe", $newFileName, 'public');
    }

    $item->save();

    return redirect()
        ->route('admin.akuntabilitas.index', $tipe)
        ->with('success', 'File Berhasil Diperbarui!');
    }


    // 6. Proses Hapus Data
    public function destroy($id)
    {
        try {
            $item = Akuntabilitas::findOrFail($id);
            if ($item->file_path && Storage::disk('public')->exists($item->file_path)) {
                Storage::disk('public')->delete($item->file_path);
            }
            $item->delete();

            return response()->json(['success' => true, 'message' => 'Data berhasil dihapus!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false], 500);
        }
    }

    // 7. Proses Download File
    public function download($id)
    {
    $item = Akuntabilitas::findOrFail($id);

    if (!$item->file_path) {
        return back()->with('error', 'Path file tidak tersedia.');
    }

    if (!Storage::disk('public')->exists($item->file_path)) {
        return back()->with('error', 'File fisik tidak ditemukan di server.');
    }

    $filePath = Storage::disk('public')->path($item->file_path);
    $extension = pathinfo($filePath, PATHINFO_EXTENSION);
    $namaFileDownload = Str::slug($item->nama_dokumen) . '.' . $extension;

    return response()->download($filePath, $namaFileDownload);
}

}