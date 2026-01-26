<section class="section berita-terbaru" style="padding-top: 10px; padding-bottom: 30px; margin-top: -80px;">
    <div class="container">

        <h2 class="judul-center" style="margin-top: 0; margin-bottom: 20px; text-align: left;">
            Artikel <span style="color: #0ea5e9;">Terbaru</span>
        </h2>
        <div class="berita-grid" style="margin-top: 0; gap: 20px;">
            @forelse (($artikelAlinea ?? []) as $item)
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
                        <h4 style="margin-top: 5px; margin-bottom: 8px;">{{ $item['judul'] ?? '-' }}</h4>
                    </a>

                    <p style="margin-bottom: 15px;">{{ \Illuminate\Support\Str::limit(strip_tags($item['isi'] ?? ''), 120) }}</p>

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
                            <span class="views"><i class="fa-regular fa-eye"></i></span>
                            {{ $item['pembaca'] ?? 0 }}
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <p style="text-align:center; width:100%; padding: 20px 0;">Belum ada artikel/alinea.</p>
            @endforelse
        </div>

        <div class="btn-center" style="margin-top: 20px; text-align: center;">
            <a href="{{ route('artikel.index') }}" class="btn-berita">
                Lihat semua artikel
            </a>
        </div>
    </div>
</section>