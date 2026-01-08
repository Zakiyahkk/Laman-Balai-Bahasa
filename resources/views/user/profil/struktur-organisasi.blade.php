@extends('layouts.user')

@section('title', 'Struktur Organisasi')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/profil.css') }}">
@endsection

@section('content')
    <section class="profil-riau">
        <div class="container">

            <div class="profil-header-struktur">
                <h1>Struktur Organisasi</h1>
            </div>

            <div class="profil-content">
                <div class="profil-section text-center">
                    <p>
                        Struktur organisasi Balai Bahasa Provinsi Riau menggambarkan
                        susunan dan hubungan kerja antarbagian dalam pelaksanaan tugas.
                    </p>

                    <img src="{{ asset('images/struktur-organisasi.png') }}"
                        alt="Struktur Organisasi Balai Bahasa Provinsi Riau" class="img-fluid mt-4">
                </div>

                <div class="section-divider"></div>
            </div>

        </div>
    </section>
@endsection
