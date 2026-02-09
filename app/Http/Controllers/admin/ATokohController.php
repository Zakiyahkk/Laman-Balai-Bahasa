<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ATokohController extends Controller
{
    private $publicHtml = '/home/balaibahasariau/public_html/';

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

            // ===============================
            // HAPUS FOTO LAMA DI DUA LOKASI
            // ===============================
            if ($tokoh->foto_tokoh) {

                // public_html
                $oldPublicHtml = $this->publicHtml . $tokoh->foto_tokoh;
                if (file_exists($oldPublicHtml)) {
                    unlink($oldPublicHtml);
                }

                // public laravel
                $oldLaravel = public_path($tokoh->foto_tokoh);
                if (file_exists($oldLaravel)) {
                    unlink($oldLaravel);
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

            // hapus di public_html
            $filePublicHtml = $this->publicHtml . $tokoh->foto_tokoh;
            if (file_exists($filePublicHtml)) {
                unlink($filePublicHtml);
            }

            // hapus di public laravel
            $fileLaravel = public_path($tokoh->foto_tokoh);
            if (file_exists($fileLaravel)) {
                unlink($fileLaravel);
            }
        }

        DB::table('tokoh')->where('tokoh_id', $id)->delete();

        return back()->with('success', 'Tokoh berhasil dihapus');
    }

    private function uploadFotoTokoh($file)
    {
        // simpan ke public Laravel
        $laravelPath = public_path('img/tokoh');

        if (!is_dir($laravelPath)) {
            mkdir($laravelPath, 0755, true);
        }

        $name = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $file->move($laravelPath, $name);

        // copy ke public_html
        $targetPath = $this->publicHtml . 'img/tokoh';

        if (!is_dir($targetPath)) {
            mkdir($targetPath, 0755, true);
        }

        copy(
            $laravelPath . '/' . $name,
            $targetPath . '/' . $name
        );

        return 'img/tokoh/' . $name;
    }
}
