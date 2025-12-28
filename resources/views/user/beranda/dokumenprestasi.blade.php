<!-- ================= HERO ================= -->
<section class="dokpres-hero">
    <div class="container">

        {{-- Judul & deskripsi hero (bisa dinamis) --}}
        <h2>Dokumen & Prestasi</h2>
        <p>
            Informasi dokumen resmi serta capaian prestasi Balai Bahasa
            sebagai bentuk transparansi, akuntabilitas, dan kinerja institusi.
        </p>

    </div>
</section>

<!-- ================= DOKUMEN ================= -->
<section class="dokpres-section">
    <div class="container">

        {{-- Judul section dokumen (bisa dinamis) --}}
        <div class="dokpres-title">
            <h3>Dokumen Resmi</h3>
            <p>Unduh dan akses berbagai dokumen penting Balai Bahasa</p>
        </div>

        <div class="dokpres-grid">

            {{-- CARD DOKUMEN (nanti bisa loop dari backend) --}}
            <div class="dokpres-card dokumen-card fade-up delay-1">
                <div class="dokumen-icon">📄</div>
                <div class="dokumen-content">
                    <h4>Rencana Strategis</h4>
                    <p>Dokumen perencanaan strategis Balai Bahasa.</p>
                    <a href="#">Unduh Dokumen</a>
                </div>

                {{--
                DATA DINAMIS DI SINI:
                - judul dokumen
                - deskripsi
                - file_url
                --}}
            </div>

            <div class="dokpres-card dokumen-card fade-up delay-2">
                <div class="dokumen-icon">📑</div>
                <div class="dokumen-content">
                    <h4>Laporan Kinerja</h4>
                    <p>Laporan kinerja tahunan dan evaluasi.</p>
                    <a href="#">Unduh Dokumen</a>
                </div>
            </div>

            <div class="dokpres-card dokumen-card fade-up delay-3">
                <div class="dokumen-icon">📘</div>
                <div class="dokumen-content">
                    <h4>Pedoman & Regulasi</h4>
                    <p>Pedoman, juknis, dan regulasi kebahasaan.</p>
                    <a href="#">Unduh Dokumen</a>
                </div>
            </div>

            {{--
            LOOP DOKUMEN DINAMIS DI SINI
            --}}
        </div>

    </div>
</section>

<!-- ================= PRESTASI ================= -->
<section class="dokpres-section">
    <div class="container">

        {{-- Judul section prestasi (bisa dinamis) --}}
        <div class="dokpres-title">
            <h3>Prestasi Balai Bahasa</h3>
            <p>Capaian dan penghargaan yang telah diraih</p>
        </div>

        <div class="dokpres-grid">

            {{-- CARD PRESTASI (nanti bisa loop dari backend) --}}
            <div class="dokpres-card prestasi-card fade-up delay-1">
                <span class="prestasi-badge">2023</span>
                <h4>Zona Integritas WBK</h4>
                <p>
                    Penghargaan atas komitmen pembangunan zona integritas
                    menuju Wilayah Bebas dari Korupsi.
                </p>

                {{--
                DATA DINAMIS DI SINI:
                - tahun
                - judul prestasi
                - deskripsi
                --}}
            </div>

            <div class="dokpres-card prestasi-card fade-up delay-2">
                <span class="prestasi-badge">2022</span>
                <h4>Pelayanan Publik Terbaik</h4>
                <p>
                    Apresiasi atas peningkatan kualitas layanan
                    kebahasaan kepada masyarakat.
                </p>
            </div>

            <div class="dokpres-card prestasi-card fade-up delay-3">
                <span class="prestasi-badge">2021</span>
                <h4>Inovasi Program Bahasa</h4>
                <p>
                    Penghargaan inovasi program pengembangan dan
                    pelindungan bahasa daerah.
                </p>
            </div>

            {{--
            LOOP PRESTASI DINAMIS DI SINI
            --}}
        </div>

    </div>
</section>