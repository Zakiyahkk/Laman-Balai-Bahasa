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

        <!-- HEADER -->
        <div class="profil-header hero-header">
            <h1>Pegawai</h1>
            <p class="profil-subtitle">Balai Bahasa Provinsi Riau</p>
        </div>

        {{-- ===================== --}}
        {{-- PIMPINAN --}}
        {{-- ===================== --}}
        <div class="pegawai-pimpinan">

            {{-- KEPALA BALAI --}}
            @if ($kepala)
                <div class="pegawai-card glass-card pegawai-kepala">
                    <div class="foto-pegawai">
                        <img src="{{ $kepala['foto_url'] }}" alt="{{ $kepala['nama'] }}">
                    </div>
                    <h4>{{ $kepala['nama'] }}</h4>
                    <p>{{ $kepala['jabatan'] }}</p>
                </div>
            @endif

            {{-- KASUBBAG --}}
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

            @forelse ($anggota as $item)
                <div class="pegawai-card glass-card">
                    <div class="foto-pegawai">
                        <img src="{{ $item['foto_url'] }}" alt="{{ $item['nama'] }}">
                    </div>
                    <h4>{{ $item['nama'] }}</h4>
                    <p>{{ $item['jabatan'] }}</p>
                </div>
            @empty
                <p class="text-center text-muted">
                    Data pegawai belum tersedia.
                </p>
            @endforelse

        </div>

    </div>
</section>
@endsection
