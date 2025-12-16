@extends('admin.layout')

@section('content')
<!-- =================  SECTION LAYOUT ATAS ================= -->
<div class="page-header d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="mb-1">Galeri</h3>
        <p class="text-muted mb-0">
            Halaman ini untuk mengelola alinea yang dipublikasikan di Balai Bahasa Provinsi Riau
        </p>
    </div>

    <div class="header-logo">
        <img src="/img/logo.png"
             alt="Logo Balai Bahasa Provinsi Riau"
             class="img-fluid header-logo">
    </div>
</div>
<body>
    <div class="gallery-container">
        <header class="gallery-header">
            <button class="upload-button">
            <i class="fas fa-plus"></i> Upload Media
            </button>
        </header>
        <div class="gallery-filters">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Cari media...">
            </div>
            <select class="filter-select">
                <option>Semua Kategori</option>
                </select>
            <select class="filter-select">
                <option>Semua Tipe</option>
                </select>
        </div>

        <div class="gallery-grid">
            <div class="gallery-item photo-item">
                <div class="media-preview photo-placeholder">
                    <i class="fas fa-image"></i>
                    <span class="media-type-tag photo-tag">Foto</span>
                </div>
                <div class="item-details">
                    <h3 class="item-title">Seminar Bahasa Indonesia 2024</h3>
                    <p class="item-category"><i class="fas fa-folder"></i> Kegiatan</p>
                    <p class="item-date">10 Des 2024</p>
                    <p class="item-size">2.4 MB</p>
                </div>
                <button class="delete-button"><i class="fas fa-trash-alt"></i> Hapus</button>
            </div>

            <div class="gallery-item photo-item">
                <div class="media-preview photo-placeholder">
                    <i class="fas fa-image"></i>
                    <span class="media-type-tag photo-tag">Foto</span>
                </div>
                <div class="item-details">
                    <h3 class="item-title">Workshop Penulisan Kreatif</h3>
                    <p class="item-category"><i class="fas fa-folder"></i> Kegiatan</p>
                    <p class="item-date">8 Des 2024</p>
                    <p class="item-size">1.8 MB</p>
                </div>
                <button class="delete-button"><i class="fas fa-trash-alt"></i> Hapus</button>
            </div>

            <div class="gallery-item video-item">
                <div class="media-preview video-placeholder">
                    <i class="fas fa-play-circle"></i>
                    <span class="media-type-tag video-tag">Video</span>
                </div>
                <div class="item-details">
                    <h3 class="item-title">Lomba Menulis Cerpen</h3>
                    <p class="item-category"><i class="fas fa-folder"></i> Kegiatan</p>
                    <p class="item-date">5 Des 2024</p>
                    <p class="item-size">45 MB</p>
                </div>
                <button class="delete-button"><i class="fas fa-trash-alt"></i> Hapus</button>
            </div>

            <div class="gallery-item photo-item">
                <div class="media-preview photo-placeholder">
                    <i class="fas fa-image"></i>
                    <span class="media-type-tag photo-tag">Foto</span>
                </div>
                <div class="item-details">
                    <h3 class="item-title">Perpustakaan Balai Bahasa</h3>
                    <p class="item-category"><i class="fas fa-folder"></i> Fasilitas</p>
                    <p class="item-date">3 Des 2024</p>
                    <p class="item-size">3.1 MB</p>
                </div>
                <button class="delete-button"><i class="fas fa-trash-alt"></i> Hapus</button>
            </div>
        </div>
    </div>
</body>
</html>
</div>
@endsection
