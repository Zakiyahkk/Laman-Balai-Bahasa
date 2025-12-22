@extends('layouts.user')

@section('title', 'Tugas Pokok dan Fungsi')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/profil.css') }}">
@endsection

@section('content')
    <section class="profil-page">
        <div class="container profil-container">

            <!-- Header -->
            <div class="profil-header">
                <h1>Tugas Pokok dan Fungsi</h1>
                <p class="profil-subtitle">
                    Balai Bahasa Provinsi Riau
                </p>
            </div>

            <!-- Tugas Pokok -->
            <div class="profil-card">
                <h3>Tugas Pokok</h3>
                <p>
                    Balai Bahasa Provinsi Riau mempunyai tugas melaksanakan
                    pengembangan, pembinaan, dan pelindungan bahasa dan sastra
                    Indonesia serta bahasa daerah di wilayah Provinsi Riau.
                </p>
            </div>

            <!-- Fungsi -->
            <div class="profil-card">
                <h3>Fungsi</h3>
                <ol>
                    <li>Pelaksanaan pembinaan bahasa dan sastra</li>
                    <li>Pelaksanaan pengembangan bahasa dan sastra</li>
                    <li>Pelaksanaan pelindungan bahasa dan sastra</li>
                    <li>Pelaksanaan pelayanan kebahasaan kepada masyarakat</li>
                    <li>Pelaksanaan kerja sama di bidang kebahasaan</li>
                </ol>
            </div>

        </div>
    </section>
@endsection
