@extends('layouts.user')

@section('title', 'Tugas Pokok dan Fungsi')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/profil.css') }}">
@endsection

@section('content')
    <section class="profil-page profil-tupoksi profil-hero profil-theme">


        <div class="hero-bg">
            <img src="https://ppidbbpriau.kemendikdasmen.go.id/images/gedung-balai.jpeg" alt="Gedung Balai">
        </div>
        <div class="container profil-container">

            <!-- Header -->
            <div class="profil-header ">
                <h1>Tugas dan Fungsi</h1>
                <p class="profil-subtitle">
                    Balai Bahasa Provinsi Riau
                </p>
            </div>

            <!-- Tugas Pokok -->
            <div class="profil-card">
                <h3>Tugas</h3>
                <p>
                    {{ $tugas }}
                </p>
            </div>

            <!-- Fungsi -->
            <div class="profil-card">
                <h3>Fungsi</h3>
                <ol>
                    @foreach ($fungsi as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                </ol>
            </div>

        </div>
    </section>
@endsection
