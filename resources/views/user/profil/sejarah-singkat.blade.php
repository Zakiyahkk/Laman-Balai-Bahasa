@extends('layouts.user')

@section('title', 'Sejarah Singkat')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/profil.css') }}">
    
    {{-- CSS Override Khusus Halaman Ini --}}
    <style>
        /* Base Background */
        .sejarah-page {
            background-color: #f8fafc;
            background-image: 
                radial-gradient(at 0% 0%, rgba(11, 42, 74, 0.03) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(252, 163, 17, 0.03) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(11, 42, 74, 0.03) 0px, transparent 50%);
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .hero-bg::after {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, 
                rgba(11, 42, 74, 0.4) 0%, 
                rgba(11, 42, 74, 0.85) 100%);
        }

        /* --- DESKTOP LAYOUT (SPLIT 3/4 : 1/4) --- */
        
        /* 1. Kontainer Utama: Putih Solid */
        .sejarah-content {
            background: #ffffff !important; /* Putih Solid */
            padding: 50px;
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.05);
            border: 1px solid rgba(0,0,0,0.02);
            backdrop-filter: none !important;
            
            /* Grid Layout: Kiri Teks (3fr), Kanan Foto (1fr) */
            display: grid;
            grid-template-columns: 3fr 1fr; 
            gap: 40px;
            align-items: start; /* Rata atas */
            margin-top: 0;
        }

        /* 2. Teks Deskripsi (Kiri) */
        .sejarah-deskripsi {
            background: transparent;
            padding: 0;
            border: none;
            box-shadow: none;
        }

        /* Typography */
        .sejarah-deskripsi h4 {
            color: #0b2a4a !important;
            font-weight: 700;
            font-size: 26px;
            margin-bottom: 24px;
        }
        .text-box p {
            color: #334155 !important;
            text-shadow: none !important;
            font-size: 16px;
            line-height: 1.8;
            margin-bottom: 20px;
            text-align: justify;
            text-indent: 0 !important; /* TIDAK MENJOROK KE DALAM */
        }

        /* 3. Foto Ilustrasi (Kanan): Stack Vertikal */
        .sejarah-illustration {
            display: flex;
            flex-direction: column; /* Susun ke bawah */
            gap: 20px;
            margin-top: 0 !important;
        }

        .upload-box {
            /* Hapus background putih kotak */
            background: transparent; 
            box-shadow: none; 
            border-radius: 12px;
            overflow: hidden;
            width: 100%;
            height: 160px; /* Tinggi seragam */
            position: relative;
        }
        
        .upload-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1); /* Shadow langsung di gambar */
            transition: transform 0.3s ease;
        }
        .upload-box:hover img {
            transform: scale(1.02);
        }

        /* --- FIX SLIDER GAP & SIZE (Agar JS Hitungannya Tepat) --- */
        .sejarah-galeri-grid {
            gap: 30px !important; /* Pastikan gap sesuai hitungan JS */
            padding: 40px 20px;
        }
        .galeri-box {
            min-width: 260px !important; /* Ukuran pasti */
            width: 260px !important;
        }

        /* --- MOBILE RESPONSIVE --- */
        @media (max-width: 900px) {
            .sejarah-content {
                display: flex;       
                flex-direction: column;
                padding: 30px 20px;
                gap: 30px;
            }

            /* Urutan Mobile: Teks dulu, baru Foto */
            .sejarah-deskripsi {
                order: 1; 
            }
            .sejarah-deskripsi h4 {
                font-size: 20px; 
                margin-bottom: 15px;
            }
            .text-box p {
                font-size: 14px; 
                line-height: 1.6;
            }

            .sejarah-illustration {
                order: 2;
                
                /* Layout Slider Horizontal khusus Mobile */
                display: flex !important; /* Paksa jadi Flex */
                flex-direction: row !important; 
                overflow-x: auto; 
                scroll-snap-type: x mandatory;
                padding-bottom: 25px; /* Lebih lebar untuk scrollbar */
                gap: 15px;
                
                /* TAMPILKAN Scrollbar dengan Warna Kontras */
                scrollbar-width: thin;
                scrollbar-color: #475569 #e2e8f0;
                -webkit-overflow-scrolling: touch; /* Smooth scrolling native */
            }
            
            /* Styling Scrollbar Webkit (Chrome/Safari) - Dipertegas */
            .sejarah-illustration::-webkit-scrollbar { 
                height: 10px; /* Lebih tebal supaya mudah ditekan */
                display: block; 
                background-color: #f1f5f9;
                border-radius: 6px;
            }
            .sejarah-illustration::-webkit-scrollbar-track {
                background: #e2e8f0; 
                border-radius: 6px;
            }
            .sejarah-illustration::-webkit-scrollbar-thumb {
                background-color: #475569; /* Warna gelap solid */
                border-radius: 6px;
                border: 2px solid #e2e8f0; 
            }
            .sejarah-illustration::-webkit-scrollbar-thumb:hover {
                background-color: #334155; 
            }

            .upload-box {
                /* Ukuran Card di Mobile */
                min-width: 220px; 
                width: 220px;
                height: 140px;
                scroll-snap-align: center; 
            }
        }
    </style>
