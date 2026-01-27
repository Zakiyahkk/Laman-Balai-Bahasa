@extends('layouts.user')

@section('title', 'Pegawai')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/profil.css') }}">
@endsection

@section('content')
    <section class="profil-page profil-pegawai profil-hero profil-theme">
        <div class="hero-bg">
            <img src="https://ppidbbpriau.kemendikdasmen.go.id/images/gedung-balai.jpeg" alt="Gedung Balai">
        </div>

        <div class="container profil-container">

            <!-- Header -->
            <div class="profil-header hero-header">
                <h1>Pegawai</h1>
                <p class="profil-subtitle">Balai Bahasa Provinsi Riau</p>
            </div>

            {{-- ===================== --}}
            {{-- PIMPINAN / STRATEGIS --}}
            {{-- ===================== --}}
            <div class="pegawai-pimpinan">
                @if ($kepala)
                    <div class="pegawai-card glass-card pegawai-kepala">
                        <div class="foto-pegawai">
                            <img src="{{ $kepala['foto_url'] }}" alt="{{ $kepala['nama'] }}">
                        </div>
                        <h4>{{ $kepala['nama'] }}</h4>
                        <p>{{ $kepala['jabatan'] }}</p>
                    </div>
                @endif

                @if ($kasubbag)
                    <div class="pegawai-card glass-card pegawai-kasubbag">
                        <div class="foto-pegawai">
                            <img src="{{ $kasubbag['foto_url'] }}" alt="{{ $kasubbag['nama'] }}">
                        </div>
                        <h4>{{ $kasubbag['nama'] }}</h4>
                        <p>{{ $kasubbag['jabatan'] }}</p>
                    </div>
                @endif
            </div>

            {{-- ===================== --}}
            {{-- PEGAWAI LAIN --}}
            {{-- ===================== --}}
            <div class="pegawai-grid">
                @foreach ($anggota as $item)
                    <div class="pegawai-card glass-card">
                        <div class="foto-pegawai">
                            <img src="{{ $item['foto_url'] }}" alt="{{ $item['nama'] }}">
                        </div>
                        <h4>{{ $item['nama'] }}</h4>
                        <p>{{ $item['jabatan'] }}</p>
                    </div>
                @endforeach
            </div>

        </div>

    </section>
@endsection
