<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AkuntabilitasController extends Controller
{
    public function perjanjianKinerja()
    {
        return view('user.akuntabilitas.perjanjian-kinerja');
    }

    public function renstra(Request $request)
    {
        $docs = collect([
            ['judul' => 'Renstra 2025–2029', 'tahun' => 2025, 'tipe' => 'pdf', 'file' => 'renstra/dokumentesting1.pdf'],
            ['judul' => 'Renstra 2020–2024', 'tahun' => 2024, 'tipe' => 'pdf', 'file' => 'renstra/dokumentesting2.pdf'],
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
    
    public function lakin()
    {
        return view('user.akuntabilitas.lakin');
    }

    public function dipa()
    {
        return view('user.akuntabilitas.dipa');
    }

    public function sakai()
    {
        return view('user.akuntabilitas.sakai');
    }

    public function rencanaAksi()
    {
        return view('user.akuntabilitas.rencana-aksi');
    }
}