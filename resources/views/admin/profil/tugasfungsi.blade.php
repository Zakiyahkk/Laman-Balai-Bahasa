@extends('admin.layout')

@section('content')

@php
$visi = "Menjadi Lembaga Penyuluhan Pertanian yang profesional dan terpercaya dalam mendukung pembangunan pertanian yang berkelanjutan di Provinsi Riau.";
$misi = [
    "Meningkatkan kapasitas dan kompetensi penyuluh pertanian",
    "Mengembangkan sistem penyuluhan yang inovatif dan adaptif",
    "Memperkuat kemitraan dengan stakeholder pertanian",
    "Mendorong adopsi teknologi pertanian modern",
    "Meningkatkan kesejahteraan petani melalui program pemberdayaan",
];
@endphp

<!-- ================= HEADER ================= -->
<div class="page-header d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="mb-1">Tugas & Fungsi</h3>
        <p class="text-muted mb-0">Kelola tugas dan fungsi BPP Riau</p>
    </div>
    <img src="/img/logobbpr.png" class="header-logo">
</div>

<div class="row">

    <!-- ================= KIRI ================= -->
    <div class="col-md-6">
        <div class="card p-4">

            <!-- ===== Visi ===== -->
            <label class="fw-bold mb-2">Visi</label>

            <!-- VIEW -->
            <div id="visiView" class="bg-light text-muted p-3 rounded mb-3">
                {{ $visi }}
            </div>

            <!-- EDIT -->
            <textarea id="visiInput"
                      class="form-control mb-3 d-none"
                      rows="4">{{ $visi }}</textarea>

            <!-- ===== Misi ===== -->
            <label class="fw-bold mb-2">Misi</label>

            <!-- VIEW -->
            <div id="misiView" class="bg-light text-muted p-3 rounded mb-3">
                <ol class="mb-0">
                    @foreach($misi as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                </ol>
            </div>

            <!-- EDIT -->
            <textarea id="misiInput"
                      class="form-control mb-3 d-none"
                      rows="6">@foreach($misi as $i => $m){{ ($i+1).'. '.$m."\n" }}@endforeach</textarea>

            <!-- ACTION BUTTON (HANYA EDIT MODE) -->
            <div id="actionButtons" class="gap-2 d-none">
                <button class="btn btn-dark px-4">
                    <i class="bi bi-save me-1"></i> Simpan
                </button>
                <button type="button"
                        class="btn btn-outline-secondary px-4"
                        onclick="cancelEdit()">
                    Batal
                </button>
            </div>

        </div>
    </div>

    <!-- ================= KANAN : PREVIEW ================= -->
    <div class="col-md-6">
        <div class="card p-4 position-relative h-100">

            <!-- TOMBOL EDIT -->
            <button class="btn btn-outline-primary btn-sm position-absolute top-0 end-0 m-3"
                    onclick="enableEdit()">
                <i class="bi bi-pencil-square"></i> Edit
            </button>

            <h5 class="fw-bold mb-3">
                <i class="bi bi-eye me-1"></i> Preview
            </h5>

            <h6 class="text-primary fw-bold">VISI</h6>
            <p id="visiPreview">{{ $visi }}</p>

            <h6 class="text-primary fw-bold mt-3">MISI</h6>
            <ol id="misiPreview">
                @foreach($misi as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ol>

        </div>
    </div>

</div>

<!-- ================= SCRIPT ================= -->
<script>
const visiView = document.getElementById('visiView');
const misiView = document.getElementById('misiView');
const visiInput = document.getElementById('visiInput');
const misiInput = document.getElementById('misiInput');
const actionButtons = document.getElementById('actionButtons');
const visiPreview = document.getElementById('visiPreview');
const misiPreview = document.getElementById('misiPreview');

function enableEdit() {
    visiView.classList.add('d-none');
    misiView.classList.add('d-none');

    visiInput.classList.remove('d-none');
    misiInput.classList.remove('d-none');

    actionButtons.classList.remove('d-none');
}

function cancelEdit() {
    visiInput.classList.add('d-none');
    misiInput.classList.add('d-none');

    visiView.classList.remove('d-none');
    misiView.classList.remove('d-none');

    actionButtons.classList.add('d-none');

    // reset preview
    visiPreview.innerText = visiView.innerText;
    misiPreview.innerHTML = misiView.innerHTML;
}

// LIVE PREVIEW
visiInput.addEventListener('input', () => {
    visiPreview.innerText = visiInput.value;
});

misiInput.addEventListener('input', () => {
    const lines = misiInput.value.split('\n').filter(l => l.trim() !== '');
    misiPreview.innerHTML = lines
        .map(l => `<li>${l.replace(/^\d+\.\s*/, '')}</li>`)
        .join('');
});
</script>

@endsection
