@extends('admin.layout')
@php use Carbon\Carbon; @endphp

@section('content')

{{-- ================= NOTIF ================= --}}
@if(session('success'))
<div id="notif-top" class="notif-top show">{{ session('success') }}</div>
@endif

@if(session('error'))
<div id="notif-top" class="notif-top notif-error show">{{ session('error') }}</div>
@endif

<style>
.notif-top{
    position:fixed;top:20px;left:50%;transform:translateX(-50%);
    background:#067ac1;color:#fff;padding:14px 28px;border-radius:10px;
    font-weight:700;z-index:9999;opacity:0;animation:slideDown .5s forwards
}
.notif-error{background:#d9534f}
@keyframes slideDown{
    from{transform:translate(-50%,-30px);opacity:0}
    to{transform:translate(-50%,0);opacity:1}
}
</style>

<script>
document.addEventListener("DOMContentLoaded",()=>{
    const n=document.getElementById("notif-top");
    if(n){
        setTimeout(()=>n.style.opacity=0,2500);
        setTimeout(()=>n.remove(),3000);
    }
});
</script>

{{-- ================= HEADER ================= --}}
<div class="page-header d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="mb-1">Ubah Data Publikasi</h3>
        <p class="text-muted mb-0">Perbarui data publikasi yang akan ditampilkan di laman</p>
    </div>
    <img src="/img/logobbpr.png" class="img-fluid header-logo">
</div>

{{-- ================= FORM ================= --}}
<div class="card border-0 shadow-sm">
<div class="card-body p-4">

<form action="{{ route('admin.publikasi.update',$data->publikasi_id) }}"
      method="POST" enctype="multipart/form-data">
@csrf
@method('PUT')

{{-- TANGGAL | KATEGORI | PENULIS --}}
<div class="row mb-3">
    <div class="col-md-4">
        <label class="form-label fw-semibold">Tanggal Terbit *</label>
        <input type="date" class="form-control" name="tanggal"
               value="{{ Carbon::parse($data->tanggal)->format('Y-m-d') }}" required>
    </div>
    <div class="col-md-4">
        <label class="form-label fw-semibold">Kategori *</label>
        <select class="form-select" name="kategori" required>
            <option value="alinea" {{ $data->kategori=='alinea'?'selected':'' }}>Alinea</option>
            <option value="artikel" {{ $data->kategori=='artikel'?'selected':'' }}>Artikel</option>
            <option value="berita" {{ $data->kategori=='berita'?'selected':'' }}>Berita</option>
            <option value="pengumuman" {{ $data->kategori=='pengumuman'?'selected':'' }}>Pengumuman</option>
        </select>
    </div>
    <div class="col-md-4">
        <label class="form-label fw-semibold">Penulis</label>
        <input type="text" class="form-control" name="penulis" value="{{ $data->penulis }}">
    </div>
</div>

{{-- JUDUL --}}
<div class="mb-3">
    <label class="form-label fw-semibold">Judul *</label>
    <input type="text" class="form-control" name="judul" value="{{ $data->judul }}" required>
</div>

{{-- ================= GAMBAR ================= --}}
<div class="mb-3">
    <label class="form-label fw-semibold">Gambar Publikasi</label>
    <input type="file" class="form-control" name="gambar" id="gambarInput"
           accept="image/*" onchange="previewImage(event)">

    <div class="position-relative d-inline-block mt-3">
        <img id="preview"
             src="{{ $data->gambar ?? asset('img/logobbpr.png') }}"
             class="img-fluid rounded" style="max-height:220px">
        <button type="button"
                id="removeImageBtn"
                onclick="removeImage()"
                class="btn btn-sm btn-danger position-absolute top-0 end-0"
                style="border-radius:50%;"
                @if(!$data->gambar) hidden @endif>
            ✕
        </button>

    </div>
</div>

{{-- ================= FILE (SAMA DENGAN CREATE) ================= --}}
<div class="mb-3">
    <label class="form-label fw-semibold">Lampiran File (PDF / Excel / Doc)</label>

    <input type="file" class="form-control" name="file" id="fileInput"
           accept=".pdf,.xls,.xlsx,.doc,.docx,.zip,.rar"
           onchange="previewFile(event)">

    <div id="filePreview" class="mt-3">
        @if($data->file)
        <div class="alert d-flex justify-content-between align-items-center rounded"
             style="background:#fff3cd;border:1px solid #ffeeba">
            <div><strong>{{ basename($data->file) }}</strong></div>
            <div class="d-flex gap-2">
                <a href="{{ $data->file }}" target="_blank"
                   class="btn btn-sm text-white" style="background:#067ac1">
                    Buka
                </a>
                <button type="button" class="btn btn-sm btn-outline-danger"
                        onclick="removeFile()">✕</button>
            </div>
        </div>
        @endif
    </div>

    {{-- FLAG FILE DIHAPUS --}}
    <input type="hidden" name="remove_file" id="removeFileFlag" value="0">
</div>

{{-- IZIN UNDUH --}}
<div class="form-check mb-4">
    <input class="form-check-input" type="checkbox" name="allow_download" value="1"
           {{ $data->allow_download?'checked':'' }}>
    <label class="form-check-label fw-semibold">Izinkan unduh lampiran</label>
</div>

{{-- ISI --}}
<div class="mb-4">
    <label class="form-label fw-semibold">Isi Artikel</label>
    <textarea class="form-control" name="isi" rows="12">{{ $data->isi }}</textarea>
</div>

{{-- ACTION --}}
<div class="d-flex justify-content-end gap-2">
    <a href="{{ route('admin.publikasi') }}" class="btn btn-action btn-cancel">Batal</a>
    <button type="submit" class="btn btn-action btn-save">Perbarui</button>
</div>

</form>
</div>
</div>

{{-- ================= SCRIPT ================= --}}
<script>
function previewImage(e){
    const img=document.getElementById('preview');
    const btn=document.getElementById('removeImageBtn');
    if(e.target.files.length){
        img.src=URL.createObjectURL(e.target.files[0]);
        btn.style.display='block';
    }
}
function removeImage(){
    document.getElementById('gambarInput').value="";
    document.getElementById('preview').src="{{ asset('img/logobbpr.png') }}";
    document.getElementById('removeImageBtn').style.display='none';
}

function previewFile(e){
    const f=e.target.files[0];
    const p=document.getElementById('filePreview');
    if(!f){p.innerHTML="";return;}
    const url=URL.createObjectURL(f);
    p.innerHTML=`
    <div class="alert d-flex justify-content-between align-items-center rounded"
         style="background:#fff3cd;border:1px solid #ffeeba">
        <div><strong>${f.name}</strong></div>
        <div class="d-flex gap-2">
            <button type="button" class="btn btn-sm text-white"
                    style="background:#067ac1"
                    onclick="window.open('${url}','_blank')">Buka</button>
            <button type="button" class="btn btn-sm btn-outline-danger"
                    onclick="removeFile()">✕</button>
        </div>
    </div>`;
}

function removeFile(){
    document.getElementById('fileInput').value="";
    document.getElementById('filePreview').innerHTML="";
    document.getElementById('removeFileFlag').value="1";
}
</script>

@endsection
