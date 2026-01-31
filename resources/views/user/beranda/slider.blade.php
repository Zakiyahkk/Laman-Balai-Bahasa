<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Balai Bahasa Provinsi Riau</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <link rel="stylesheet" href="{{ asset('css/slider.css') }}">
</head>

<body>

    <section class="hero-container">

        <div class="swiper mySwiper">
            <div class="swiper-wrapper">

                <!-- SLIDE 1: KANTOR (BALAI BAHASA) -->
                <div class="swiper-slide slide-hero">
                    <div class="hero-bg"
                        style="background-image:url('https://ppidbbpriau.kemendikdasmen.go.id/images/gedung-balai.jpeg')">
                    </div>
                    <div class="hero-overlay"></div>
                    <div class="hero-content">
                        <h2 class="slide-title">BALAI BAHASA PROVINSI RIAU</h2>
                        <p class="slide-desc">Kementerian Pendidikan Dasar dan Menengah</p>
                    </div>
                </div>

                <!-- SLIDE 2: ANDAL (LOGO) -->
                <div class="swiper-slide" style="position: relative; width: 100%; height: 100%; display: flex !important; justify-content: center !important; align-items: center !important; background: #f9f9f9ff !important; overflow: hidden;">
                    <!-- background blur (Ambiance Jelas) -->
                    <div style="position: absolute; inset: 0; background-image: url('{{ asset('img/slider/LogoAndal.png') }}'); background-size: cover; background-position: center; filter: blur(8px); transform: scale(1.1); opacity: 0.15;"></div>
                    <!-- konten utama - CENTERED -->
                    <div style="position: relative; z-index: 2; width: 100%; height: 100%; display: flex; justify-content: center; align-items: center; padding: 20px;">
                        <img src="{{ asset('img/slider/LogoAndal.png') }}" alt="Logo Pelayanan Andal" style="max-width: 85%; max-height: 70%; object-fit: contain; background: transparent; filter: drop-shadow(0 10px 30px rgba(0,0,0,0.5));">
                    </div>
                </div>

                <!-- SLIDE 3: MAKLUMAT PELAYANAN -->
                <div class="swiper-slide" style="position: relative; width: 100%; height: 100%; display: flex !important; justify-content: center !important; align-items: center !important; background: #000; overflow: hidden;">
                    <!-- background blur -->
                    <div style="position: absolute; inset: 0; background-image: url('{{ asset('img/slider/maklumat.jpg') }}'); background-size: cover; background-position: center; filter: blur(12px); transform: scale(1.1); opacity: 0.35;"></div>
                    <!-- judul di atas gambar -->
                    <div style="position: absolute; top: 50px; left: 50%; transform: translateX(-50%); z-index: 3; text-align: center;">
                        <h2 style="color: #fff; font-size: 1.35rem; font-weight: 700; letter-spacing: 0.5px; text-shadow: 0 3px 15px rgba(0, 0, 0, 0.8), 0 1px 3px rgba(0, 0, 0, 0.9); margin: 0; padding: 0;">
                            Maklumat Pelayanan
                        </h2>
                    </div>
                    <!-- konten utama - CENTERED -->
                    <div style="position: relative; z-index: 2; width: 100%; height: 100%; display: flex; justify-content: center; align-items: center; padding: 20px;">
                        <img src="{{ asset('img/slider/maklumat.jpg') }}" alt="Maklumat Pelayanan" style="max-width: 85%; max-height: 70%; object-fit: contain; background: #fff; border-radius: 12px; box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);">
                    </div>
                </div>

            </div>

            <div class="swiper-pagination"></div>
        </div>

    </section>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script src="{{ asset('js/slider.js') }}"></script>
</body>

</html>
