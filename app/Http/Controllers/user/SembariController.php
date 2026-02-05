<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sembari;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SembariController extends Controller
{
    /**
     * Fungsi Helper untuk mengambil data Sembari dari Database dengan Filter
     */
    private function getDokumenSembari(Request $request)
    {
        $q = trim((string) $request->query('q', ''));
        $year = $request->query('year');
        $daerah = $request->query('daerah');
        $jenjang = $request->query('jenjang');

        // 1. Mulai Query
        $query = Sembari::query();

        // 2. Filter Status (Hanya Published)
        $query->where(function($query) {
            $query->where('status', 'published')
                ->orWhere('status', 'Published');
        });

        // 3. Filter Pencarian Nama Dokumen
        if ($q !== '') {
            $query->where('nama_dokumen', 'like', "%{$q}%");
        }

        // 4. Filter Tahun
        if ($year) {
            $query->whereYear('tanggal', $year);
        }

        // 5. Filter Daerah
        if ($daerah) {
            $query->where('daerah', $daerah);
        }

        // 6. Filter Jenjang
        if ($jenjang) {
            $query->where('jenjang', $jenjang);
        }

        // 7. Eksekusi Ambil Data Dokumen & Urutkan Terbaru
        $data = $query->orderBy('tanggal', 'desc')->get();

        // 8. Mapping ke format yang View harapkan
        $docs = $data->map(function ($item) {
            return [
                'id'      => $item->id,
                'judul'   => $item->nama_dokumen,
                'tahun'   => $item->tanggal ? $item->tanggal->format('Y') : '-',
                'daerah'  => $item->daerah ?? '-',
                'jenjang' => $item->jenjang ?? '-',
                'file'    => $item->file_path, // Untuk digunakan di view dengan asset('storage/' . $file)
            ];
        });

        // 9. Ambil daftar tahun untuk Dropdown
        $years = Sembari::whereNotNull('tanggal')
            ->selectRaw('YEAR(tanggal) as year')
            ->distinct()
            ->orderByDesc('year')
            ->pluck('year');

        // 10. Ambil daftar daerah unik untuk Dropdown
        $daerahList = Sembari::whereNotNull('daerah')
            ->distinct()
            ->orderBy('daerah')
            ->pluck('daerah');

        // 11. Ambil daftar jenjang unik untuk Dropdown
        $jenjangList = Sembari::whereNotNull('jenjang')
            ->distinct()
            ->orderBy('jenjang')
            ->pluck('jenjang');

        // 12. Kembalikan data
        return [
            'docs'           => $docs,
            'years'          => $years,
            'daerahList'     => $daerahList,
            'jenjangList'    => $jenjangList,
            'q'              => $q,
            'selectedYear'   => $year,
            'selectedDaerah' => $daerah,
            'selectedJenjang' => $jenjang,
        ];
    }

    /**
     * Halaman Index Sembari (Menampilkan semua dokumen dengan filter)
     */
    public function index(Request $request)
    {
        return view('user.produk.sembari', $this->getDokumenSembari($request));
    }

    /**
     * METHOD PREVIEW (Inline Browser) - Tampilkan File di Browser
     */
    public function file($id)
    {
        $doc = Sembari::findOrFail($id);
        $path = $doc->file_path;

        if (!$path || !Storage::disk('public')->exists($path)) {
            abort(404, 'File tidak ditemukan');
        }

        return response()->file(Storage::disk('public')->path($path));
    }

    /**
     * METHOD DOWNLOAD (Force Download) - Download File
     */
    public function download($id)
    {
        $item = Sembari::findOrFail($id);

        if (!$item->file_path || !Storage::disk('public')->exists($item->file_path)) {
            return back()->with('error', 'File tidak ditemukan.');
        }

        $filePath = Storage::disk('public')->path($item->file_path);
        
        $ext = pathinfo($filePath, PATHINFO_EXTENSION);
        $downloadName = Str::slug($item->nama_dokumen) . '-sembari.' . $ext;

        return response()->download($filePath, $downloadName);
    }
}
