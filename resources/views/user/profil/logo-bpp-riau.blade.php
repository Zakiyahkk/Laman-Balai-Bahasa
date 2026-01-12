@extends('layouts.user')

@section('title', 'Logo')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/profil.css') }}">
@endsection

@section('content')
    <section class="profil-page profil-logo profil-hero" data-bg="{{ asset('img/latar.jpg') }}">
        <div class="container profil-container">

            <div class="profil-header hero-header">
                <h1>Logo</h1>
                <p class="profil-subtitle">
                    Identitas Resmi Balai Bahasa Provinsi Riau
                </p>
            </div>

            <div class="profil-card text-center">
                <img src="{{ asset('img/logobbpr4.png') }}" alt="Logo BPP Riau"
                    style="max-width: 220px; margin-bottom: 20px;">
            </div>

        </div>
    </section>
@endsection
