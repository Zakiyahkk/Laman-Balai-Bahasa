@extends('admin.layout')

@section('content')
<!-- ================= HEADER ================= -->
<div class="page-header d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="mb-1 text-white">Tokoh</h3>
        <p class="mb-0 text-white">Penginputan Tokoh-Tokoh Bahasa</p>
    </div>
    <img src="/img/logobbpr4.png" class="img-fluid header-logo">
</div>

<!-- ================= SEARCH + FILTER + ADD TOKOH ================= -->
<div class="d-flex justify-content-between align-items-center mb-4 gap-2">
  <div class="flex-grow-1">
    <div class="search-wrapper-inside">
      <i class="bi bi-search search-icon"></i>

      <form method="GET" action="{{ route('admin.tokoh') }}" class="flex-grow-1 m-0 p-0">
        <input
            type="text"
            name="search"
            id="searchField"
            placeholder="Cari tokoh..."
            class="search-input-inside"
            value="{{ request('search') }}"
            onkeydown="if(event.key === 'Enter'){ this.form.submit(); }"
        >
      </form>

      <button class="filter-btn-inside" id="filterToggle">
        <i class="bi bi-sliders"></i>
      </button>

      <div class="filter-dropdown" id="filterDropdown">
        <div class="filter-header">Kategori Tokoh</div>

        <a href="{{ request('search') ? '?search='.request('search').'&kategori=Tokoh Bahasa dan Sastra' : '?kategori=Tokoh Bahasa dan Sastra' }}"
            class="filter-item">
            Tokoh Bahasa & Sastra
        </a>
        <a href="{{ request('search') ? '?search='.request('search').'&kategori=Tokoh Sastra Lisan' : '?kategori=Tokoh Sastra Lisan' }}"
            class="filter-item">
          Tokoh Sastra Lisan
        </a>
        <a href="{{ request('search') ? '?search='.request('search').'&kategori=Komunitas Literasi' : '?kategori=Komunitas Literasi' }}"
            class="filter-item">
          Komunitas Literasi
        </a>
        <a href="{{ request('search') ? '?search='.request('search').'&kategori=Komunitas Sastra' : '?kategori=Komunitas Sastra' }}"
            class="filter-item">
          Komunitas Sastra
        </a>

        <div class="filter-divider"></div>

        <a href="{{ route('admin.tokoh') }}" class="filter-item text-danger">
          Reset Filter
        </a>
      </div>
    </div>
  </div>

  <button class="btn btn-add-article d-flex align-items-center ms-2"
          data-bs-toggle="modal"
          data-bs-target="#modalTambahTokoh">
    <span class="icon-plus">+</span> Tokoh
  </button>
</div>

<!-- ================= REKAP ================= -->
<div class="row g-3 mb-4">
    <div class="col-md-3"><div class="card p-3">{{ $countBahasa }}<br><small>Tokoh Bahasa & Sastra</small></div></div>
    <div class="col-md-3"><div class="card p-3">{{ $countLisan }}<br><small>Tokoh Sastra Lisan</small></div></div>
    <div class="col-md-3"><div class="card p-3">{{ $countLiterasi }}<br><small>Komunitas Literasi</small></div></div>
    <div class="col-md-3"><div class="card p-3">{{ $countKomunitas }}<br><small>Komunitas Sastra</small></div></div>
</div>

<!-- ================= LIST TOKOH ================= -->
<div class="tokoh-list-wrapper">
@forelse($tokoh as $item)
<div class="tokoh-card tokoh-clickable"
     onclick="openDetailTokoh(this)"
     data-id="{{ $item->tokoh_id }}"
     data-nama="{{ $item->nama }}"
     data-kategori="{{ $item->kategori }}"
     data-deskripsi="{{ $item->deskripsi ?? '' }}"
     data-foto="{{ $item->foto_tokoh ? asset($item->foto_tokoh) : asset('img/default-user.png') }}">

    <img src="{{ $item->foto_tokoh ? asset($item->foto_tokoh) : asset('img/default-user.png') }}"
         class="tokoh-avatar">

    <div class="tokoh-name-col">
        <div class="tokoh-nama">{{ $item->nama }}</div>
        <span class="tokoh-badge green">{{ $item->kategori }}</span>
    </div>

    <div class="tokoh-desc-col">
        {{ $item->deskripsi ?? '-' }}
    </div>

    <div class="publication-action" onclick="event.stopPropagation()">
        <button class="btn btn-outline-secondary btn-sm"
                title="Edit"
                onclick="event.stopPropagation(); openEditTokoh(this)">
            <i class="bi bi-pencil"></i>
        </button>


        <form action="{{ route('admin.tokoh.destroy',$item->tokoh_id) }}"
            method="POST"
            onsubmit="return confirmDeleteTokoh('{{ $item->nama }}', this)">
            @csrf
            @method('DELETE')
            <button class="btn btn-outline-danger btn-sm">
                <i class="bi bi-trash"></i>
            </button>
        </form>
    </div>
</div>
@empty
<p class="text-center text-muted">Belum ada data tokoh</p>
@endforelse
</div>

