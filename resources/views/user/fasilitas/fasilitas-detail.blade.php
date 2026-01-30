@extends('layouts.user')

@section('title', 'Detail Fasilitas')

@section('content')

    @php
        $galeriFasilitas = [
            'aula' => ['aula/aula-1.jpg', 'aula/aula-2.jpg', 'aula/aula-3.jpg', 'aula/aula-4.jpg'],

            'perpustakaan' => [
                'perpustakaan/perpustakaan.png',
                'perpustakaan/perpus-2.jpg',
                'perpustakaan/perpus-3.jpg',
                'perpustakaan/perpus-4.jpg',
                'perpustakaan/perpus-1.jpg',
                'perpustakaan/perpus-2.jpg',
                'perpustakaan/perpus-3.jpg',
                'perpustakaan/perpus-4.jpg',
            ],

            'serambi' => [
                'serambi/serambi-1.png',
                'serambi/serambi-2.jpg',
                'serambi/serambi-3.jpg',
                'serambi/serambi-4.jpg',
                'serambi/serambi-1.png',
                'serambi/serambi-2.jpg',
                'serambi/serambi-3.jpg',
                'serambi/serambi-4.jpg',
            ],

            'toilet' => [
                'toilet/toilet-1.png',
                'toilet/toilet-2.jpg',
                'toilet/toilet-3.jpg',
                'toilet/toilet-4.jpg',
                'toilet/toilet-1.jpg',
                'toilet/toilet-2.jpg',
                'toilet/toilet-3.jpg',
                'toilet/toilet-4.jpg',
            ],

            'mushola' => [
                'mushola/musla-1.jpg',
                'mushola/musala-2.jpg',
                'mushola/musala-3.jpg',
                'mushola/musala-4.jpg',
            ],

            'Disabilitas' => [
                'disabilitas/disabilitas-1.png',
                'disabilitas/disabilitas-2.jpg',
                'disabilitas/disabilitas-3.jpg',
                'disabilitas/disabilitas-4.jpg',
                'disabilitas/disabilitas-1.jpg',
                'disabilitas/disabilitas-2.jpg',
                'disabilitas/disabilitas-3.jpg',
                'disabilitas/disabilitas-4.jpg',
            ],

            'parkir' => ['parkir/parkir-1.jpg', 'parkir/parkir-2.jpg', 'parkir/parkir-3.jpg', 'parkir/parkir-4.jpg'],

            'ult' => ['ult/ult-1.jpg', 'ult/ult-2.jpg', 'ult/ult-3.jpg', 'ult/ult-4.jpg'],

            'ppid' => ['ppid/ppid-1.jpg', 'ppid/ppid-2.jpg', 'ppid/ppid-3.jpg', 'ppid/ppid-4.jpg'],
        ];

        $judulFasilitas = [
            'aula' => 'Aula',
            'perpustakaan' => 'Perpustakaan',
            'serambi' => 'Serambi Bahasa',
            'ult' => 'Unit Layanan Terpadu',
            'toilet' => 'Toilet',
            'mushola' => 'Mushola',
            'Disabilitas' => 'Fasilitas Disabilitas',
            'parkir' => 'Tempat Parkir',
            'ppid' => 'PPID',
        ];

        $galeri = $galeriFasilitas[$slug] ?? [];
        $judul = $judulFasilitas[$slug] ?? 'Fasilitas';
    @endphp

    <section class="fasilitas-detail">
        <div class="container">

            {{-- HEADER --}}
            <div class="fasilitas-detail-header">
                <h1>{{ $judul }}</h1>
                <p>Dokumentasi fasilitas {{ strtolower($judul) }} dari berbagai sudut.</p>
            </div>

            {{-- GALERI --}}
            <div class="fasilitas-galeri">
                @forelse ($galeri as $foto)
                    <div class="fasilitas-galeri-item">
                        <img src="{{ asset('img/fasilitas/' . $foto) }}" alt="{{ $judul }}" loading="lazy">
                    </div>
                @empty
                    <div class="fasilitas-galeri-empty">
                        Foto fasilitas belum tersedia.
                    </div>
                @endforelse
            </div>

            {{-- TOMBOL KEMBALI --}}
            <div class="fasilitas-detail-back">
                <a href="{{ url('/') }}" class="btn-kembali">
                    ← Kembali ke Beranda
                </a>
            </div>

        </div>
    </section>

@endsection
