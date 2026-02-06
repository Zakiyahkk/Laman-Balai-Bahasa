@extends('admin.layout')
@section('content')

{{-- ================= NOTIF ================= --}}
@if(session('success') || session('error'))
<div id="notif-top" class="notif-top">
    {{ session('success') ?? session('error') }}
</div>
@endif

<style>
.notif-top{
    position:fixed;
    top:20px; left:50%;
    transform:translateX(-50%);
    background:#067ac1;
    color:#fff;
    padding:14px 28px;
    border-radius:10px;
    font-size:15px;
    z-index:9999;
    animation:slideDown .4s ease forwards;
}
@keyframes slideDown{
    from{opacity:0;transform:translate(-50%,-20px)}
    to{opacity:1;transform:translate(-50%,0)}
}
</style>

<script>
document.addEventListener("DOMContentLoaded",()=>{
    const n=document.getElementById("notif-top");
    if(n){
        setTimeout(()=>n.style.opacity="0",2500);
        setTimeout(()=>n.remove(),3000);
    }
});
</script>

{{-- ================= HEADER ================= --}}
<div class="page-header d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="mb-1 text-white">Tambah Hasil Survei</h3>
        <p class="mb-0 text-white">
            Unggah dokumen atau gambar hasil survei
        </p>
    </div>

    <div class="header-logo">
        <img src="https://ppidbbpriau.kemendikdasmen.go.id/bbpr/img/logobbpr4.png"
             class="img-fluid header-logo">
    </div>
</div>

{{-- ================= FORM ================= --}}
<div class="card border-0 shadow-sm">
    <div class="card-body p-4">

        <form action="{{ route('admin.hasilsurvei.store') }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf

            {{-- TANGGAL + STATUS --}}
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">
                        Tanggal Survei <span class="text-danger">*</span>
                    </label>
                    <input type="date"
                           name="tanggal"
                           class="form-control"
                           value="{{ date('Y-m-d') }}"
                           required>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">
                        Status <span class="text-danger">*</span>
                    </label>
                    <select name="status" class="form-select" required>
                        <option value="terbit">Terbit</option>
                        <option value="draf">Draf</option>
                    </select>
                </div>
            </div>

            {{-- JUDUL --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">
                    Judul Survei <span class="text-danger">*</span>
                </label>
                <input type="text"
                       name="judul_survei"
                       class="form-control"
                       placeholder="Masukkan judul survei.."
                       required>
            </div>

            {{-- FILE --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">
                    Upload File (PNG / JPG / PDF) <span class="text-danger">*</span>
                </label>

                <input type="file"
                       name="file"
                       id="fileInput"
                       class="form-control"
                       accept="image/png,image/jpeg,application/pdf"
                       onchange="handleFilePreview(event)"
                       required>

                <small class="text-muted">
                    Format: PNG, JPG, PDF • Maksimal 50 MB
                </small>

                {{-- PREVIEW AREA --}}
                <div id="previewImageWrap" class="mt-3" style="display:none;">
                    <div class="position-relative d-inline-block">
                        <img id="imagePreview"
                             class="img-fluid rounded"
                             style="max-height:220px;">
                        <button type="button"
                                onclick="removeFile()"
                                class="btn btn-sm btn-danger position-absolute top-0 end-0"
                                style="border-radius:50%;">✕</button>
                    </div>
                </div>

                <div id="previewFileWrap" class="mt-3"></div>
            </div>

            {{-- ACTION --}}
            <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="{{ route('admin.hasilsurvei.index') }}"
                   class="btn btn-action btn-cancel">
                    Batal
                </a>
                <button type="submit"
                        class="btn btn-action btn-save">
                    Simpan
                </button>
            </div>

        </form>
    </div>
</div>

{{-- ================= SCRIPT PREVIEW ================= --}}
<script>
function handleFilePreview(e){
    const file = e.target.files[0];
    const imgWrap = document.getElementById('previewImageWrap');
    const fileWrap = document.getElementById('previewFileWrap');

    imgWrap.style.display = 'none';
    fileWrap.innerHTML = '';

    if(!file) return;

    const type = file.type;
    const url  = URL.createObjectURL(file);

    // ===== JIKA GAMBAR =====
    if(type.startsWith('image/')){
        document.getElementById('imagePreview').src = url;
        imgWrap.style.display = 'block';
        return;
    }

    // ===== JIKA PDF =====
    if(type === 'application/pdf'){
        fileWrap.innerHTML = `
            <div class="alert d-flex justify-content-between align-items-center rounded"
                 style="background:#fff3cd;border:1px solid #ffeeba;">
                <div>
                    <strong>${file.name}</strong><br>
                    <small class="text-muted">
                        ${(file.size/1024/1024).toFixed(2)} MB
                    </small>
                </div>
                <div class="d-flex gap-2">
                    <button type="button"
                            class="btn btn-sm text-white"
                            style="background:#067ac1"
                            onclick="window.open('${url}','_blank')">
                        Buka
                    </button>
                    <button type="button"
                            class="btn btn-sm btn-outline-danger"
                            onclick="removeFile()">✕</button>
                </div>
            </div>
        `;
    }
}

function removeFile(){
    document.getElementById('fileInput').value = '';
    document.getElementById('previewImageWrap').style.display = 'none';
    document.getElementById('previewFileWrap').innerHTML = '';
}
</script>

@endsection
