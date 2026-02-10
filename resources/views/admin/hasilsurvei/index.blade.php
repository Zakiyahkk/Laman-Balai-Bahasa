@extends('admin.layout')
@php use Carbon\Carbon; @endphp

@section('content')

{{-- ================= HEADER ================= --}}
<div class="page-header d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="mb-1 text-white">Hasil Survei</h3>
        <p class="mb-0 text-white">
            Manajemen dokumen hasil survei
        </p>
    </div>

    <div class="header-logo">
        <img src="https://ppidbbpriau.kemendikdasmen.go.id/bbpr/img/logobbpr4.png"
             class="img-fluid header-logo">
    </div>
</div>

{{-- ================= SEARCH + TAMBAH ================= --}}
<div class="d-flex justify-content-between align-items-center mb-4 gap-2">

    <div class="flex-grow-1">
        <div class="search-wrapper-inside">
            <i class="bi bi-search search-icon"></i>
            <form method="GET"
                  action="{{ route('admin.hasilsurvei.index') }}"
                  class="flex-grow-1 m-0">
                <input type="text"
                       name="search"
                       placeholder="Cari judul hasil survei"
                       class="search-input-inside"
                       value="{{ request('search') }}">
            </form>
        </div>
    </div>

    <a href="{{ route('admin.hasilsurvei.create') }}"
       class="btn btn-add-article d-flex align-items-center ms-2">
        <span class="icon-plus">+</span> Hasil Survei
    </a>

</div>

{{-- ================= TABLE ================= --}}
<div class="admin-table-wrapper mb-4">
    <div class="card border-0 shadow-sm admin-table-card">
        <div class="card-body p-0">

            <table class="table mb-0 align-middle">
                <thead style="background:#f9fafb;">
                    <tr>
                        <th class="ps-4" style="width:48%">Judul Survei</th>
                        <th style="width:15%">Tanggal</th>
                        <th style="width:7%">Tipe</th>
                        <th style="width:8%">Status</th>
                        <th style="width:5%" class="text-center">Preview</th>
                        <th style="width:7%" class="text-center pe-4">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($hasilsurvei as $item)
                    <tr>

                        {{-- JUDUL --}}
                        <td class="ps-4">
                            <div class="d-flex align-items-center gap-3">
                                <div class="doc-icon">
                                    @if($item->tipe_file === 'pdf')
                                        <i class="fa-solid fa-file-pdf text-danger"></i>
                                    @elseif(in_array($item->tipe_file,['png','jpg','jpeg']))
                                        <i class="fa-solid fa-file-image text-primary"></i>
                                    @else
                                        <i class="fa-solid fa-file"></i>
                                    @endif
                                </div>
                                <span class="fw-semibold">
                                    {{ $item->judul_survei }}
                                </span>
                            </div>
                        </td>

                        {{-- TANGGAL --}}
                        <td>
                            {{ Carbon::parse($item->tanggal)
                                ->locale('id')
                                ->translatedFormat('d F Y') }}
                        </td>

                        {{-- TIPE --}}
                        <td>
                            <span class="badge bg-secondary text-uppercase">
                                {{ $item->tipe_file }}
                            </span>
                        </td>

                        {{-- STATUS --}}
                        <td>
                            <span class="badge {{ $item->status === 'terbit' ? 'badge-published' : 'badge-draft' }}">
                                {{ ucfirst($item->status) }}
                            </span>
                        </td>

                        {{-- PREVIEW --}}
                        <td class="text-center">
                            <button class="btn btn-link p-1 text-primary btn-preview"
                                    data-title="{{ $item->judul_survei }}"
                                    data-file="{{ $item->file_url }}">
                                <i class="bi bi-eye"></i>
                            </button>
                        </td>

                        {{-- AKSI --}}
                        <td class="text-center pe-4">
                            <div class="d-flex justify-content-center align-items-center gap-1">

                                <a href="{{ route('admin.hasilsurvei.edit',$item->id) }}"
                                   class="btn btn-link text-secondary p-1">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <a href="{{ route('admin.hasilsurvei.download',$item->id) }}"
                                   class="btn btn-link text-success p-1">
                                    <i class="bi bi-download"></i>
                                </a>

                                <form action="{{ route('admin.hasilsurvei.destroy',$item->id) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirmDelete('{{ $item->judul_survei }}', this)">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-link text-danger p-1">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>

                            </div>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            Belum ada data hasil survei
                        </td>
                    </tr>
                @endforelse
                </tbody>

            </table>

        </div>
    </div>
</div>

{{-- ================= MODAL PREVIEW ================= --}}
<div class="modal fade" id="previewModal" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0 rounded-4">
            <div class="modal-header">
                <h5 class="modal-title" id="previewTitle">Preview Dokumen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body p-0" style="height:80vh; background:#f1f5f9;">
                <iframe id="previewFrame"
                        style="width:100%;height:100%;border:none;display:none;"></iframe>

                <img id="previewImage"
                     style="max-width:100%;
                            max-height:100%;
                            margin:auto;
                            display:none;
                            object-fit:contain;
                            background:#fff;">
            </div>
        </div>
    </div>
</div>

