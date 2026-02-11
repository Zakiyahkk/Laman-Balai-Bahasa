@push('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<style>
    .hero-container {
        height: 120vh !important; /* Force height override */
        position: relative;
        width: 100%;
        max-width: 100%;
        background: #020617;
        overflow: hidden;
        font-family: "Plus Jakarta Sans", sans-serif;
    }
    
    .hero-bg {
        position: absolute;
        inset: 0;
        background-size: cover;
        background-position: center;
        transform: scale(1.05);
    }
</style>
@endpush

<section class="hero-container">

    <div class="swiper mySwiper">
        <div class="swiper-wrapper">

            <!-- SLIDE 1: KANTOR (BALAI BAHASA) -->
            <div class="swiper-slide slide-hero">
                <div class="hero-bg"
                    style="background-image:url('https://ppidbbpriau.kemendikdasmen.go.id/images/gedung-balai.jpeg')">
                </div>
                <!-- Navy Gradient Overlay -->
                <div class="hero-overlay" style="background: linear-gradient(to top, rgba(15, 23, 42, 1) 0%, rgba(30, 58, 138, 0.6) 50%, rgba(30, 58, 138, 0.2) 100%);"></div>
                
                <div class="hero-content">
                    <!-- Badge "Laman dan Informasi Resmi" -->
                    <div style="margin-bottom: 24px; display: inline-block; padding: 10px 24px; background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); border-radius: 50px; border: 1px solid rgba(255, 255, 255, 0.2); box-shadow: 0 8px 20px rgba(0,0,0,0.2);">
                        <span style="color: #facc15; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; font-size: 13px;">
                            <i class="fa-solid fa-certificate" style="margin-right: 8px;"></i> Laman dan Informasi Resmi
                        </span>
                    </div>

                    <h2 class="slide-title" style="text-shadow: 0 4px 10px rgba(0,0,0,0.5);">BALAI BAHASA PROVINSI RIAU</h2>
                    <p class="slide-desc" style="font-size: 1.2rem; margin-top: 10px; color: #e2e8f0; font-weight: 300;">Kementerian Pendidikan Dasar dan Menengah</p>
                </div>
            </div>

            <!-- SLIDE 2: ANDAL (LOGO) -->
            <div class="swiper-slide" style="position: relative; width: 100%; height: 100%; display: flex !important; justify-content: center !important; align-items: center !important; background: #fff !important; overflow: hidden;">
                <!-- background blur (Ambiance Jelas) -->
                <div style="position: absolute; inset: 0; background-image: url('{{ asset('img/slider/LogoAndal.png') }}'); background-size: cover; background-position: center; filter: blur(20px); opacity: 0.15;"></div>
                
                <!-- Gold Gradient Bottom -->
                <div style="position: absolute; bottom: 0; left: 0; width: 100%; height: 50%; background: linear-gradient(to top, rgba(234, 179, 8, 0.15) 0%, transparent 100%); z-index: 1;"></div>
                
                <!-- konten utama - CENTERED & FULL HEIGHT -->
                <div style="position: relative; z-index: 2; width: 100%; height: 100%; display: flex; justify-content: center; align-items: center; padding-top: 40px;"> <!-- padding top to push image slightly down if needed, but flex center handles it -->
                     <img src="{{ asset('img/slider/LogoAndal.png') }}" alt="Logo Pelayanan Andal" style="width: auto; height: 90%; object-fit: contain; filter: drop-shadow(0 20px 40px rgba(0,0,0,0.15));">
                </div>
            </div>

            <!-- SLIDE 3: MAKLUMAT PELAYANAN -->
            <div class="swiper-slide" style="position: relative; width: 100%; height: 100%; display: flex !important; justify-content: center !important; align-items: center !important; background: #020617; overflow: hidden;">
                <!-- background blur -->
                <div style="position: absolute; inset: 0; background-image: url('{{ asset('img/slider/maklumat.jpg') }}'); background-size: cover; background-position: center; filter: blur(8px); transform: scale(1.1); opacity: 0.5;"></div>
                
                <!-- Navy Gradient Overlay -->
                <div style="position: absolute; inset: 0; background: linear-gradient(to top, rgba(15, 23, 42, 1) 0%, rgba(30, 58, 138, 0.4) 100%); z-index: 1;"></div>

                <!-- judul di atas gambar -->
                <div style="position: absolute; top: 100px; left: 50%; transform: translateX(-50%); z-index: 3; text-align: center; width: 100%;">
                    <div style="display: inline-block; padding: 12px 30px; background: rgba(255,255,255,0.05); backdrop-filter: blur(5px); border-radius: 50px; border: 1px solid rgba(255,255,255,0.1); box-shadow: 0 10px 30px rgba(0,0,0,0.3);">
                        <h2 style="color: #f8fafc; font-size: 1.25rem; font-weight: 700; letter-spacing: 2px; margin: 0; text-transform: uppercase;">
                            <i class="fa-solid fa-scroll" style="margin-right: 10px; color: #facc15;"></i> Maklumat Pelayanan
                        </h2>
                    </div>
                </div>
                <!-- konten utama - CENTERED -->
                <div style="position: relative; z-index: 2; width: 100%; height: 100%; display: flex; justify-content: center; align-items: center; padding: 20px; padding-top: 80px;">
                    <img src="{{ asset('img/slider/maklumat.jpg') }}" alt="Maklumat Pelayanan" style="max-width: 90%; max-height: 75%; object-fit: contain; background: #fff; border-radius: 8px; box-shadow: 0 25px 50px rgba(0, 0, 0, 0.6); border: 1px solid rgba(255,255,255,0.1);">
                </div>
            </div>

        </div>

        <div class="swiper-pagination"></div>
    </div>

</section>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="{{ asset('js/slider.js') }}"></script>
@endpush
