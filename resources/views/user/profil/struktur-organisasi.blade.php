@extends('layouts.user')

@section('title', 'Struktur Organisasi')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/profil.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        /* ================= BACKGROUND ================= */
        .profil-riau {
            position: relative;
            background: #0f172a; 
            min-height: 100vh;
            overflow: hidden; 
            padding-bottom: 80px;
        }

        .hero-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
        }

        .hero-bg img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            animation: none !important;
        }

        .hero-bg::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(
                to bottom, 
                rgba(15, 23, 42, 0.6) 0%, 
                rgba(15, 23, 42, 0.3) 100%
            );
            z-index: 1;
        }

        .profil-riau .container {
            position: relative;
            z-index: 2;
            padding-top: 60px;
            width: 100%;
        }

        .profil-header-struktur {
            text-align: center;
            margin-bottom: 50px;
            color: #fff;
            text-shadow: 0 2px 15px rgba(0,0,0,0.8);
        }
        
        .profil-header-struktur h1 { font-size: 2.5rem; font-weight: 800; margin-bottom: 10px; color: #ffffff; }
        .profil-header-struktur p { color: #fff; font-weight: 500; font-size: 1rem; max-width: 700px; margin: 0 auto; text-shadow: 0 1px 10px rgba(0,0,0,0.8); }

        /* ================= LAYOUT STRUKTUR BARU (CUSTOM TREE) ================= */
        .structure-canvas {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            max-width: 900px;
            margin: 0 auto;
        }

        /* --- GARIS VERTIKAL TENGAH (SPINE) --- */
        /* Ini garis panjang dari Kepala sampai Fungsional */
        .spine-vertical {
            position: absolute;
            top: 160px; /* Mulai dari bawah card Kepala */
            bottom: 160px; /* Berhenti di atas card Fungsional */
            left: 50%; /* Tepat di tengah */
            width: 4px;
            background: rgba(255, 255, 255, 0.8);
            transform: translateX(-50%);
            z-index: 1;
            box-shadow: 0 0 5px rgba(0,0,0,0.3);
        }

        /* --- CABANG KE KANAN (UNTUK KASUBBAG) --- */
        .branch-right {
            position: absolute;
            top: 50%; /* Posisi vertikal di tengah spine */
            left: 50%;
            width: 120px; /* Panjang lengan ke kanan */
            height: 4px;
            background: rgba(255, 255, 255, 0.8);
            z-index: 1;
            box-shadow: 0 0 5px rgba(0,0,0,0.3);
        }

        /* --- CONTAINER POSISI CARD --- */
        .row-head {
            z-index: 10;
            margin-bottom: 60px; /* Jarak ke cabang */
        }

        .row-middle {
            display: flex;
            justify-content: flex-end; /* Dorong Kasubbag ke kanan */
            width: 100%;
            position: relative;
            height: 100px; /* Tinggi area tengah */
            margin-bottom: 60px; /* Jarak ke Fungsional */
        }

        /* Wrapper Kasubbag agar posisinya pas di ujung garis kanan */
        .kasubbag-wrapper {
            position: absolute;
            left: calc(50% + 120px); /* Tengah + Panjang Lengan */
            top: 50%;
            transform: translateY(-50%); /* Tengah vertikal */
            z-index: 10;
        }

        .row-bottom {
            z-index: 10;
        }

        /* ================= CARD STYLE (GLASS & LONJONG) ================= */
        .card-struktur {
            background: rgba(255, 255, 255, 0.15); 
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.4);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            border-radius: 20px;
            padding: 20px 15px;
            width: 240px; /* Lebar card fix */
            text-align: center;
            transition: all 0.3s ease;
        }

        .card-struktur:hover {
            transform: scale(1.05);
            background: rgba(255, 255, 255, 0.25);
            border-color: #fff;
            z-index: 20;
        }

        /* Strip Warna Atas */
        .card-struktur.level-head { border-top: 4px solid #facc15; }
        .card-struktur.level-sub { border-top: 4px solid #3b82f6; }
        .card-struktur.level-func { border-top: 4px solid #10b981; }

        /* FOTO LONJONG (PORTRAIT CAPSULE) */
        .foto-lonjong {
            width: 90px;
            height: 115px; /* Tinggi > Lebar = Lonjong */
            margin: 0 auto 12px;
            border-radius: 50px; /* Lengkungan penuh */
            overflow: hidden;
            border: 3px solid rgba(255,255,255, 0.9);
            background: rgba(255,255,255,0.2);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        
        .foto-lonjong img {
            width: 100%; height: 100%; object-fit: cover; object-position: top center;
        }

        /* Icon pengganti foto */
        .icon-box {
            width: 90px; height: 115px;
            margin: 0 auto 12px;
            border-radius: 50px;
            display: flex; align-items: center; justify-content: center;
            border: 3px solid rgba(255,255,255, 0.5);
            background: rgba(255,255,255,0.1);
        }
        .icon-box i { font-size: 40px; color: #fff; }

        /* Teks */
        .nama-role {
            font-size: 0.95rem; font-weight: 700; color: #ffffff;
            margin-bottom: 4px; line-height: 1.3; 
            text-shadow: 0 1px 3px rgba(0,0,0,0.6);
        }
        .jabatan-role {
            font-size: 0.8rem; color: rgba(255, 255, 255, 0.9);
            font-weight: 500; line-height: 1.2;
            text-shadow: 0 1px 3px rgba(0,0,0,0.6);
        }

        /* ================= RESPONSIVE (MOBILE) ================= */
        @media (max-width: 768px) {
            .structure-canvas {
                margin-top: 20px;
            }
            /* Sembunyikan garis desktop */
            .spine-vertical, .branch-right { display: none; }
            
            /* Ubah posisi Kasubbag jadi di bawah (stack vertikal) */
            .kasubbag-wrapper {
                position: relative;
                left: auto; top: auto; transform: none;
                margin: 20px 0;
            }
            
            .row-middle {
                height: auto;
                justify-content: center;
                margin-bottom: 0;
            }

            .row-head, .row-bottom {
                margin-bottom: 20px;
            }

            /* Tambahkan garis vertikal sederhana antar card di mobile */
            .row-head::after, .kasubbag-wrapper::after {
                content: ''; display: block; width: 2px; height: 20px;
                background: rgba(255,255,255,0.5); margin: 0 auto;
            }
        }
    </style>
@endsection

@section('content')
<section class="profil-riau">
    
    {{-- BACKGROUND --}}
    <div class="hero-bg">
        <img src="https://ppidbbpriau.kemendikdasmen.go.id/images/gedung-balai.jpeg" alt="Gedung Balai">
    </div>

    <div class="container">

        <div class="profil-header-struktur">
            <h1>Struktur Organisasi</h1>
            <p>Susunan dan hubungan kerja antarbagian Balai Bahasa Provinsi Riau.</p>
        </div>

        {{-- AREA GAMBAR STRUKTUR --}}
        <div class="structure-canvas">
            
            {{-- 1. GARIS PENGHUBUNG (Desktop Only) --}}
            <div class="spine-vertical"></div> {{-- Garis lurus tengah --}}
            <div class="branch-right"></div>   {{-- Garis cabang ke kanan --}}

            {{-- 2. POSISI ATAS: KEPALA BALAI --}}
            <div class="row-head">
                <div class="card-struktur level-head">
                    <div class="foto-lonjong">
                        <img src="{{ $kepala['foto'] }}" alt="{{ $kepala['nama'] }}">
                    </div>
                    <div class="nama-role">{{ $kepala['nama'] }}</div>
                    <div class="jabatan-role">Kepala Balai</div>
                </div>
            </div>

            {{-- 3. POSISI TENGAH: AREA KASUBBAG --}}
            <div class="row-middle">
                {{-- Kasubbag ditempatkan absolut di kanan --}}
                <div class="kasubbag-wrapper">
                    <div class="card-struktur level-sub">
                        <div class="foto-lonjong">
                            <img src="{{ $kasubbag['foto'] }}" alt="{{ $kasubbag['nama'] }}">
                        </div>
                        <div class="nama-role">{{ $kasubbag['nama'] }}</div>
                        <div class="jabatan-role">Kasubbag Umum</div>
                    </div>
                </div>
            </div>

            {{-- 4. POSISI BAWAH: FUNGSIONAL --}}
            <div class="row-bottom">
                <div class="card-struktur level-func">
                    <div class="icon-box">
                        <i class="fa-solid fa-users-gear"></i>
                    </div>
                    <div class="nama-role">Kelompok Jabatan Fungsional</div>
                </div>
            </div>

        </div>

    </div>
</section>
@endsection