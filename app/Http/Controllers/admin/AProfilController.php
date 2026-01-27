<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class AProfilController extends Controller
{
    public function visiMisi()
    {
        $response = Http::withHeaders([
            'apikey'        => env('SUPABASE_SERVICE_ROLE_KEY'),
            'Authorization' => 'Bearer ' . env('SUPABASE_SERVICE_ROLE_KEY'),
            'Accept'        => 'application/json',
        ])->get(
            rtrim(env('SUPABASE_URL'), '/') . '/rest/v1/profil?profil_id=eq.1&select=visi,misi'
        );

        $data = $response->json()[0] ?? null;

        return view('admin.profil.visimisi', [
            'visi' => $data['visi'] ?? '',
            'misi' => isset($data['misi'])
                ? preg_split("/\r\n|\n|\r/", $data['misi'])
                : [],
        ]);
    }

    public function updateVisiMisi(Request $request)
    {
        $data = $request->json()->all();

        $validated = validator($data, [
            'visi' => 'required|string',
            'misi' => 'required|string',
        ])->validate();

        $response = Http::withHeaders([
            'apikey'        => env('SUPABASE_SERVICE_ROLE_KEY'),
            'Authorization' => 'Bearer ' . env('SUPABASE_SERVICE_ROLE_KEY'),
            'Content-Type'  => 'application/json',
            'Accept'        => 'application/json',
            'Prefer'        => 'return=representation',
        ])->patch(
            rtrim(env('SUPABASE_URL'), '/') . '/rest/v1/profil?profil_id=eq.1',
            [
                'visi'       => $validated['visi'],
                'misi'       => $validated['misi'],
                'updated_at' => now()->toISOString(),
            ]
        );

        if ($response->failed()) {
            return response()->json([
                'message' => 'Gagal menyimpan ke Supabase',
                'status'  => $response->status(),
                'error'   => $response->body(),
            ], 500);
        }

                return response()->json([
                    'message' => 'Berhasil menyimpan',
                    'data' => $response->json()
                ]);
            }

    public function tugasFungsi()
    {
        $response = Http::withHeaders([
            'apikey'        => env('SUPABASE_SERVICE_ROLE_KEY'),
            'Authorization' => 'Bearer ' . env('SUPABASE_SERVICE_ROLE_KEY'),
            'Accept'        => 'application/json',
        ])->get(
            rtrim(env('SUPABASE_URL'), '/') . '/rest/v1/profil?profil_id=eq.1&select=tugas,fungsi'
        );

        $data = $response->json()[0] ?? null;

        return view('admin.profil.tugasfungsi', [
            'tugas' => $data['tugas'] ?? '',
            'fungsi' => isset($data['fungsi'])
                ? preg_split("/\r\n|\n|\r/", $data['fungsi'])
                : [],
        ]);
    }

    public function updateTugasFungsi(Request $request)
    {
        $data = $request->json()->all();

        $validated = validator($data, [
            'tugas'  => 'required|string',
            'fungsi' => 'required|string',
        ])->validate();

        $response = Http::withHeaders([
            'apikey'        => env('SUPABASE_SERVICE_ROLE_KEY'),
            'Authorization' => 'Bearer ' . env('SUPABASE_SERVICE_ROLE_KEY'),
            'Content-Type'  => 'application/json',
            'Prefer'        => 'return=minimal',
        ])->patch(
            rtrim(env('SUPABASE_URL'), '/') . '/rest/v1/profil?profil_id=eq.1',
            [
                'tugas'      => $validated['tugas'],
                'fungsi'     => $validated['fungsi'],
                'updated_at' => now()->toISOString(),
            ]
        );

        if ($response->failed()) {
            return response()->json([
                'message' => 'Gagal menyimpan Tugas & Fungsi',
            ], 500);
        }

        return response()->json([
            'message' => 'Tugas & Fungsi berhasil disimpan',
        ]);
    }

    public function pegawai(Request $request)
    {
        $search = $request->query('search');

        $headers = [
            'apikey'        => env('SUPABASE_SERVICE_ROLE_KEY'),
            'Authorization' => 'Bearer ' . env('SUPABASE_SERVICE_ROLE_KEY'),
            'Accept'        => 'application/json',
        ];

        /* ================= WAJIB: INISIALISASI ================= */
        $kepalaBalai  = null;
        $kasubbagUmum = null;

        /* ================= AMBIL JABATAN STRATEGIS ================= */
        $kepalaBalai = Http::withHeaders($headers)->get(
            rtrim(env('SUPABASE_URL'), '/') .
            '/rest/v1/pegawai?select=pegawai_id,nama,jabatan,foto&jabatan=eq.Kepala Balai&limit=1'
        )->json()[0] ?? null;

        $kasubbagUmum = Http::withHeaders($headers)->get(
            rtrim(env('SUPABASE_URL'), '/') .
            '/rest/v1/pegawai?select=pegawai_id,nama,jabatan,foto&jabatan=eq.Kasubbag Umum&limit=1'
        )->json()[0] ?? null;

        /* ================= LIST PEGAWAI (TANPA STRATEGIS) ================= */
        $url = rtrim(env('SUPABASE_URL'), '/') .
            '/rest/v1/pegawai?select=pegawai_id,nama,jabatan,foto&order=created_at.desc' .
            '&jabatan=not.in.(Kepala Balai,Kasubbag Umum)';

        if (!empty($search)) {
            $search = urlencode($search);
            $url .= "&or=(nama.ilike.*{$search}*,jabatan.ilike.*{$search}*)";
        }

        $pegawai = Http::withHeaders($headers)->get($url)->json() ?? [];

        return view('admin.profil.pegawai', compact(
            'pegawai',
            'kepalaBalai',
            'kasubbagUmum'
        ));
    }

    public function storePegawai(Request $request)
    {
        $request->validate([
            'nama'    => 'required|string',
            'jabatan' => 'required|string',
            'foto'    => 'required|image|max:2048',
        ]);

        /* ================= SIMPAN FOTO KE LARAVEL ================= */
        $file = $request->file('foto');
        $namaFile = Str::uuid() . '.' . $file->getClientOriginalExtension();

        $file->move(public_path('img/pegawai'), $namaFile);

        $fotoPath = 'img/pegawai/' . $namaFile;

        /* ================= SIMPAN KE SUPABASE (DB SAJA) ================= */
        $insert = Http::withHeaders([
            'apikey'        => env('SUPABASE_SERVICE_ROLE_KEY'),
            'Authorization' => 'Bearer ' . env('SUPABASE_SERVICE_ROLE_KEY'),
            'Content-Type'  => 'application/json',
        ])->post(
            rtrim(env('SUPABASE_URL'), '/') . '/rest/v1/pegawai',
            [
                'nama'    => $request->nama,
                'jabatan' => $request->jabatan,
                'foto'    => $fotoPath,
            ]
        );

        if ($insert->failed()) {
            return back()->with('error', 'Gagal menyimpan data pegawai');
        }

        return redirect()
            ->route('admin.profil.pegawai')
            ->with('success', 'Pegawai berhasil ditambahkan');
    }

    public function updatePegawai(Request $request, $id)
    {
        $request->validate([
            'nama'    => 'required|string',
            'jabatan' => 'required|string',
            'foto'    => 'nullable|image|max:2048',
        ]);

        $headers = [
            'apikey'        => env('SUPABASE_SERVICE_ROLE_KEY'),
            'Authorization' => 'Bearer ' . env('SUPABASE_SERVICE_ROLE_KEY'),
            'Accept'        => 'application/json',
        ];

        /* ================= DATA LAMA ================= */
        $pegawaiLama = Http::withHeaders($headers)->get(
            rtrim(env('SUPABASE_URL'), '/') .
            "/rest/v1/pegawai?pegawai_id=eq.{$id}&select=foto,jabatan"
        )->json()[0] ?? null;

        $dataUpdate = [
            'nama'    => $request->nama,
            'jabatan' => $request->jabatan,
        ];

        /* ================= JIKA GANTI FOTO ================= */
        if ($request->hasFile('foto')) {

            // hapus foto lama lokal
            if (!empty($pegawaiLama['foto'])) {
                $oldPath = public_path($pegawaiLama['foto']);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            // simpan foto baru
            $file = $request->file('foto');
            $namaFile = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('img/pegawai'), $namaFile);

            $dataUpdate['foto'] = 'img/pegawai/' . $namaFile;
        }

        /* ================= UPDATE DB SUPABASE ================= */
        Http::withHeaders([
            'apikey'        => env('SUPABASE_SERVICE_ROLE_KEY'),
            'Authorization' => 'Bearer ' . env('SUPABASE_SERVICE_ROLE_KEY'),
            'Content-Type'  => 'application/json',
        ])->patch(
            rtrim(env('SUPABASE_URL'), '/') .
            "/rest/v1/pegawai?pegawai_id=eq.{$id}",
            $dataUpdate
        );

        return redirect()
            ->route('admin.profil.pegawai')
            ->with('success', 'Data pegawai berhasil diperbarui');
    }

    public function destroyPegawai($id)
    {
        $headers = [
            'apikey'        => env('SUPABASE_SERVICE_ROLE_KEY'),
            'Authorization' => 'Bearer ' . env('SUPABASE_SERVICE_ROLE_KEY'),
            'Accept'        => 'application/json',
        ];

        $pegawai = Http::withHeaders($headers)->get(
            rtrim(env('SUPABASE_URL'), '/') .
            "/rest/v1/pegawai?pegawai_id=eq.{$id}&select=foto"
        )->json()[0] ?? null;

        if (!$pegawai) {
            return back()->with('error', 'Data pegawai tidak ditemukan');
        }

        /* ================= HAPUS FOTO LOKAL ================= */
        if (!empty($pegawai['foto'])) {
            $path = public_path($pegawai['foto']);
            if (file_exists($path)) {
                unlink($path);
            }
        }

        /* ================= HAPUS DATA DB ================= */
        Http::withHeaders($headers)->delete(
            rtrim(env('SUPABASE_URL'), '/') .
            "/rest/v1/pegawai?pegawai_id=eq.{$id}"
        );

        return redirect()
            ->route('admin.profil.pegawai')
            ->with('success', 'Pegawai berhasil dihapus');
    }

        public function strukturorganisasi(Request $request)
    {
        $headers = [
            'apikey'        => env('SUPABASE_SERVICE_ROLE_KEY'),
            'Authorization' => 'Bearer ' . env('SUPABASE_SERVICE_ROLE_KEY'),
            'Accept'        => 'application/json',
        ];

        /* ================= AMBIL RIWAYAT STRUKTUR ================= */
        $riwayat = Http::withHeaders($headers)->get(
            rtrim(env('SUPABASE_URL'), '/') .
            '/rest/v1/struktur_organisasi?order=created_at.desc'
        )->json() ?? [];

        /* ================= TENTUKAN STRUKTUR YANG DITAMPILKAN ================= */
        $strukturAktif = null;

        // JIKA KLIK RIWAYAT (?struktur=ID)
        if ($request->struktur) {
            $strukturAktif = Http::withHeaders($headers)->get(
                rtrim(env('SUPABASE_URL'), '/') .
                "/rest/v1/struktur_organisasi?struktur_id=eq.{$request->struktur}"
            )->json()[0] ?? null;
        }
        if (!$strukturAktif) {
            $strukturAktif = collect($riwayat)->firstWhere('status', true);
        }
        if ($strukturAktif) {
            // DARI SNAPSHOT STRUKTUR
            $kepalaBalai  = $strukturAktif['kepala_balai'];
            $kasubbagUmum = $strukturAktif['kasubbag_umum'];
        } else {
            // FALLBACK DARI PEGAWAI (JIKA RIWAYAT KOSONG)
            $kepalaBalai = Http::withHeaders($headers)->get(
                rtrim(env('SUPABASE_URL'), '/') .
                '/rest/v1/pegawai?jabatan=eq.Kepala Balai&limit=1'
            )->json()[0] ?? null;

            $kasubbagUmum = Http::withHeaders($headers)->get(
                rtrim(env('SUPABASE_URL'), '/') .
                '/rest/v1/pegawai?jabatan=eq.Kasubbag Umum&limit=1'
            )->json()[0] ?? null;
        }

        return view('admin.profil.strukturorganisasi', compact(
            'kepalaBalai',
            'kasubbagUmum',
            'riwayat',
            'strukturAktif'
        ));
    }

    private function simpanSnapshotStruktur()
    {
        $headers = [
            'apikey'        => env('SUPABASE_SERVICE_ROLE_KEY'),
            'Authorization' => 'Bearer ' . env('SUPABASE_SERVICE_ROLE_KEY'),
            'Content-Type'  => 'application/json',
        ];

        $kepala = Http::withHeaders($headers)->get(
            rtrim(env('SUPABASE_URL'), '/') .
            '/rest/v1/pegawai?jabatan=eq.Kepala Balai&limit=1'
        )->json()[0] ?? null;

        $kasubbag = Http::withHeaders($headers)->get(
            rtrim(env('SUPABASE_URL'), '/') .
            '/rest/v1/pegawai?jabatan=eq.Kasubbag Umum&limit=1'
        )->json()[0] ?? null;

        if (!$kepala && !$kasubbag) return;

        Http::withHeaders($headers)->patch(
            rtrim(env('SUPABASE_URL'), '/') .
            '/rest/v1/struktur_organisasi?status=eq.true',
            ['status' => false]
        );

        Http::withHeaders($headers)->post(
            rtrim(env('SUPABASE_URL'), '/') .
            '/rest/v1/struktur_organisasi',
            [
                'versi'          => now()->year,
                'kepala_balai'   => $kepala,
                'kasubbag_umum'  => $kasubbag,
                'status'         => true,
            ]
        );
    }

    public function updateStrategis(Request $request)
    {
        $headers = [
            'apikey'        => env('SUPABASE_SERVICE_ROLE_KEY'),
            'Authorization' => 'Bearer ' . env('SUPABASE_SERVICE_ROLE_KEY'),
            'Content-Type'  => 'application/json',
        ];

        /* ================= KEPALA BALAI ================= */
        if ($request->kepala_id) {

            $old = Http::withHeaders($headers)->get(
                rtrim(env('SUPABASE_URL'), '/') .
                "/rest/v1/pegawai?pegawai_id=eq.{$request->kepala_id}&select=foto"
            )->json()[0] ?? null;

            $data = [
                'nama'    => $request->kepala_nama,
                'jabatan' => 'Kepala Balai',
            ];

            if ($request->hasFile('kepala_foto')) {
                $data['foto'] = $this->uploadFoto(
                    $request->file('kepala_foto')
                );
            }

            Http::withHeaders($headers)->patch(
                rtrim(env('SUPABASE_URL'), '/') .
                "/rest/v1/pegawai?pegawai_id=eq.{$request->kepala_id}",
                $data
            );
        }

        /* ================= KASUBBAG UMUM ================= */
        if ($request->kasubbag_id) {

            $old = Http::withHeaders($headers)->get(
                rtrim(env('SUPABASE_URL'), '/') .
                "/rest/v1/pegawai?pegawai_id=eq.{$request->kasubbag_id}&select=foto"
            )->json()[0] ?? null;

            $data = [
                'nama'    => $request->kasubbag_nama,
                'jabatan' => 'Kasubbag Umum',
            ];

            if ($request->hasFile('kasubbag_foto')) {

                // HAPUS FOTO LAMA DI LARAVEL
                if (!empty($old['foto'])) {
                    $oldPath = public_path($old['foto']);
                    if (file_exists($oldPath)) {
                        unlink($oldPath);
                    }
                }

                // SIMPAN FOTO BARU KE LARAVEL
                $data['foto'] = $this->uploadFoto(
                    $request->file('kasubbag_foto')
                );
            }
            Http::withHeaders($headers)->patch(
                rtrim(env('SUPABASE_URL'), '/') .
                "/rest/v1/pegawai?pegawai_id=eq.{$request->kasubbag_id}",
                $data
            );
        }

        /* ================= SNAPSHOT STRUKTUR BARU ================= */
        $this->simpanSnapshotStruktur();


            return redirect()
                ->route('admin.profil.pegawai')
                ->with('success', 'Jabatan strategis berhasil diperbarui');
        }

        private function uploadFoto($file)
        {
            $path = public_path('img/pegawai');

            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }

            $name = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->move($path, $name);

            return 'img/pegawai/' . $name;
        }
}
