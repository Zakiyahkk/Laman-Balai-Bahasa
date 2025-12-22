@extends('layouts.user')

@section('title', 'Logo BPP Riau')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/profil.css') }}">
@endsection

@section('content')
    <section class="profil-page">
        <div class="container profil-container">

            <div class="profil-header">
                <h1>Logo BPP Riau</h1>
                <p class="profil-subtitle">
                    Identitas Resmi Balai Bahasa Provinsi Riau
                </p>
            </div>

            <div class="profil-card text-center">
                <img src="{{ asset('images/logo-bpp-riau.png') }}" alt="Logo BPP Riau"
                    style="max-width: 220px; margin-bottom: 20px;">

                <h3>Makna Logo</h3>
                <p>
                    Logo Balai Bahasa Provinsi Riau melambangkan komitmen dalam
                    pembinaan, pengembangan, dan pelindungan bahasa dan sastra
                    Indonesia serta bahasa daerah di Provinsi Riau.
                </p>
            </div>

        </div>
    </section>
@endsection
