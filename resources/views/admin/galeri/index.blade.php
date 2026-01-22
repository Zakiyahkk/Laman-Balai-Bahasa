@extends('admin.layout')

@section('content')

<div class="page-header d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="mb-1 fw-bold" style="color:#ffffff;">Galeri</h3>
        <p class="mb-0" style="color:#ffffff;">
            Halaman ini untuk Pengelolaan media dokumentasi Balai Bahasa Provinsi Riau.
        </p>
    </div>
    <img src="/img/logobbpr4.png" alt="Logo" style="height:55px;">
</div>

<form action="{{ route('admin.galeri.index') }}" method="GET" class="bg-white p-3 rounded shadow-sm mb-4">
    <div class="row g-2">
        <div class="col-md">
            <input type="text" name="search" class="form-control" placeholder="Cari judul..." value="{{ request('search') }}">
        </div>
        <div class="col-md-2">
            <select name="kategori" class="form-select" onchange="this.form.submit()">
                <option value="">Kategori</option>
                <option value="kegiatan" {{ request('kategori')=='kegiatan'?'selected':'' }}>Kegiatan</option>
                <option value="publikasi" {{ request('kategori')=='publikasi'?'selected':'' }}>Publikasi</option>
                <option value="dokumentasi" {{ request('kategori')=='dokumentasi'?'selected':'' }}>Dokumentasi</option>
            </select>
        </div>
        <div class="col-md-2">
            <select name="tipe" class="form-select" onchange="this.form.submit()">
                <option value="">Tipe</option>
                <option value="foto" {{ request('tipe')=='foto'?'selected':'' }}>Foto</option>
                <option value="video" {{ request('tipe')=='video'?'selected':'' }}>Video</option>
            </select>
        </div>
        <div class="col-md-auto">
            <a href="{{ route('admin.galeri.create') }}" class="btn btn-primary">+ Media</a>
        </div>
    </div>
</form>

<div class="row g-4">
@forelse($galeri as $item)
@php
    $files = $item->file_media_all ?? [$item->file_media];
@endphp

<div class="col-md-6 col-lg-4">
    <div class="card h-100 shadow-sm">

        {{-- THUMBNAIL --}}
        <div class="position-relative" style="height:220px; cursor:pointer"
             onclick="viewGallery(
                '{{ addslashes($item->judul) }}',
                {!! json_encode($files) !!},
                '{{ $item->tipe }}'
             )">

            <img src="{{ $item->file_media }}"
                 class="w-100 h-100 object-fit-cover"
                 onerror="this.src='https://placehold.co/600x400?text=No+Image'">

            <span class="badge position-absolute top-0 end-0 m-2
                {{ $item->tipe=='foto'?'bg-warning':'bg-success' }}">
                {{ ucfirst($item->tipe) }}
            </span>

            @if(count($files) > 1)
            <span class="badge bg-dark position-absolute bottom-0 start-0 m-2">
                <i class="bi bi-images"></i> {{ count($files) }}
            </span>
            @endif
        </div>

        {{-- ACTION --}}
        <div class="card-body d-flex gap-2">
            <a href="{{ route('admin.galeri.show',$item->id) }}" class="btn btn-outline-primary w-100">
                <i class="bi bi-pencil"></i> Edit
            </a>
            <button class="btn btn-outline-danger w-100"
                onclick="confirm('Simulasi hapus item {{ $item->id }}')">
                <i class="bi bi-trash"></i> Hapus
            </button>
        </div>
    </div>
</div>

@empty
<div class="col-12 text-center text-muted py-5">
    <i class="bi bi-image fs-1"></i>
    <p>Data galeri tidak ditemukan</p>
</div>
@endforelse
</div>

{{-- MODAL --}}
<div class="modal fade" id="galleryModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content bg-dark">
      <div class="modal-header border-0">
        <h6 class="modal-title text-white" id="modalTitle"></h6>
        <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body p-0" id="modalContent"></div>
    </div>
  </div>
</div>

<script>
function viewGallery(judul, files, tipe) {
    document.getElementById('modalTitle').innerText = judul;

    let html = '';
    if (tipe === 'video') {
        html = `<video controls class="w-100"><source src="${files[0]}"></video>`;
    } else {
        html = `
        <div id="carouselGaleri" class="carousel slide">
            <div class="carousel-inner">
            ${files.map((f,i)=>`
                <div class="carousel-item ${i==0?'active':''}">
                    <img src="${f}" class="d-block w-100">
                </div>`).join('')}
            </div>
            ${files.length>1?`
            <button class="carousel-control-prev" data-bs-slide="prev"
                data-bs-target="#carouselGaleri">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" data-bs-slide="next"
                data-bs-target="#carouselGaleri">
                <span class="carousel-control-next-icon"></span>
            </button>`:''}
        </div>`;
    }

    document.getElementById('modalContent').innerHTML = html;
    new bootstrap.Modal(document.getElementById('galleryModal')).show();
}
</script>

@endsection
