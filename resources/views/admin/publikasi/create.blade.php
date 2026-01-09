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
        }, 2500); // mulai fade out di 2,5 detik

        setTimeout(() => {
            notif.remove();
        }, 3000); // hilang total di 3 detik
    }
});
</script>


<div class="page-header d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="mb-1">Tambah Publikasi Baru</h3>
        <p class="text-muted mb-0">
            Silakan lengkapi data publikasi yang akan ditampilkan di laman
        </p>
    </div>

    <div class="header-logo">
        <img src="/img/logobbpr.png" class="img-fluid header-logo">
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <form action="{{ route('admin.publikasi.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- TANGGAL | KATEGORI | PENULIS -->
            <div class="row mb-3">
                <!-- TANGGAL -->
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Tanggal Terbit</label>
                    <input type="date" class="form-control" name="tanggal" value="{{ date('Y-m-d') }}">
                </div>

                <!-- KATEGORI -->
                <div class="col-md-4">
                    <label class="form-label fw-semibold">
                        Kategori <span class="text-danger">*</span>
                    </label>
                    <select class="form-select" name="kategori" required>
                        <option value="" selected disabled>-- Pilih Kategori --</option>
                        <option value="berita">Berita</option>
                        <option value="alinea">Alinea</option>
                        <option value="artikel">Artikel</option>
                    </select>
                </div>

                <!-- PENULIS -->
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

            <!-- GAMBAR + PREVIEW -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Gambar Publikasi</label>
                <input type="file" class="form-control" name="gambar" accept="image/*" onchange="previewImage(event)">
                <img id="preview" src="{{ asset('img/logobbpr.png') }}" class="img-fluid rounded mt-3" style="max-height:220px;">
            </div>

            <!-- UPLOAD FILE + PREVIEW -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Lampiran File (PDF / Excel / Doc)</label>
                <input type="file" class="form-control" name="file" accept=".pdf,.xls,.xlsx,.doc,.docx" onchange="previewFile(event)">

                <!-- Preview Area -->
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
function previewImage(event) {
    const img = document.getElementById('preview');

    if (event.target.files.length > 0) {
        img.src = URL.createObjectURL(event.target.files[0]);
    } else {
        img.src = "{{ asset('img/logobbpr.png') }}"; // reset ke default jika batal pilih file
    }

    img.classList.add('d-block');
}

function previewFile(event) {
    const file = event.target.files[0];
    const previewArea = document.getElementById('filePreview');

    if (!file) {
        previewArea.innerHTML = "";
        return;
    }

    const fileURL = URL.createObjectURL(file);
    const fileType = file.type;

    // Jika PDF → tampilkan di iframe
    if (fileType === "application/pdf") {
        previewArea.innerHTML = `<iframe src="${fileURL}" class="w-100 rounded border" style="height:400px;"></iframe>`;
    }

    // Jika selain PDF → tampil alert kuning yang bisa diklik untuk buka file
    else {
    const url = URL.createObjectURL(file);

    previewArea.innerHTML = `
    <div class="mt-3">
        <a href="#" onclick="return false" id="previewLink"
           class="alert alert-warning small rounded border d-block text-decoration-none text-dark"
           style="font-weight:400; background:#fff3cd; border-color:#ffeeba; cursor:pointer;">
            <strong>File terlampir:</strong> ${file.name}
            <br><small>(Klik untuk membuka file)</small>
        </a>
    </div>`;

    // Tambahkan event listener biar alert bisa diklik dan buka file tanpa download
    document.getElementById("previewLink").addEventListener("click", function (e) {
        e.preventDefault();
        window.open(url, '_blank');
    });
}



}

</script>
@endsection
