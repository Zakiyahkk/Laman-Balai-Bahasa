<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Galeri; // Pastikan kamu sudah punya Model Galeri

class GaleriController extends Controller
{
    public function store(Request $request)
{
    // 1. Validasi Input
    $request->validate([
        'judul'      => 'required|string|max:255',
        'file_media' => 'required|file|mimes:jpg,jpeg,png,mp4|max:51200',
        'kategori'   => 'required',
        'tipe'       => 'required',
    ]);

    $path = null;

    // 2. Proses Simpan File
    if ($request->hasFile('file_media')) {
        $file = $request->file('file_media');
        $namaFile = time() . '_' . $file->getClientOriginalName();
        // Simpan ke storage/app/public/uploads/galeri
        $path = $file->storeAs('uploads/galeri', $namaFile, 'public');
    }

    // 3. Simpan ke Database
    Galeri::create([
        'judul'      => $request->judul,
        'file_media' => $path, // Pastikan ini sesuai dengan nama kolom di database kamu
        'kategori'   => $request->kategori,
        'tipe'       => $request->tipe,
    ]);

    // 4. Redirect (Pastikan nama route ini sudah ada di web.php)
    return redirect('/admin/galeri')->with('success', 'Media berhasil diunggah!');
}
    public function create()
{
    // Mengarahkan ke file resources/views/admin/galeri/create.blade.php
    return view('admin.galeri.create');
}
public function index()
{
    return view('admin.galeri.index');
}
}
