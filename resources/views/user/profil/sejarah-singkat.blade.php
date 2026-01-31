@extends('layouts.user')

@section('title', 'Sejarah Singkat')

@section('css')
<style>
/* =========================================
   CSS KHUSUS HALAMAN SEJARAH SINGKAT
========================================= */

/* Halaman Utama */
.sejarah-page {
    position: relative;
    width: 100%;
    min-height: 100vh;
    
    /* BACKGROUND ELEGAN: Base putih kebiruan dengan bias cahaya */
    background-color: #f8fafc;
    background-image: 
        radial-gradient(at 0% 0%, rgba(11, 42, 74, 0.03) 0px, transparent 50%),
        radial-gradient(at 100% 0%, rgba(252, 163, 17, 0.03) 0px, transparent 50%),
        radial-gradient(at 100% 100%, rgba(11, 42, 74, 0.03) 0px, transparent 50%);
    
    /* UPDATE FONT: Plus Jakarta Sans */
    font-family: 'Plus Jakarta Sans', sans-serif;
    padding-bottom: 0; 
}

/* Background Hero Image */
.hero-bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 500px;
    z-index: 0;
}
.hero-bg img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    /* HAPUS animasi zoom otomatis */
    animation: none !important;
    transform: none !important;
}
.hero-bg::after {
    content: "";
    position: absolute;
    inset: 0;
    /* UPDATE: Hapus fade-to-white. Gunakan overlay gelap flat/clean agar gambar terlihat utuh & tajam */
    background: rgba(11, 42, 74, 0.6); 
}

/* Container Umum */
.sejarah-container {
    position: relative;
    z-index: 1;
    /* UPDATE: Diperlebar sedikit agar konten lebih lega (1100px -> 1280px) */
    max-width: 1280px;
    margin: auto;
    padding: 0 24px;
}

/* -- BAGIAN 1: HEADER & DESKRIPSI -- */
.sejarah-top-section {
    padding-top: 140px;
    padding-bottom: 60px;
}

/* Header Section */
.sejarah-header {
    text-align: center;
    margin-bottom: 50px;
    color: #fff;
}
.sejarah-header h1 {
    font-size: 42px;
    font-weight: 800;
    margin-bottom: 16px;
    letter-spacing: -0.5px;
}
.sejarah-header p {
    font-size: 18px;
    opacity: 0.95;
    max-width: 700px;
    margin: auto;
    line-height: 1.6;
    font-weight: 300;
}

/* Card Content Utama */
.sejarah-content {
    background: #fff;
    border-radius: 24px;
    padding: 60px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.05);
    border: 1px solid rgba(0,0,0,0.02);
}

/* Typography Deskripsi */
.sejarah-deskripsi h4 {
    font-size: 28px;
    font-weight: 700;
    color: #0b2a4a;
    margin-bottom: 30px;
    position: relative;
    padding-bottom: 10px;
}
.sejarah-deskripsi h4::after {
    content: "";
    position: absolute;
    left: 0;
    bottom: 0;
    width: 80px;
    height: 5px;
    background: #fca311;
    border-radius: 10px;
}

.text-box p {
    font-size: 17px;
    line-height: 1.85;
    color: #334155;
    margin-bottom: 24px;
    text-align: justify;
}

