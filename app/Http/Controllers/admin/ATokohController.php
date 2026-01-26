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
            'foto_tokoh' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
        ]);

        $path = null;

        if ($request->hasFile('foto_tokoh')) {
            $file = $request->file('foto_tokoh');

            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();

            // simpan ke public/img/tokoh
            $file->move(public_path('img/tokoh'), $filename);

            // path relatif untuk DB
            $path = 'img/tokoh/' . $filename;
        }

        DB::table('tokoh')->insert([
            'nama' => $request->nama,
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'foto_tokoh' => $path, // contoh: img/tokoh/abc.jpg
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Tokoh berhasil ditambahkan');
    }

        public function update(Request $request, $id)
    {
        $tokoh = DB::table('tokoh')->where('tokoh_id', $id)->first();

        $path = $tokoh->foto_tokoh;

        if ($request->hasFile('foto_tokoh')) {
            if ($path && file_exists(public_path($path))) {
                unlink(public_path($path));
            }

            $file = $request->file('foto_tokoh');
            $filename = Str::uuid().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('img/tokoh'), $filename);
            $path = 'img/tokoh/'.$filename;
        }

        DB::table('tokoh')->where('tokoh_id', $id)->update([
            'nama' => $request->nama,
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'foto_tokoh' => $path,
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Tokoh berhasil diperbarui');
    }

    public function destroy($id)
    {
        $tokoh = DB::table('tokoh')->where('tokoh_id', $id)->first();

        if ($tokoh && $tokoh->foto_tokoh) {
            $filePath = public_path($tokoh->foto_tokoh);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        DB::table('tokoh')->where('tokoh_id', $id)->delete();

        return back()->with('success', 'Tokoh Berhasil dihapus');
    }

}
