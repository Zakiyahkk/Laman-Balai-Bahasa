@extends('layouts.user')

@section('title', 'Sejarah Singkat')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/profil.css') }}">
@endsection

@section('content')
    <section class="sejarah-page profile-hero profil-theme">

        <div class="hero-bg">
            <img src="https://ppidbbpriau.kemendikdasmen.go.id/images/gedung-balai.jpeg" alt="Gedung Balai">
        </div>

        <div class="container sejarah-container">

            <div class="sejarah-header">
                <h1>Sejarah Singkat</h1>
                <p>Dokumentasi perjalanan Balai Bahasa Provinsi Riau dari awal berdiri hingga sekarang.</p>
            </div>

            {{-- TIMELINE --}}
            <div class="sejarah-timeline">

                {{-- PERIODE 1 --}}
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <h3>Awal Berdiri (Contoh: 2005–2010)</h3>
                        <p>Dokumentasi awal kegiatan, perintisan program, dan perkembangan fasilitas.</p>

                        <div class="sejarah-gallery">
                            <a class="sejarah-photo" href="{{ asset('img/pantun.jpg') }}" target="_blank">
                                <img src="{{ asset('img/pantun.jpg') }}" alt="Awal 1">
                            </a>
                            <a class="sejarah-photo" href="{{ asset('img/buku.jpg') }}" target="_blank">
                                <img src="{{ asset('img/buku.jpg') }}" alt="Awal 2">
                            </a>
                            <a class="sejarah-photo" href="{{ asset('img/pantun2.png') }}" target="_blank">
                                <img src="{{ asset('img/pantun2.png') }}" alt="Awal 3">
                            </a>
                        </div>
                    </div>
                </div>

                {{-- PERIODE 2 --}}
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <h3>Masa Pengembangan (Contoh: 2011–2016)</h3>
                        <p>Kegiatan kebahasaan, pendampingan, serta penguatan layanan publik.</p>

                        <div class="sejarah-gallery">
                            <a class="sejarah-photo" href="{{ asset('img/sejarah/pengembangan-1.jpg') }}" target="_blank">
                                <img src="{{ asset('img/sejarah/pengembangan-1.jpg') }}" alt="Pengembangan 1">
                            </a>
                            <a class="sejarah-photo" href="{{ asset('img/sejarah/pengembangan-2.jpg') }}" target="_blank">
                                <img src="{{ asset('img/sejarah/pengembangan-2.jpg') }}" alt="Pengembangan 2">
                            </a>
                            <a class="sejarah-photo" href="{{ asset('img/sejarah/pengembangan-3.jpg') }}" target="_blank">
                                <img src="{{ asset('img/sejarah/pengembangan-3.jpg') }}" alt="Pengembangan 3">
                            </a>
                        </div>
                    </div>
                </div>

                {{-- PERIODE 3 --}}
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <h3>Sekarang (Contoh: 2017–Sekarang)</h3>
                        <p>Inovasi layanan, kegiatan terbaru, dan dokumentasi terkini.</p>

                        <div class="sejarah-gallery">
                            <a class="sejarah-photo" href="{{ asset('img/sejarah/sekarang-1.jpg') }}" target="_blank">
                                <img src="{{ asset('img/sejarah/sekarang-1.jpg') }}" alt="Sekarang 1">
                            </a>
                            <a class="sejarah-photo" href="{{ asset('img/sejarah/sekarang-2.jpg') }}" target="_blank">
                                <img src="{{ asset('img/sejarah/sekarang-2.jpg') }}" alt="Sekarang 2">
                            </a>
                            <a class="sejarah-photo" href="{{ asset('img/sejarah/sekarang-3.jpg') }}" target="_blank">
                                <img src="{{ asset('img/sejarah/sekarang-3.jpg') }}" alt="Sekarang 3">
                            </a>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        {{-- LIGHTBOX --}}
        <div id="lightbox" class="lightbox" aria-hidden="true">
            <button class="lightbox-close" type="button" aria-label="Tutup">&times;</button>
            <button class="lightbox-nav prev" type="button" aria-label="Sebelumnya">&#10094;</button>

            <div class="lightbox-content">
                <img id="lightbox-img" src="" alt="Preview">
                <div id="lightbox-caption" class="lightbox-caption"></div>
            </div>

            <button class="lightbox-nav next" type="button" aria-label="Berikutnya">&#10095;</button>
        </div>
    </section>
@endsection
