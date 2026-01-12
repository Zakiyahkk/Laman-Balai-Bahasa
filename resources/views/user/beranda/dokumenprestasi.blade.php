<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Piagam Penghargaan</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>

    <section class="dokpres-hero">
        <div class="container">
            <h2>Piagam Penghargaan</h2>
            <p>
                Bukti nyata dedikasi dan komitmen Balai Bahasa Provinsi Riau dalam memberikan pelayanan prima, inovasi, dan akuntabilitas kinerja.
            </p>
        </div>
    </section>

    <section class="dokpres-section">
        <div class="container">
            <div class="section-header">
                <h3>Capaian & Prestasi</h3>
                <p>Klik pada kartu untuk melihat sertifikat secara penuh.</p>
            </div>

            <div class="dokpres-grid">

                <div class="piagam-card fade-up delay-1" onclick="openModal(this)">
                    <div class="piagam-thumb">
                        <img src="img/sertifikat.jpg" alt="Sertifikat Full" class="card-img">
                        <div class="thumb-overlay"><i class="fa-solid fa-eye"></i></div>
                    </div>
                    <div class="piagam-content">
                        <div class="piagam-year-badge">2023</div>
                        <h4>Zona Integritas WBK</h4>
                        <p>Penghargaan Wilayah Bebas dari Korupsi (WBK) dari Kemenpan RB atas keberhasilan reformasi birokrasi.</p>
                        <i class="fa-solid fa-award watermark"></i>
                    </div>
                </div>

                <div class="piagam-card fade-up delay-2" onclick="openModal(this)">
                    <div class="piagam-thumb">
                        <img src="img/sertifikat.jpg" alt="Sertifikat Full" class="card-img">
                        <div class="thumb-overlay"><i class="fa-solid fa-eye"></i></div>
                    </div>
                    <div class="piagam-content">
                        <div class="piagam-year-badge">2022</div>
                        <h4>Pelayanan Publik Terbaik</h4>
                        <p>Peringkat pertama kategori pelayanan publik inklusif tingkat provinsi atas inovasi layanan disabilitas.</p>
                        <i class="fa-solid fa-thumbs-up watermark"></i>
                    </div>
                </div>

                <div class="piagam-card fade-up delay-3" onclick="openModal(this)">
                    <div class="piagam-thumb">
                        <img src="img/sertifikat.jpg" alt="Sertifikat Full" class="card-img">
                        <div class="thumb-overlay"><i class="fa-solid fa-eye"></i></div>
                    </div>
                    <div class="piagam-content">
                        <div class="piagam-year-badge">2021</div>
                        <h4>Inovasi Program Bahasa</h4>
                        <p>Penghargaan inovasi terbaik dalam pelestarian bahasa daerah berbasis digital dan komunitas.</p>
                        <i class="fa-solid fa-lightbulb watermark"></i>
                    </div>
                </div>

                <div class="piagam-card fade-up delay-1" onclick="openModal(this)">
                    <div class="piagam-thumb">
                        <img src="img/sertifikat.jpg" alt="Sertifikat Full" class="card-img">
                        <div class="thumb-overlay"><i class="fa-solid fa-eye"></i></div>
                    </div>
                    <div class="piagam-content">
                        <div class="piagam-year-badge">2020</div>
                        <h4>Satker Berkinerja Terbaik</h4>
                        <p>Apresiasi sebagai Satuan Kerja dengan kinerja pelaksanaan anggaran terbaik dari KPPN.</p>
                        <i class="fa-solid fa-star watermark"></i>
                    </div>
                </div>

                <div class="piagam-card fade-up delay-2" onclick="openModal(this)">
                    <div class="piagam-thumb">
                        <img src="img/sertifikat.jpg" alt="Sertifikat Full" class="card-img">
                        <div class="thumb-overlay"><i class="fa-solid fa-eye"></i></div>
                    </div>
                    <div class="piagam-content">
                        <div class="piagam-year-badge">2019</div>
                        <h4>Pegiat Literasi</h4>
                        <p>Penghargaan khusus atas kontribusi aktif dalam menggerakkan literasi di daerah tertinggal.</p>
                        <i class="fa-solid fa-book-open watermark"></i>
                    </div>
                </div>

                <div class="piagam-card fade-up delay-3" onclick="openModal(this)">
                    <div class="piagam-thumb">
                        <img src="img/sertifikat.jpg" alt="Sertifikat Full" class="card-img">
                        <div class="thumb-overlay"><i class="fa-solid fa-eye"></i></div>
                    </div>
                    <div class="piagam-content">
                        <div class="piagam-year-badge">2018</div>
                        <h4>Akreditasi A Perpustakaan</h4>
                        <p>Perpustakaan Balai Bahasa meraih akreditasi unggul dengan koleksi dan layanan standar nasional.</p>
                        <i class="fa-solid fa-certificate watermark"></i>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <div id="piagamModal" class="modal-overlay" onclick="closeModal(event)">
        <div class="modal-content-simple">
            <button class="modal-close-simple" onclick="closeModalBtn()">
                <i class="fa-solid fa-xmark"></i>
            </button>

            <img id="modalImg" src="" alt="Sertifikat Full">
        </div>
    </div>

</body>

</html>