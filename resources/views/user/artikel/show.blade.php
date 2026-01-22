@extends('layouts.user')

@section('title', 'Detail Artikel')

@section('content')

    <section class="section berita-detail">
        <div class="container">

            {{-- WRAPPER biar rapi di tengah --}}
            <div class="berita-detail-wrap">

                {{-- JUDUL --}}
                <h1 class="berita-detail-title">
                    {{ $item['judul'] ?? '-' }}
                </h1>

                {{-- META --}}
                <div class="berita-detail-meta">
                    <span class="meta-item">
                        <i class="fa-regular fa-calendar"></i>
                        @if (!empty($item['tanggal']))
                            {{ \Carbon\Carbon::parse($item['tanggal'])->translatedFormat('d F Y') }}
                        @else
                            -
                        @endif
                    </span>

                    <span class="meta-dot">•</span>

                    <span class="meta-item">
                        <i class="fa-regular fa-user"></i>
                        {{ $item['penulis'] ?? 'Admin' }}
                    </span>

                    <span class="meta-dot">•</span>

                    <span class="meta-item meta-views">
                        <i class="fa-regular fa-eye"></i>
                        {{ $item['pembaca'] ?? 0 }}
                    </span>
                </div>

                {{-- CARD (konten) --}}
                <div class="berita-detail-card">

                    {{-- GAMBAR --}}
                    @if (!empty($item['gambar_url']))
                        <div class="berita-detail-image">
                            <img src="{{ $item['gambar_url'] }}" alt="{{ $item['judul'] ?? 'Konten' }}">
                        </div>
                    @endif

                    {{-- ISI --}}
                    <div class="berita-detail-content">
                        {!! $item['isi'] ?? '' !!}
                    </div>
                </div>

                {{-- TOMBOL KEMBALI --}}
                <div class="berita-detail-actions">
                    <a href="{{ route('artikel.index') }}" class="btn-kembali">
                        ← Kembali ke Artikel
                    </a>
                </div>

            </div>
        </div>
    </section>

@endsection
