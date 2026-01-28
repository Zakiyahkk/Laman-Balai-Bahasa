@extends('layouts.user')

@section('title', 'Layanan UKBI')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/layanan.css') }}">
@endsection

@section('content')
    <section class="layanan-page">

        <div class="layanan-container">

            <div class="layanan-card">

                {{-- HEADER --}}
                <header class="layanan-header">
                    <h1>Layanan UKBI</h1>
                </header>

                {{-- DESKRIPSI --}}
                <div class="layanan-deskripsi">
                    <p>
                        <strong>Uji Kemahiran Berbahasa Indonesia (UKBI)</strong> merupakan
                        sarana uji untuk mengukur tingkat kemahiran seseorang dalam
                        menggunakan bahasa Indonesia, baik secara lisan maupun tulis.
                    </p>
                    <p>
                        Layanan UKBI diselenggarakan oleh Balai Bahasa Provinsi Riau
                        bagi masyarakat, lembaga, dan instansi yang memerlukan
                        sertifikasi kemahiran berbahasa Indonesia sesuai standar yang berlaku.
                    </p>
                </div>

                {{-- GAMBAR --}}
                <div class="layanan-media">
                    <img src="{{ asset('img/UKBI.png') }}" alt="Standar Pelayanan UKBI">
                </div>

                {{-- LINK --}}
                <div class="layanan-link">
                    <span>Ajukan permohonan layanan UKBI</span>
                    <a href="https://balaibahasariau.kemendikdasmen.go.id/layanan/layanan.php?page=ukbi" target="_blank"
                        rel="noopener noreferrer">
                        di sini
                    </a>
                </div>

            </div>

        </div>

    </section>
@endsection