@endsection

@section('content')
    <section class="sejarah-page profile-hero profil-theme">
        <div class="hero-bg">
            <img src="https://ppidbbpriau.kemendikdasmen.go.id/images/gedung-balai.jpeg" alt="Gedung Balai">
        </div>

        <div class="container sejarah-container">

            {{-- HEADER --}}
            <div class="sejarah-header">
                <h1>Sejarah Singkat</h1>
                <p>Dokumentasi perjalanan Balai Bahasa Provinsi Riau dari awal berdiri hingga sekarang.</p>
            </div>

            {{-- KONTEN UTAMA (SPLIT 3/4 : 1/4) --}}
            <div class="sejarah-content">

                {{-- KOLOM KIRI (75%): TEKS DESKRIPSI --}}
                <div class="sejarah-deskripsi">
                    <h4>Sejarah Singkat Balai Bahasa Provinsi Riau</h4>
                    <div class="text-box">
                        <p>Balai Bahasa Provinsi Riau awalnya bernama Balai Bahasa Pekanbaru yang berdiri
                            berdasarkan Keputusan Menteri Pendidikan dan Kebudayaan Nomor 226/0/1999 Tanggal 23
                            September 1999 dan sesuai dengan DIK 1997/1998 Pusat Pembinaan dan Pengembangan
                            Bahasa Jakarta. Balai bahasa dibangun di atas sebidang tanah yang luasnya 2000 meter
                            persegi terletak di Kampus UNRI, Jalan H.R. Subrantas Km. 12,5 Simpang Baru,
                            Pekanbaru. Tanah ini dihibahkan oleh Pemerintah Provinsi Riau pada bulan April 1997. Luas
                            bangunan Balai Bahasa Pekanbaru adalah 2000 meter. Meskipun perkembangannya masih
                            70%, Balai Bahasa Pekanbaru sudah mulai dioperasikan secara resmi pada tanggal 28 Oktober 2000.
                        </p>

                        <p>Melalui Permendikbud Nomor 21 Tahun 2012 (dan perubahan berikutnya dengan
                            Permendikbud/Permendikbudristek), nomenklatur Balai Bahasa Pekanbaru diubah menjadi Balai Bahasa
                            Provinsi Riau,
                            selaras dengan nomenklatur UPT Balai Bahasa di provinsi lain. Perubahan ini diperbarui kembali
                            dalam
                            Permendikbudristek
                            Nomor 12 Tahun 2022, serta diperkuat dalam Permendikbudristek Nomor 47 Tahun 2024, yang
                            menjelaskan
                            nomenklatur resmi Balai
                            Bahasa Provinsi Riau dengan lokasi di Kota Pekanbaru dan wilayah kerja Provinsi Riau. Balai
                            Bahasa
                            Provinsi Riau adalah Unit
                            Pelaksana Teknis (UPT) di bawah Badan Pengembangan dan Pembinaan Bahasa, Kementerian Pendidikan
                            Pendidikan Dasar dan Menengah,
                            yang berkedudukan di Kota Pekanbaru, dengan wilayah kerja meliputi seluruh Provinsi Riau.</p>

                        <p>Balai ini memiliki mandat untuk menjalankan tugas pengembangan, pembinaan,
                            pelindungan,dan fasilitasi kebahasaan dan kesastraan, baik dalam bahasa Indonesia
                            maupun bahasa daerah yang hidup dan berkembang di Riau.</p>
                    </div>
                </div>

                {{-- KOLOM KANAN (25%): FOTO ILUSTRASI (VERTICAL STACK) --}}
                <div class="sejarah-illustration">
                    <div class="upload-box">
                        <img src="{{ asset('img/fotobalai.png') }}" alt="Dokumentasi 1">
                    </div>
                    <div class="upload-box">
                        <img src="{{ asset('img/fotobalai.png') }}" alt="Dokumentasi 2">
                    </div>
                    <div class="upload-box">
                        <img src="{{ asset('img/fotobalai.png') }}" alt="Dokumentasi 3">
                    </div>
                    <div class="upload-box">
                        <img src="{{ asset('img/fotobalai.png') }}" alt="Dokumentasi 4">
                    </div>
                </div>

            </div>

            {{-- GALERI SLIDER PEMIMPIN --}}
            <div class="sejarah-galeri">
                <h4>Kepala Balai dari Masa ke Masa</h4>
                <div class="galeri-wrapper">
                    <button class="galeri-nav prev" id="tokohPimpinanPrev">&#10094;</button>
                    <div class="sejarah-galeri-grid" id="tokohPimpinanSlider">

                        {{-- Foto Terbaru --}}
                        <div class="galeri-box">
                            <img src="{{ asset('img/kepala balai 2025-sekarang.jpeg') }}">
                        </div>

                        <div class="galeri-box">
                            <img src="{{ asset('img/kepala balai 2022-2025.jpeg') }}">
                        </div>

                        <div class="galeri-box">
                            <img src="{{ asset('img/kepala balai 2020-2022.jpeg') }}">
                        </div>

                        <div class="galeri-box">
                            <img src="{{ asset('img/kepala balai 2019-2020.jpeg') }}">
                        </div>

                        <div class="galeri-box">
                            <img src="{{ asset('img/kepala balai 2016-2019.jpeg') }}">
                        </div>

                        <div class="galeri-box">
                            <img src="{{ asset('img/kepala balai 2009-2016.jpeg') }}">
                        </div>

                        <div class="galeri-box">
                            <img src="{{ asset('img/kepala balai 2002-2009.jpeg') }}">
                        </div>

                        <div class="galeri-box">
                            <img src="{{ asset('img/kepala balai 2000-2002.jpeg') }}">
                        </div>

                    </div>
                    <button class="galeri-nav next" id="tokohPimpinanNext">&#10095;</button>
                </div>
            </div>

        </div>
    </section>
