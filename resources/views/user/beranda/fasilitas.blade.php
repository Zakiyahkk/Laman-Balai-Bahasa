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
            'nama' => 'Lobi',
            'slug' => 'lobi',
            'gambar' => 'Lobi/lobi.png',
        ],
        [
            'nama' => 'Unit Layanan Terpadu (ULT)',
            'slug' => 'ult',
            'gambar' => 'Unit Layanan Terpadu (ULT)/ult.jpg',
        ],
        [
            'nama' => 'PPID',
            'slug' => 'ppid',
            'gambar' => 'PPID/ppid.png',
        ],
        [
            'nama' => 'Fasilitas Disabilitas',
            'slug' => 'disabilitas',
            'gambar' => 'Fasilitas Disabilitas/disabilitas.png',
        ],
        [
            'nama' => 'Aula R. H. Fisabilillah',
            'slug' => 'aula-fisabilillah',
            'gambar' => 'Aula R. H. Fisabilillah/ARHF.png',
        ],
        [
            'nama' => 'Aula Raja Ali Haji',
            'slug' => 'aula-raja-ali-haji',
            'gambar' => 'Aula Raja Ali Haji/ARAH.jpg',
        ],
        [
            'nama' => 'Serambi Kreatif',
            'slug' => 'serambi-kreatif',
            'gambar' => 'Serambi Kreatif/serambi.png',
        ],
        [
            'nama' => 'Musala Hikmah',
            'slug' => 'mushola',
            'gambar' => 'Musala Hikmah/musala.jpg',
        ],
        [
            'nama' => 'Perpustakaan',
            'slug' => 'perpustakaan',
            'gambar' => 'Perpustakaan/perpus.jpg',
        ],
        [
            'nama' => 'Fasilitas Olahraga',
            'slug' => 'olahraga',
            'gambar' => 'Fasilitas Olahraga/olahraga.jpg',
        ],
        [
            'nama' => 'Resam Bastra',
            'slug' => 'resam-bastra',
            'gambar' => 'Resam Bastra/resbas.jpg',
        ],
        [
            'nama' => 'Area Parkir',
            'slug' => 'parkir',
            'gambar' => 'Area Parkir/parkir.png',
        ],
        [
            'nama' => 'Ruang Laktasi',
            'slug' => 'laktasi',
            'gambar' => 'Ruang Laktasi/laktasi.jpg',
        ],
        [
            'nama' => 'Toilet',
            'slug' => 'toilet',
            'gambar' => 'Toilet/toilet.png',
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
