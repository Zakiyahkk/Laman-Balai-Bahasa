@extends('layouts.user')

@section('title', 'Layanan Perpustakaan')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/layanan.css') }}">
@endsection

@section('content')
    <section class="layanan-page">

        <div class="layanan-container">

            <div class="layanan-card">

                {{-- HEADER --}}
                <header class="layanan-header">
                    <h1>Layanan Perpustakaan</h1>
                </header>

                {{-- DESKRIPSI --}}
                <div class="layanan-deskripsi">
                    <p>
                        <strong>Layanan Perpustakaan</strong> merupakan layanan yang disediakan
                        oleh Balai Bahasa Provinsi Riau untuk mendukung kegiatan literasi,
                        penelitian, dan pengembangan kebahasaan serta kesastraan.
                    </p>
                    <p>
                        Perpustakaan Balai Bahasa Provinsi Riau menyediakan koleksi buku,
                        referensi kebahasaan, karya sastra, serta sumber informasi lainnya
                        yang dapat dimanfaatkan oleh masyarakat sesuai ketentuan yang berlaku.
                    </p>
                </div>

                {{-- GAMBAR --}}
                <div class="layanan-media">
                    <img src="{{ asset('img/SP-Perpustakaan.png') }}" alt="Standar Pelayanan Perpustakaan">
                </div>

                {{-- LINK --}}

                <div class="layanan-link">
                    <span>Informasi dan layanan Perpustakaan</span>
                    <a href="https://balaibahasariau.kemendikdasmen.go.id/layananbalai/layanan.php?page=perpustakaan"
                        target="_blank" rel="noopener noreferrer">
                        di sini
                    </a>
                </div>

            </div>

        </div>

    </section>
@endsection
