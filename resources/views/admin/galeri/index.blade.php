@extends('admin.layout')

@section('content')

<!-- ================= HEADER ================= -->
<div class="page-header d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="mb-1">Galeri</h3>
        <p class="text-muted mb-0">
            Halaman ini untuk Pengelolaan media dokumentasi Balai Bahasa Provinsi Riau.
        </p>
    </div>

    <div class="header-logo">
        <img src="/img/logobbpr.png" alt="Logo" class="img-fluid header-logo">
    </div>
</div>

<!-- ================= GALERI ================= -->
<div class="galeri-container">

    <!-- FILTER BAR (ATAS) -->
    <div class="container mt-4">
  <div class="row g-1 align-items-center bg-white p-3 rounded shadow-sm mb-3">
    
    <div class="col-12 col-md-7">
      <div class="input-group">
        <span class="input-group-text bg-white border-end-0">
          <i class="bi bi-search text-muted"></i>
        </span>
        <input type="text" class="form-control border-start-0" placeholder="Cari...">
      </div>
    </div>

    <div class="col-6 col-md-1.5" style="flex: 0 0 auto; width: 12.5%;">
      <select class="form-select">
        <option selected>Kategori</option>
        <option value="1">Kegiatan</option>
        <option value="2">Berita</option>
        <option value="publikasi">Publikasi</option>
        <option value="acara">Acara</option>
        <option value="dokumentasi">Dokumentasi</option>
      </select>
    </div>

    <div class="col-6 col-md-1.5" style="flex: 0 0 auto; width: 12.5%;">
      <select class="form-select">
        <option selected>Tipe File</option>
        <option value="1">Foto</option>
        <option value="2">Video</option>
      </select>
    </div>
       <a href="{{ route('admin.galeri.create') }}"
   class="btn btn-add-article d-flex align-items-center ms-2"
   style="font-size: 12px !important;">
    <div class="col-12 col-md-auto ms-auto">
      <button class="btn btn-primary px-4 fw-bold">
        + Media
      </button>
    </div>
</a>

    </div>

    <!-- GRID CARD (DI BAWAH FILTER BAR) -->
    <div class="media-grid">

        <!-- CARD -->
        <div class="media-card">
            <span class="media-type-badge foto">Foto</span>
            <div class="media-preview"></div>
            <div class="media-info">
                <h3>Seminar Bahasa Indonesia 2024</h3>
                <p>Kegiatan</p>
                <p>10 DES 2024</p>
                <p>2.4 MB</p>
            </div>
            <button class="delete-button">Hapus</button>
        </div>

        <!-- CARD -->
        <div class="media-card">
            <span class="media-type-badge video">Video</span>
            <div class="media-preview"></div>
            <div class="media-info">
                <h3>Seminar Bahasa Indonesia 2024</h3>
                <p>Kegiatan</p>
                <p>10 DES 2024</p>
                <p>2.4 MB</p>
            </div>
            <button class="delete-button">Hapus</button>
        </div>

        <!-- CARD -->
        <div class="media-card">
            <span class="media-type-badge video">Video</span>
            <div class="media-preview"></div>
            <div class="media-info">
                <h3>Seminar Bahasa Indonesia 2024</h3>
                <p>Kegiatan</p>
                <p>10 DES 2024</p>
                <p>2.4 MB</p>
            </div>
            <button class="delete-button">Hapus</button>
        </div>


        <!-- CARD -->
        <div class="media-card">
            <span class="media-type-badge foto">Foto</span>
            <div class="media-preview"></div>
            <div class="media-info">
                <h3>Seminar Bahasa Indonesia 2024</h3>
                <p>Kegiatan</p>
                <p>10 DES 2024</p>
                <p>2.4 MB</p>
            </div>
            <button class="delete-button">Hapus</button>
        </div>

        <!-- CARD -->
        <div class="media-card">
            <span class="media-type-badge foto">Foto</span>
            <div class="media-preview"></div>
            <div class="media-info">
                <h3>Seminar Bahasa Indonesia 2024</h3>
                <p>Kegiatan</p>
                <p>10 DES 2024</p>
                <p>2.4 MB</p>
            </div>
            <button class="delete-button">Hapus</button>
        </div>
    </div>

</div>

@endsection
