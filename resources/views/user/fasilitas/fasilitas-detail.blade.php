@extends('layouts.user')

@section('title', 'Detail Fasilitas')

@section('content')

    @php
    $galeriFasilitas = [
    
        'lobi' => [
            'Lobi/lobi.png',
            'Lobi/lobi1.png',
        ],
    
        'ult' => [
            'Unit Layanan Terpadu (ULT)/ult.jpg',
            'Unit Layanan Terpadu (ULT)/ult2.png',
            'Unit Layanan Terpadu (ULT)/ult3.png',
            'Unit Layanan Terpadu (ULT)/ult4.png',
        ],
    
        'ppid' => [
            'PPID/ppid.png',
            'PPID/ppid1.png',
        ],
    
        'disabilitas' => [
            'Fasilitas Disabilitas/disabilitas.png',
            'Fasilitas Disabilitas/disabilitas1.png',
        ],
    
        'aula-fisabilillah' => [
            'Aula R. H. Fisabilillah/ARHF.png',
            'Aula R. H. Fisabilillah/ARHF1.png',
        ],
    
        'aula-raja-ali-haji' => [
            'Aula Raja Ali Haji/ARAH.jpg',
            'Aula Raja Ali Haji/ARAH1.jpg',
            'Aula Raja Ali Haji/ARAH2.jpg',
            'Aula Raja Ali Haji/ARAH3.png',
            'Aula Raja Ali Haji/ARAH4.png',
            'Aula Raja Ali Haji/ARAH5.jpg',
        ],
    
        'serambi-kreatif' => [
            'Serambi Kreatif/serambi.png',
        ],
    
        'mushola' => [
            'Musala Hikmah/musala.jpg',
            'Musala Hikmah/musala1.jpg',
            'Musala Hikmah/musala2.jpg',
        ],
    
        'perpustakaan' => [
            'Perpustakaan/perpus.jpg',
            'Perpustakaan/perpus1.jpg',
            'Perpustakaan/perpus2.jpg',
            'Perpustakaan/perpus3.jpg',
            'Perpustakaan/perpus4.jpg',
            'Perpustakaan/perpus5.jpg',
            'Perpustakaan/perpus6.jpg',
            'Perpustakaan/perpus7.jpg',
            'Perpustakaan/perpus8.jpg',
        ],
    
        'olahraga' => [
            'Fasilitas Olahraga/olahraga.jpg',
            'Fasilitas Olahraga/olahraga1.jpg',
            'Fasilitas Olahraga/olahraga2.jpg',
            'Fasilitas Olahraga/olahraga3.jpg',
            'Fasilitas Olahraga/olahraga4.jpg',
            'Fasilitas Olahraga/olahraga5.jpg',
            'Fasilitas Olahraga/olahraga6.jpg',
            'Fasilitas Olahraga/olahraga7.jpg',
            'Fasilitas Olahraga/olahraga8.jpg',
        ],
    
        'resam-bastra' => [
            'Resam Bastra/resbas.jpg',
            'Resam Bastra/resbas1.jpg',
            'Resam Bastra/resbas2.jpg',
            'Resam Bastra/resbas3.jpg',
            'Resam Bastra/resbas4.jpg',
        ],
    
        'parkir' => [
            'Area Parkir/parkir.png',
            'Area Parkir/parkir1.jpg',
            'Area Parkir/parkir2.jpg',
        ],
    
        'laktasi' => [
            'Ruang Laktasi/laktasi.jpg',
            'Ruang Laktasi/laktasi1.jpg',
            'Ruang Laktasi/laktasi2.jpg',
            'Ruang Laktasi/laktasi3.jpg',
            'Ruang Laktasi/laktasi4.jpg',
            'Ruang Laktasi/laktasi5.jpg',
            'Ruang Laktasi/laktasi6.jpg',
        ],
    
        'toilet' => [
            'Toilet/toilet.png',
            'Toilet/toilet1.jpg',
            'Toilet/toilet2.jpg',
        ],
    ];
    
    $judulFasilitas = [
        'lobi' => 'Lobi',
        'ult' => 'Unit Layanan Terpadu',
        'ppid' => 'PPID',
        'disabilitas' => 'Fasilitas Disabilitas',
        'aula-fisabilillah' => 'Aula R. H. Fisabilillah',
        'aula-raja-ali-haji' => 'Aula Raja Ali Haji',
        'serambi-kreatif' => 'Serambi Kreatif',
        'mushola' => 'Musala Hikmah',
        'perpustakaan' => 'Perpustakaan',
        'olahraga' => 'Fasilitas Olahraga',
        'resam-bastra' => 'Resam Bastra',
        'parkir' => 'Area Parkir',
        'laktasi' => 'Ruang Laktasi',
        'toilet' => 'Toilet',
    ];
    
    $galeri = $galeriFasilitas[$slug] ?? [];
    $judul = $judulFasilitas[$slug] ?? 'Fasilitas';
    @endphp

    <section class="fasilitas-detail">
        <div class="container">

            {{-- HEADER --}}
            <div class="fasilitas-detail-header">
                <h1>{{ $judul }}</h1>
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