@endsection

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const slider = document.getElementById("tokohPimpinanSlider");
        const prevBtn = document.getElementById("tokohPimpinanPrev");
        const nextBtn = document.getElementById("tokohPimpinanNext");

        // Perhitungan Scroll Dinamis (Card + Gap)
        const getScrollStep = () => {
            const card = slider.querySelector('.galeri-box');
            if (!card) return 290; 
            return card.offsetWidth + 30; // Gap 30px CSS
        };

        const duration = 500; // ms

        // Fungsi Animasi Manual (Old Style)
        function smoothScroll(element, distance, duration) {
            const start = element.scrollLeft;
            const startTime = performance.now();

            function easeInOutCubic(t) {
                return t < 0.5 ? 4 * t * t * t : 1 - Math.pow(-2 * t + 2, 3) / 2;
            }

            function animate(currentTime) {
                const elapsed = currentTime - startTime;
                const progress = Math.min(elapsed / duration, 1);
                const ease = easeInOutCubic(progress);

                element.scrollLeft = start + distance * ease;

                if (progress < 1) {
                    requestAnimationFrame(animate);
                }
            }

            requestAnimationFrame(animate);
        }

        // Event Listeners
        nextBtn.addEventListener("click", () => {
            smoothScroll(slider, getScrollStep(), duration);
        });

        prevBtn.addEventListener("click", () => {
            smoothScroll(slider, -getScrollStep(), duration);
        });
    });
</script>
@endsection
