@extends('admin.layout')
@php use Carbon\Carbon; @endphp
@section('content')

@if(session('success'))
<div id="notif-top" class="notif-top">
    {{ session('success') }}
</div>
@endif
<style>
.notif-top {
    position: fixed;
    top: 20px;
    left: 50%;
    transform: translateX(-50%);
    background: #0485c7;;
    color: white;
    padding: 14px 28px;
    border-radius: 10px;
    font-weight: 600;
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
            <h4 class="fw-bold mb-0">{{ $data->judul }}</h4>

            @if($data->status === 'draf')
                <span class="badge badge-draft">Draf</span>
            @else
                <span class="badge badge-published">Terbit</span>
            @endif
        </div>

        <!-- META INFO -->
        <div class="text-muted small mb-3 d-flex flex-wrap gap-3">
            <span class="publication-category category-{{ $data->kategori }}">
                {{ ucfirst($data->kategori) }}
            </span>
            <span><i class="bi bi-calendar-event me-1"></i> {{ $data->tanggal ? \Carbon\Carbon::parse($data->tanggal)->translatedFormat('d F Y') : '-' }}</span>
            <span><i class="bi bi-person me-1"></i> {{ $data->penulis ?? $data->email }}</span>
            <span><i class="bi bi-eye me-1"></i> 0 Pembaca</span>
        </div>

        <!-- PREVIEW AREA -->
<div class="mb-4">
    @if($data->file)
        @php $ext = strtolower(pathinfo($data->file, PATHINFO_EXTENSION)); @endphp

        @if($ext === 'pdf')
            <!-- Jika PDF → preview PDF -->
            <iframe src="{{ $data->file }}" class="w-100 rounded border mb-3" style="height:450px;"></iframe>
        @else
            @if($data->gambar)
                <!-- Jika bukan PDF dan ada gambar → preview gambar -->
                <img src="{{ $data->gambar }}" class="img-fluid rounded mb-3"
                     style="max-width: 100%; height: auto;">
            @else
                <!-- Jika bukan PDF dan tidak ada gambar → tampil file langsung -->
                <div class="border rounded p-3 text-center text-muted">
                    Lampiran tidak dapat ditampilkan sebagai gambar, silakan buka file.
                </div>
            @endif
        @endif

        <!-- ALERT KUNING (link klik buka file) hanya jika file bukan PDF -->
        @if($ext !== 'pdf')
        <div class="mt-3">
            <a href="{{ $data->file }}" target="_blank"
               class="alert alert-warning small rounded border d-block text-decoration-none text-dark">
                <strong>File terlampir:</strong> {{ basename($data->file) }}
                <br><small>(Klik untuk membuka file)</small>
            </a>
        </div>
        @endif

        <!-- Tombol Download jika diizinkan -->
        @if($data->allow_download == 1)
        <div class="mt-2">
            <a href="{{ route('admin.publikasi.download', $data->publikasi_id) }}"
               class="btn btn-sm fw-semibold"
               style="color:#067ac1;">
               <i class="bi bi-download me-1"></i> Unduh Lampiran
            </a>
        </div>
        @endif

    @elseif($data->gambar && !$data->file)
        <!-- Jika hanya ada gambar → preview gambar -->
        <img src="{{ $data->gambar }}" class="img-fluid rounded mb-3"
             style="max-width: 100%; height: auto;">

    @else
        <!-- Jika tidak ada file & tidak ada gambar → gambar default -->
        <img src="{{ asset('img/logobbpr.png') }}" class="img-fluid rounded mb-3"
             style="max-width: 100%; height: auto;">
    @endif
</div>

        <!-- ISI PUBLIKASI -->
        <div class="content-publication">
            {!! nl2br(e($data->isi)) !!}
        </div>

        <!-- ACTION BUTTON -->
        <div class="d-flex justify-content-end gap-2 mt-4">
            <form action="{{ route('admin.publikasi.status', $data->publikasi_id) }}" method="POST" class="d-inline">
                @csrf
                @method('PUT')
                <input type="hidden" name="status" value="draf">
                <button type="submit" class="btn btn-action btn-draft">Draf</button>
            </form>

            <form action="{{ route('admin.publikasi.status', $data->publikasi_id) }}" method="POST" class="d-inline">
                @csrf
                @method('PUT')
                <input type="hidden" name="status" value="terbit">
                <button type="submit" class="btn btn-action btn-save">Terbit</button>
            </form>
        </div>

    </div>
</div>

@endsection



