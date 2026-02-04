<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Akuntabilitas; 
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str; // Tambahan untuk download name

class AkuntabilitasController extends Controller
{
    /**
     * Fungsi Helper untuk mengambil data dari Database berdasarkan tipe
     */
    private function getDokumen($tipe, Request $request)
    {
        $q = trim((string) $request->query('q', ''));
        $year = $request->query('year');

        // 1. Mulai Query
        $query = Akuntabilitas::where('tipe', $tipe);

        // 2. Cek Status (Flexible: published/Published)
        $query->where(function($query) {
            $query->where('status', 'published')
                ->orWhere('status', 'Published');
        });

        // 3. Filter Pencarian Nama
        if ($q !== '') {
            $query->where('nama_dokumen', 'like', "%{$q}%");
        }

        // 4. Filter Tahun
        if ($year) {
            $query->whereYear('tanggal', $year);
        }

        // 5. Eksekusi Ambil Data Dokumen
        $docs = $query->orderBy('tanggal', 'desc')->get();

        // 6. Ambil daftar tahun untuk Dropdown
        $years = Akuntabilitas::where('tipe', $tipe)
            ->whereNotNull('tanggal')
            ->selectRaw('YEAR(tanggal) as tahun')
            ->distinct()
            ->orderByDesc('tahun')
            ->pluck('tahun');

        // 7. Kembalikan data
        return [
            'docs'         => $docs,
            'years'        => $years,
            'q'            => $q,
            'selectedYear' => $year,
        ];
    }

    public function perjanjianKinerja(Request $request) {
        return view('user.akuntabilitas.perjanjian-kinerja', $this->getDokumen('pk', $request)); // Sesuaikan tipe DB 'pk' atau 'perjanjian-kinerja'
    }

    public function renstra(Request $request) {
        return view('user.akuntabilitas.renstra', $this->getDokumen('renstra', $request));
    }

    public function lakin(Request $request) {
        return view('user.akuntabilitas.lakin', $this->getDokumen('lakin', $request));
    }

    public function dipa(Request $request) {
        return view('user.akuntabilitas.dipa', $this->getDokumen('dipa', $request));
    }

    public function rencanaAksi(Request $request) {
        $data = $this->getDokumen('ra', $request); // Sesuaikan tipe DB 'ra' atau 'rencana-aksi'
        if (!isset($data['docs'])) { $data['docs'] = []; }
        return view('user.akuntabilitas.rencana-aksi', $data); 
    }

    public function sakai() {
        return view('user.akuntabilitas.sakai');
    }

    // METHOD PREVIEW (Inline Browser)
    public function file($id)
    {
        $doc = Akuntabilitas::findOrFail($id);
        $path = $doc->file_path;

        if (!$path || !Storage::disk('public')->exists($path)) {
            abort(404, 'File tidak ditemukan');
        }

        return response()->file(Storage::disk('public')->path($path));
    }

    // METHOD DOWNLOAD (Force Download)
    public function download($id)
    {
        $item = Akuntabilitas::findOrFail($id); // Gunakan $item agar konsisten

        if (!$item->file_path || !Storage::disk('public')->exists($item->file_path)) {
            return back()->with('error', 'File tidak ditemukan.');
        }

        $filePath = Storage::disk('public')->path($item->file_path);
        
        $ext = pathinfo($filePath, PATHINFO_EXTENSION);
        $downloadName = Str::slug($item->nama_dokumen) . '.' . $ext;

        return response()->download($filePath, $downloadName);
    }
}