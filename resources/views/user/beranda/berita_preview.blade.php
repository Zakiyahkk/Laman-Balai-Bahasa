<section class="section berita-terbaru artikel-preview" style="margin-top: 10px;">
    <div class="container">

        <h2 class="judul-center">
            Berita <span style="color: #0ea5e9;">Terbaru</span>
        </h2>

        <div class="berita-grid">

            @forelse ($berita ?? [] as $item)
            <div class="berita-card">
                <div class="berita-img">
                    <span class="badge">BERITA</span>

                    <a href="{{ route('berita.show', $item['publikasi_id']) }}">
                        <img src="{{ $item['gambar_url'] ?? asset('img/img1.png') }}"
                            alt="{{ $item['judul'] ?? 'Berita' }}">
                    </a>
                </div>

                <div class="berita-body">
                    <a href="{{ route('berita.show', $item['publikasi_id']) }}">
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
            <p style="text-align:center; width:100%;">Belum ada berita.</p>
            @endforelse

        </div>

        <div class="btn-center">
            <a href="{{ route('berita.index') }}" class="btn-berita">
                Berita Selengkapnya
            </a>
        </div>

        <div class="section-divider"></div>

    </div>
</section>