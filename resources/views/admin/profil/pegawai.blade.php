@extends('admin.layout')

@section('content')

<!-- ================= HEADER ================= -->
<div class="page-header d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="mb-1" style="color:#ffffff;">Data Pegawai</h3>
        <p class="mb-0" style="color:#ffffff;">Kelola data pegawai BBP Riau</p>
    </div>
    <img src="/img/logobbpr4.png" class="header-logo">
</div>

{{-- ================= SEARCH + TAMBAH ================= --}}
<div class="d-flex justify-content-between align-items-center mb-4 gap-2">
    <div class="flex-grow-1">
        <div class="search-wrapper-inside">
            <i class="bi bi-search search-icon"></i>
            <form method="GET" action="{{ route('admin.profil.pegawai') }}" class="m-0">
                <input type="text"
                       name="search"
                       placeholder="Cari pegawai berdasarkan nama atau jabatan"
                       class="search-input-inside"
                       value="{{ request('search') }}">
            </form>
        </div>
    </div>
    <button class="btn-add-article d-flex align-items-center"
            data-bs-toggle="modal"
            data-bs-target="#modalTambahPegawai">
        <span class="icon-plus">+</span> Pegawai
    </button>
</div>

{{-- ================= JABATAN STRATEGIS ================= --}}
<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-body p-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="fw-semibold mb-0">Jabatan Strategis</h5>
            <button id="btnEditStrategis"
                    class="btn btn-outline-dark btn-sm btn-action-fixed">
                <i class="bi bi-pencil"></i> Edit
            </button>
        </div>

        <div class="row g-4">

            {{-- KEPALA BALAI --}}
            <div class="col-md-6">
                <div class="card pegawai-card p-3 text-center h-100">

                    <div class="avatar-wrapper mx-auto mb-2">
    @if($kepalaBalai ?? null)
        <img src="{{ $kepalaBalai['foto'] }}" class="avatar-img">
    @else
        <div class="avatar-img d-flex align-items-center justify-content-center bg-light">
            <i class="bi bi-person fs-1 text-muted"></i>
        </div>
    @endif
</div>

<div class="fw-semibold">
    {{ $kepalaBalai['nama'] ?? 'Belum ada Kepala Balai' }}
</div>


                    <div class="text-muted small">Kepala Balai</div>
                </div>
            </div>

            {{-- KASUBBAG UMUM --}}
            <div class="col-md-6">
                <div class="card pegawai-card p-3 text-center h-100">

                    <div class="avatar-wrapper mx-auto mb-2">
                        @if($kasubbagUmum)
                            <img src="{{ $kasubbagUmum['foto'] }}" class="avatar-img">
                        @else
                            <div class="avatar-img d-flex align-items-center justify-content-center bg-light">
                                <i class="bi bi-person fs-1 text-muted"></i>
                            </div>
                        @endif
                    </div>

                    <div class="fw-semibold">
                        {{ $kasubbagUmum['nama'] ?? 'Belum ada Kasubbag Umum' }}
                    </div>

                    <div class="text-muted small">Kasubbag Umum</div>
                </div>
            </div>

        </div>

    </div>
</div>


<!-- ================= LIST PEGAWAI ================= -->
<div class="row g-3">
@forelse ($pegawai as $item)
<div class="col-pegawai">
    <div class="card pegawai-card p-3 text-center">
        <div>
            <div class="avatar-wrapper mx-auto mb-2">
                <img src="{{ $item['foto'] }}" class="avatar-img">
            </div>
            <div class="fw-semibold text-limit-2">{{ $item['nama'] }}</div>
            <div class="text-muted small text-limit-2">{{ $item['jabatan'] }}</div>
        </div>
        <div class="d-flex justify-content-center gap-2 mt-auto">
            <!-- HAPUS -->
            <form method="POST"
                action="{{ route('admin.profil.pegawai.destroy', $item['pegawai_id']) }}"
                class="form-delete-pegawai"
                data-nama="{{ $item['nama'] }}">
                @csrf @method('DELETE')
                <button class="btn btn-outline-danger btn-sm btn-action-fixed">
                    <i class="bi bi-trash"></i> Hapus
                </button>
            </form>
            <!-- EDIT -->
            <button class="btn btn-outline-dark btn-sm btn-action-fixed btn-edit-pegawai"
                    data-id="{{ $item['pegawai_id'] }}"
                    data-nama="{{ $item['nama'] }}"
                    data-jabatan="{{ $item['jabatan'] }}"
                    data-foto="{{ $item['foto'] }}">
                <i class="bi bi-pencil"></i> Edit
            </button>
        </div>
    </div>
</div>
@empty
<div class="col-12 text-center text-muted">Belum ada data pegawai</div>
@endforelse
</div>

{{-- ================= NOTIFIKASI ================= --}}
@if(session('success') || session('error'))
@php
$msg = strtolower(session('success') ?? session('error'));

