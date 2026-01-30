<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function terbitanbbpr()
    {
        return view('user.produk.terbitan-bbpr');
    }

    public function jurnal()
    {
        return view('user.produk.jurnal');
    }

    public function majalah()
    {
        return view('user.produk.majalah');
    }

    public function sembari(Request $request)
    {
        // ===============================
        // DOKUMEN CONTOH (DUMMY)
        // ===============================
        $docs = collect([
            [
                'judul' => 'Pedoman Penggunaan Aplikasi SEMBARI Tahun 2025',
                'tahun' => 2025,
                'tipe'  => 'pdf',
                'file'  => 'null',
            ],
            [
                'judul' => 'Laporan Implementasi SEMBARI Balai Bahasa Provinsi Riau Tahun 2024',
                'tahun' => 2024,
                'tipe'  => 'pdf',
                'file'  => 'null',
            ],
            [
                'judul' => 'Dokumen Teknis Sistem Manajemen Berbasis Riset (SEMBARI)',
                'tahun' => 2023,
                'tipe'  => 'pdf',
                'file'  => 'null',
            ],
            [
                'judul' => 'Panduan Admin SEMBARI',
                'tahun' => 2022,
                'tipe'  => 'pdf',
                'file'  => 'null',
            ],
        ]);
    
        // ===============================
        // FILTER
        // ===============================
        $q = trim((string) $request->query('q', ''));
        $year = $request->query('year');
    
        $filtered = $docs
            ->when($q !== '', fn ($c) =>
                $c->filter(fn ($d) =>
                    str_contains(
                        strtolower($d['judul']),
                        strtolower($q)
                    )
                )
            )
            ->when($year, fn ($c) =>
                $c->where('tahun', (int) $year)
            )
            ->values();
    
        $years = $docs->pluck('tahun')->unique()->sortDesc()->values();
    
        return view('user.produk.sembari', [
            'docs' => $filtered,
            'years' => $years,
            'q' => $q,
            'selectedYear' => $year,
        ]);
    }
    
    public function petaPembinaanBahasa()
    {
        return view('user.produk.peta-pembinaan-bahasa');
    }
    public function petaPembinaanSastra()
    {
        return view('user.produk.peta-pembinaan-sastra');
    }
    public function bipa()
    {
        return view('user.produk.bipa');
    }
    public function kemala()
    {
        return view('user.produk.kemala');
    }
    
}
