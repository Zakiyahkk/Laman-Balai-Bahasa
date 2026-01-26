@extends('admin.layout')
@section('content')

@if(session('success') || session('error'))
<div id="notif-top" class="notif-top">
    {{ session('success') ?? session('error') }}
</div>
@endif

<style>
.notif-top {
    position: fixed;
    top: 20px;
    left: 50%;
    transform: translateX(-50%);
    background: #067ac1;
    color: white;
    padding: 14px 28px;
    border-radius: 10px;
    font-weight: 400;
    font-size: 16px;
    min-width: 300px;
    text-align: center;
    z-index: 9999;
    animation: slideDown 0.5s ease-out forwards;
    opacity: 0;
}
@keyframes slideDown {
    0% { transform: translate(-50%, -30px); opacity: 0; }
    100% { transform: translate(-50%, 0); opacity: 1; }
}
</style>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const notif = document.getElementById("notif-top");
    if (notif) {
        setTimeout(() => {
            notif.style.opacity = "0";
            notif.style.transition = "0.5s ease";
        }, 2500);
        setTimeout(() => {
            notif.remove();
        }, 3000);
    }
});
</script>

<div class="page-header d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="mb-1" style="color:#ffffff;">Tambah Publikasi Baru</h3>
        <p class="mb-0" style="color:#ffffff;">
            Silakan lengkapi data publikasi yang akan ditampilkan di laman
        </p>
    </div>

    <div class="header-logo">
        <img src="/img/logobbpr4.png" class="img-fluid header-logo">
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <form action="{{ route('admin.publikasi.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- TANGGAL | KATEGORI | PENULIS -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Tanggal Terbit</label>
                    <input type="date" class="form-control" name="tanggal" value="{{ date('Y-m-d') }}">
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold">
                        Kategori <span class="text-danger">*</span>
                    </label>
                    <select class="form-select" name="kategori" required>
                        <option value="" selected disabled>-- Pilih Kategori --</option>
                        <option value="alinea">Alinea</option>
                        <option value="berita">Berita</option>
                        <option value="lensa">Lensa</option>
                        <option value="pengumuman">Pengumuman</option>
                        <option value="ragam">Ragam</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold">Penulis</label>
                    <input type="text" class="form-control" name="penulis" placeholder="Nama penulis">
                </div>
            </div>

            <!-- JUDUL -->
            <div class="mb-3">
                <label class="form-label fw-semibold">
                    Judul <span class="text-danger">*</span>
                </label>
                <input type="text" class="form-control" name="judul" placeholder="Judul tulisan" required>
            </div>

            <!-- GAMBAR + PREVIEW (DIUBAH) -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Gambar Publikasi</label>
                <input type="file" class="form-control" name="gambar" id="gambarInput"
                       accept="image/*" onchange="previewImage(event)">

                <div class="position-relative d-inline-block mt-3">
                    <img id="preview" src="{{ asset('img/logobbpr.png') }}"
                         class="img-fluid rounded"
                         style="max-height:220px;">

                    <button type="button"
                            id="removeImageBtn"
                            onclick="removeImage()"
                            class="btn btn-sm btn-danger position-absolute top-0 end-0"
                            style="display:none;border-radius:50%;">
                        ✕
                    </button>
                </div>
            </div>

            <!-- UPLOAD FILE + PREVIEW (DIUBAH) -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Lampiran File (PDF / Excel / Doc)</label>
                <input type="file" class="form-control" name="file" id="fileInput"
                       accept=".pdf,.xls,.xlsx,.doc,.docx"
                       onchange="previewFile(event)">
                <div id="filePreview" class="mt-3"></div>
            </div>

            <!-- CEKLIS IZIN UNDUH -->
            <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" name="allow_download" id="allowDownloadCheck" value="1">
                <label class="form-check-label fw-semibold" for="allowDownloadCheck">
                    Izinkan unduh lampiran
                </label>
            </div>

            <!-- ISI -->
            <div class="mb-4">
                <label class="form-label fw-semibold">
                    Isi Artikel
                </label>
                <textarea class="form-control" name="isi" rows="12" placeholder="Isi artikel"></textarea>
            </div>

            <!-- ACTION -->
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.publikasi') }}" class="btn btn-action btn-cancel">Batal</a>
                <button type="submit" class="btn btn-action btn-save">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
/* ===== PREVIEW GAMBAR ===== */
function previewImage(event) {
    const img = document.getElementById('preview');
    const btn = document.getElementById('removeImageBtn');

    if (event.target.files.length > 0) {
        img.src = URL.createObjectURL(event.target.files[0]);
        btn.style.display = 'block';
    }
}

function removeImage() {
    document.getElementById('gambarInput').value = "";
    document.getElementById('preview').src = "{{ asset('img/logobbpr.png') }}";
    document.getElementById('removeImageBtn').style.display = 'none';
}

/* ===== PREVIEW FILE ===== */
function previewFile(event) {
    const file = event.target.files[0];
    const previewArea = document.getElementById('filePreview');

    if (!file) {
        previewArea.innerHTML = "";
        return;
    }

    const url = URL.createObjectURL(file);

    previewArea.innerHTML = `
        <div class="alert d-flex justify-content-between align-items-center rounded"
             style="background:#fff3cd; border:1px solid #ffeeba;">
            <div>
                <strong>${file.name}</strong><br>
            </div>
            <div class="d-flex gap-2">
                <button type="button"
                        class="btn btn-sm text-white"
                        style="background:#067ac1"
                        onclick="window.open('${url}','_blank')">
                    Buka
                </button>
                <button type="button"
                        class="btn btn-sm btn-outline-danger"
                        onclick="removeFile()">✕</button>
            </div>
        </div>
    `;
}

function removeFile() {
    document.getElementById('fileInput').value = "";
    document.getElementById('filePreview').innerHTML = "";
}

</script>

@endsection