if (str_contains($msg,'hapus')) {
    $status = 'delete';
} elseif (str_contains($msg,'tambah')) {
    $status = 'add';
} elseif (str_contains($msg,'perbarui') || str_contains($msg,'ubah')) {
    $status = 'update';
} else {
    $status = 'info';
}
@endphp
<div id="notif-top" class="notif-top notif-{{ $status }}">
    {{ session('success') ?? session('error') }}
</div>
@endif

{{-- ================= MODAL DELETE ================= --}}
<div id="deleteModal" class="delete-modal">
    <p id="deleteText"></p>
    <div class="d-flex justify-content-center gap-3 mt-4">
        <button id="btnYes" class="btn-yes">Ya</button>
        <button id="btnNo" class="btn-no">Tidak</button>
    </div>
</div>

{{-- ================= MODAL EDIT JABATAN STRATEGIS ================= --}}
<div class="modal fade" id="modalEditStrategis" tabindex="-1">
<div class="modal-dialog modal-lg modal-dialog-centered">
<div class="modal-content">

<form method="POST"
      action="{{ route('admin.profil.pegawai.updateStrategis') }}"
      enctype="multipart/form-data">
@csrf @method('PUT')

<div class="modal-header">
    <h5 class="modal-title">Edit Jabatan Strategis</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">
<div class="row g-4">

{{-- ================= KEPALA BALAI ================= --}}
<div class="col-md-6">
    <h6 class="fw-semibold mb-3" style="color:#067ac1">Kepala Balai</h6>

    <input type="hidden"
           name="kepala_id"
           value="{{ $kepalaBalai['pegawai_id'] ?? '' }}">

    <div class="mb-3">
        <label class="fw-semibold">Nama</label>
        <input name="kepala_nama"
               class="form-control"
               value="{{ $kepalaBalai['nama'] ?? '' }}">
    </div>
    <div class="mb-3">
        <label class="fw-semibold">Foto (opsional)</label>
        <input type="file"
               name="kepala_foto"
               class="form-control"
               onchange="previewImage(this, 'previewKepala')">
    </div>
     <div class="mb-2 text-center">
        @if(!empty($kepalaBalai['foto']))
            <img id="previewKepala"
                 src="{{ $kepalaBalai['foto'] }}"
                 style="width:96px;height:96px;border-radius:50%;object-fit:cover">
        @else
            <i id="previewKepala"
               class="bi bi-person-circle fs-1 text-muted"></i>
        @endif
    </div>
</div>

{{-- ================= KASUBBAG UMUM ================= --}}
<div class="col-md-6">
    <h6 class="fw-semibold mb-3" style="color:#067ac1">Kasubbag Umum</h6>

    <input type="hidden"
           name="kasubbag_id"
           value="{{ $kasubbagUmum['pegawai_id'] ?? '' }}">

    <div class="mb-3">
        <label class="fw-semibold">Nama</label>
        <input name="kasubbag_nama"
               class="form-control"
               value="{{ $kasubbagUmum['nama'] ?? '' }}">
    </div>
    <div class="mb-3">
        <label class="fw-semibold">Foto (opsional)</label>
        <input type="file"
               name="kasubbag_foto"
               class="form-control"
               onchange="previewImage(this, 'previewKasubbag')">
    </div>
    <div class="mb-2 text-center">
        @if(!empty($kasubbagUmum['foto']))
            <img id="previewKasubbag"
                 src="{{ $kasubbagUmum['foto'] }}"
                 style="width:96px;height:96px;border-radius:50%;object-fit:cover">
        @else
            <i id="previewKasubbag"
               class="bi bi-person-circle fs-1 text-muted"></i>
        @endif
    </div>
</div>

</div>
</div>

<div class="modal-footer">
    <button class="btn btn-action btn-save">Simpan</button>
</div>

</form>
</div>
</div>
</div>

{{-- ================= MODAL TAMBAH ================= --}}
<div class="modal fade" id="modalTambahPegawai" tabindex="-1">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">
<form method="POST" action="{{ route('admin.profil.pegawai.store') }}" enctype="multipart/form-data">
@csrf
<div class="modal-header">
    <h5 class="modal-title">Tambah Pegawai</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>
<div class="modal-body">
    <div class="mb-3">
        <label class="fw-semibold">Nama Pegawai</label>
        <input name="nama" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="fw-semibold">Jabatan</label>
        <input name="jabatan" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="fw-semibold">Foto</label>
        <input type="file" name="foto" class="form-control" accept="image/*" required>
    </div>
</div>
<div class="modal-footer">
    <button class="btn btn-action btn-save">Simpan</button>
</div>
</form>
</div>
</div>
</div>

{{-- ================= MODAL EDIT ================= --}}
<div class="modal fade" id="modalEditPegawai" tabindex="-1">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">
<form method="POST" id="formEditPegawai" enctype="multipart/form-data">
@csrf @method('PUT')

