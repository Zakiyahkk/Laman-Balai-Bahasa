<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Balai Bahasa Provinsi Riau</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://unpkg.com/typed.js@2.0.16/dist/typed.umd.js"></script>
</head>

<body>
    <section class="hero-container">
        <div class="hero-bg">
            <img src="https://ppidbbpriau.kemendikdasmen.go.id/images/gedung-balai.jpeg" alt="Gedung Balai">
        </div>
        <div class="overlay"></div>

        <div class="content-wrapper">
            <div class="welcome-badge">Selamat Datang</div>

            <div id="seq-brand" class="text-sequence active">
                <h1 class="brand-title">Balai Bahasa Provinsi Riau</h1>
                <h3 class="brand-sub">Kementerian Pendidikan Dasar dan Menengah</h3>
            </div>

            <div id="seq-service" class="text-sequence">
                <h2 class="main-text">
                    Kami siap melayani dengan <br>
                    <span id="typing-element" class="highlight-text"></span>
                </h2>
            </div>

            <div class="scroll-indicator" onclick="window.scrollTo({top: window.innerHeight, behavior: 'smooth'});">
                <span class="scroll-text">Lihat ke Bawah</span>
                <div class="mouse-icon">
                    <div class="wheel"></div>
                </div>
                <i class="fa-solid fa-chevron-down" style="margin-top: 5px; animation: bounce 2s infinite;"></i>
            </div>
        </div>

        <div id="welcomePopup" class="popup-overlay">
            <div class="popup-box">
                <button class="close-btn" onclick="closeWelcomePopup()">
                    <i class="fa-solid fa-xmark"></i>
                </button>

                <img src="{{ asset('img/pantun2.png') }}" alt="Pantun Hari Ini" class="popup-img">
            </div>
        </div>

    </section>
</body>

</html>