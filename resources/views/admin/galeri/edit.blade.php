@extends('admin.layout')

@section('content')



<div class="page-header d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="mb-1">Halaman Web</h3>
        <p class="text-muted mb-0">
            Halaman ini untuk mengelola alinea yang dipublikasikan di Balai Bahasa Provinsi Riau
        </p>
    </div>

    <div class="header-logo">
        <img src="/img/logo.png"
             alt="Logo Balai Bahasa Provinsi Riau"
             class="img-fluid" style="max-height: 50px;">
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-md-8 col-lg-7">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white border-0 pt-4 px-4 d-flex justify-content-between align-items-start">
                <div>
                    <h5 class="fw-bold mb-0">Detail Media</h5>
                    <small class="text-muted">Edit informasi media Anda</small>
                </div>
                <button type="button" class="btn-close shadow-none" aria-label="Close"></button>
            </div>

            <div class="card-body px-4">
                <div class="mb-4">
                    <img src="https://images.unsplash.com/photo-1459749411177-042180ce673c?q=80&w=1000" 
                         alt="Media" class="img-fluid rounded-4 w-100" style="height: 300px; object-fit: cover;">
                </div>

                <form action="#" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Judul Media</label>
                            <input type="text" class="form-control bg-light border-0 py-2" value="Workshop Penulisan Kreatif">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Kategori</label>
                            <select class="form-select bg-light border-0 py-2">
                                <option selected>Kegiatan</option>
                                <option>Berita</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Tipe Media</label>
                            <select class="form-select bg-light border-0 py-2">
                                <option selected>Foto</option>
                                <option>Video</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Tanggal Upload</label>
                            <input type="text" class="form-control bg-light border-0 py-2" value="8 Des 2024">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold small">Ukuran File</label>
                            <input type="text" class="form-control bg-light border-0 py-2" value="1.8 MB">
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-5 pb-2">
                        <button type="button" class="btn btn-danger px-4 py-2 fw-semibold rounded-3" style="background-color: #dc3545;">
                            Hapus Media
                        </button>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-secondary px-4 py-2 fw-semibold rounded-3 border-light-subtle text-dark">
                                Batal
                            </button>
                            <button type="submit" class="btn px-4 py-2 fw-semibold rounded-3 text-white d-flex align-items-center gap-2" style="background-color: #0d8a83;">
                                <i class="bi bi-save"></i> Simpan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .rounded-4 { border-radius: 1rem !important; }
    .form-control:focus, .form-select:focus {
        background-color: #f8f9fa;
        box-shadow: 0 0 0 0.25rem rgba(13, 138, 131, 0.15);
        border: 1px solid #0d8a83 !important;
    }
</style>
@endsection