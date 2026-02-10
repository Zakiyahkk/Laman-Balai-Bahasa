<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ATokohController extends Controller
{

    public function index(Request $request)
    {
        $query = DB::table('tokoh')
            ->orderBy('tokoh_id', 'desc');

        if ($request->filled('search')) {
            $q = strtolower($request->search);

            $query->where(function ($dbq) use ($q) {
                $dbq->whereRaw('LOWER(nama) LIKE ?', ["%{$q}%"])
                    ->orWhereRaw('LOWER(deskripsi) LIKE ?', ["%{$q}%"]);
            });
        }

        if ($request->filled('kategori')) {
            $query->where('kategori', '=', $request->kategori);
        }

        $tokoh = $query->get()->map(function ($item) {
            // Generate foto URL dengan Laravel Storage
            if ($item->foto_tokoh) {
                // Strip prefix lama
                $foto = preg_replace(
                    '#^(storage/|/storage/|img/tokoh/|/img/tokoh/|tokoh/|/tokoh/)#',
                    '',
                    ltrim($item->foto_tokoh, '/')
                );
                $item->foto_url = asset('storage/tokoh/' . $foto);
            } else {
                $item->foto_url = asset('img/default-user.png');
            }
            
            return $item;
        });

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
            $path = $request->file('foto_tokoh')->store('tokoh', 'public');
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
            // Hapus foto lama jika ada
            if ($tokoh->foto_tokoh) {
                Storage::disk('public')->delete($tokoh->foto_tokoh);
            }

            $data['foto_tokoh'] = $request->file('foto_tokoh')->store('tokoh', 'public');
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
            Storage::disk('public')->delete($tokoh->foto_tokoh);
        }

        DB::table('tokoh')->where('tokoh_id', $id)->delete();

        return back()->with('success', 'Tokoh berhasil dihapus');
    }
}
