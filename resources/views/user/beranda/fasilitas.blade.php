<section class="fasilitas-section">
    <div class="container">
        <h2 class="section-title text-center">
            Fasilitas <span>Balai Bahasa Provinsi Riau</span>
        </h2>

        <div class="fasilitas-wrapper">

            <!-- PANAH KIRI -->
            <button class="fasilitas-arrow fasilitas-arrow-left" type="button" id="fasilitasPrev" aria-label="Sebelumnya">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M15 18l-6-6 6-6" fill="none" stroke="currentColor" stroke-width="2.6"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>

            <!-- SLIDER -->
            <div class="fasilitas-slider" id="fasilitasSlider">
                <div class="fasilitas-indicator" id="fasilitasIndicator"></div>

                <!-- CARD -->
                <div class="fasilitas-card">
                    <img src="{{ asset('img/fasilitas.png') }}" alt="">
                    <div class="fasilitas-card-content">
                        <h4>Fasilitas Disabilitas</h4>
                        <p>
                            Balai Bahasa Provinsi Riau menyediakan fasilitas ramah
                            disabilitas sebagai bentuk pelayanan publik yang inklusif.
                        </p>
                    </div>
                    <a href="#" class="btn-fasilitas">Selengkapnya</a>
                </div>

                <div class="fasilitas-card">
                    <img src="{{ asset('img/fasilitas.png') }}" alt="">
                    <div class="fasilitas-card-content">
                        <h4>Unit Layanan Terpadu</h4>
                        <p>
                            Unit Layanan Terpadu melayani berbagai kebutuhan kebahasaan
                            dan kesastraan masyarakat.
                        </p>
                    </div>
                    <a href="#" class="btn-fasilitas">Selengkapnya</a>
                </div>

                <div class="fasilitas-card">
                    <img src="{{ asset('img/fasilitas.png') }}" alt="">
                    <div class="fasilitas-card-content">
                        <h4>Tempat Bermain Balai</h4>
                        <p>
                            Area ramah anak untuk mendukung kegiatan literasi
                            dan pembelajaran yang menyenangkan.
                        </p>
                    </div>
                    <a href="#" class="btn-fasilitas">Selengkapnya</a>
                </div>

                <div class="fasilitas-card">
                    <img src="{{ asset('img/fasilitas.png') }}" alt="">
                    <div class="fasilitas-card-content">
                        <h4>Tempat Olahraga</h4>
                        <p>
                            Area ramah anak untuk mendukung kegiatan literasi
                            dan pembelajaran yang menyenangkan.
                        </p>
                    </div>
                    <a href="#" class="btn-fasilitas">Selengkapnya</a>
                </div>

            </div>

            <!-- PANAH KANAN -->
            <button class="fasilitas-arrow fasilitas-arrow-right" type="button" id="fasilitasNext"
                aria-label="Berikutnya">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M9 6l6 6-6 6" fill="none" stroke="currentColor" stroke-width="2.6"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>

        </div>
        <div class="section-divider"></div>
    </div>
</section>
