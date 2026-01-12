<section class="section berita-terbaru">
    <div class="container">

        <h2 class="judul-center">
            Berita <span>Terbaru</span>
        </h2>

        <div class="berita-grid">

            {{-- CARD 1 --}}
            <div class="berita-card">
                <div class="berita-img">
                    <span class="badge">BERITA</span>
                    <a href="{{ route('berita.show', 'kolaborasi-komunitas-relawan-cerdas-riau') }}">
                        <img src="/img/img1.png" alt="Kolaborasi Relawan Cerdas Riau">
                    </a>
                </div>

                <div class="berita-body">
                    <a href="{{ route('berita.show', 'kolaborasi-komunitas-relawan-cerdas-riau') }}">
                        <h4>Kolaborasi dengan Komunitas Relawan Cerdas Riau</h4>
                    </a>

                    <p>
                        Balai Bahasa Provinsi Riau melaksanakan kegiatan
                        pemantapan kebahasaan...
                    </p>

                    <div class="berita-meta">
                        <span>14 Desember 2025</span>
                        <div class="meta-right">
                            <span>Admin</span>
                            <span class="views">
                                <i class="fa-regular fa-eye"></i>
                            </span> 486
                        </div>
                    </div>
                </div>
            </div>

            {{-- CARD 2 --}}
            <div class="berita-card">
                <div class="berita-img">
                    <span class="badge">BERITA</span>
                    <a href="{{ route('berita.show', 'pembinaan-bahasa-provinsi-riau') }}">
                        <img src="/img/img1.png" alt="Pembinaan Bahasa Riau">
                    </a>
                </div>

                <div class="berita-body">
                    <a href="{{ route('berita.show', 'pembinaan-bahasa-provinsi-riau') }}">
                        <h4>Pembinaan Bahasa di Provinsi Riau</h4>
                    </a>

                    <p>
                        Kegiatan pembinaan dilakukan untuk meningkatkan
                        kualitas penggunaan bahasa...
                    </p>

                    <div class="berita-meta">
                        <span>13 Desember 2025</span>
                        <div class="meta-right">
                            <span>Admin</span>
                            <span class="views">
                                <i class="fa-regular fa-eye"></i>
                            </span> 486
                        </div>
                    </div>
                </div>
            </div>

            {{-- CARD 3 --}}
            <div class="berita-card">
                <div class="berita-img">
                    <span class="badge">BERITA</span>
                    <a href="{{ route('berita.show', 'literasi-sekolah-riau') }}">
                        <img src="/img/img1.png" alt="Literasi Sekolah Riau">
                    </a>
                </div>

                <div class="berita-body">
                    <a href="{{ route('berita.show', 'literasi-sekolah-riau') }}">
                        <h4>Penguatan Literasi Sekolah di Provinsi Riau</h4>
                    </a>

                    <p>
                        Program literasi dilaksanakan untuk meningkatkan
                        minat baca peserta didik...
                    </p>

                    <div class="berita-meta">
                        <span>12 Desember 2025</span>
                        <div class="meta-right">
                            <span>Admin</span>
                            <span class="views">
                                <i class="fa-regular fa-eye"></i>
                            </span> 486
                        </div>
                    </div>
                </div>
            </div>

            {{-- CARD 4 --}}
            <div class="berita-card">
                <div class="berita-img">
                    <span class="badge">BERITA</span>
                    <a href="{{ route('berita.show', 'dialog-kebijakan-bahasa-riau') }}">
                        <img src="/img/img1.png" alt="Dialog Kebijakan Bahasa">
                    </a>
                </div>

                <div class="berita-body">
                    <a href="{{ route('berita.show', 'dialog-kebijakan-bahasa-riau') }}">
                        <h4>Dialog Kebijakan Bahasa Bersama Pemangku Kepentingan</h4>
                    </a>

                    <p>
                        Diskusi kebijakan bahasa dilakukan untuk menyamakan
                        persepsi lintas sektor...
                    </p>

                    <div class="berita-meta">
                        <span>11 Desember 2025</span>
                        <div class="meta-right">
                            <span>Admin</span>
                            <span class="views">
                                <i class="fa-regular fa-eye"></i>
                            </span> 486
                        </div>
                    </div>
                </div>
            </div>

        </div> {{-- end .berita-grid --}}

        <div class="btn-center">
            <a href="{{ route('berita.index') }}" class="btn-berita">
                Berita Selengkapnya
            </a>
        </div>

        <div class="section-divider"></div>

    </div>
</section>
