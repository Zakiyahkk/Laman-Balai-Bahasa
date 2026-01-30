<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 

class SurveiController extends Controller
{
    public function survei(Request $request)
    {
        // =========================
        // DATA GIMMICK (DUMMY)
        // =========================
        $surveis = [
            [
                'judul' => 'Hasil Survei Kepuasan Masyarakat',
                'tahun' => 2024,
                'tipe'  => 'pdf',
                'file'  => 'dummy/hasil-survei-kepuasan-2024.pdf',
            ],
            [
                'judul' => 'Hasil Survei Persepsi Kualitas Pelayanan',
                'tahun' => 2023,
                'tipe'  => 'pdf',
                'file'  => 'dummy/hasil-survei-kualitas-2023.pdf',
            ],
            [
                'judul' => 'Hasil Survei Persepsi Antikorupsi',
                'tahun' => 2023,
                'tipe'  => 'pdf',
                'file'  => 'aasaw023.pdf', // simulasi belum ada file
            ],
        ];

        // =========================
        // AMBIL TAHUN
        // =========================
        $years = collect($surveis)
            ->pluck('tahun')
            ->unique()
            ->sortDesc()
            ->values();

        // =========================
        // FILTER
        // =========================
        $q = $request->q;
        $selectedYear = $request->year;

        $filtered = collect($surveis)->filter(function ($item) use ($q, $selectedYear) {
            if ($q && !str_contains(strtolower($item['judul']), strtolower($q))) {
                return false;
            }
            if ($selectedYear && $item['tahun'] != $selectedYear) {
                return false;
            }
            return true;
        })->values();

        return view('user.survei.survei', [
            'surveis'      => $filtered,
            'years'        => $years,
            'q'            => $q,
            'selectedYear' => $selectedYear,
        ]);
    }
}