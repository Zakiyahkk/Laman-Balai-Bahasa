@extends('admin.layout')

@section('content')
<!-- =================  SECTION LAYOUT ATAS ================= -->
<div class="page-header d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="mb-1">Galeri</h3>
        <p class="text-muted mb-0">
            Halaman ini untuk Pengelolaan media dokumentasi Balai Bahasa Provinsi Riau.
        </p>
    </div>

    <div class="header-logo">
        <img src="/img/logo.png"
             alt="Logo Balai Bahasa Provinsi Riau"
             class="img-fluid header-logo">
    </div>
</div>
<body>
<div class="galeri-container">
    <div class="galeri-header">
    </div>
    <div class="filter-bar">
        <div class="search-box">
            <i class="fas fa-search"></i> 
            <input type="text" placeholder="Cari media...">
        </div>
        <div class="dropdown-filter">
            <select class="filter-select">
                <option value="">Semua Kategori</option>
                <option value="foto">Foto</option>
                <option value="video">Video</option>
            </select>
        </div>
        <div class="dropdown-filter">
            <select class="filter-select">
                <option value="">Semua Tipe</option>
                <option value="png">PNG</option>
                <option value="jpg">JPG</option>
                <option value="mp4">MP4</option>
            </select>
        </div>
            <a href="{{ route('admin.galeri.create') }}" class="btn btn-primary"> + Upload Media </a>
        </button>   
    </div>
        <div class="media-grid" id="media-grid"> 
            <div class="media-card" data-category="kegiatan" data-type="foto">
                <span class="media-type-badge foto">Foto</span>
                <div class="media-preview">
                    <i class="far fa-image"></i>
                </div>
                <div class="media-info">
                    <h3 class="media-title">Seminar Bahasa Indonesia 2024 </h3>
                    <p><i class="fas fa-tag"></i>Kegiatan</p>
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
            <div class="media-card" data-category="kegiatan" data-type="video">
                <span class="media-type-badge video">video</span>
                <div class="media-preview">
                    <i class="far fa-image"></i>
                </div>
                <div class="media-info">
                    <h3 class="media-title">Kiat-kiat dalam ilmu bahasa melayu</h3>
                    <p><i class="fas fa-tag"></i>Kegiatan</p>
                    <p><i class="far fa-calendar-alt"></i> 14 Jan 2024</p>
                    <p>4.1 MB</p>
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