<div class="modal-header">
    <h5 class="modal-title">Edit Pegawai</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>
<div class="modal-body">
    <div class="mb-3">
        <label class="fw-semibold">Nama Pegawai</label>
        <input id="editNama" name="nama" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="fw-semibold">Jabatan</label>
        <input id="editJabatan" name="jabatan" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="fw-semibold">Foto Baru</label>
        <input type="file"
            name="foto"
            class="form-control"
            onchange="previewImage(this, 'previewFoto')">
    </div>

    <div class="text-center">
        <img id="previewFoto" style="width:96px;height:96px;border-radius:50%;">
    </div>
</div>
<div class="modal-footer">
    <button class="btn btn-action btn-save">Perbarui</button>
</div>
</form>
</div>
</div>
</div>

{{-- ================= SCRIPT ================= --}}
<script>
let deleteFormTarget = null;
/* === TANGKAP SUBMIT FORM DELETE === */
document.querySelectorAll('.form-delete-pegawai').forEach(form => {
    form.addEventListener('submit', function (e) {
        e.preventDefault();

        deleteFormTarget = this;
        const nama = this.dataset.nama;

        document.getElementById("deleteText").innerHTML =
            "Apakah anda yakin ingin menghapus <br> pegawai <b>" + nama + "</b>?</br>";

        const modal = document.getElementById("deleteModal");
        modal.style.display = "block";

        setTimeout(() => {
            modal.classList.add("show");
        }, 50);
    });
});
/* === KLIK YA === */
document.getElementById("btnYes").addEventListener("click", function () {
    if (deleteFormTarget) {
        deleteFormTarget.submit();
    }
});
/* === KLIK TIDAK === */
document.getElementById("btnNo").addEventListener("click", function () {
    const modal = document.getElementById("deleteModal");
    modal.classList.remove("show");

    setTimeout(() => {
        modal.style.display = "none";
        deleteFormTarget = null;
    }, 500);
});
</script>

<script>
/* ================= EDIT PEGAWAI ================= */
document.querySelectorAll('.btn-edit-pegawai').forEach(btn => {
    btn.addEventListener('click', function (e) {
        e.stopPropagation(); // ⬅️ PENTING

        document.getElementById('editNama').value    = this.dataset.nama;
        document.getElementById('editJabatan').value = this.dataset.jabatan;
        document.getElementById('previewFoto').src   = this.dataset.foto;

        document.getElementById('formEditPegawai').action =
            `/admin/profil/pegawai/${this.dataset.id}`;

        bootstrap.Modal
            .getOrCreateInstance(document.getElementById('modalEditPegawai'))
            .show();
    });
});
</script>

<script>
document.getElementById('btnEditStrategis')
    ?.addEventListener('click', function () {

        bootstrap.Modal
            .getOrCreateInstance(
                document.getElementById('modalEditStrategis')
            )
            .show();
});
</script>


<script>
document.addEventListener("DOMContentLoaded", function () {
    const notif = document.getElementById("notif-top");

    if (notif) {
        notif.classList.add("show");

        // tampil 2,5 detik
        setTimeout(() => {
            notif.classList.add("fade-out");
        }, 2500);

        // hilang total
        setTimeout(() => {
            notif.remove();
        }, 3000);
    }
});
</script>

<script>
function previewImage(input, previewId) {
    const preview = document.getElementById(previewId);
    const file = input.files[0];

    if (!file) return;

    const reader = new FileReader();
    reader.onload = function (e) {
        if (preview.tagName === 'IMG') {
            preview.src = e.target.result;
        } else {
            const img = document.createElement('img');
            img.id = previewId;
            img.src = e.target.result;
            img.style.width = '96px';
            img.style.height = '96px';
            img.style.borderRadius = '50%';
            img.style.objectFit = 'cover';
            preview.replaceWith(img);
        }
    };
    reader.readAsDataURL(file);
}
</script>

<script>
/* ================= RESET MODAL SAAT DITUTUP ================= */
function resetModal(modalId, previewMap = {}) {
    const modal = document.getElementById(modalId);
    if (!modal) return;

    modal.addEventListener('hidden.bs.modal', function () {
        const form = modal.querySelector('form');
        if (form) form.reset();

        Object.entries(previewMap).forEach(([previewId, originalSrc]) => {
            const el = document.getElementById(previewId);
            if (!el) return;

            if (el.tagName === 'IMG') {
                el.src = originalSrc || '';
            }
        });
    });
}

const pegawaiData = document.getElementById('pegawaiData');

/* === EDIT PEGAWAI BIASA === */
resetModal('modalEditPegawai', {
    previewFoto: ''
});

/* === EDIT JABATAN STRATEGIS === */
resetModal('modalEditStrategis', {
    previewKepala: pegawaiData.dataset.kepalaFoto,
    previewKasubbag: pegawaiData.dataset.kasubbagFoto
});
</script>



@endsection
