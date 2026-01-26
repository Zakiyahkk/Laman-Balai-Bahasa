<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

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
        $baseUrl = rtrim(env('SUPABASE_URL'), '/') . '/rest/v1/profil';

        $profil = $this->supabase()->get($baseUrl, [
            'select' => 'visi,misi',
            'limit'  => 1,
        ])->throw()->json();

        $profil = $profil[0] ?? [
            'visi' => '',
            'misi' => '',
        ];

        return view('user.profil.visi-misi', compact('profil'));
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
        $baseUrl = rtrim(env('SUPABASE_URL'), '/') . '/rest/v1/profil';

        $profil = $this->supabase()->get($baseUrl, [
            'select' => 'tugas,fungsi',
            'limit'  => 1,
        ])->throw()->json();

        $profil = $profil[0] ?? [
            'tugas'  => '',
            'fungsi' => '',
        ];

        return view('user.profil.tugas-dan-fungsi', compact('profil'));
    }

    // =========================
    // STRUKTUR ORGANISASI
    // =========================
    public function strukturOrganisasi()
    {
        return view('user.profil.struktur-organisasi');
    }

    // =========================
    // PEGAWAI
    // =========================
    public function pegawai()
    {
        return view('user.profil.pegawai');
    }

    // =========================
    // LOGO BBP RIAU
    // =========================
    public function logobppriau()
    {
        return view('user.profil.logo-bpp-riau');
    }
}
