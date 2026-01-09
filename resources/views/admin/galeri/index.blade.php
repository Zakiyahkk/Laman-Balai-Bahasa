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
    @foreach($galeri as $item)
    <div class="col-12 col-md-6 col-lg-4">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden h-100 d-flex flex-column transition-all hover:shadow-md">
            
            <div class="position-relative w-full" 
                 style="height: 200px; background-color: #f8f9fa; cursor: pointer;"
                 data-bs-toggle="modal" 
                 data-bs-target="#galleryModal"
                 data-type="{{ $item->tipe }}"
                 data-src="{{ $item->file_media }}"
                 data-judul="{{ $item->judul }}">
                
                @if($item->tipe == 'foto')
                    <img src="{{ $item->file_media }}" class="w-100 h-100 object-fit-cover">
                @else
                    <div class="w-100 h-100 position-relative">
                        <img src="{{ $item->thumbnail ?? 'https://placehold.co/600x400/C7F9EE/00A884?text=Video' }}" class="w-100 h-100 object-fit-cover" style="filter: brightness(0.8);">
                        <div class="position-absolute top-50 start-50 translate-middle">
                            <i class="bi bi-play-circle-fill text-white" style="font-size: 3.5rem;"></i>
                        </div>
                    </div>
                @endif

                <div class="position-absolute top-0 end-0 m-3" style="z-index: 20;">
                    <span class="px-3 py-1 text-xs font-bold text-white rounded-pill shadow-sm" 
                          style="background-color: {{ $item->tipe == 'foto' ? '#FFB800' : '#00D26A' }};">
                        {{ ucfirst($item->tipe) }}
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
            </div>

            <div class="p-4 pt-0">
        
                <div class="p-4 pt-0">
    <div class="d-flex gap-2">
        <a href="{{ route('admin.galeri.show', $item->id) }}" 
        class="btn btn-outline-primary flex-grow-1 d-flex align-items-center 
        justify-content-center gap-2" style="border-radius: 8px; font-weight: 500;">
            <i class="bi bi-pencil-square"></i> Edit
        </a>
        <button class="btn btn-outline-danger flex-grow-1 d-flex align-items-center 
        justify-content-center gap-2" 
        style="border-radius: 8px; font-weight: 500;"
        onclick="confirm('Simulasi: Item {{ $item->id }} akan dihapus?')">
            <i class="bi bi-trash3"></i> Hapus
        </button>
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
            <div class="modal-body p-0 d-flex justify-content-center align-items-center" style="min-height: 300px; background: #000;">
                <img id="modalImage" src="" class="img-fluid d-none" style="max-height: 80vh;">
                
                <div id="modalVideoContainer" class="w-100 d-none">
                    <div class="ratio ratio-16x9">
                        <video id="modalVideo" controls>
                            <source src="" type="video/mp4">
                            Browser anda tidak mendukung video.
                        </video>
                    </div>
                </div>
            </div>
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
