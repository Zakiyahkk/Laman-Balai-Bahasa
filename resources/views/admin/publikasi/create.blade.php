@extends('admin.layout')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="mb-1">Tambah Publikasi Baru</h3>
        <p class="text-muted mb-0">
            Silakan lengkapi data publikasi yang akan ditampilkan di website
        </p>
    </div>

    <div class="header-logo">
        <img src="/img/logo.png" class="img-fluid header-logo">
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">

        <!-- FRONTEND ONLY -->
        <form onsubmit="handleSubmit(event)" enctype="multipart/form-data">

            <!-- TANGGAL & PENULIS -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Tanggal Terbit</label>
                    <input type="date"
                           class="form-control"
                           value="{{ date('Y-m-d') }}"
                           readonly>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Penulis</label>
                    <input type="text"
                           class="form-control"
                           placeholder="Nama penulis">
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
                       required>
            </div>

            <!-- GAMBAR + PREVIEW -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Gambar Publikasi</label>
                <input type="file"
                       class="form-control"
                       accept="image/*"
                       onchange="previewImage(event)">

                <img id="preview"
                     class="img-fluid rounded mt-3 d-none"
                     style="max-height:220px;">
            </div>

            <!-- ISI -->
            <div class="mb-4">
                <label class="form-label fw-semibold">
                    Isi Artikel <span class="text-danger">*</span>
                </label>
                <textarea class="form-control"
                          rows="12"
                          placeholder="Isi artikel"
                          required></textarea>
            </div>

            <!-- ACTION -->
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.publikasi') }}"
                class="btn btn-action btn-cancel">
                    Batal
                </a>

                <button type="submit"
                        class="btn btn-action btn-save">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function previewImage(event) {
    const img = document.getElementById('preview');
    img.src = URL.createObjectURL(event.target.files[0]);
    img.classList.remove('d-none');
}

function handleSubmit(event) {
    event.preventDefault();

    // simulasi simpan (frontend only)
    setTimeout(() => {
        window.location.href = "{{ route('admin.publikasi.show', 1) }}";
    }, 300);
}
</script>
@endsection
