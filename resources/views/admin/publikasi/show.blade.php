@extends('admin.layout')

@section('content')

<!-- =================  ISI MAIN CONTENT ================= -->
<div class="card border-0 shadow-sm position-relative">
    <div class="card-body p-4">

        <!-- CLOSE (X) BUTTON -->
        <a href="{{ route('admin.publikasi') }}"
           class="position-absolute top-0 end-0 m-3 text-muted text-decoration-none"
           title="Tutup">
            <i class="bi bi-x-lg fs-5"></i>
        </a>

        <!-- HEADER JUDUL + STATUS -->
        <div class="d-flex align-items-center gap-3 mb-2">
            <h4 class="fw-bold mb-0">
                Literasi Digital di Kalangan Pelajar
            </h4>

            <!-- STATUS (GANTI SESUAI KONDISI) -->
            <!-- DRAF -->
            <span class="badge badge-draft">
                Draf
            </span>

            <!-- TERBIT (contoh jika sudah publish)
            <span class="badge badge-published">
                Terbit
            </span>
            -->
        </div>

        <!-- META INFO -->
        <div class="text-muted small mb-3 d-flex flex-wrap gap-3">
            <span class="publication-category category-berita">
                Berita
            </span>
            <span>
                <i class="bi bi-calendar-event me-1"></i>
                12 Januari 2025
            </span>

            <span>
                <i class="bi bi-person me-1"></i>
                Admin Balai Bahasa
            </span>

            <span>
                <i class="bi bi-eye me-1"></i>
                0 Pembaca
            </span>
        </div>

        <!-- GAMBAR PUBLIKASI -->
        <div class="mb-4">
            <img src="https://picsum.photos/900/400"
                 alt="Gambar Publikasi"
                 class="img-fluid rounded w-100">
        </div>

        <!-- ISI PUBLIKASI -->
        <div class="content-publication">
            <p>
                Literasi digital menjadi kompetensi penting bagi pelajar di era teknologi
                informasi. Kemampuan untuk memahami, mengevaluasi, dan menggunakan informasi
                secara bijak sangat dibutuhkan dalam menghadapi arus digital yang semakin
                masif.
            </p>

            <p>
                Melalui berbagai program edukasi dan publikasi, Balai Bahasa Provinsi Riau
                berupaya meningkatkan kesadaran serta keterampilan literasi digital di
                kalangan pelajar. Kegiatan ini diharapkan mampu membentuk generasi yang
                cakap digital, kritis, dan bertanggung jawab.
            </p>

            <p>
                Publikasi ini merupakan bagian dari komitmen Balai Bahasa Provinsi Riau
                dalam mendukung pengembangan bahasa dan sastra Indonesia di tengah
                perkembangan teknologi informasi.
            </p>
        </div>

        <!-- ACTION BUTTON -->
       <div class="d-flex justify-content-end gap-2 mt-4">
            <a href="{{ route('admin.publikasi') }}"
            class="btn btn-action btn-draft">
                Draf
            </a>

            <a href="{{ route('admin.publikasi') }}"
            class="btn btn-action btn-save">
                Terbit
            </a>
        </div>
    </div>
</div>

@endsection
