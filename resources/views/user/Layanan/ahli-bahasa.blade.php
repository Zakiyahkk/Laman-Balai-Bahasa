@extends('layouts.user')

@section('title', 'Layanan Ahli Bahasa')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/layanan.css') }}">
@endsection

@section('content')
    <section class="layanan-page">

        <div class="layanan-container">

            <div class="layanan-card">

                {{-- HEADER --}}
                <header class="layanan-header">
                    <h1>Layanan Ahli Bahasa</h1>
                </header>

                {{-- DESKRIPSI --}}
                <div class="layanan-deskripsi">
                    <p>
                        <strong>Layanan Ahli Bahasa</strong> merupakan layanan profesional
                        yang diselenggarakan oleh Balai Bahasa Provinsi Riau untuk mendukung
                        peningkatan mutu dan pemartabatan bahasa Indonesia serta pelindungan
                        bahasa daerah.
                    </p>
                    <p>
                        Layanan ini meliputi penyediaan narasumber kebahasaan, penyuluhan bahasa,
                        penyuntingan naskah, pendampingan bahasa, serta kegiatan literasi sesuai
                        dengan kebutuhan pemohon. Pelaksanaan layanan dilakukan berdasarkan
                        standar pelayanan yang berlaku.
                    </p>
                </div>

                {{-- GAMBAR --}}
                <div class="layanan-media">
                    <img src="{{ asset('img/Ahli-Bahasa.png') }}" alt="Standar Pelayanan Ahli Bahasa">
                </div>

                {{-- LINK --}}
                <div class="layanan-link">
                    <span>Ajukan permohonan layanan Ahli Bahasa</span>
                    <a href="https://balaibahasariau.kemendikdasmen.go.id/layananbalai/layanan.php?page=ahli_bahasa"
                        target="_blank" rel="noopener noreferrer">
                        di sini
                    </a>
                </div>
            </div>

        </div>

    </section>
@endsection
