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
        <div class="col-12 col-md-5">
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-search"></i></span>
                <input type="text" name="search" class="form-control border-start-0 ps-0" placeholder="Cari judul..." value="{{ request('search') }}">
            </div>
        </div>

        <div class="col-6 col-md-2">
            <select name="kategori" class="form-select text-muted" onchange="this.form.submit()">
                <option>Tipe Kategori</option>
                <option value="kegiatan" {{ request('kategori') == 'kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                <option value="publikasi" {{ request('kategori') == 'publikasi' ? 'selected' : '' }}>Publikasi</option>
            </select>
        </div>

        <div class="col-6 col-md-2">
            <select name="tipe" class="form-select text-muted" onchange="this.form.submit()">
                <option>Tipe File</option>
                <option value="foto" {{ request('tipe') == 'foto' ? 'selected' : '' }}>Foto</option>
                <option value="video" {{ request('tipe') == 'video' ? 'selected' : '' }}>Video</option>
            </select>
        </div>

        <div class="col-12 col-md-3">
            <a href="{{ route('admin.galeri.create') }}" class="btn btn-primary w-100 fw-bold shadow-sm">Upload Media</a>
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
            </div>

            <div class="p-4 flex-grow-1">
                <h5 class="font-bold text-gray-800 mb-3" style="font-size: 1.1rem;">{{ $item->judul }}</h5>
                <div class="text-gray-500" style="font-size: 0.9rem;">
                    <div class="d-flex align-items-center mb-2">
                        <i class="bi bi-folder2-open me-2"></i>
                        <span class="text-capitalize">{{ $item->kategori }}</span>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <i class="bi bi-calendar-event me-2"></i>
                        <span>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</span>
                    </div>
                    <div class="ps-4 mt-1">
                        <span class="text-muted small">{{ $item->ukuran }}</span>
                    </div>
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
    </div>
    @endforeach
</div>

{{-- --- MODAL POPUP AREA --- --}}
<div class="modal fade" id="galleryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-dark border-0 overflow-hidden">
            <div class="modal-header border-0 pb-0">
                <h6 class="modal-title text-white fw-bold" id="modalTitle">Preview</h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const galleryModal = document.getElementById('galleryModal');
    const modalImage = document.getElementById('modalImage');
    const modalVideoContainer = document.getElementById('modalVideoContainer');
    const modalVideo = document.getElementById('modalVideo');
    const modalTitle = document.getElementById('modalTitle');

    galleryModal.addEventListener('show.bs.modal', function(event) {
        const trigger = event.relatedTarget;
        const type = trigger.getAttribute('data-type');
        const src = trigger.getAttribute('data-src');
        const judul = trigger.getAttribute('data-judul');

        modalTitle.innerText = judul;

        // Reset
        modalImage.classList.add('d-none');
        modalVideoContainer.classList.add('d-none');
        modalVideo.pause();

        if (type === 'foto') {
            modalImage.src = src;
            modalImage.classList.remove('d-none');
        } else {
            modalVideo.src = src;
            modalVideoContainer.classList.remove('d-none');
            modalVideo.load();
        }
    });

    // Stop video saat modal ditutup
    galleryModal.addEventListener('hidden.bs.modal', function() {
        modalVideo.pause();
        modalVideo.src = "";
    });
});
</script>

@endsection