<!-- ================= MODAL DETAIL ================= -->
<div class="modal fade" id="modalDetailTokoh" tabindex="-1">
<div class="modal-dialog modal-lg modal-dialog-centered">
<div class="modal-content modal-tokoh">

<div class="modal-header border-0">
    <h5 class="modal-title">Detail Tokoh</h5>
    <button class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body tokoh-modal-body">
<div class="d-flex gap-4 align-items-start">
    <img id="detailFoto"
         style="width:160px; aspect-ratio:3/4; object-fit:cover"
         class="rounded-3">
    <div>
        <span id="detailKategori" class="tokoh-badge green mb-2"></span>
        <h4 id="detailNama" class="fw-bold mb-2"></h4>
        <p id="detailDeskripsi"></p>
    </div>
</div>
</div>

</div>
</div>
</div>

<!-- ================= MODAL EDIT ================= -->
<div class="modal fade" id="modalEditTokoh" tabindex="-1">
<div class="modal-dialog modal-lg modal-dialog-centered">
<form method="POST" enctype="multipart/form-data"
      class="modal-content modal-tokoh" id="formEditTokoh">
@csrf
@method('PUT')

<div class="modal-header border-0">
    <h5 class="modal-title">Edit Tokoh</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body tokoh-modal-body">

<div class="tokoh-form-top">
<div class="tokoh-photo-col">
    <label class="form-label">Foto</label>

    <div class="upload-wrapper">
        <label class="upload-box d-none" id="editUploadBox">
            <input type="file" id="editFotoInput" name="foto_tokoh" hidden>
            <div class="upload-content">
                <i class="bi bi-upload fs-2"></i>
                <span>Ganti foto</span>
                <small>PNG, JPG</small>
            </div>
        </label>

        <div class="photo-preview" id="editPhotoPreview">
            <img id="editPreviewImage">
            <button type="button" class="btn-remove-photo" id="editRemovePhoto">&times;</button>
        </div>
    </div>
</div>

<div class="tokoh-input-col">
    <label class="form-label">Nama</label>
    <input name="nama" id="editNama" class="form-control input-soft mb-3">

    <label class="form-label">Kategori</label>
    <select name="kategori" id="editKategori" class="form-select input-soft">
        <option>Tokoh Bahasa dan Sastra</option>
        <option>Tokoh Sastra Lisan</option>
        <option>Komunitas Literasi</option>
        <option>Komunitas Sastra</option>
    </select>
</div>
</div>

<div class="tokoh-desc-wrapper">
<label class="form-label">Deskripsi</label>
<textarea name="deskripsi" id="editDeskripsi"
          rows="4" class="form-control input-soft"></textarea>
</div>

</div>

<div class="modal-footer border-0">
<button class="btn btn-dark w-100 btn-submit-tokoh">
    Simpan Perubahan
</button>
</div>

</form>
</div>
</div>

<!-- ================= MODAL CREATE ================= -->
<div class="modal fade" id="modalTambahTokoh">
<div class="modal-dialog modal-lg modal-dialog-centered">
<form method="POST" action="{{ route('admin.tokoh.store') }}"
      enctype="multipart/form-data"
      class="modal-content modal-tokoh">
@csrf

<div class="modal-header border-0">
    <h5 class="modal-title">Tambah Tokoh Baru</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body tokoh-modal-body">
<div class="tokoh-form-top">

<div class="tokoh-photo-col">
    <label class="form-label">Foto</label>

    <div class="upload-wrapper">
        <label class="upload-box" id="uploadBox">
            <input type="file" id="fotoTokohInput" name="foto_tokoh" hidden>
            <div class="upload-content">
                <i class="bi bi-upload fs-2"></i>
                <span>Upload foto</span>
                <small>PNG, JPG</small>
            </div>
        </label>

        <div class="photo-preview d-none" id="photoPreview">
            <img id="previewImage">
            <button type="button" class="btn-remove-photo" id="removePhoto">&times;</button>
        </div>
    </div>
</div>

<div class="tokoh-input-col">
<label class="form-label">Nama</label>
<input name="nama" class="form-control input-soft mb-3">

<label class="form-label">Kategori</label>
<select name="kategori" class="form-select input-soft">
<option>Pilih kategori</option>
<option>Tokoh Bahasa dan Sastra</option>
<option>Tokoh Sastra Lisan</option>
<option>Komunitas Literasi</option>
<option>Komunitas Sastra</option>
</select>
</div>

</div>

<div class="tokoh-desc-wrapper">
<label class="form-label">Deskripsi</label>
<textarea name="deskripsi" rows="4" class="form-control input-soft"></textarea>
</div>
</div>

<div class="modal-footer border-0">
<button class="btn btn-dark w-100 btn-submit-tokoh">
Tambah Tokoh
</button>
</div>

</form>
</div>
</div>

