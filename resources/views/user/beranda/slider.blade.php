<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Balai Bahasa Provinsi Riau</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <link rel="stylesheet" href="{{ asset('css/slider.css') }}">
</head>

<body>

    <section class="hero-container">

        <div class="swiper mySwiper">
            <div class="swiper-wrapper">

                <div class="swiper-slide">
                    <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?q=80&w=1600&auto=format&fit=crop" alt="Andal" class="slide-bg">
                    <div class="slide-overlay"></div>
                    <div class="slide-content">
                        <h2 class="slide-title">PELAYANAN ANDAL</h2>
                        <p class="slide-desc">Siap Melayani dengan Cepat, Tepat, dan Akuntabel</p>
                    </div>
                </div>

                <div class="swiper-slide">
                    <img src="https://images.unsplash.com/photo-1450101499163-c8848c66ca85?q=80&w=1600&auto=format&fit=crop" alt="Maklumat" class="slide-bg">
                    <div class="slide-overlay"></div>
                    <div class="slide-content">
                        <h2 class="slide-title">MAKLUMAT PELAYANAN</h2>
                        <p class="slide-desc">Informasi Terkini dan Transparansi Publik</p>
                    </div>
                </div>

                <div class="swiper-slide">
                    <img src="https://ppidbbpriau.kemendikdasmen.go.id/images/gedung-balai.jpeg" alt="Kantor Balai" class="slide-bg">
                    <div class="slide-overlay"></div>
                    <div class="slide-content">
                        <h2 class="slide-title">BALAI BAHASA PROVINSI RIAU</h2>
                        <p class="slide-desc">Kementerian Pendidikan Dasar dan Menengah</p>
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