@extends('admin.layout')

@section('content')

<div class="page-header d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="mb-1 font-bold" style="font-weight: 700;">Galeri</h3>
        <p class="text-muted mb-0">
            Halaman ini untuk Pengelolaan media dokumentasi Balai Bahasa Provinsi Riau.
        </p>
    </div>

    <div class="header-logo">
        <img src="/img/logobbpr.png" alt="Logo" class="img-fluid" style="height: 55px;">
    </div>
</div>

<form action="{{ route('admin.galeri.index') }}" method="GET" class="bg-white p-3 rounded-xl shadow-sm border border-gray-100 mb-4">
    <div class="row g-2 align-items-center">
        <div class="col-12 col-md">
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0 text-muted">
                    <i class="bi bi-search"></i>
                </span>
                <input type="text" name="search" class="form-control border-start-0 ps-0" placeholder="Cari judul..." value="{{ request('search') }}">
            </div>
        </div>

        <div class="col-6 col-md-2">
            <select name="kategori" class="form-select text-muted" onchange="this.form.submit()">
                <option value="">Kategori</option>
                <option value="kegiatan" {{ request('kategori') == 'kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                <option value="publikasi" {{ request('kategori') == 'publikasi' ? 'selected' : '' }}>Publikasi</option>
                <option value="dokumentasi" {{ request('kategori') == 'dokumentasi' ? 'selected' : '' }}>Dokumentasi</option>
            </select>
        </div>

        <div class="col-6 col-md-2">
            <select name="tipe" class="form-select text-muted" onchange="this.form.submit()">
                <option value="">Tipe File</option>
                <option value="foto" {{ request('tipe') == 'foto' ? 'selected' : '' }}>Foto</option>
                <option value="video" {{ request('tipe') == 'video' ? 'selected' : '' }}>Video</option>
            </select>
        </div>

        <div class="col-12 col-md-auto">
            <a href="{{ route('admin.galeri.create') }}" class="btn-add-article text-decoration-none">
                <span class="icon-plus">+</span>
                <span>Media</span>
            </a>
        </div>
    </div>
</form>
<div class="row g-4">
        @forelse($galeri as $item)
        @php
            // Logic ambil media & thumbnail
            $rawMedia = data_get($item, 'file_media');
            $files = is_array($rawMedia) ? $rawMedia : [$rawMedia];
            
            // Ambil gambar cover
            $firstFile = $files[0] ?? 'https://placehold.co/600x400?text=No+Image';
            $urlThumbnail = data_get($item, 'thumbnail') ?? $firstFile;
        @endphp

        <div class="col-12 col-md-6 col-lg-4">
            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden position-relative">
                
                {{-- Badge Tipe --}}
                <div class="position-absolute top-0 end-0 m-3" style="z-index: 5;">
                    <span class="badge {{ $item->tipe == 'foto' ? 'bg-warning' : 'bg-success' }} text-uppercase px-3 py-2 shadow-sm">
                        {{ $item->tipe }}
                    </span>
                </div>

                {{-- Area Klik Gambar --}}
                <div class="position-relative" style="height: 220px; cursor: pointer; background: #f8f9fa;" 
                     onclick="viewGallery('{{ addslashes($item->judul) }}', {{ json_encode($files) }}, '{{ $item->tipe }}')">
                    
                    <img src="{{ is_array($urlThumbnail) ? $urlThumbnail[0] : $urlThumbnail }}" 
                         class="w-100 h-100 object-fit-cover" 
                         onerror="this.src='https://placehold.co/600x400?text=Format+Link+Salah'">
                    
                    {{-- Overlay saat hover --}}
                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center opacity-0 hover-overlay transition-all">
                        <i class="bi bi-zoom-in text-white fs-1"></i>
                    </div>

                    @if(count($files) > 1)
                    <div class="position-absolute bottom-0 start-0 m-2">
                        <span class="badge bg-dark bg-opacity-75"><i class="bi bi-images me-1"></i> {{ count($files) }} Foto</span>
                    </div>
                    @endif
                </div>

                {{-- Detail Card --}}
                <div class="card-body p-4">
                    <h5 class="fw-bold text-dark mb-1">{{ $item->judul }}</h5>
                    <div class="d-flex align-items-center text-muted small mb-3">
                        <span class="me-3"><i class="bi bi-tag me-1"></i> {{ ucfirst($item->kategori) }}</span>
                        <span><i class="bi bi-calendar3 me-1"></i> {{ $item->created_at }}</span>
                    </div>
                    
                    <div class="d-flex gap-2 mt-auto">
                        <a href="{{ route('admin.galeri.edit', $item->id) }}" class="btn btn-light border flex-grow-1 rounded-3 fw-medium">
                            <i class="bi bi-pencil-square me-1"></i> Edit
                        </a>
                        <form action="{{ route('admin.galeri.destroy', $item->id) }}" method="POST" class="flex-grow-1">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger w-100 rounded-3" onclick="return confirm('Hapus media ini?')">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <i class="bi bi-image text-muted" style="font-size: 4rem;"></i>
            <p class="mt-3 text-muted">Data galeri tidak ditemukan.</p>
        </div>
        @endforelse
    </div>
</div>

{{-- MODAL PREVIEW (SLIDER) --}}
<div class="modal fade" id="galleryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-dark border-0">
            <div class="modal-header border-0 pb-0">
                <h6 class="modal-title text-white fw-bold" id="modalTitle">Preview</h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-0" id="modalContent"></div>
        </div>
    </div>
</div>

<style>
    .hover-overlay:hover { opacity: 1; background: rgba(0,0,0,0.3); }
    .transition-all { transition: all 0.3s ease; }
    .object-fit-cover { object-fit: cover; }
    .carousel-item img { max-height: 80vh; object-fit: contain; background: #000; }
</style>

<script>
function viewGallery(judul, files, tipe) {
    const content = document.getElementById('modalContent');
    document.getElementById('modalTitle').innerText = judul;
    
    let html = '';
    if (tipe === 'video') {
        let videoSrc = (files[0] === '#' || !files[0]) ? 'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/BigBuckBunny.mp4' : files[0];
        html = `<div class="ratio ratio-16x9"><video controls autoplay><source src="${videoSrc}" type="video/mp4"></video></div>`;
    } else {
        html = `
        <div id="carouselGaleri" class="carousel slide" data-bs-ride="false">
            <div class="carousel-inner">
                ${files.map((file, i) => `
                    <div class="carousel-item ${i === 0 ? 'active' : ''}">
                        <img src="${file}" class="d-block w-100">
                        <div class="carousel-caption d-none d-md-block">
                            <span class="badge bg-dark opacity-50">Gambar ${i+1} dari ${files.length}</span>
                        </div>
                    </div>`).join('')}
            </div>
            ${files.length > 1 ? `
                <button class="carousel-control-prev" data-bs-target="#carouselGaleri" data-bs-slide="prev"><span class="carousel-control-prev-icon"></span></button>
                <button class="carousel-control-next" data-bs-target="#carouselGaleri" data-bs-slide="next"><span class="carousel-control-next-icon"></span></button>
            ` : ''}
        </div>`;
    }
    content.innerHTML = html;
    new bootstrap.Modal(document.getElementById('galleryModal')).show();
}

// Stop video saat modal ditutup
document.getElementById('galleryModal').addEventListener('hidden.bs.modal', () => {
    document.getElementById('modalContent').innerHTML = '';
});
</script>
@endsection