<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class ATokohController extends Controller
{
   public function index(Request $request)
{
    $query = DB::table('tokoh')
        ->orderBy('tokoh_id', 'desc');

    // SEARCH (nama + deskripsi)
    if ($request->filled('search')) {
        $q = strtolower($request->search);

        $query->where(function ($dbq) use ($q) {
            $dbq->whereRaw('LOWER(nama) LIKE ?', ["%{$q}%"])
                ->orWhereRaw('LOWER(deskripsi) LIKE ?', ["%{$q}%"]);
        });
    }

    // FILTER KATEGORI
    if ($request->filled('kategori')) {
        $query->where('kategori', '=', $request->kategori);
    }

    $tokoh = $query->get();

    return view('admin.tokoh', [
        'tokoh' => $tokoh,
        'countBahasa'     => DB::table('tokoh')->where('kategori','Tokoh Bahasa dan Sastra')->count(),
        'countLisan'      => DB::table('tokoh')->where('kategori','Tokoh Sastra Lisan')->count(),
        'countLiterasi'   => DB::table('tokoh')->where('kategori','Komunitas Literasi')->count(),
        'countKomunitas'  => DB::table('tokoh')->where('kategori','Komunitas Sastra')->count(),
    ]);
}


 public function store(Request $request)
{
    $request->validate([
        'nama' => 'required',
        'kategori' => 'required',
        'deskripsi' => 'nullable',
        'foto_tokoh' => 'nullable|image|mimes:jpg,jpeg,png|max:50480',
    ]);

    $path = null;

    if ($request->hasFile('foto_tokoh')) {
        $path = $this->uploadFotoTokoh($request->file('foto_tokoh'));
    }

    DB::table('tokoh')->insert([
        'nama' => $request->nama,
        'kategori' => $request->kategori,
        'deskripsi' => $request->deskripsi,
        'foto_tokoh' => $path,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return back()->with('success', 'Tokoh berhasil ditambahkan');
}


public function update(Request $request, $id)
{
    $tokoh = DB::table('tokoh')->where('tokoh_id', $id)->first();
    if (!$tokoh) {
        return back()->with('error', 'Data tidak ditemukan');
    }

    $data = [
        'nama' => $request->nama,
        'kategori' => $request->kategori,
        'deskripsi' => $request->deskripsi,
        'updated_at' => now(),
    ];

    if ($request->hasFile('foto_tokoh')) {

        // hapus foto lama di public_html
        if ($tokoh->foto_tokoh) {
            $old = '/home/aajxwzdj/public_html/bbpr/' . $tokoh->foto_tokoh;
            if (file_exists($old)) {
                unlink($old);
            }
        }

        $data['foto_tokoh'] = $this->uploadFotoTokoh($request->file('foto_tokoh'));
    }

    DB::table('tokoh')
        ->where('tokoh_id', $id)
        ->update($data);

    return back()->with('success', 'Tokoh berhasil diperbarui');
}

public function destroy($id)
{
    $tokoh = DB::table('tokoh')->where('tokoh_id', $id)->first();

    if ($tokoh && $tokoh->foto_tokoh) {
        $file = '/home/aajxwzdj/public_html/bbpr/' . $tokoh->foto_tokoh;
        if (file_exists($file)) {
            unlink($file);
        }
    }

    DB::table('tokoh')->where('tokoh_id', $id)->delete();

    return back()->with('success', 'Tokoh berhasil dihapus');
}

    
private function uploadFotoTokoh($file)
{
    // 1️⃣ simpan dulu ke public Laravel
    $laravelPath = public_path('img/tokoh');

    if (!is_dir($laravelPath)) {
        mkdir($laravelPath, 0755, true);
    }

    if (!is_writable($laravelPath)) {
        abort(500, 'Folder Laravel img/tokoh tidak bisa ditulis');
    }

    $name = Str::uuid() . '.' . $file->getClientOriginalExtension();
    $file->move($laravelPath, $name);

    // 2️⃣ copy ke public_html (WEB ROOT)
    $targetPath = '/home/aajxwzdj/public_html/bbpr/img/tokoh';

    if (!is_dir($targetPath)) {
        mkdir($targetPath, 0755, true);
    }

    if (!is_writable($targetPath)) {
        abort(500, 'Folder public_html img/tokoh tidak bisa ditulis');
    }

    copy(
        $laravelPath . '/' . $name,
        $targetPath . '/' . $name
    );

    // simpan path relatif
    return 'img/tokoh/' . $name;
}



}
