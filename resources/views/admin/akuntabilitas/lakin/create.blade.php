@extends('admin.layout')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<style>
    .upload-box {
        border: 2px dashed #e2e8f0;
        border-radius: 15px;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); /* Animasi halus */
        position: relative;
        overflow: hidden;
    }

    /* Efek saat kursor di atas kotak (Hover) */
    .upload-box:hover {
        border-color: #2563eb;
        background-color: #f8faff;
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.1);
    }

    .upload-box i {
        transition: transform 0.3s ease;
    }

    .upload-box:hover i {
        transform: scale(1.2) translateY(-5px); /* Ikon membesar & naik sedikit */
        color: #2563eb ! aspiration;
    }

    /* Animasi saat file sudah dipilih (Success State) */
    .upload-box.file-uploaded {
        border-style: solid;
        border-color: #10b981;
        background-color: #f0fdf4;
    }

    .upload-box.file-uploaded i {
        color: #10b981 !important;
        animation: bounce 0.5s ease;
    }

    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }
</style>
<div class="content-wrapper" style="background: #f8faff; padding: 2.5rem;">
    <div class="header-box d-flex align-items-center gap-3 mb-4">
        <div style="background: #e8f1ff; color: #2563eb; width: 45px; height: 45px; display: flex; align-items: center; justify-content: center; border-radius: 12px;">
            <i class="fa-solid fa-file-circle-plus"></i>
        </div>
        <div>
            <h3 class="fw-bold m-0" style="font-size: 22px;">Tambah Dokumen Baru</h3>
            <p class="text-muted m-0">LAKIN (Laporan Kinerja)</p>
        </div>
    </div>

    <div class="card border-0 shadow-sm" style="border-radius: 16px;">
        <div class="card-body p-4">
            <form action="{{ route('admin.akuntabilitas.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row g-4">
                    <div class="col-12">
                        <label class="form-label fw-bold">Nama Dokumen <span class="text-danger">*</span></label>
                        <input type="text" name="nama_dokumen" class="form-control" placeholder="Masukkan nama dokumen" style="height: 50px; border-radius: 10px;" required>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-bold">Deskripsi/Tulisan <span class="text-danger">*</span></label>
                        <textarea name="deskripsi" class="form-control" rows="4" placeholder="Masukkan deskripsi dokumen" style="border-radius: 10px;" required></textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Tanggal <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal" class="form-control" style="height: 50px; border-radius: 10px;" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-select" style="height: 50px; border-radius: 10px;">
                            <option value="Draft">Draft</option>
                            <option value="Published">Published</option>
                        </select>
                    </div>

                    <div class="col-12 mt-4">
                        <label class="form-label fw-bold">Upload Dokumen</label>
                        <div class="upload-box text-center p-5" id="dropZone" style="border: 2px dashed #e2e8f0; border-radius: 15px; cursor: pointer;">
                            <i class="fa-solid fa-cloud-arrow-up fa-2x mb-2 text-muted"></i>
                            <p class="mb-1" id="fileName">Klik untuk upload atau drag & drop file</p>
                            <span class="text-muted small">Format: PDF, DOC, XLS (Max 10MB)</span>
                            <input type="file" name="file_dokumen" class="d-none" id="fileInput">
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-5">
                    <a href="{{ route('admin.akuntabilitas.lakin') }}" class="btn btn-outline-secondary px-4" style="border-radius: 10px;">Batal</a>
                    <button type="submit" class="btn btn-primary px-4" style="background: #2563eb; border-radius: 10px;">Simpan Dokumen</button>
                </div>
            </form> </div>
    </div>
</div>

<script>
    const fileInput = document.getElementById('fileInput');
    const uploadBox = document.getElementById('dropZone');
    const fileNameText = document.getElementById('fileName');

    uploadBox.addEventListener('click', () => fileInput.click());

    fileInput.addEventListener('change', function() {
        if (this.files && this.files.length > 0) {
            fileNameText.innerText = "File dipilih: " + this.files[0].name;
            // Tambahkan class ini agar animasi bounce dan warna hijau aktif
            uploadBox.classList.add('file-uploaded'); 
        }
    });
</script>
@endsection