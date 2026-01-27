@extends('admin.layout')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    .content-wrapper {
        font-family: 'Inter', sans-serif;
        background-color: #f8faff;
        padding: 2.5rem;
        min-height: 100vh;
    }

    /* Header & Back Button */
    .header-box { display: flex; align-items: center; gap: 15px; margin-bottom: 30px; }
    .btn-back {
        width: 40px; height: 40px;
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        color: #64748b; text-decoration: none;
        transition: all 0.2s;
    }
    .btn-back:hover { background: #f1f5f9; color: #1e293b; }

    /* Card Styling */
    .form-card {
        background: white;
        border-radius: 16px;
        border: 1px solid #eef2f7;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        padding: 30px;
        max-width: 800px;
    }

    .form-label {
        font-weight: 600;
        color: #334155;
        font-size: 14px;
        margin-bottom: 8px;
        display: block;
    }

    .form-control-custom {
        width: 100%;
        padding: 12px 16px;
        border-radius: 10px;
        border: 1px solid #e2e8f0;
        font-size: 14px;
        transition: all 0.2s;
        outline: none;
        background: #fcfdfe;
    }

    .form-control-custom:focus {
        border-color: #2563eb;
        background: white;
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
    }

    /* File Upload Area */
    .file-upload-box {
        border: 2px dashed #e2e8f0;
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        background: #f8faff;
        cursor: pointer;
        transition: all 0.2s;
    }
    .file-upload-box:hover { border-color: #3b82f6; background: #eff6ff; }
    .file-info { font-size: 13px; color: #64748b; margin-top: 8px; }

    /* Footer Buttons */
    .form-footer {
        display: flex; justify-content: flex-end;
        gap: 12px; margin-top: 30px;
        padding-top: 20px; border-top: 1px solid #f1f5f9;
    }

    .btn-save {
        background-color: #2563eb; color: white;
        padding: 12px 24px; border-radius: 10px;
        font-weight: 600; border: none;
        cursor: pointer; transition: all 0.2s;
    }
    .btn-save:hover { background-color: #1d4ed8; transform: translateY(-1px); }

    .btn-cancel {
        background-color: white; color: #64748b;
        padding: 12px 24px; border-radius: 10px;
        font-weight: 600; border: 1px solid #e2e8f0;
        text-decoration: none; transition: all 0.2s;
    }
    .btn-cancel:hover { background: #f8fafc; color: #1e293b; }
</style>

<div class="content-wrapper">
    <div class="header-box">
        <a href="{{ route('admin.akuntabilitas.lakin') }}" class="btn-back">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <div>
            <h3 class="m-0" style="font-weight: 700; color: #1e293b;">Edit Dokumen LAKIN</h3>
            <p class="text-muted m-0 small">Perbarui informasi dokumen akuntabilitas instansi</p>
        </div>
    </div>

    <div class="form-card">
        <form action="{{ route('admin.akuntabilitas.update', $akuntabilitas->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                <div>
                    <label class="form-label">Nama Dokumen</label>
                    <input type="text" name="nama_dokumen" 
                        class="form-control-custom @error('nama_dokumen') is-invalid @enderror" 
                        value="{{ old('nama_dokumen', $akuntabilitas->nama_dokumen) }}" required>
                    @error('nama_dokumen')
                        <div style="color: #dc3545; font-size: 12px; margin-top: 5px;">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label class="form-label">Tanggal Dokumen</label>
                    <input type="date" name="tanggal" 
                        class="form-control-custom @error('tanggal') is-invalid @enderror" 
                        value="{{ old('tanggal', $akuntabilitas->tanggal) }}" required>
                    @error('tanggal')
                        <div style="color: #dc3545; font-size: 12px; margin-top: 5px;">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                <div>
                    <label class="form-label">Status Publikasi</label>
                    <select name="status" class="form-control-custom">
                        <option value="published" {{ $akuntabilitas->status == 'published' ? 'selected' : '' }}>Published</option>
                        <option value="draft" {{ $akuntabilitas->status == 'draft' ? 'selected' : '' }}>Draft</option>
                    </select>
                </div>
            </div>

            <div style="margin-bottom: 20px;">
                <label class="form-label">Deskripsi / Tulisan</label>
                <textarea name="deskripsi" class="form-control-custom" rows="4" placeholder="Masukkan ringkasan isi dokumen...">{{ old('deskripsi', $akuntabilitas->deskripsi) }}</textarea>
            </div>

            <div style="margin-bottom: 10px;">
                <label class="form-label">File Dokumen (PDF/DOCX)</label>
                <div class="file-upload-box" onclick="document.getElementById('fileInput').click()">
                    <i class="fa-solid fa-cloud-arrow-up" style="font-size: 24px; color: #3b82f6;"></i>
                    <div style="font-weight: 600; margin-top: 10px; color: #1e293b;">Klik untuk ganti file</div>
                    <div class="file-info" id="fileInfo">File saat ini: <span class="text-primary">{{ basename($akuntabilitas->file_path) }}</span></div>
                    <input type="file" id="fileInput" name="file_dokumen" style="display: none;">
                </div>
                <p class="text-muted small mt-2">*Kosongkan jika tidak ingin mengubah file.</p>
            </div>

            <div class="form-footer">
                <a href="{{ route('admin.akuntabilitas.lakin') }}" class="btn-cancel">Batal</a>
                <button type="submit" class="btn-save shadow-sm">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Preview nama file saat dipilih
    document.getElementById('fileInput').addEventListener('change', function(e) {
        if (this.files && this.files.length > 0) {
            const fileName = this.files[0].name;
            const fileInfo = document.getElementById('fileInfo');
            fileInfo.innerHTML = `File terpilih: <span style="color: #2563eb; font-weight: 600;">${fileName}</span>`;
        }
    });
</script>
@endsection