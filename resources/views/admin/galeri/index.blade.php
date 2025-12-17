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
 <header class="galeri-header">
    <div class="header-left">
    </div>
    
    <button class="upload-button">
        <i class="fas fa-plus"></i> Upload Media
    </button>
</header>
        <div class="filter-bar">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Cari media...">
            </div>
            
            <div class="dropdown-filter">
                <select class="filter-select" id="kategori-filter">
                    <option value="all" selected>Semua Kategori</option>
                    <option value="kegiatan">Kegiatan</option>
                    <option value="fasilitas">Fasilitas</option>
                    <option value="tim">Tim</option>
                    <option value="lainnya">Lainnya</option>
                </select>
            </div>

            <div class="dropdown-filter">
                <select class="filter-select" id="tipe-filter">
                    <option value="all" selected>Semua Tipe</option>
                    <option value="foto">Foto</option>
                    <option value="video">Video</option>
                </select>
            </div>
        </div>

        <div class="media-grid" id="media-grid">
            
            <div class="media-card" data-category="kegiatan" data-type="foto">
                <span class="media-type-badge foto">Foto</span>
                <div class="media-preview">
                    <i class="far fa-image"></i>
                </div>
                <div class="media-info">
                    <h3 class="media-title">Seminar Bahasa Indonesia 2024</h3>
                    <p><i class="fas fa-tag"></i> Kegiatan</p>
                    <p><i class="far fa-calendar-alt"></i> 10 DES 2024</p>
                    <p>2.4 MB</p>
                </div>
                <button class="delete-button" onclick="hapusMedia(this)">
                    <i class="fas fa-trash-alt"></i> Hapus
                </button>
            </div>

            <div class="media-card" data-category="kegiatan" data-type="foto">
                <span class="media-type-badge foto">Foto</span>
                <div class="media-preview">
                    <i class="far fa-image"></i>
                </div>
                <div class="media-info">
                    <h3 class="media-title">Workshop Penulisan Kreatif</h3>
                    <p><i class="fas fa-tag"></i> Kegiatan</p>
                    <p><i class="far fa-calendar-alt"></i> 8 DES 2024</p>
                    <p>1.8 MB</p>
                </div>
                <button class="delete-button" onclick="hapusMedia(this)">
                    <i class="fas fa-trash-alt"></i> Hapus
                </button>
            </div>

            <div class="media-card" data-category="kegiatan" data-type="video">
                <span class="media-type-badge video">Video</span>
                <div class="media-preview">
                    <i class="fas fa-play-circle"></i>
                </div>
                <div class="media-info">
                    <h3 class="media-title">Lomba Menulis Cerpen</h3>
                    <p><i class="fas fa-tag"></i> Kegiatan</p>
                    <p><i class="far fa-calendar-alt"></i> 5 DES 2024</p>
                    <p>45 MB</p>
                </div>
                <button class="delete-button" onclick="hapusMedia(this)">
                    <i class="fas fa-trash-alt"></i> Hapus
                </button>
            </div>

            <div class="media-card" data-category="fasilitas" data-type="foto">
                <span class="media-type-badge foto">Foto</span>
                <div class="media-preview">
                    <i class="far fa-image"></i>
                </div>
                <div class="media-info">
                    <h3 class="media-title">Perpustakaan Balai Bahasa</h3>
                    <p><i class="fas fa-tag"></i> Fasilitas</p>
                    <p><i class="far fa-calendar-alt"></i> 3 DES 2024</p>
                    <p>3.1 MB</p>
                </div>
                <button class="delete-button" onclick="hapusMedia(this)">
                    <i class="fas fa-trash-alt"></i> Hapus
                </button>
            </div>

            </div>

    </div>

    <script src="script.js"></script>
</body>
</html>
</div>
@endsection
