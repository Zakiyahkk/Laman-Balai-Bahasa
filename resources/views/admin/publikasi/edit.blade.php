@extends('admin.layout')
@php use Carbon\Carbon; @endphp

@section('content')
@if(session('success'))
<div id="notif-top" class="notif-top show">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div id="notif-top" class="notif-top notif-error show">
    {{ session('error') }}
</div>
@endif

<style>
.notif-top {
    position: fixed;
    top: 20px;
    left: 50%;
    transform: translate(-50%, 0);
    background: #067ac1;
    color: white;
    padding: 14px 28px;
    border-radius: 10px;
    font-weight: 700;
    font-size: 16px;
    min-width: 300px;
    text-align: center;
    z-index: 9999;
    animation: slideDown 0.5s ease-out forwards;
    opacity: 0;
}

.notif-error {
    background: #d9534f;
    color: white;
    font-weight: 700;
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
        <h3 class="mb-1">Ubah Data Publikasi</h3>
        <p class="text-muted mb-0">
            Perbarui data publikasi yang akan ditampilkan di laman
        </p>
    </div>

    <div class="header-logo">
        <img src="/img/logobbpr.png" class="img-fluid header-logo">
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">

        <form action="{{ route('admin.publikasi.update', $data->publikasi_id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Tanggal Terbit <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" name="tanggal"
                        value="{{ $data->tanggal ? Carbon::parse($data->tanggal)->format('Y-m-d') : '' }}"
                        required>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold">Kategori <span class="text-danger">*</span></label>
                    <select class="form-select" name="kategori" required>
                        <option value="berita" {{ $data->kategori == 'berita' ? 'selected' : '' }}>Berita</option>
                        <option value="alinea" {{ $data->kategori == 'alinea' ? 'selected' : '' }}>Alinea</option>
                        <option value="artikel" {{ $data->kategori == 'artikel' ? 'selected' : '' }}>Artikel</option>
                        <option value="draf" {{ $data->kategori == 'draf' ? 'selected' : '' }}>Draf</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold">Penulis</label>
                    <input type="text" class="form-control" name="penulis" value="{{ $data->penulis }}">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Judul <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="judul" value="{{ $data->judul }}" required>
            </div>

            <!-- Upload Gambar -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Gambar Publikasi</label>
                <input type="file" class="form-control" name="gambar" accept="image/*" onchange="previewImage(event)">

                @php $extFile = $data->file ? strtolower(pathinfo($data->file, PATHINFO_EXTENSION)) : null; @endphp

                @if($data->gambar)
                    <img id="preview" src="{{ $data->gambar }}" class="img-fluid rounded mt-3" style="max-height:220px;">
                @elseif($extFile !== 'pdf')
                    <img id="preview" src="{{ asset('img/logobbpr.png') }}" class="img-fluid rounded mt-3" style="max-height:220px;">
                @else
                    <img id="preview" src="{{ asset('img/logobbpr.png') }}" class="img-fluid rounded mt-3" style="max-height:220px; display:none;">
                @endif
            </div>

            <!-- Upload File -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Lampiran File (PDF / Excel / Doc)</label>
                <input type="file" class="form-control" name="file" accept=".pdf,.xls,.xlsx,.doc,.docx,.zip,.rar" onchange="previewFile(event)">

                <!-- Preview File -->
                <div id="filePreview" class="mt-3">
                    @if($data->file)
                        @if($extFile === 'pdf')
                            <iframe src="{{ $data->file }}" class="w-100 rounded border mb-3" style="height:450px;"></iframe>
                        @endif
                    @endif
                </div>

                <!-- Jika file bukan PDF → tampil alert kuning klik buka file -->
                @if($data->file && $extFile !== 'pdf')
                    <a href="{{ $data->file }}" target="_blank"
                       class="alert alert-warning small rounded border d-block text-decoration-none text-dark mt-3">
                        <strong>File terlampir:</strong> {{ basename($data->file) }}
                        <br><small>(Klik untuk membuka file)</small>
                    </a>
                @endif
            </div>

            <!-- CEKLIS IZIN UNDUH -->
            <div class="form-check mb-4 mt-3">
                <input class="form-check-input" type="checkbox" name="allow_download" id="allowDownloadCheck" value="1"
                    {{ $data->allow_download == 1 ? 'checked' : '' }}>
                <label class="form-check-label fw-semibold" for="allowDownloadCheck">
                    Izinkan unduh lampiran
                </label>
            </div>

            <!-- ISI ARTIKEL -->
            <div class="mb-4">
                <label class="form-label fw-semibold">Isi Artikel</label>
                <textarea class="form-control" name="isi" rows="12">{{ $data->isi }}</textarea>
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.publikasi') }}" class="btn btn-action btn-cancel">Batal</a>
                <button type="submit" class="btn btn-action btn-save">Perbarui</button>
            </div>

        </form>
    </div>
</div>

<script>
function previewImage(event) {
    const img = document.getElementById('preview');
    if (event.target.files.length > 0) {
        img.style.display = "block";
        img.src = URL.createObjectURL(event.target.files[0]);
    } else {
        img.style.display = "block";
        img.src = "{{ asset('img/logobbpr.png') }}";
    }
}

function previewFile(event) {
    const file = event.target.files[0];
    const previewArea = document.getElementById('filePreview');
    if (!file) {
        previewArea.innerHTML = "";
        return;
    }

    const fileURL = URL.createObjectURL(file);
    const ext = file.name.split('.').pop().toLowerCase();

    if (ext === 'pdf') {
        previewArea.innerHTML = `<iframe src="${fileURL}" class="w-100 rounded border mb-3" style="height:450px;"></iframe>`;
    } else {
        previewArea.innerHTML = "";
    }
}
</script>
@endsection
