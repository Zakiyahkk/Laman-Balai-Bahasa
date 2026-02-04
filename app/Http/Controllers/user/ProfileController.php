<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class ProfileController extends Controller
{
    // =========================
    // KONEKSI SUPABASE
    // =========================
    private function supabase()
    {
        $key = env('SUPABASE_ANON_KEY');

        if (!$key) {
            abort(500, 'SUPABASE_ANON_KEY tidak ditemukan di .env');
        }

        return Http::withHeaders([
            'apikey'        => $key,
            'Authorization' => 'Bearer ' . $key,
            'Accept'        => 'application/json',
        ]);
    }

    // =========================
    // VISI & MISI
    // =========================
    public function visiMisi()
    {
        $profil = DB::table('profil')
            ->select('visi', 'misi')
            ->first();
    
        // fallback aman
        $visi = $profil->visi ?? '';
    
        // misi disimpan sebagai text (baris-baris)
        $misi = [];
        if (!empty($profil->misi)) {
            $misi = array_filter(
                array_map(
                    'trim',
                    preg_split("/\r\n|\n|\r/", $profil->misi)
                )
            );
        }
    
        return view('user.profil.visi-misi', compact('visi', 'misi'));
    }

    // =========================
    // SEJARAH SINGKAT
    // =========================
    public function sejarahSingkat()
    {
        return view('user.profil.sejarah-singkat');
    }

    // =========================
    // TUGAS & FUNGSI
    // =========================
    public function tugasdanfungsi()
    {
        $profil = DB::table('profil')
            ->select('tugas', 'fungsi')
            ->first();
    
        // fallback aman
        $tugas = $profil->tugas ?? '';
    
        // fungsi disimpan per baris
        $fungsi = [];
        if (!empty($profil->fungsi)) {
            $fungsi = array_filter(
                array_map(
                    'trim',
                    preg_split("/\r\n|\n|\r/", $profil->fungsi)
                )
            );
        }
    
        return view('user.profil.tugas-dan-fungsi', compact(
            'tugas',
            'fungsi'
        ));
    }


    // =========================
    // STRUKTUR ORGANISASI
    // =========================
    public function strukturOrganisasi()
    {
        $pegawai = DB::table('pegawai')->get();
    
        // Kepala Balai
        $kepalaRow = $pegawai->first(function ($item) {
            return str_contains(strtolower($item->jabatan), 'kepala');
        });
    
        // Kasubbag Umum
        $kasubbagRow = $pegawai->first(function ($item) {
            return str_contains(strtolower($item->jabatan), 'kasubbag');
        });
    
        // Helper foto
        $foto = function ($path) {
            return $path
                ? asset(ltrim($path, '/'))
                : asset('img/default-user.png');
        };
    
        $kepala = [
            'nama'    => $kepalaRow->nama ?? '',
            'jabatan' => $kepalaRow->jabatan ?? '',
            'foto'    => $kepalaRow ? $foto($kepalaRow->foto) : asset('img/default-user.png'),
        ];
    
        $kasubbag = [
            'nama'    => $kasubbagRow->nama ?? '',
            'jabatan' => $kasubbagRow->jabatan ?? '',
            'foto'    => $kasubbagRow ? $foto($kasubbagRow->foto) : asset('img/default-user.png'),
        ];
    
        return view('user.profil.struktur-organisasi', compact(
            'kepala',
            'kasubbag'
        ));
    }

    // =========================
    // PEGAWAI
    // =========================
    public function pegawai()
    {
        $pegawai = DB::table('pegawai')
            ->orderBy('created_at', 'asc')
            ->get();
    
        // Kepala Balai
        $kepala = $pegawai->first(function ($item) {
            return str_contains(strtolower($item->jabatan), 'kepala');
        });
    
        // Kasubbag
        $kasubbag = $pegawai->first(function ($item) {
            return str_contains(strtolower($item->jabatan), 'kasubbag');
        });
    
        // Pegawai lain
        $anggota = $pegawai->filter(function ($item) {
            return !str_contains(strtolower($item->jabatan), 'kepala')
                && !str_contains(strtolower($item->jabatan), 'kasubbag');
        })->values();
    
        // Helper foto
        $mapFoto = function ($item) {
            return [
                'nama'     => $item->nama,
                'jabatan'  => $item->jabatan,
                'foto_url' => $item->foto
                    ? asset(ltrim($item->foto, '/'))
                    : asset('img/default-user.png'),
            ];
        };
    
        return view('user.profil.pegawai', [
            'kepala'   => $kepala ? $mapFoto($kepala) : null,
            'kasubbag' => $kasubbag ? $mapFoto($kasubbag) : null,
            'anggota'  => $anggota->map($mapFoto),
        ]);
    }

    // =========================
    // LOGO BBP RIAU
    // =========================
    public function logobppriau()
    {
        return view('user.profil.logo-bpp-riau');
    }
    
    
}


