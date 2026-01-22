@extends('layouts.user')

@section('title', 'Artikel & Alinea')

@section('content')

    <section class="section berita-terbaru artikel-index">
        <div class="container">

            <h2 class="judul-center">
                Artikel dan Alinea <span>Terbaru</span>
            </h2>

            <div class="berita-grid">
                @forelse (($items ?? []) as $item)
                    <div class="berita-card">
                        <div class="berita-img">
                            <span class="badge">
                                {{ strtoupper($item['kategori'] ?? 'ARTIKEL') }}
                            </span>

                            <a href="{{ route('artikel.show', $item['publikasi_id']) }}">
                                <img src="{{ $item['gambar_url'] ?? asset('img/img1.png') }}"
                                    alt="{{ $item['judul'] ?? 'Konten' }}">
                            </a>
                        </div>

                        <div class="berita-body">
                            <a href="{{ route('artikel.show', $item['publikasi_id']) }}">
                                <h4>{{ $item['judul'] ?? '-' }}</h4>
                            </a>

                            <p>
                                {{ \Illuminate\Support\Str::limit(strip_tags($item['isi'] ?? ''), 120) }}
                            </p>

                            <div class="berita-meta">
                                <span>
                                    @if (!empty($item['tanggal']))
                                        {{ \Carbon\Carbon::parse($item['tanggal'])->translatedFormat('d F Y') }}
                                    @else
                                        -
                                    @endif
                                </span>

                                <div class="meta-right">
                                    <span>{{ $item['penulis'] ?? 'Admin' }}</span>
                                    <span class="views">
                                        <i class="fa-regular fa-eye"></i>
                                    </span>
                                    {{ $item['pembaca'] ?? 0 }}
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p style="text-align:center; width:100%;">Belum ada artikel/alinea.</p>
                @endforelse
            </div>

        </div>
    </section>

@endsection
