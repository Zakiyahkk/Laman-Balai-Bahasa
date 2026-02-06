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
        <h3 class="mb-1 text-white">Edit Hasil Survei</h3>
        <p class="mb-0 text-white">
            Perbarui dokumen atau gambar hasil survei
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

        <form action="{{ route('admin.hasilsurvei.update', $hasilsurvei->id) }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- TANGGAL + STATUS --}}
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">
                        Tanggal Survei <span class="text-danger">*</span>
                    </label>
                    <input type="date"
                           name="tanggal"
                           class="form-control"
                           value="{{ $hasilsurvei->tanggal }}"
                           required>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">
                        Status <span class="text-danger">*</span>
                    </label>
                    <select name="status" class="form-select" required>
                        <option value="terbit" {{ $hasilsurvei->status=='terbit'?'selected':'' }}>Terbit</option>
                        <option value="draf" {{ $hasilsurvei->status=='draf'?'selected':'' }}>Draf</option>
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
                       value="{{ $hasilsurvei->judul_survei }}"
                       required>
            </div>

            {{-- FILE --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">
                    Upload File (PNG / JPG / PDF)
                </label>

                <input type="file"
                       name="file"
                       id="fileInput"
                       class="form-control"
                       accept="image/png,image/jpeg,application/pdf"
                       onchange="handleFilePreview(event)">

                <small class="text-muted">
                    Kosongkan jika tidak ingin mengganti file • Maks 50 MB
                </small>

                {{-- FLAG HAPUS FILE --}}
                <input type="hidden" name="remove_file" id="removeFileFlag" value="0">

                {{-- PREVIEW IMAGE --}}
                <div id="previewImageWrap" class="mt-3"
                     style="{{ in_array($hasilsurvei->tipe_file,['png','jpg','jpeg']) ? '' : 'display:none;' }}">
                    <div class="position-relative d-inline-block">
                        <img id="imagePreview"
                             src="{{ in_array($hasilsurvei->tipe_file,['png','jpg','jpeg']) ? asset($hasilsurvei->file_path) : '' }}"
                             class="img-fluid rounded"
                             style="max-height:220px;">
                        <button type="button"
                                onclick="removeFile()"
                                class="btn btn-sm btn-danger position-absolute top-0 end-0"
                                style="border-radius:50%;">✕</button>
                    </div>
                </div>

                {{-- PREVIEW FILE --}}
                <div id="previewFileWrap" class="mt-3">
                    @if($hasilsurvei->tipe_file === 'pdf')
                        <div class="alert d-flex justify-content-between align-items-center rounded"
                             style="background:#fff3cd;border:1px solid #ffeeba;">
                            <div>
                                <strong>{{ basename($hasilsurvei->file_path) }}</strong>
                            </div>
                            <div class="d-flex gap-2">
                                <a href="{{ asset($hasilsurvei->file_path) }}"
                                   target="_blank"
                                   class="btn btn-sm text-white"
                                   style="background:#067ac1">
                                    Buka
                                </a>
                                <button type="button"
                                        class="btn btn-sm btn-outline-danger"
                                        onclick="removeFile()">✕</button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            {{-- ACTION --}}
            <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="{{ route('admin.hasilsurvei.index') }}"
                   class="btn btn-action btn-cancel">
                    Batal
                </a>
                <button type="submit"
                        class="btn btn-action btn-save">
                    Perbarui
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
    document.getElementById('removeFileFlag').value = 0;

    if(!file) return;

    const type = file.type;
    const url  = URL.createObjectURL(file);

    if(type.startsWith('image/')){
        document.getElementById('imagePreview').src = url;
        imgWrap.style.display = 'block';
        return;
    }

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
    document.getElementById('removeFileFlag').value = 1;
}
</script>

@endsection
