<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AkuntabilitasController extends Controller
{
    public function perjanjianKinerja(Request $request)
{
    // DATA DUMMY PERJANJIAN KINERJA
    $docs = collect([
        [
            'judul' => 'Perjanjian Kinerja Balai Bahasa Provinsi Tahun 2025',
            'tahun' => 2025,
            'tipe'  => 'pdf',
            'file'  => 'perjanjian-kinerja/pk-2025.pdf',
        ],
        [
            'judul' => 'Perjanjian Kinerja Balai Bahasa Provinsi Tahun 2024',
            'tahun' => 2024,
            'tipe'  => 'pdf',
            'file'  => 'perjanjian-kinerja/pk-2024.pdf',
        ],
        [
            'judul' => 'Perjanjian Kinerja Balai Bahasa Provinsi Tahun 2023',
            'tahun' => 2023,
            'tipe'  => 'pdf',
            'file'  => 'perjanjian-kinerja/pk-2023.pdf',
        ],
    ]);

    $q = trim((string) $request->query('q', ''));
    $year = $request->query('year');

    $filtered = $docs
        ->when($q !== '', fn ($c) =>
            $c->filter(fn ($d) =>
                str_contains(strtolower($d['judul']), strtolower($q))
            )
        )
        ->when($year, fn ($c) =>
            $c->where('tahun', (int) $year)
        )
        ->values();

    $years = $docs->pluck('tahun')->unique()->sortDesc()->values();

    return view('user.akuntabilitas.perjanjian-kinerja', [
        'docs' => $filtered,
        'years' => $years,
        'q' => $q,
        'selectedYear' => $year,
    ]);
}

    public function renstra(Request $request)
    {
        $docs = collect([
            ['judul' => 'Rencana Strategis Unit Kerja Tahun 2025–2029', 'tahun' => 2025, 'tipe' => 'pdf', 'file' => 'renstra/dokumentesting1.pdf'],
            ['judul' => 'Renstra Badan Bahasa: Arah Kebijakan dan Program 2025–2029', 'tahun' => 2025, 'tipe' => 'pdf', 'file' => 'renstra/dokumentesting2.pdf'],
            ['judul' => 'Dokumen Renstra dan Indikator Kinerja 2020–2024', 'tahun' => 2024, 'tipe' => 'pdf', 'file' => 'renstra/dokumentesting3.pdf'],
            ['judul' => 'Renstra: Sasaran Strategis dan Target Tahunan 2023', 'tahun' => 2023, 'tipe' => 'pdf', 'file' => 'renstra/dokumentesting4.pdf'],
        ]);
        $q = trim((string) $request->query('q', ''));
        $year = $request->query('year');
    
        $filtered = $docs
            ->when($q !== '', fn($c) => $c->filter(fn($d) => str_contains(strtolower($d['judul']), strtolower($q))))
            ->when($year, fn($c) => $c->where('tahun', (int)$year))
            ->values();
    
        $years = $docs->pluck('tahun')->unique()->sortDesc()->values();
    
        return view('user.akuntabilitas.renstra', [
            'docs' => $filtered,
            'years' => $years,
            'q' => $q,
            'selectedYear' => $year,
        ]);
    }
    
    public function lakin(Request $request)
{
    // DATA DUMMY LAKIN
    $docs = collect([
        [
            'judul' => 'Laporan Akuntabilitas Kinerja Instansi Pemerintah Tahun 2025',
            'tahun' => 2025,
            'tipe'  => 'pdf',
            'file'  => 'lakin/lakin-2025.pdf',
        ],
        [
            'judul' => 'Laporan Akuntabilitas Kinerja Instansi Pemerintah Tahun 2024',
            'tahun' => 2024,
            'tipe'  => 'pdf',
            'file'  => 'lakin/lakin-2024.pdf',
        ],
        [
            'judul' => 'Laporan Akuntabilitas Kinerja Instansi Pemerintah Tahun 2023',
            'tahun' => 2023,
            'tipe'  => 'pdf',
            'file'  => 'lakin/lakin-2023.pdf',
        ],
    ]);

    // Ambil query
    $q = trim((string) $request->query('q', ''));
    $year = $request->query('year');

    // FILTER (SAMA PERSIS RENSTRA & DIPA)
    $filtered = $docs
        ->when($q !== '', fn ($c) =>
            $c->filter(fn ($d) =>
                str_contains(strtolower($d['judul']), strtolower($q))
            )
        )
        ->when($year, fn ($c) =>
            $c->where('tahun', (int) $year)
        )
        ->values();

    // LIST TAHUN
    $years = $docs->pluck('tahun')->unique()->sortDesc()->values();

    return view('user.akuntabilitas.lakin', [
        'docs' => $filtered,
        'years' => $years,
        'q' => $q,
        'selectedYear' => $year,
    ]);
}


        /* ================= DIPA ================= */
        public function dipa(Request $request)
        {
            // DATA DUMMY DIPA
            $docs = collect([
                ['judul' => 'DIPA Balai Bahasa Provinsi Tahun Anggaran 2025', 'tahun' => 2025, 'tipe' => 'pdf', 'file' => 'dipa/dipa-2025.pdf'],
                ['judul' => 'DIPA Revisi I Tahun Anggaran 2025', 'tahun' => 2025, 'tipe' => 'pdf', 'file' => 'dipa/dipa-revisi-2025.pdf'],
                ['judul' => 'DIPA Balai Bahasa Provinsi Tahun Anggaran 2024', 'tahun' => 2024, 'tipe' => 'pdf', 'file' => 'dipa/dipa-2024.pdf'],
                ['judul' => 'DIPA dan Rincian Anggaran Tahun 2023', 'tahun' => 2023, 'tipe' => 'pdf', 'file' => 'dipa/dipa-2023.pdf'],
            ]);
    
            $q = trim((string) $request->query('q', ''));
            $year = $request->query('year');
    
            // FILTER (SAMA DENGAN RENSTRA)
            $filtered = $docs
                ->when($q !== '', fn ($c) =>
                    $c->filter(fn ($d) =>
                        str_contains(strtolower($d['judul']), strtolower($q))
                    )
                )
                ->when($year, fn ($c) =>
                    $c->where('tahun', (int) $year)
                )
                ->values();
    
            $years = $docs->pluck('tahun')->unique()->sortDesc()->values();
    
            return view('user.akuntabilitas.dipa', [
                'docs' => $filtered,
                'years' => $years,
                'q' => $q,
                'selectedYear' => $year,
            ]);
        }

    public function sakai()
    {
        return view('user.akuntabilitas.sakai');
    }

    public function rencanaAksi(Request $request)
{
    $docs = collect([
        [
            'judul' => 'Rencana Aksi Kinerja Tahun 2025',
            'tahun' => 2025,
            'tipe'  => 'pdf',
            'file'  => 'rencana-aksi/ra-2025.pdf',
        ],
        [
            'judul' => 'Rencana Aksi Kinerja Tahun 2024',
            'tahun' => 2024,
            'tipe'  => 'pdf',
            'file'  => 'rencana-aksi/ra-2024.pdf',
        ],
        [
            'judul' => 'Rencana Aksi Kinerja Tahun 2023',
            'tahun' => 2023,
            'tipe'  => 'pdf',
            'file'  => 'rencana-aksi/ra-2023.pdf',
        ],
    ]);

    $q = trim((string) $request->query('q', ''));
    $year = $request->query('year');

    $filtered = $docs
        ->when($q !== '', fn ($c) =>
            $c->filter(fn ($d) =>
                str_contains(strtolower($d['judul']), strtolower($q))
            )
        )
        ->when($year, fn ($c) =>
            $c->where('tahun', (int) $year)
        )
        ->values();

    $years = $docs->pluck('tahun')->unique()->sortDesc()->values();

    return view('user.akuntabilitas.rencana-aksi', [
        'docs' => $filtered,
        'years' => $years,
        'q' => $q,
        'selectedYear' => $year,
    ]);
}

}