{{-- ================= NOTIFIKASI (SAMA DENGAN PUBLIKASI) ================= --}}
@if(session('success') || session('error'))
@php
    $msg = strtolower(session('success') ?? session('error'));
    $status = str_contains($msg,'hapus') ? 'delete'
            : (str_contains($msg,'draf') ? 'draf' : 'terbit');
@endphp
<div id="notif-top" class="notif-top notif-{{ $status }}">
    {{ session('success') ?? session('error') }}
</div>
@endif

{{-- ================= MODAL DELETE (PERSIS PUBLIKASI) ================= --}}
<div id="deleteModal" class="delete-modal">
    <p id="deleteText"></p>
    <div class="d-flex justify-content-center gap-3 mt-4">
        <button id="btnYes" class="btn-yes">Ya</button>
        <button id="btnNo" class="btn-no">Tidak</button>
    </div>
</div>

{{-- ================= SCRIPT ================= --}}
<script>
document.addEventListener('click', e => {
    const btn = e.target.closest('.btn-preview');
    if (!btn) return;

    const file  = btn.dataset.file;
    const title = btn.dataset.title;

    const iframe = document.getElementById('previewFrame');
    const img    = document.getElementById('previewImage');

    document.getElementById('previewTitle').innerText = title;

    // reset
    iframe.style.display = 'none';
    iframe.src = '';
    img.style.display = 'none';
    img.src = '';

    const ext = file.split('.').pop().toLowerCase();

    // IMAGE
    if (['jpg','jpeg','png','webp'].includes(ext)) {
        img.src = file;
        img.style.display = 'block';
    }
    // PDF
    else {
        iframe.src = file + '#toolbar=0&navpanes=0&scrollbar=1';
        iframe.style.display = 'block';
    }

    new bootstrap.Modal(document.getElementById('previewModal')).show();
});
</script>

{{-- ================= NOTIFIKASI ================= --}}
@if(session('success') || session('error'))
@php
    $msg = strtolower(session('success') ?? session('error'));
    $status = str_contains($msg,'hapus') ? 'delete'
            : (str_contains($msg,'draf') ? 'draf' : 'terbit');
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

<style>
/* ===== NOTIF ===== */
.notif-top {
    position: fixed;
    top: -80px;
    left: 50%;
    transform: translateX(-50%);
    padding: 18px 32px;
    border-radius: 10px;
    font-size: 17px;
    font-weight: 600;
    min-width: 330px;
    text-align: center;
    z-index: 10000;
    box-shadow: 0 4px 14px rgba(0,0,0,0.15);
}
.notif-terbit { background: #0dbf4e; color: #fff; }
.notif-draf   { background: #f9a703; color: #fff; }
.notif-delete { background: #d9534f; color: #fff; }

@keyframes slideDown {
    from { top: -80px; opacity: 0; }
    to   { top: 40px; opacity: 1; }
}
.notif-top.show {
    animation: slideDown 0.6s ease forwards;
}
.notif-top.fade-out {
    opacity: 0;
    transition: 0.4s;
}

/* ===== DELETE MODAL ===== */
.delete-modal {
    display: none;
    position: fixed;
    top: -150px;
    left: 50%;
    transform: translateX(-50%);
    background: #fef8eb;
    padding: 32px;
    border-radius: 14px;
    width: 460px;
    text-align: center;
    font-size: 18px;
    font-weight: 600;
    z-index: 20000;
    opacity: 0;
    box-shadow: 0 6px 26px rgba(0,0,0,0.22);
    transition: 0.6s ease;
}
.delete-modal.show {
    top: 50%;
    opacity: 1;
    transform: translate(-50%, -50%);
}

.btn-yes, .btn-no {
    min-width: 140px;
    height: 46px;
    border-radius: 10px;
    font-weight: 600;
    font-size: 16px;
}
.btn-yes {
    background: #fff;
    border: 2px solid #d9534f;
    color: #d9534f;
}
.btn-no {
    background: #0485c7;
    border: none;
    color: #fff;
}
</style>

<script>
let deleteFormTarget = null;

function confirmDelete(judul, formEl) {
    event.preventDefault();
    deleteFormTarget = formEl;

    document.getElementById("deleteText").innerHTML =
    "<div class='fw-light mb-2'>Apakah anda yakin ingin menghapus</div>" +
        "<div class='fw-bold'>" + judul + "?</div>";

    const modal = document.getElementById("deleteModal");
    modal.style.display = "block";
    setTimeout(() => modal.classList.add("show"), 50);
    return false;
}

document.getElementById("btnYes").onclick = () => {
    if (deleteFormTarget) deleteFormTarget.submit();
};

document.getElementById("btnNo").onclick = () => {
    const modal = document.getElementById("deleteModal");
    modal.classList.remove("show");
    setTimeout(() => modal.style.display = "none", 600);
};

// AUTO CLOSE NOTIF
document.addEventListener("DOMContentLoaded", () => {
    const notif = document.getElementById("notif-top");
    if (!notif) return;

    notif.classList.add("show");
    setTimeout(() => notif.classList.add("fade-out"), 2500);
    setTimeout(() => notif.remove(), 3000);
});
</script>


@endsection
