@extends('layouts.user')

@section('title', 'Layanan Penerjemahan')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/layanan.css') }}">
@endsection

@section('content')
    <section class="layanan-page">

        <div class="layanan-container">

            <div class="layanan-card">

                {{-- HEADER --}}
                <header class="layanan-header">
                    <h1>Layanan Penerjemahan</h1>
                </header>

                {{-- DESKRIPSI --}}
                <div class="layanan-deskripsi">
                    <p>
                        <strong>Layanan Penerjemahan</strong> merupakan layanan yang disediakan
                        oleh Balai Bahasa Provinsi Riau untuk membantu penerjemahan naskah dari
                        dan ke bahasa Indonesia sesuai dengan kaidah kebahasaan yang berlaku.
                    </p>
                    <p>
                        Layanan ini ditujukan untuk mendukung kebutuhan lembaga, instansi,
                        dan masyarakat dalam penyediaan terjemahan yang akurat, jelas,
                        dan bertanggung jawab sesuai standar pelayanan.
                    </p>
                </div>

                {{-- GAMBAR --}}
                <div class="layanan-media">
                    <img src="{{ asset('img/Penerjemahan.png') }}" alt="Standar Pelayanan Penerjemahan">
                </div>

                {{-- LINK --}}
                <div class="layanan-link">
                    <span>Ajukan permohonan layanan Penerjemahan</span>
                    <a href="https://balaibahasariau.kemendikdasmen.go.id/layananbalai/layanan.php?page=penerjemah"
                        target="_blank" rel="noopener noreferrer">
                        di sini
                    </a>
                </div>

            </div>

        </div>

    </section>
@endsection
