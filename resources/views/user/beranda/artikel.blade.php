<section class="bb33-artikel">
    <div class="container">
        <h2 class="bb33-title">Artikel <span>Terbaru</span></h2>

        <div class="bb33-artikel-wrap">
            {{-- Panah kiri --}}
            <button class="bb33-arrow bb33-arrow-left" type="button" id="bb33ArtikelPrev" aria-label="Sebelumnya">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M15 18l-6-6 6-6" fill="none" stroke="currentColor" stroke-width="2.6"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
            {{-- Track --}}
            <div class="bb33-track" id="bb33ArtikelTrack">
                @php
                    // STATIS (tanpa model) - seperti file berita
                    $artikelItems = [
                        [
                            'slug' => 'summer-reading-camp',
                            'title' =>
                                'Summer Reading Camp: Upaya Membangun Budaya Literasi Berbasis Kearifan Lokal di Banyumas',
                            'author' => 'Mukhamad Hamid Samiaji',
                            'views' => 430,
                            'avatar' => asset('img/user.png'),
                        ],
                        [
                            'slug' => 'tujuh-pilar-karakter',
                            'title' => 'Tujuh Pilar Karakter: Kebiasaan Emas untuk Generasi Gemilang',
                            'author' => 'Mursal Azis, M.Pd',
                            'views' => 486,
                            'avatar' => asset('img/user.png'),
                        ],
                        [
                            'slug' => 'resep-bahagia',
                            'title' => 'Resep Bahagia, Buku Kumpulan Sajak Fajrul Alam',
                            'author' => 'Abdul Wachid B.S',
                            'views' => 601,
                            'avatar' => asset('img/user.png'),
                        ],
                        [
                            'slug' => 'resep-bahagia',
                            'title' => 'Resep Bahagia, Buku Kumpulan Sajak Fajrul Alam',
                            'author' => 'Abdul Wachid B.S',
                            'views' => 601,
                            'avatar' => asset('img/user.png'),
                        ],
                        [
                            'slug' => 'resep-bahagia',
                            'title' => 'Resep Bahagia, Buku Kumpulan Sajak Fajrul Alam',
                            'author' => 'Abdul Wachid B.S',
                            'views' => 601,
                            'avatar' => asset('img/user.png'),
                        ],
                        // tambah item kalau mau
                        // [
                        //   'slug'=>'judul-4', 'title'=>'...', 'author'=>'...', 'views'=>123, 'avatar'=>asset('img/user.png')
                        // ],
                    ];
                @endphp

                @foreach ($artikelItems as $a)
                    <div class="bb33-slide">
                        <article class="bb33-card">
                            <div class="bb33-card-top">
                                <div class="bb33-thumb" aria-hidden="true">
                                    {{-- placeholder watermark ala screenshot --}}
                                    <div class="bb33-watermark"></div>
                                </div>

                                <div class="bb33-main">
                                    <span class="bb33-badge">ARTIKEL</span>

                                    <h3 class="bb33-card-title">
                                        <a href="{{ route('artikel.show', $a['slug']) }}">
                                            {{ $a['title'] }}
                                        </a>
                                    </h3>
                                </div>
                            </div>

                            <div class="bb33-card-bottom">
                                <div class="bb33-author">
                                    <span class="bb33-avatar">
                                        <img src="{{ $a['avatar'] }}" alt="{{ $a['author'] }}">
                                    </span>
                                    <span class="bb33-author-name">{{ $a['author'] }}</span>
                                </div>

                                <div class="bb33-views">
                                    <span class="bb33-eye" aria-hidden="true">
                                        <svg viewBox="0 0 24 24" fill="none">
                                            <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12z"
                                                stroke="currentColor" stroke-width="2" />
                                            <circle cx="12" cy="12" r="3" stroke="currentColor"
                                                stroke-width="2" />
                                        </svg>
                                    </span>
                                    <span class="bb33-views-num">{{ number_format($a['views']) }}</span>
                                </div>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>

            {{-- Panah kanan --}}
            <button class="bb33-arrow bb33-arrow-right" type="button" id="bb33ArtikelNext" aria-label="Berikutnya">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M9 6l6 6-6 6" fill="none" stroke="currentColor" stroke-width="2.6"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
        </div>

        {{-- Dots --}}
        <div class="bb33-dots" id="bb33ArtikelDots" aria-label="Navigasi slide"></div>

        <div class="bb33-cta">
            <a href="{{ route('artikel.index') }}" class="bb33-btn">Lihat semua artikel</a>
        </div>
    </div>
</section>
