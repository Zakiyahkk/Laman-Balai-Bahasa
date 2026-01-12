@extends('layouts.user')

@section('title', 'Detail Berita')

@section('content')

    <section class="section berita-detail">
        <div class="container">

            {{-- WRAPPER biar rapi di tengah --}}
            <div class="berita-detail-wrap">

                {{-- JUDUL --}}
                <h1 class="berita-detail-title">
                    Kolaborasi dengan Komunitas Relawan Cerdas Riau
                </h1>

                {{-- META --}}
                <div class="berita-detail-meta">
                    <span class="meta-item">
                        <i class="fa-regular fa-calendar"></i>
                        14 Desember 2025
                    </span>

                    <span class="meta-dot">•</span>

                    <span class="meta-item">
                        <i class="fa-regular fa-user"></i>
                        Admin
                    </span>

                    <span class="meta-dot">•</span>

                    <span class="meta-item meta-views">
                        <i class="fa-regular fa-eye"></i>
                        486
                    </span>
                </div>

                {{-- CARD (konten) --}}
                <div class="berita-detail-card">

                    {{-- GAMBAR --}}
                    <div class="berita-detail-image">
                        <img src="/img/fasilitas-1.png" alt="Kolaborasi Relawan Cerdas Riau">
                    </div>

                    {{-- ISI --}}
                    <div class="berita-detail-content">
                        <p>
                            Balai Bahasa Provinsi Riau melaksanakan kegiatan kolaborasi
                            dengan Komunitas Relawan Cerdas Riau sebagai upaya memperkuat
                            peran literasi dan kebahasaan di tengah masyarakat.
                        </p>

                        <p>
                            Kegiatan ini bertujuan untuk meningkatkan kesadaran masyarakat
                            terhadap penggunaan bahasa Indonesia yang baik dan benar,
                            serta pelestarian bahasa daerah sebagai kekayaan budaya
                            bangsa.
                        </p>

                        <p>
                            Kepala Balai Bahasa Provinsi Riau menyampaikan bahwa sinergi
                            antara lembaga pemerintah dan komunitas sangat penting dalam
                            menyukseskan program kebahasaan dan kesastraan.
                        </p>

                        <p>
                            Melalui kegiatan ini diharapkan terbangun jejaring kerja sama
                            yang berkelanjutan untuk mendukung visi Balai Bahasa Provinsi
                            Riau sebagai pusat pembinaan bahasa di wilayah Riau.
                        </p>
                    </div>
                </div>

                {{-- TOMBOL KEMBALI --}}
                <div class="berita-detail-actions">
                    <a href="{{ route('berita.index') }}" class="btn-kembali">
                        ← Kembali ke Berita
                    </a>
                </div>

            </div>
        </div>
    </section>

@endsection
