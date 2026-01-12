<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fasilitas Balai Bahasa</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>

<body>

    <section class="fasilitas-section">
        <div class="container">

             <div class="section-header">
                <h2 class="judul-section">Fasilitas Balai Bahasa Provinsi Riau</h2>
                <div class="header-line"></div>
            </div>

            <div class="fasilitas-wrapper">

                <button class="fasilitas-arrow fasilitas-arrow-left" id="prevBtn" aria-label="Sebelumnya">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M15 18l-6-6 6-6" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>

                <div class="fasilitas-slider-window">
                    <div class="fasilitas-track" id="track">

                        <div class="fasilitas-card">
                            <div class="card-img-box">
                                <img src="{{ asset('img/fasilitas.png') }}" alt="ULT" onerror="this.src='https://via.placeholder.com/400x250?text=ULT'">
                            </div>
                            <div class="fasilitas-card-content">
                                <h4>Unit Layanan Terpadu</h4>
                                <p>Pusat pelayanan informasi dan administrasi kebahasaan satu pintu yang cepat, tepat, dan ramah.</p>
                                <a href="#" class="btn-fasilitas">Lihat Detail <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </div>

                        <div class="fasilitas-card">
                            <div class="card-img-box">
                                <img src="{{ asset('img/fasilitas.png') }}" alt="Perpustakaan" onerror="this.src='https://via.placeholder.com/400x250?text=Perpustakaan'">
                            </div>
                            <div class="fasilitas-card-content">
                                <h4>Perpustakaan</h4>
                                <p>Koleksi ribuan buku sastra dan linguistik lengkap dengan ruang baca yang nyaman dan tenang.</p>
                                <a href="#" class="btn-fasilitas">Lihat Detail <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </div>

                        <div class="fasilitas-card">
                            <div class="card-img-box">
                                <img src="{{ asset('img/fasilitas.png') }}" alt="Fasilitas Disabilitas" onerror="this.src='https://via.placeholder.com/400x250?text=Disabilitas'">
                            </div>
                            <div class="fasilitas-card-content">
                                <h4>Ramah Disabilitas</h4>
                                <p>Tersedia jalur kursi roda, guiding block, dan toilet khusus untuk menjamin aksesibilitas bagi semua.</p>
                                <a href="#" class="btn-fasilitas">Lihat Detail <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </div>

                        <div class="fasilitas-card">
                            <div class="card-img-box">
                                <img src="{{ asset('img/fasilitas.png') }}" alt="Sarana Olahraga" onerror="this.src='https://via.placeholder.com/400x250?text=Olahraga'">
                            </div>
                            <div class="fasilitas-card-content">
                                <h4>Sarana Olahraga</h4>
                                <p>Lapangan multifungsi untuk mendukung kesehatan fisik pegawai dan aktivitas luar ruangan pengunjung.</p>
                                <a href="#" class="btn-fasilitas">Lihat Detail <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </div>

                        <div class="fasilitas-card">
                            <div class="card-img-box">
                                <img src="{{ asset('img/fasilitas.png') }}" alt="Serambi" onerror="this.src='https://via.placeholder.com/400x250?text=Serambi'">
                            </div>
                            <div class="fasilitas-card-content">
                                <h4>Serambi Bahasa</h4>
                                <p>Ruang tunggu dan area komunal yang nyaman untuk berdiskusi santai seputar bahasa dan sastra.</p>
                                <a href="#" class="btn-fasilitas">Lihat Detail <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </div>

                        <div class="fasilitas-card">
                            <div class="card-img-box">
                                <img src="{{ asset('img/fasilitas.png') }}" alt="Mushala" onerror="this.src='https://via.placeholder.com/400x250?text=Mushala'">
                            </div>
                            <div class="fasilitas-card-content">
                                <h4>Mushala Al-Bayan</h4>
                                <p>Tempat ibadah yang bersih, sejuk, dan dilengkapi perlengkapan sholat yang memadai.</p>
                                <a href="#" class="btn-fasilitas">Lihat Detail <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </div>

                        <div class="fasilitas-card">
                            <div class="card-img-box">
                                <img src="{{ asset('img/fasilitas.png') }}" alt="Parkir" onerror="this.src='https://via.placeholder.com/400x250?text=Parkir'">
                            </div>
                            <div class="fasilitas-card-content">
                                <h4>Tempat Parkir Luas</h4>
                                <p>Area parkir roda dua dan roda empat yang luas, tertata rapi, dan diawasi petugas keamanan.</p>
                                <a href="#" class="btn-fasilitas">Lihat Detail <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </div>

                        <div class="fasilitas-card">
                            <div class="card-img-box">
                                <img src="{{ asset('img/fasilitas.png') }}" alt="Pojok ASI" onerror="this.src='https://via.placeholder.com/400x250?text=Pojok+ASI'">
                            </div>
                            <div class="fasilitas-card-content">
                                <h4>Pojok ASI (Laktasi)</h4>
                                <p>Ruang privat yang nyaman dan higienis bagi ibu menyusui yang berkunjung ke Balai Bahasa.</p>
                                <a href="#" class="btn-fasilitas">Lihat Detail <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </div>

                        <div class="fasilitas-card">
                            <div class="card-img-box">
                                <img src="{{ asset('img/fasilitas.png') }}" alt="Taman Anak" onerror="this.src='https://via.placeholder.com/400x250?text=Taman+Anak'">
                            </div>
                            <div class="fasilitas-card-content">
                                <h4>Taman Bermain Anak</h4>
                                <p>Area bermain edukatif untuk anak-anak guna menumbuhkan kecintaan literasi sejak dini.</p>
                                <a href="#" class="btn-fasilitas">Lihat Detail <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </div>

                        <div class="fasilitas-card">
                            <div class="card-img-box">
                                <img src="{{ asset('img/fasilitas.png') }}" alt="Aula" onerror="this.src='https://via.placeholder.com/400x250?text=Aula'">
                            </div>
                            <div class="fasilitas-card-content">
                                <h4>Aula Serbaguna</h4>
                                <p>Ruang pertemuan berkapasitas besar dengan fasilitas audio visual lengkap untuk seminar dan acara.</p>
                                <a href="#" class="btn-fasilitas">Lihat Detail <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </div>

                        <div class="fasilitas-card">
                            <div class="card-img-box">
                                <img src="{{ asset('img/fasilitas.png') }}" alt="Ruang Siniar" onerror="this.src='https://via.placeholder.com/400x250?text=Studio+Podcast'">
                            </div>
                            <div class="fasilitas-card-content">
                                <h4>Ruang Siniar (Podcast)</h4>
                                <p>Studio rekaman kedap suara dengan peralatan profesional untuk produksi konten kreatif digital.</p>
                                <a href="#" class="btn-fasilitas">Lihat Detail <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </div>

                        <div class="fasilitas-card">
                            <div class="card-img-box">
                                <img src="{{ asset('img/fasilitas.png') }}" alt="Toilet" onerror="this.src='https://via.placeholder.com/400x250?text=Toilet'">
                            </div>
                            <div class="fasilitas-card-content">
                                <h4>Toilet Higienis</h4>
                                <p>Fasilitas sanitasi yang bersih, terawat, dan tersedia air bersih yang cukup di setiap lantai.</p>
                                <a href="#" class="btn-fasilitas">Lihat Detail <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </div>

                    </div>
                </div>

                <button class="fasilitas-arrow fasilitas-arrow-right" id="nextBtn" aria-label="Berikutnya">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M9 6l6 6-6 6" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>

            </div>
        </div>
    </section>
</body>

</html>