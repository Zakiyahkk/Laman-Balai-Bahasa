<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fasilitas Balai Bahasa</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
</head>

<body>

    @php
        $fasilitas = [
            [
                'nama' => 'Unit Layanan Terpadu',
                'slug' => 'ult',
                'gambar' => 'ult.png',
                'deskripsi' => 'Pusat pelayanan informasi dan administrasi kebahasaan satu pintu.',
            ],
            [
                'nama' => 'PPID',
                'slug' => 'ppid',
                'gambar' => 'ppid.jpeg',
                'deskripsi' => 'Pejabat Pengelola Informasi dan Dokumentasi Balai Bahasa.',
            ],
            [
                'nama' => 'Perpustakaan',
                'slug' => 'perpustakaan',
                'gambar' => 'perpustakaan.png',
                'deskripsi' => 'Koleksi buku bahasa dan sastra dengan ruang baca nyaman.',
            ],
            [
                'nama' => 'Serambi Bahasa',
                'slug' => 'serambi',
                'gambar' => 'serambi.jpeg',
                'deskripsi' => 'Ruang tunggu dan diskusi santai.',
            ],
            [
                'nama' => 'Mushola',
                'slug' => 'mushola',
                'gambar' => 'musala.png',
                'deskripsi' => 'Tempat ibadah yang bersih dan nyaman.',
            ],
            [
                'nama' => 'Tempat Parkir',
                'slug' => 'parkir',
                'gambar' => 'parkir.jpeg',
                'deskripsi' => 'Area parkir luas dan tertata.',
            ],
            [
                'nama' => 'Fasilitas Disabilitas',
                'slug' => 'Disabilitas',
                'gambar' => 'disabilitas.png',
                'deskripsi' => 'Area parkir luas dan tertata.',
            ],
            [
                'nama' => 'Ruang Laktasi',
                'slug' => 'laktasi',
                'gambar' => 'laktasi.png',
                'deskripsi' => 'Ruang khusus ibu menyusui.',
            ],
            [
                'nama' => 'Aula',
                'slug' => 'aula',
                'gambar' => 'aula.jpeg',
                'deskripsi' => 'Ruang pertemuan dan kegiatan besar.',
            ],
            [
                'nama' => 'Toilet',
                'slug' => 'toilet',
                'gambar' => 'toilet.jpeg',
                'deskripsi' => 'Toilet bersih dan higienis.',
            ],
        ];
    @endphp

    <section class="fasilitas-section">
        <div class="container">

            <div class="section-header">
                <h2 class="judul-section">Fasilitas Balai Bahasa Provinsi Riau</h2>
                <div class="header-line"></div>
            </div>

            <div class="fasilitas-wrapper">

                <!-- 🔹 PANAH PREV (TETAP ADA) -->
                <button class="fasilitas-arrow fasilitas-arrow-left" id="prevBtn" aria-label="Sebelumnya">
                    <svg viewBox="0 0 24 24">
                        <path d="M15 18l-6-6 6-6" fill="none" stroke="currentColor" stroke-width="2.6"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>

                <div class="fasilitas-slider-window">
                    <div class="fasilitas-track" id="track">

                        @foreach ($fasilitas as $item)
                            <div class="fasilitas-card">
                                <div class="card-img-box">
                                    <img src="{{ asset('img/fasilitas/' . $item['gambar']) }}" alt="{{ $item['nama'] }}"
                                        onerror="this.src='https://via.placeholder.com/400x250?text={{ urlencode($item['nama']) }}'">
                                </div>

                                <div class="fasilitas-card-content">
                                    <h4>{{ $item['nama'] }}</h4>
                                    <p>{{ $item['deskripsi'] }}</p>

                                    <a href="{{ route('fasilitas.detail', $item['slug']) }}" class="btn-fasilitas">
                                        Lihat Detail
                                    </a>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>

                <!-- 🔹 PANAH NEXT (TETAP ADA) -->
                <button class="fasilitas-arrow fasilitas-arrow-right" id="nextBtn" aria-label="Berikutnya">
                    <svg viewBox="0 0 24 24">
                        <path d="M9 6l6 6-6 6" fill="none" stroke="currentColor" stroke-width="2.6"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>

            </div>
        </div>
    </section>

</body>

</html>
