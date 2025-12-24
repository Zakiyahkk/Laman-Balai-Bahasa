@extends('layouts.user')

@section('title', 'Pegawai')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/profil.css') }}">
@endsection

@section('content')
    <section class="profil-page">
        <div class="container profil-container">

            <!-- Header -->
            <div class="profil-header">
                <h1>Pegawai</h1>
                <p class="profil-subtitle">
                    Balai Bahasa Provinsi Riau
                </p>
            </div>

            <!-- Grid Pegawai -->
            <div class="pegawai-grid">

                <div class="pegawai-card">
                    <img src="{{ asset('images/pegawai/kepala.png') }}" alt="Kepala Balai">
                    <h4>Nama Kepala Balai</h4>
                    <p>Kepala Balai Bahasa</p>
                </div>

                <div class="pegawai-card">
                    <img src="{{ asset('images/pegawai/tu.png') }}" alt="Kasubbag TU">
                    <h4>Nama Kasubbag TU</h4>
                    <p>Kepala Subbagian Tata Usaha</p>
                </div>

                <div class="pegawai-card">
                    <img src="{{ asset('images/pegawai/fungsional.png') }}" alt="JF">
                    <h4>Nama Pegawai</h4>
                    <p>Jabatan Fungsional</p>
                </div>

            </div>

        </div>
    </section>
@endsection
