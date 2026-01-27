<section class="section berita-terbaru" style="padding-top: 10px; padding-bottom: 30px; margin-top: -80px;">
    <div class="container">

        <h2 class="judul-center" style="margin-top: 0; margin-bottom: 20px; text-align: left;">
            Konten <span style="color: #0ea5e9;">Terbaru</span>
        </h2>

        <div class="berita-grid" style="margin-top: 0; gap: 20px;">

            @forelse ($kontenTerbaru ?? [] as $item)
                <div class="berita-card">

                    <div class="berita-img">
                        <span class="badge">
                            {{ strtoupper($item['kategori']) }}
                        </span>

                        <a href="{{ route('artikel.show', $item['publikasi_id']) }}">
                            <img src="{{ $item['gambar_url'] }}" alt="{{ $item['judul'] }}" loading="lazy"
                                onerror="this.onerror=null;this.src='{{ asset('img/default.jpg') }}';">
                        </a>
                    </div>

                    <div class="berita-body">
                        <a href="{{ route('artikel.show', $item['publikasi_id']) }}">
                            <h4>{{ $item['judul'] }}</h4>
                        </a>

                        <p>
                            {{ \Illuminate\Support\Str::limit(strip_tags($item['isi']), 120) }}
                        </p>

                        <div class="berita-meta">
                            <span>
                                {{ \Carbon\Carbon::parse($item['tanggal'])->translatedFormat('d F Y') }}
                            </span>

                            <div class="meta-right">
                                <span>{{ $item['penulis'] ?? 'Admin' }}</span>
                                <span class="views">
                                    <i class="fa-regular fa-eye"></i>
                                    {{ $item['pembaca'] ?? 0 }}
                                </span>
                            </div>
                        </div>
                    </div>

                </div>
            @empty
                <p style="text-align:center; width:100%; padding: 20px 0;">
                    Belum ada konten.
                </p>
            @endforelse

        </div>

        <div class="btn-center" style="margin-top: 20px; text-align: center;">
            <a href="{{ route('artikel.index') }}" class="btn-berita">
                Lihat semua konten
            </a>
        </div>

    </div>
</section>
