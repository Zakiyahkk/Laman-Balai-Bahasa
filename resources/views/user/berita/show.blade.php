@extends('layouts.user')

@section('title', 'Detail Berita')

@section('content')

    <section class="section berita-detail">
        <div class="container">

            {{-- WRAPPER biar rapi di tengah --}}
            <div class="berita-detail-wrap">

                {{-- JUDUL --}}
                <h1 class="berita-detail-title">
                    {{ $berita->judul }}
                </h1>

                {{-- META --}}
                <div class="berita-detail-meta">
                    <span class="meta-item">
                        <i class="fa-regular fa-calendar"></i>
                        {{ \Carbon\Carbon::parse($berita->tanggal)->translatedFormat('d F Y') }}
                    </span>

                    <span class="meta-dot">•</span>

                    <span class="meta-item">
                        <i class="fa-regular fa-user"></i>
                        {{ $berita->penulis ?? 'Admin' }}
                    </span>

                    <span class="meta-dot">•</span>

                    <span class="meta-item meta-views">
                        <i class="fa-regular fa-eye"></i>
                        {{ $berita->pembaca ?? 0 }}
                    </span>
                </div>

                {{-- CARD (konten) --}}
                <div class="berita-detail-card">

                    {{-- GAMBAR --}}
                    @if (!empty($berita->gambar_url))
                        <div class="berita-detail-image">
                            <img src="{{ $berita->gambar_url }}" alt="{{ $berita->judul }}">
                        </div>
                    @endif

                    {{-- ISI --}}
                    <div class="berita-detail-content">
                        {!! $berita->isi !!}
                    </div>

                </div>

                {{-- TOMBOL KEMBALI --}}
                <div class="berita-detail-actions">
                    <a href="{{ route('berita.index') }}" class="btn-kembali">
                        ← Kembali ke Berita
                    </a>
                </div>

            </div>
        </div>
    </section>

@endsection
