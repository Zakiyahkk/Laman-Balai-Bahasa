@extends('layouts.user')

@section('title', 'Visi dan Misi')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/profil.css') }}">
@endsection

@section('content')
    <section class="profil-page profil-visi-misi profil-hero profil-theme">
        <div class="hero-bg">
            <img src="https://ppidbbpriau.kemendikdasmen.go.id/images/gedung-balai.jpeg" alt="Gedung Balai">
        </div>

        <div class="container profil-container">
            <div class="profil-header hero-header">
                <h1>Visi dan Misi</h1>
                <p class="profil-subtitle">Balai Bahasa Provinsi Riau</p>
            </div>

            <div class="profil-card">
                <h3>Visi</h3>
                <p>
                    {{ $visi }}
                </p>
            </div>

            <div class="profil-card">
                <h3>Misi</h3>
                <ol>
                    @foreach ($misi as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                </ol>
            </div>
        </div>

    </section>
@endsection
