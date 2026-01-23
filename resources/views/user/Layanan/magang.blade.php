@extends('layouts.user')

@section('title', 'Layanan Magang')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/layanan.css') }}">
@endsection

@section('content')
    <section class="layanan-page">

        <div class="layanan-container">

            <div class="layanan-card">

                {{-- HEADER --}}
                <header class="layanan-header">
                    <h1>Layanan Magang</h1>
                </header>

                {{-- DESKRIPSI --}}
                <div class="layanan-deskripsi">
                    <p>
                        <strong>Layanan Magang</strong> merupakan program yang diselenggarakan
                        oleh Balai Bahasa Provinsi Riau untuk memberikan kesempatan kepada
                        mahasiswa dan pelajar dalam memperoleh pengalaman kerja serta
                        pemahaman praktik di bidang kebahasaan dan kesastraan.
                    </p>
                    <p>
                        Program magang dilaksanakan sesuai dengan ketentuan yang berlaku
                        dan bertujuan untuk meningkatkan kompetensi, keterampilan,
                        serta wawasan peserta magang.
                    </p>
                </div>

                {{-- GAMBAR --}}
                <div class="layanan-media">
                    <img src="{{ asset('img/SP-Kerja-Lapangan.png') }}" alt="Standar Pelayanan Magang">
                </div>

                {{-- LINK --}}
                <div class="layanan-link">
                    <span>Informasi dan pendaftaran magang</span>
                    <a href="{{ url('/layanan/pengajuan') }}">di sini</a>
                </div>

            </div>

        </div>

    </section>
@endsection
