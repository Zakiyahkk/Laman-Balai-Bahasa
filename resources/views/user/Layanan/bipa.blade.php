@extends('layouts.user')

@section('title', 'Layanan BIPA')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/layanan.css') }}">
@endsection

@section('content')
    <section class="layanan-page">

        <div class="layanan-container">

            <div class="layanan-card">

                {{-- HEADER --}}
                <header class="layanan-header">
                    <h1>Layanan BIPA</h1>
                </header>

                {{-- DESKRIPSI --}}
                <div class="layanan-deskripsi">
                    <p>
                        <strong>Bahasa Indonesia bagi Penutur Asing (BIPA)</strong> merupakan
                        layanan pembelajaran bahasa Indonesia yang diselenggarakan oleh
                        Balai Bahasa Provinsi Riau bagi penutur asing dan masyarakat internasional.
                    </p>
                    <p>
                        Layanan BIPA bertujuan untuk meningkatkan kemampuan berbahasa Indonesia
                        bagi penutur asing serta mendukung diplomasi bahasa dan budaya Indonesia
                        sesuai dengan standar pelayanan yang berlaku.
                    </p>
                </div>

                {{-- GAMBAR --}}
                <div class="layanan-media">
                    <img src="{{ asset('img/Layanan-BIPA.png') }}" alt="Standar Pelayanan BIPA">
                </div>

                {{-- LINK --}}
                <div class="layanan-link">
                    <span>Ajukan permohonan layanan BIPA</span>
                    <a href="{{ url('/layanan/pengajuan') }}">di sini</a>
                </div>

            </div>

        </div>

    </section>
@endsection