/* Illustrasi Grid */
.sejarah-illustration {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    margin-top: 50px;
}
.upload-box {
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    height: 160px;
}
/* Menghilangkan efek hover aneh, cukup diam saja gambarnya */
.upload-box img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* -- BAGIAN 2: GALERI SLIDER (Full Width Gradient) -- */
.sejarah-galeri-full {
    position: relative;
    width: 100%;
    /* Gradient Biru Halus Penutup */
    background: linear-gradient(180deg, #f8f9fa 0%, #e6f0ff 100%);
    padding: 80px 0 100px;
    clip-path: ellipse(150% 100% at 50% 100%);
    margin-top: -40px; 
    z-index: 2;
}

.sejarah-galeri-title {
    text-align: center;
    margin-bottom: 50px;
}
.sejarah-galeri-title h4 {
    font-size: 32px;
    font-weight: 800;
    color: #0b2a4a;
    margin-bottom: 10px;
}
.sejarah-galeri-title p {
    color: #64748b;
    font-size: 16px;
}

/* --- FIX SUPAYA TIDAK ADA WARNA BIRU SAAT DIKLIK --- */
* {
    -webkit-tap-highlight-color: transparent; /* Hilangkan highlight di mobile */
}

/* Wrapper Slider */
.galeri-wrapper {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    max-width: 1200px;
    margin: auto;
}

/* Container Scroll Horizontal */
.sejarah-galeri-grid {
    display: flex;
    align-items: center;
    gap: 30px;
    overflow-x: auto;
    padding: 40px 20px; 
    scrollbar-width: none; /* Firefox */
    -ms-overflow-style: none; /* IE */
    width: 100%;
    
    /* PENTING: Matikan smooth scroll CSS agar tidak bentrok dengan Script JS */
    scroll-behavior: auto; 
    
    /* Mencegah seleksi teks/gambar tidak sengaja */
    user-select: none;
    -webkit-user-select: none;
}
.sejarah-galeri-grid::-webkit-scrollbar { display: none; } /* Chrome/Safari */

/* Kartu Foto */
.galeri-box {
    /* PENTING: Gunakan min-width agar kartu tidak mengecil */
    min-width: 260px;
    width: 260px;
    
    background: #fff;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 15px 40px rgba(11, 42, 74, 0.1); 
    transition: box-shadow 0.3s ease;
    position: relative;
    border: 1px solid rgba(255,255,255,0.8);
    transform: translateZ(0); /* Hardware acceleration */
}

.galeri-box:hover {
    box-shadow: 0 25px 50px rgba(11, 42, 74, 0.25);
    z-index: 5;
}

.galeri-box img {
    width: 100%;
    height: auto;
    display: block;
    pointer-events: none; /* Supaya gambar gak ke-drag/ke-select */
}

/* Tombol Navigasi */
.galeri-nav {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: #fff !important; /* PAKSA tetap putih */
    color: #0b2a4a;
    border: 1px solid rgba(0,0,0,0.1);
    cursor: pointer;
    font-size: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    transition: box-shadow 0.2s; /* Hanya shadow yang transisi */
    position: absolute;
    z-index: 999;
    top: 50%;
    transform: translateY(-50%);
    outline: none !important;
    -webkit-tap-highlight-color: transparent !important;
}
.galeri-nav:hover {
    background: #0b2a4a !important;
    color: #fff;
    box-shadow: 0 12px 24px rgba(11, 42, 74, 0.3);
}
/* HAPUS :active state agar tidak berubah saat diklik */
.galeri-nav:active,
.galeri-nav:focus {
    background: #fff !important; /* Tetap putih */
    color: #0b2a4a !important;
    outline: none !important;
}

.galeri-nav.prev { left: -25px; }
.galeri-nav.next { right: -25px; }


/* =========================================
   RESPONSIVE MOBILE
========================================= */
@media (max-width: 900px) {
    .galeri-nav.prev { left: 0; }
    .galeri-nav.next { right: 0; }
}

@media (max-width: 768px) {
    .sejarah-top-section { padding-top: 100px; padding-bottom: 40px; }
    .sejarah-header h1 { font-size: 32px; }
    .sejarah-header p { font-size: 15px; }
    
    .sejarah-content { padding: 30px 24px; }
    .sejarah-deskripsi h4 { font-size: 22px; }
    .text-box p { font-size: 15px; text-align: left; }

    .sejarah-illustration {
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }
    .upload-box { height: 120px; }

    .sejarah-galeri-full {
        padding: 50px 0 80px;
        margin-top: 0;
        clip-path: none;
    }
    .sejarah-galeri-title h4 { font-size: 26px; }
    
    .galeri-wrapper { padding: 0; }
    .galeri-nav { display: none; } /* Mobile swipe only */
    
    .galeri-box {
        min-width: 220px;
        width: 220px;
    }
    .sejarah-galeri-grid {
        justify-content: flex-start;
        padding-left: 20px; /* Biar kartu pertama gak nempel kiri */
    }
}
</style>
@endsection

@section('content')
    <section class="sejarah-page">
        {{-- Hero Background --}}
        <div class="hero-bg">
            <img src="https://ppidbbpriau.kemendikdasmen.go.id/images/gedung-balai.jpeg" alt="Gedung Balai">
        </div>

        {{-- BAGIAN 1: KONTEN UTAMA --}}
        <div class="sejarah-container sejarah-top-section">
            
            {{-- Header --}}
            <div class="sejarah-header">
                <h1>Sejarah Singkat</h1>
                <p>Dokumentasi perjalanan Balai Bahasa Provinsi Riau dari awal berdiri hingga sekarang.</p>
            </div>

            {{-- Card Putih --}}
            <div class="sejarah-content">
                {{-- Deskripsi --}}
                <div class="sejarah-deskripsi">
                    <h4>Sejarah Balai Bahasa Riau</h4>
                    <div class="text-box">
                        <p>Balai Bahasa Provinsi Riau awalnya bernama Balai Bahasa Pekanbaru yang berdiri
                            berdasarkan Keputusan Menteri Pendidikan dan Kebudayaan Nomor 226/0/1999 Tanggal 23
                            September 1999 dan sesuai dengan DIK 1997/1998 Pusat Pembinaan dan Pengembangan
                            Bahasa Jakarta.</p> 
                            
                        <p>Balai bahasa dibangun di atas sebidang tanah yang luasnya 2000 meter
                            persegi terletak di Kampus UNRI, Jalan H.R. Subrantas Km. 12,5 Simpang Baru,
                            Pekanbaru. Tanah ini dihibahkan oleh Pemerintah Provinsi Riau pada bulan April 1997. Luas
                            bangunan Balai Bahasa Pekanbaru adalah 2000 meter. Meskipun perkembangannya masih
                            70%, Balai Bahasa Pekanbaru sudah mulai dioperasikan secara resmi pada tanggal 28 Oktober 2000.
                        </p>

                        <p>Melalui Permendikbud Nomor 21 Tahun 2012, nomenklatur Balai Bahasa Pekanbaru diubah menjadi Balai Bahasa
                            Provinsi Riau, selaras dengan nomenklatur UPT Balai Bahasa di provinsi lain. Perubahan ini diperbarui kembali
                            dalam Permendikbudristek Nomor 12 Tahun 2022, serta diperkuat dalam Permendikbudristek Nomor 47 Tahun 2024.</p>
                            
                        <p>Balai Bahasa Provinsi Riau adalah Unit Pelaksana Teknis (UPT) di bawah Badan Pengembangan dan Pembinaan Bahasa, Kementerian Pendidikan Dasar dan Menengah,
                            yang berkedudukan di Kota Pekanbaru, dengan wilayah kerja meliputi seluruh Provinsi Riau. Balai ini memiliki mandat untuk menjalankan tugas pengembangan, pembinaan,
                            pelindungan, dan fasilitasi kebahasaan dan kesastraan.</p>
                    </div>
                </div>

                {{-- Ilustrasi --}}
                <div class="sejarah-illustration">
                    <div class="upload-box"><img src="{{ asset('img/fotobalai.png') }}" alt="Dokumentasi 1"></div>
                    <div class="upload-box"><img src="{{ asset('img/fotobalai.png') }}" alt="Dokumentasi 2"></div>
                    <div class="upload-box"><img src="{{ asset('img/fotobalai.png') }}" alt="Dokumentasi 3"></div>
                    <div class="upload-box"><img src="{{ asset('img/fotobalai.png') }}" alt="Dokumentasi 4"></div>
                </div>
            </div>
        </div>

        {{-- BAGIAN 2: SLIDER KEPALA BALAI (Full Width Gradient) --}}
        <div class="sejarah-galeri-full">
            <div class="sejarah-container">
                <div class="sejarah-galeri-title">
                    <h4>Kepala Balai dari Masa ke Masa</h4>
                    <p>Dedikasi kepemimpinan dalam memajukan kebahasaan dan kesastraan di Riau</p>
                </div>

                <div class="galeri-wrapper">
                    <!-- Tombol Prev -->
                    <button type="button" class="galeri-nav prev" id="tokohPimpinanPrev" aria-label="Previous">
                        <i class="fas fa-chevron-left"></i>
                    </button>

                    <!-- Scroll Container -->
                    <div class="sejarah-galeri-grid" id="tokohPimpinanSlider">
                        {{--  Foto 1: Sekarang --}}
                        <div class="galeri-box">
                            <img src="{{ asset('img/kepala balai 2025-sekarang.jpeg') }}" loading="lazy" alt="2025-Sekarang">
                        </div>

                        {{-- Foto 2: 2022-2025 --}}
                        <div class="galeri-box">
                            <img src="{{ asset('img/kepala balai 2022-2025.jpeg') }}" loading="lazy" alt="2022-2025">
                        </div>

                        {{-- Foto 3: 2020-2022 --}}
                        <div class="galeri-box">
                            <img src="{{ asset('img/kepala balai 2020-2022.jpeg') }}" loading="lazy" alt="2020-2022">
                        </div>

                        {{-- Foto 4: 2019-2020 --}}
                        <div class="galeri-box">
                            <img src="{{ asset('img/kepala balai 2019-2020.jpeg') }}" loading="lazy" alt="2019-2020">
                        </div>

                        {{-- Foto 5: 2016-2019 --}}
                        <div class="galeri-box">
                            <img src="{{ asset('img/kepala balai 2016-2019.jpeg') }}" loading="lazy" alt="2016-2019">
                        </div>

                        {{-- Foto 6: 2009-2016 --}}
                        <div class="galeri-box">
                            <img src="{{ asset('img/kepala balai 2009-2016.jpeg') }}" loading="lazy" alt="2009-2016">
                        </div>

                        {{-- Foto 7: 2002-2009 --}}
                        <div class="galeri-box">
                            <img src="{{ asset('img/kepala balai 2002-2009.jpeg') }}" loading="lazy" alt="2002-2009">
                        </div>

                        {{-- Foto 8: 2000-2002 --}}
                        <div class="galeri-box">
                            <img src="{{ asset('img/kepala balai 2000-2002.jpeg') }}" loading="lazy" alt="2000-2002">
                        </div>
                    </div>

                    <!-- Tombol Next -->
                    <button type="button" class="galeri-nav next" id="tokohPimpinanNext" aria-label="Next">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>

    </section>
@endsection

@section('js')
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const slider = document.getElementById("tokohPimpinanSlider");
        const prevBtn = document.getElementById("tokohPimpinanPrev");
        const nextBtn = document.getElementById("tokohPimpinanNext");

        if (!slider || !prevBtn || !nextBtn) return;

        // Ambil lebar kartu + gap secara dinamis agar presisi dengan CSS baru
        const getScrollStep = () => {
            const card = slider.querySelector('.galeri-box');
            if (!card) return 290; 
            return card.offsetWidth + 30; // Gap 30px
        };

        const duration = 500; // Durasi animasi (ms)

        // --- LOGIKA "OLD CODE" (Manual Animation) ---
        function smoothScroll(element, distance, duration) {
            const start = element.scrollLeft;
            const startTime = performance.now();

            function easeInOutCubic(t) {
                return t < 0.5 ?
                    4 * t * t * t :
                    1 - Math.pow(-2 * t + 2, 3) / 2;
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

        // Gunakan event listener sederhana seperti kode lama
        nextBtn.addEventListener("click", () => {
            const scrollStep = getScrollStep();
            smoothScroll(slider, scrollStep, duration);
        });

        prevBtn.addEventListener("click", () => {
            const scrollStep = getScrollStep();
            smoothScroll(slider, -scrollStep, duration);
        });
    });
</script>
@endsection
