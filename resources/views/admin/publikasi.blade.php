@extends('admin.layout')

@section('content')
<!-- =================  SECTION LAYOUT ATAS ================= -->
<div class="page-header d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="mb-1">Publikasi</h3>
        <p class="text-muted mb-0">
            Total publikasi: 4
        </p>
    </div>

    <div class="header-logo">
        <img src="/img/logo.png"
             alt="Logo Balai Bahasa Provinsi Riau"
             class="img-fluid header-logo">
    </div>
</div>
<!-- =================  ISI MAIN CONTENT ================= -->
 <!-- ================= FILTER + ACTION BAR ================= -->
<div class="d-flex align-items-center mb-4 gap-2">

    <!-- SEARCH (LEBAR MAKSIMAL) -->
    <div class="flex-grow-1">
        <div class="input-group">
            <span class="input-group-text bg-white border-end-0">
                <i class="bi bi-search"></i>
            </span>

            <input type="text"
                   class="form-control border-start-0"
                   placeholder="Cari judul...">

            <button class="btn btn-outline-secondary dropdown-toggle"
                    type="button"
                    data-bs-toggle="dropdown">
                <i class="bi bi-funnel"></i>
            </button>

            <ul class="dropdown-menu dropdown-menu-end">
                <li><h6 class="dropdown-header">Kategori</h6></li>
                <li><a class="dropdown-item active" href="#">Semua</a></li>
                <li><a class="dropdown-item" href="#">Bahasa</a></li>
                <li><a class="dropdown-item" href="#">Sastra</a></li>
                <li><a class="dropdown-item" href="#">Kegiatan</a></li>
                <li><a class="dropdown-item" href="#">Pelatihan</a></li>
            </ul>
        </div>
    </div>
    <!-- TOMBOL TAMBAH -->
    <button class="btn btn-add-article fw-semibold d-flex align-items-center ms-2">
        <span class="icon-plus me-2">+</span>
        Publikasi
    </button>
</div>
<!-- ================= LIST PUBLIKASI ================= -->

<!-- CARD 1 -->
<div class="publication-card d-flex gap-4 mb-3">

    <img src="https://picsum.photos/220/160?1"
         alt="Thumbnail Publikasi"
         class="publication-thumb-lg">

    <div class="flex-grow-1">
        <h5 class="fw-bold mb-2">
            Perkembangan Teknologi AI di Indonesia
        </h5>

        <div class="d-flex align-items-center flex-wrap gap-3 text-muted small mb-3">
            <span><i class="bi bi-calendar-event me-1"></i> 15 Desember 2025</span>
            <span><i class="bi bi-person me-1"></i> Refanny Nabilla</span>
            <span><i class="bi bi-eye me-1"></i> 1.245 pembaca</span>
        </div>

        <p class="mb-0 text-muted">
            Perkembangan teknologi AI di Indonesia menunjukkan tren positif dan mulai
            diterapkan di berbagai sektor strategis.
        </p>
    </div>

    <div class="publication-action">
        <button class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-pencil"></i>
        </button>
        <button class="btn btn-outline-danger btn-sm">
            <i class="bi bi-trash"></i>
        </button>
    </div>

</div>

<!-- CARD 2 -->
<div class="publication-card d-flex gap-4 mb-3">

    <img src="https://picsum.photos/220/160?2"
         alt="Thumbnail Publikasi"
         class="publication-thumb-lg">

    <div class="flex-grow-1">
        <h5 class="fw-bold mb-2">
            Pelestarian Bahasa Melayu Riau
        </h5>

        <div class="d-flex align-items-center flex-wrap gap-3 text-muted small mb-3">
            <span><i class="bi bi-calendar-event me-1"></i> 10 Desember 2025</span>
            <span><i class="bi bi-person me-1"></i>Rian Lesmana Putra</span>
            <span><i class="bi bi-eye me-1"></i> 860 pembaca</span>
        </div>

        <p class="mb-0 text-muted">
            Upaya pelestarian bahasa daerah terus dilakukan melalui program edukasi,
            penelitian, dan publikasi digital.
        </p>
    </div>

    <div class="publication-action">
        <button class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-pencil"></i>
        </button>
        <button class="btn btn-outline-danger btn-sm">
            <i class="bi bi-trash"></i>
        </button>
    </div>

</div>

<!-- CARD 3 -->
<div class="publication-card d-flex gap-4 mb-3">

    <img src="https://picsum.photos/220/160?3"
         alt="Thumbnail Publikasi"
         class="publication-thumb-lg">

    <div class="flex-grow-1">
        <h5 class="fw-bold mb-2">
            Literasi Digital di Kalangan Pelajar
        </h5>

        <div class="d-flex align-items-center flex-wrap gap-3 text-muted small mb-3">
            <span><i class="bi bi-calendar-event me-1"></i> 8 Desember 2025</span>
            <span><i class="bi bi-person me-1"></i>Zakiyah Binti Adlas</span>
            <span><i class="bi bi-eye me-1"></i> 532 pembaca</span>
        </div>

        <p class="mb-0 text-muted">
            Literasi digital menjadi kebutuhan penting bagi pelajar untuk menghadapi
            tantangan era informasi dan teknologi.
        </p>
    </div>

    <div class="publication-action">
        <button class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-pencil"></i>
        </button>
        <button class="btn btn-outline-danger btn-sm">
            <i class="bi bi-trash"></i>
        </button>
    </div>

</div>

<!-- CARD 3 -->
<div class="publication-card d-flex gap-4 mb-3">

    <img src="https://picsum.photos/220/160?4"
         alt="Thumbnail Publikasi"
         class="publication-thumb-lg">

    <div class="flex-grow-1">
        <h5 class="fw-bold mb-2">
            Ekonomi Digital Indonesia Tahun 2024
        </h5>

        <div class="d-flex align-items-center flex-wrap gap-3 text-muted small mb-3">
            <span><i class="bi bi-calendar-event me-1"></i> 3 Desember 2025</span>
            <span><i class="bi bi-person me-1"></i>Sahala Pane</span>
            <span><i class="bi bi-eye me-1"></i> 352 pembaca</span>
        </div>

        <p class="mb-0 text-muted">
            Laporan terbaru menunjukkan bahwa ekonomi digital Indonesia terus mengalami pertumbuhan
            signifikan. E-commerce, fintech, dan layanan digital lainnya menjadi pendorong utama
            pertumbuhan ini. Jumlah pengguna internet yang terus meningkat dan penetrasi smartphone
            yang semakin luas menjadi fakto
        </p>
    </div>

    <div class="publication-action">
        <button class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-pencil"></i>
        </button>
        <button class="btn btn-outline-danger btn-sm">
            <i class="bi bi-trash"></i>
        </button>
    </div>

</div>

@endsection
