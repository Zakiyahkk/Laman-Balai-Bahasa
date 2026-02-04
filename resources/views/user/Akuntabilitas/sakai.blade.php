@extends('layouts.user')

@section('title', 'SAKAI')

@section('css')
<link rel="stylesheet" href="{{ asset('css/akuntabilitas.css') }}">
@endsection

@section('content')

<section class="sakai-hero">
    <div class="hero-bg">
        <img src="{{ asset('images/gedung-balai.jpg') }}" alt="SAKAI">
    </div>

    <div class="container sakai-container">

        <div class="sakai-header">
            <h1>SAKAI</h1>
            <p class="sakai-subtitle">
                Sistem Aplikasi Keuangan dan Anggaran Internal
            </p>
        </div>

        <div class="sakai-card">
            <h3>Deskripsi</h3>
            <p>
                SAKAI merupakan sistem informasi yang digunakan untuk mendukung
                pengelolaan data dan layanan di lingkungan Balai Bahasa Provinsi Riau
                secara terintegrasi, transparan, dan akuntabel.
            </p>
        </div>

    </div>
</section>

@endsection
