@extends('layouts.user')

@section('title', 'Berita')

@section('content')

    <section class="section berita-terbaru artikel-preview">
        <div class="container">

            <h2 class="judul-center">
                Berita <span>Terbaru</span>
            </h2>

            <div class="berita-grid">

                @forelse ($berita as $item)
                    <div class="berita-card">

                        <div class="berita-img">
                            <span class="badge">BERITA</span>

                            <a href="{{ route('berita.show', $item['publikasi_id']) }}">
                                <img src="{{ $item['gambar_url'] }}" alt="{{ $item['judul'] }}" loading="lazy"
                                    onerror="this.src='{{ asset('img/default.jpg') }}'">
                            </a>
                        </div>

                        <div class="berita-body">
                            <a href="{{ route('berita.show', $item['publikasi_id']) }}">
                                <h4>{{ $item['judul'] }}</h4>
                            </a>

                            <p>
                                {{ \Illuminate\Support\Str::limit(strip_tags($item['isi'] ?? ''), 120) }}
                            </p>

                            <div class="berita-meta">
                                <span>
                                    {{ \Carbon\Carbon::parse($item['tanggal'])->translatedFormat('d F Y') }}
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
                    <p style="text-align:center;color:#94a3b8;">Belum ada berita.</p>
                @endforelse

            </div>

        </div>
    </section>

@endsection
