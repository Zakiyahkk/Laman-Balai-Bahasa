@extends('admin.layout')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    .content-wrapper-custom {
        padding: 2.5rem;
        background: #f8faff;
        min-height: 100vh;
        font-family: 'Inter', sans-serif;
    }

    .card-full {
        background: #ffffff;
        border-radius: 16px;
        border: none;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        width: 100%;
    }

    /* Box Upload Style */
    .upload-box {
        border: 2px dashed #cbd5e1;
        border-radius: 15px;
        padding: 3rem !important;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        background: #ffffff;
        position: relative;
    }

    .upload-box:hover {
        border-color: #2563eb;
        background-color: #f0f7ff;
    }

    .upload-box i {
        color: #94a3b8;
        transition: color 0.3s;
    }

    .upload-box:hover i {
        color: #2563eb;
    }

    /* Container Preview */
    #previewContainer {
        display: none;
        margin-top: 1.5rem;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        overflow: hidden;
        background: #f1f5f9;
        animation: fadeIn 0.5s;
    }

    #pdfPreview {
        width: 100%;
        height: 600px;
        border: none;
    }

    .form-control, .form-select {
        border-radius: 10px;
        padding: 0.75rem 1rem;
        border: 1px solid #e2e8f0;
    }

    .form-control:focus, .form-select:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="content-wrapper-custom">
    <div class="d-flex align-items-center gap-3 mb-4">
        <div style="background: #e8f1ff; color: #2563eb; width: 48px; height: 48px; display: flex; align-items: center; justify-content: center; border-radius: 14px;" class="shadow-sm">
            <i class="fa-solid fa-file-circle-plus fa-lg"></i>
        </div>
        <div>
            <h3 class="fw-bold m-0 text-uppercase" style="letter-spacing: -0.5px;">Tambah {{ str_replace('-', ' ', $tipe) }}</h3>
            <p class="text-muted m-0 small">Lengkapi formulir di bawah untuk mengunggah dokumen baru</p>
        </div>
    </div>

    <div class="card card-full">
        <div class="card-body p-4 p-lg-5">
            <form action="{{ route('admin.akuntabilitas.store', $tipe) }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row g-4">
                    <div class="col-12">
                        <label class="form-label fw-bold text-dark">Nama Dokumen <span class="text-danger">*</span></label>
                        <input type="text" name="nama_dokumen" class="form-control" placeholder="Contoh: Laporan Kinerja Tahunan 2024" required>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-bold text-dark">Deskripsi Singkat <span class="text-danger">*</span></label>
                        <textarea name="deskripsi" class="form-control" rows="3" placeholder="Berikan ringkasan isi dokumen..." required></textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold text-dark">Tanggal Dokumen <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal" class="form-control" required value="{{ date('Y-m-d') }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold text-dark">Status Publikasi <span class="text-danger">*</span></label>
                        <select name="status" class="form-select">
                            <option value="published">Published (Terlihat di Publik)</option>
                            <option value="draft">Draft (Hanya Admin)</option>
                        </select>
                    </div>

                    <div class="col-12 mt-4">
                        <label class="form-label fw-bold text-dark">Berkas Dokumen</label>
                        
                        <div class="upload-box" id="dropZone">
                            <input type="file" name="file_dokumen" class="d-none" id="fileInput" accept="application/pdf,application/vnd.openxmlformats-officedocument.wordprocessingml.document" required>
                            <i class="fa-solid fa-cloud-arrow-up fa-3x mb-3"></i>
                            <h5 class="fw-bold mb-1" id="fileName">Klik atau Tarik File ke Sini</h5>
                            <p class="text-muted small">Format yang didukung: <strong>PDF</strong> atau <strong>DOCX</strong> (Maksimal 5MB)</p>
                        </div>

                        <div id="previewContainer">
                            <div class="bg-dark text-white p-3 d-flex justify-content-between align-items-center">
                                <span class="small fw-medium"><i class="fa-solid fa-eye me-2 text-info"></i>Pratinjau Dokumen</span>
                                <button type="button" class="btn btn-sm btn-light fw-bold" onclick="removeFile()" style="font-size: 11px;">
                                    <i class="fa-solid fa-rotate-left me-1"></i> GANTI FILE
                                </button>
                            </div>
                            <iframe id="pdfPreview"></iframe>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-3 mt-5">
                    <a href="{{ route('admin.akuntabilitas.index', $tipe) }}" class="btn btn-light px-4 fw-semibold border">Batal</a>
                    <button type="submit" class="btn btn-primary px-5 fw-bold shadow-sm" style="background: #2563eb;">
                        <i class="fa-solid fa-floppy-disk me-2"></i> Simpan Dokumen
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const fileInput = document.getElementById('fileInput');
    const uploadBox = document.getElementById('dropZone');
    const fileNameText = document.getElementById('fileName');
    const previewContainer = document.getElementById('previewContainer');
    const pdfPreview = document.getElementById('pdfPreview');

    // Trigger click input file
    uploadBox.addEventListener('click', () => fileInput.click());

    // Handle file selection
    fileInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            // Validasi Ukuran (5MB)
            if (file.size > 5 * 1024 * 1024) {
                alert("Ukuran file terlalu besar! Maksimal 5MB.");
                this.value = "";
                return;
            }

            fileNameText.innerText = file.name;
            
            if (file.type === "application/pdf") {
                const fileURL = URL.createObjectURL(file);
                pdfPreview.src = fileURL;
                previewContainer.style.display = "block";
                uploadBox.style.display = "none";
            } else {
                // Untuk DOCX
                previewContainer.style.display = "none";
                uploadBox.style.display = "block";
                uploadBox.style.borderColor = "#22c55e";
                uploadBox.classList.add('bg-light');
                fileNameText.innerHTML = `<i class="fa-solid fa-file-word text-primary me-2"></i> ${file.name}`;
            }
        }
    });

    // Reset function
    function removeFile() {
        fileInput.value = "";
        previewContainer.style.display = "none";
        uploadBox.style.display = "block";
        uploadBox.style.borderColor = "#cbd5e1";
        uploadBox.classList.remove('bg-light');
        fileNameText.innerText = "Klik atau Tarik File ke Sini";
        pdfPreview.src = "";
    }

    // Simple Drag & Drop Visual Effect
    uploadBox.addEventListener('dragover', (e) => {
        e.preventDefault();
        uploadBox.style.borderColor = "#2563eb";
        uploadBox.style.background = "#f0f7ff";
    });

    uploadBox.addEventListener('dragleave', () => {
        if (!fileInput.value) {
            uploadBox.style.borderColor = "#cbd5e1";
            uploadBox.style.background = "#ffffff";
        }
    });
</script>
@endsection