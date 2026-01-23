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

            {{-- HEADER --}}
            <div class="sejarah-header">
                <h1>Sejarah Singkat</h1>
                <p>Dokumentasi perjalanan Balai Bahasa Provinsi Riau dari awal berdiri hingga sekarang.</p>
            </div>

            {{-- KONTEN UTAMA --}}
            <div class="sejarah-content">

                {{-- DESKRIPSI SEJARAH --}}
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

                {{-- GAMBAR ILUSTRASI (LANDSCAPE) --}}
                <div class="sejarah-illustration">
                    <div class="upload-box">
                        <div class="upload-placeholder">
                            Tidak ada gambar
                        </div>
                    </div>

                    <div class="upload-box">
                        <div class="upload-placeholder">
                            Tidak ada gambar
                        </div>
                    </div>

                    <div class="upload-box">
                        <div class="upload-placeholder">
                            Tidak ada gambar
                        </div>
                    </div>

                    <div class="upload-box">
                        <div class="upload-placeholder">
                            Tidak ada gambar
                        </div>
                    </div>
                </div>

            </div>

            {{-- GALERI FOTO --}}
            <div class="sejarah-galeri">
                <h4>Kepala Balai dari Masa ke Masa</h4>
                <div class="galeri-wrapper">
                    <button class="galeri-nav prev" id="tokohPimpinanPrev">&#10094;</button>
                    <div class="sejarah-galeri-grid" id="tokohPimpinanSlider">

                        {{-- TERBARU --}}
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
