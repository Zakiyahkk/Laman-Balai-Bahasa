@extends('admin.layout')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
    .content-wrapper-custom {
        padding: 2rem;
        background: #f8faff;
        min-height: 100vh;
    }

    .card-full {
        background: #ffffff;
        border-radius: 16px;
        border: none;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        width: 100%;
    }

    /* Box Upload */
    .upload-box {
        border: 2px dashed #cbd5e1;
        border-radius: 15px;
        padding: 2.5rem !important;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        background: #ffffff;
    }

    .upload-box:hover {
        border-color: #2563eb;
        background-color: #f8faff;
    }

    /* Container Preview */
    #previewContainer {
        display: none;
        margin-top: 1.5rem;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        overflow: hidden;
        background: #f1f5f9;
    }

    #pdfPreview {
        width: 100%;
        height: 500px; /* Ukuran preview lebih besar agar jelas */
        border: none;
    }

    .form-control, .form-select {
        border-radius: 10px;
        padding: 0.75rem 1rem;
    }
</style>

<div class="content-wrapper-custom">
    <div class="d-flex align-items-center gap-3 mb-4">
        <div style="background: #e8f1ff; color: #2563eb; width: 48px; height: 48px; display: flex; align-items: center; justify-content: center; border-radius: 14px;">
            <i class="fa-solid fa-file-circle-plus fa-lg"></i>
        </div>
        <div>
            <h3 class="fw-bold m-0 text-uppercase">Tambah Dokumen {{ str_replace('-', ' ', $tipe) }}</h3>
            <p class="text-muted m-0">Menu Akuntabilitas</p>
        </div>
    </div>

    <div class="card card-full">
        <div class="card-body p-4">
            {{-- PERBAIKAN: Route store sekarang butuh parameter $tipe --}}
            <form action="{{ route('admin.akuntabilitas.store', $tipe) }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row g-4">
                    <div class="col-12">
                        <label class="form-label fw-bold">Nama Dokumen <span class="text-danger">*</span></label>
                        <input type="text" name="nama_dokumen" class="form-control" placeholder="Masukkan nama dokumen" required>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-bold">Deskripsi <span class="text-danger">*</span></label>
                        <textarea name="deskripsi" class="form-control" rows="3" placeholder="Jelaskan isi dokumen secara singkat..." required></textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Tanggal <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal" class="form-control" required value="{{ date('Y-m-d') }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-select">
                            <option value="published">Published</option>
                            <option value="draft">Draft</option>
                        </select>
                    </div>

                    <div class="col-12 mt-2">
                        <label class="form-label fw-bold">Unggah Berkas (PDF/DOCX)</label>
                        <div class="upload-box" id="dropZone">
                            <i class="fa-solid fa-cloud-arrow-up fa-2x mb-2 text-primary"></i>
                            <h6 class="fw-bold mb-1" id="fileName">Klik untuk pilih berkas</h6>
                            <p class="text-muted small mb-0">Mendukung format PDF atau DOCX (Maks. 5MB)</p>
                            {{-- Ubah accept agar mendukung word juga --}}
                            <input type="file" name="file_dokumen" class="d-none" id="fileInput" accept="application/pdf,application/vnd.openxmlformats-officedocument.wordprocessingml.document" required>
                        </div>

                        <div id="previewContainer">
                            <div class="bg-dark text-white p-2 d-flex justify-content-between align-items-center">
                                <span class="small ms-2"><i class="fa-solid fa-eye me-2"></i>Pratinjau Dokumen (Khusus PDF)</span>
                                <button type="button" class="btn btn-sm btn-danger" onclick="removeFile()">Hapus & Ganti</button>
                            </div>
                            <iframe id="pdfPreview"></iframe>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-3 mt-5">
                    {{-- PERBAIKAN: Link Batal balik ke index sesuai tipe --}}
                    <a href="{{ route('admin.akuntabilitas.index', $tipe) }}" class="btn btn-outline-secondary px-4">Batal</a>
                    <button type="submit" class="btn btn-primary px-5" style="background: #2563eb; border: none;">Simpan Dokumen</button>
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

    uploadBox.addEventListener('click', () => fileInput.click());

    fileInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            fileNameText.innerText = "File Terpilih: " + file.name;
            
            // Preview hanya bekerja jika filenya PDF
            if (file.type === "application/pdf") {
                const fileURL = URL.createObjectURL(file);
                pdfPreview.src = fileURL;
                previewContainer.style.display = "block";
                uploadBox.style.display = "none";
            } else {
                // Jika Word, tidak bisa preview tapi tetap tampilkan nama file
                previewContainer.style.display = "none";
                uploadBox.style.display = "block";
                uploadBox.style.borderColor = "#22c55e"; // Warna hijau tanda sukses pilih file
            }
        }
    });

    function removeFile() {
        fileInput.value = "";
        previewContainer.style.display = "none";
        uploadBox.style.display = "block";
        uploadBox.style.borderColor = "#cbd5e1";
        fileNameText.innerText = "Klik untuk pilih berkas";
        pdfPreview.src = "";
    }
</script>
@endsection