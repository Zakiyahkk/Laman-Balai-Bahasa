@extends('layouts.user')

@section('title', 'Struktur Organisasi')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/profil.css') }}">
@endsection

@section('content')
    <section class="profil-page profil-stuktur profil-hero" data-bg="{{ asset('img/latar.jpg') }}">
        <div class="container profil-container">

            <div class="profil-header hero-header">
                <h1>Struktur Organisasi</h1>
            </div>

            <div class="profil-content">
                <div class="profil-card text-center">
                    <p>
                        Struktur organisasi Balai Bahasa Provinsi Riau menggambarkan
                        susunan dan hubungan kerja antarbagian dalam pelaksanaan tugas.
                    </p>

                    <img src="{{ asset('img/logobbpr4.png') }}" alt="Struktur Organisasi Balai Bahasa Provinsi Riau"
                        style="max-width: 220px; margin-bottom: 20px;">
                </div>

            </div>

        </div>
    </section>
@endsection
