@extends('admin.layout')

@section('content')
<!-- ================= PAGE HEADER ================= -->
<div class="page-header d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="mb-1">Edit Publikasi</h3>
        <p class="text-muted mb-0">
            Perbarui data publikasi yang akan ditampilkan di website
        </p>
    </div>

    <div class="header-logo">
        <img src="/img/logobbpr.png" class="img-fluid header-logo">
    </div>
</div>

<!-- ================= FORM CARD ================= -->
<div class="card border-0 shadow-sm">
    <div class="card-body p-4">

        <!-- FRONTEND ONLY -->
        <form onsubmit="handleSubmit(event)" enctype="multipart/form-data">

            <!-- TANGGAL | KATEGORI | PENULIS -->
            <div class="row mb-3">

                <!-- TANGGAL -->
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Tanggal Terbit</label>
                    <input type="date"
                        class="form-control"
                        value="{{date('Y-m-d') }}"
                        readonly>
                </div>

                <!-- KATEGORI -->
                <div class="col-md-4">
                    <label class="form-label fw-semibold">
                        Kategori <span class="text-danger">*</span>
                    </label>

                    <select class="form-select" required>
                        <option value="berita">Berita</option>
                        <option value="alinea">Alinea</option>
                        <option value="artikel" selected>Artikel</option>
                    </select>
                </div>

                <!-- PENULIS -->
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Penulis</label>
                    <input type="text"
                        class="form-control"
                        value="Admin Balai Bahasa">
                </div>

            </div>

            <!-- JUDUL -->
            <div class="mb-3">
                <label class="form-label fw-semibold">
                    Judul <span class="text-danger">*</span>
                </label>
                <input type="text"
                       class="form-control"
                       placeholder="Judul artikel"
                       value="Literasi Digital di Kalangan Pelajar"
                       required>
            </div>

            <!-- GAMBAR + PREVIEW -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Gambar Publikasi</label>
                <input type="file"
                       class="form-control"
                       accept="image/*"
                       onchange="previewImage(event)">

                <!-- preview lama -->
                <img id="preview"
                     src="https://picsum.photos/900/400"
                     class="img-fluid rounded mt-3"
                     style="max-height:220px;">
            </div>

            <!-- ISI ARTIKEL -->
            <div class="mb-4">
                <label class="form-label fw-semibold">
                    Isi Artikel <span class="text-danger">*</span>
                </label>
                <textarea class="form-control"
                          rows="12"
                          placeholder="Isi artikel"
                          required>Literasi digital menjadi kompetensi penting bagi pelajar di era teknologi informasi. Kemampuan memahami dan menggunakan informasi secara bijak sangat diperlukan.</textarea>
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

        </form>
    </div>
</div>

<!-- ================= SCRIPT ================= -->
<script>
function previewImage(event) {
    const img = document.getElementById('preview');
    img.src = URL.createObjectURL(event.target.files[0]);
    img.classList.remove('d-none');
}

function handleSubmit(event) {
    event.preventDefault();
    // frontend only (tidak dipakai karena tombol pakai <a>)
}
</script>
@endsection
