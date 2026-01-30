<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class ZiwbkController extends Controller
{
    public function index()
    {
        return view('ziwbk.ziwbk');
    }

    public function dokumen($tahun, $area, $sub)
{
    $q = request('q');

    $judulSub = [

        // ================= MANEJEMEN PERUBAHAN =================
        'tim-kerja' => 'Tim Kerja',
        'rencana-pembangunan-wbk' => 'Rencana Pembangunan WBK',
        'pemantauan-evaluasi' => 'Pemantauan & Evaluasi',
        'pola-pikir-budaya-kerja' => 'Pola Pikir & Budaya Kerja',

        // ================= PENGUATAN TATA LAKSANA =================
        'pos' => 'Prosedur Operasional Standar (POS)',
        'sistem-elektronik' => 'Sistem Elektronik',
        'keterbukaan-informasi' => 'Keterbukaan Informasi',

        // ================= MANAJEMEN SDM =================
        'perencanaan-kebutuhan' => 'Perencanaan Kebutuhan',
        'pola-mutasi-internal' => 'Pola Mutasi Internal',
        'pengembangan-pegawai' => 'Pengembangan Pegawai',
        'penetapan-kinerja' => 'Penetapan Kinerja',
        'penegakan-disiplin' => 'Penegakan Disiplin',
        'sistem-informasi' => 'Sistem Informasi',

        // ================= PENGUATAN AKUNTABILITAS =================
        'keterlibatan-pimpinan' => 'Keterlibatan Pimpinan',
        'akuntabilitas-kinerja' => 'Akuntabilitas Kinerja',

        // ================= PENGUATAN PENGAWASAN =================
        'gratifikasi' => 'Gratifikasi',
        'spi' => 'Sistem Pengendalian Intern (SPI)',
        'pengaduan-masyarakat' => 'Pengaduan Masyarakat',
        'whistleblowing' => 'Whistle Blowing',
        'benturan-kepentingan' => 'Benturan Kepentingan',

        // ================= LAYANAN PUBLIK =================
        'standar-pelayanan' => 'Standar Pelayanan',
        'budaya-pelayanan-prima' => 'Budaya Pelayanan Prima',
        'pemanfaatan-tik' => 'Pemanfaatan TIK',
        'kepuasan-masyarakat' => 'Kepuasan Masyarakat',
    ];

    // ================= DATA DUMMY =================
    $data = [
        'tim-kerja' => [
            ['judul' => 'SK Tim Kerja ZI-WBK 1', 'tahun' => 2025, 'file' => 'dummy/sk-tim-kerja.pdf'],
            ['judul' => 'SK Tim Kerja ZI-WBK 2', 'tahun' => 2025, 'file' => 'document/buku6.pdf'],
            ['judul' => 'SK Tim Kerja ZI-WBK Tahun 2026', 'tahun' => 2026, 'file' => 'document/sk-tim-kerja-2026.pdf'],
        ],
        'rencana-pembangunan-wbk' => [
            ['judul' => 'Rencana Pembangunan WBK', 'tahun' => 2025, 'file' => null],
        ],
        'pemantauan-evaluasi' => [
            ['judul' => 'Pemantauan Evaluasi', 'tahun' => 2025, 'file' => null],
        ],
        'pola-pikir-budaya-kerja' => [
            ['judul' => 'Pola Pikir Budaya Kerja', 'tahun' => 2025, 'file' => null],
        ],
        'kepuasan-masyarakat' => [
            ['judul' => 'Kepuasan Masyarakat', 'tahun' => 2025, 'file' => null],
        ],
    ];

    // ================= FILTER DATA =================
    $docs = collect($data[$sub] ?? [])
        ->where('tahun', (int) $tahun)   // 🔒 TAHUN DIKUNCI DARI URL
        ->when($q, fn ($c) =>
            $c->filter(fn ($d) =>
                str_contains(
                    strtolower($d['judul']),
                    strtolower($q)
                )
            )
        )
        ->values();

    return view('user.ziwbk.dokumen', [
        'tahun' => $tahun,
        'area' => $area,
        'sub' => $sub,
        'judul' => $judulSub[$sub] ?? 'Dokumen ZI-WBK',
        'docs' => $docs,
    ]);
}

}