<!-- ================= SCRIPT ================= -->
<script>
function openEditTokoh(btn) {
    const card = btn.closest('.tokoh-card');

    formEditTokoh.action = "{{ url('admin/tokoh') }}/" + card.dataset.id;

    editNama.value = card.dataset.nama;
    editKategori.value = card.dataset.kategori;
    editDeskripsi.value = card.dataset.deskripsi;
    editPreviewImage.src = card.dataset.foto;

    new bootstrap.Modal(modalEditTokoh).show();
}
</script>

<script>
// ===== CREATE PREVIEW =====
const inputFoto = document.getElementById('fotoTokohInput');
const uploadBox = document.getElementById('uploadBox');
const preview = document.getElementById('photoPreview');
const img = document.getElementById('previewImage');
const removeBtn = document.getElementById('removePhoto');

if (inputFoto) {
    inputFoto.addEventListener('change', () => {
        const file = inputFoto.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = e => {
            img.src = e.target.result;
            preview.classList.remove('d-none');
            uploadBox.classList.add('d-none');
        };
        reader.readAsDataURL(file);
    });

    removeBtn.addEventListener('click', () => {
        inputFoto.value = '';
        img.src = '';
        preview.classList.add('d-none');
        uploadBox.classList.remove('d-none');
    });
}

// ===== EDIT PREVIEW =====
const editInput = document.getElementById('editFotoInput');
const editUploadBox = document.getElementById('editUploadBox');
const editPreview = document.getElementById('editPhotoPreview');
const editImg = document.getElementById('editPreviewImage');
const editRemove = document.getElementById('editRemovePhoto');

editPreview.addEventListener('click', () => {
    editUploadBox.classList.remove('d-none');
    editPreview.classList.add('d-none');
});

editInput.addEventListener('change', () => {
    const file = editInput.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = e => {
        editImg.src = e.target.result;
        editPreview.classList.remove('d-none');
        editUploadBox.classList.add('d-none');
    };
    reader.readAsDataURL(file);
});

editRemove.addEventListener('click', () => {
    editInput.value = '';
    editPreview.classList.add('d-none');
    editUploadBox.classList.remove('d-none');
});
</script>

<script>
const modalDetailTokoh = document.getElementById('modalDetailTokoh');
const detailNama = document.getElementById('detailNama');
const detailKategori = document.getElementById('detailKategori');
const detailDeskripsi = document.getElementById('detailDeskripsi');
const detailFoto = document.getElementById('detailFoto');

function openDetailTokoh(el) {
    detailNama.innerText = el.dataset.nama;
    detailKategori.innerText = el.dataset.kategori;
    detailDeskripsi.innerText = el.dataset.deskripsi || '-';
    detailFoto.src = el.dataset.foto;

    new bootstrap.Modal(modalDetailTokoh).show();
}
</script>

<script>
document.addEventListener('click', function (e) {
    const toggle = document.getElementById('filterToggle');
    const dropdown = document.getElementById('filterDropdown');

    if (!toggle || !dropdown) return;

    if (toggle.contains(e.target)) {
        dropdown.classList.toggle('show');
    } else if (!dropdown.contains(e.target)) {
        dropdown.classList.remove('show');
    }
});
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    let deleteFormTarget = null;

    window.confirmDeleteTokoh = function (nama, formEl) {
        event.preventDefault();
        deleteFormTarget = formEl;

        document.getElementById("deleteText").innerHTML =
            "<span class='fw-light'>Apakah anda yakin ingin menghapus Tokoh </span>" +
            "<span class='fw-bold'>" + nama + "</span><span class='fw-light'>?</span>";

        const modal = document.getElementById("deleteModal");
        modal.style.display = "block";

        setTimeout(() => modal.classList.add("show"), 60);
        return false;
    };

    document.getElementById("btnYes").addEventListener("click", function () {
        if (deleteFormTarget) deleteFormTarget.submit();
    });

    document.getElementById("btnNo").addEventListener("click", function () {
        const modal = document.getElementById("deleteModal");
        modal.classList.remove("show");

        setTimeout(() => {
            modal.style.display = "none";
            deleteFormTarget = null;
        }, 600);
    });

});
</script>

<div id="deleteModal" class="delete-modal">
    <p id="deleteText"></p>
    <div class="d-flex justify-content-center gap-3 mt-4">
        <button id="btnYes" class="btn-yes">Ya</button>
        <button id="btnNo" class="btn-no">Tidak</button>
    </div>
</div>

{{-- NOTIFIKASI SLIDE-DOWN --}}
@if(session('success') || session('error'))
@php
    $msg = strtolower(session('success') ?? session('error'));
    $status = str_contains($msg, 'hapus') ? 'delete'
            : (str_contains($msg, 'tambah') ? 'terbit' : 'draf');
@endphp

<div id="notif-top" class="notif-top notif-{{ $status }}">
    {{ session('success') ?? session('error') }}
</div>
@endif

<script>
document.addEventListener("DOMContentLoaded", function () {
    const notif = document.getElementById("notif-top");
    if (!notif) return;

    // tampilkan
    notif.classList.add("show");

    // hilang perlahan
    setTimeout(() => {
        notif.classList.add("fade-out");
    }, 2500);

    // hapus dari DOM
    setTimeout(() => {
        notif.remove();
    }, 3000);
});
</script>


@endsection
