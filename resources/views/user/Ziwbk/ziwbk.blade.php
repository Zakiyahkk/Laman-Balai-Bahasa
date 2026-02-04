@extends('layouts.user')

@section('title', 'ZI-WBK ' . strtoupper($sub))

@section('content')

<style>
/* ===============================
   ZI-WBK INLINE STYLE (MODAL FIX)
================================ */

.ak-pk-ui {
    padding: 0 0 60px;
    font-family: 'Montserrat', sans-serif;
}

.ak-container {
    max-width: 1230px;
    margin: auto;
    padding: 0 20px;
}

/* ================= HEADER / BANNER ================= */
.ak-pagehead {
    background: #0b2a4a;
    color: #fff;
    padding: 30px 20px;
    margin: -24px -20px 20px;
    border-radius: 0 0 16px 16px;
}

.ak-pagehead h1 {
    margin: 0;
    font-size: 28px;
    font-weight: 800;
}

.ak-breadcrumb {
    margin-top: 6px;
    font-size: 13px;
    opacity: .85;
}

/* ================= CARD ================= */
.ak-card {
    background: #fff;
    border: 1px solid #e6ecf5;
    border-radius: 14px;
    box-shadow: 0 10px 30px rgba(16,24,40,.08);
    overflow: hidden;
}

.ak-card-section {
    padding: 16px 20px;
}

.ak-section-title {
    font-size: 17px;
    font-weight: 700;
}

.ak-section-subtitle {
    font-size: 13px;
    color: #6b7a90;
    margin-top: 4px;
}

/* ================= TABLE ================= */
.ak-thead,
.ak-row {
    display: grid;
    grid-template-columns: 1fr 90px 140px 90px 110px;
    padding: 14px 20px;
    align-items: center;
}

.ak-thead {
    font-size: 12px;
    color: #6b7a90;
    background: #fafbfd;
    border-top: 1px solid #e6ecf5;
    border-bottom: 1px solid #e6ecf5;
}

.ak-row {
    border-bottom: 1px solid #e6ecf5;
}

.ak-docname {
    font-size: 13px;
    line-height: 1.4;
}

.ak-badge {
    background: #eaf2ff;
    color: #2d5aa6;
    padding: 6px 10px;
    border-radius: 999px;
    font-size: 12px;
    text-align: center;
}

.ak-filepill {
    padding: 6px 10px;
    border-radius: 999px;
    border: 1px solid #e6ecf5;
    font-size: 12px;
    text-align: center;
}

/* ================= AKSI ================= */
.ak-action {
    display: flex;
    gap: 8px;
    justify-content: center;
}

.ak-download {
    width: 36px;
    height: 36px;
    display: grid;
    place-items: center;
    border-radius: 10px;
    border: 1px solid #e6ecf5;
    color: #64748b;
    text-decoration: none;
    cursor: pointer;
}

.ak-download:hover {
    background: #f0f7ff;
    color: #1d5aa6;
    border-color: #1d5aa6;
}

/* ================= MODAL ================= */
.ak-modal {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,.65);
    z-index: 9999;
    align-items: center;
    justify-content: center;
}

.ak-modal-box {
    width: 90%;
    height: 90%;
    background: #fff;
    border-radius: 16px;
    position: relative;
    padding: 14px;
}

.ak-modal-close {
    position: absolute;
    top: 10px;
    right: 16px;
    font-size: 28px;
    cursor: pointer;
    color: #444;
}

.ak-modal iframe {
    width: 100%;
    height: 100%;
    border-radius: 12px;
    border: none;
}

/* ================= EMPTY ================= */
.ak-empty {
    padding: 24px;
    text-align: center;
    color: #6b7a90;
}

/* ================= MOBILE ================= */
@media (max-width: 820px) {
    .ak-thead { display: none; }

    .ak-row {
        grid-template-columns: 1fr;
        gap: 10px;
        margin: 12px;
        border: 1px solid #e6ecf5;
        border-radius: 12px;
    }

    .ak-docname {
        font-weight: 600;
        border-bottom: 1px solid #eee;
        padding-bottom: 8px;
    }

    .ak-action {
        justify-content: flex-start;
    }
}
</style>

<script>
function openPreview(url) {
    document.getElementById('modalFrame').src = url;
    document.getElementById('previewModal').style.display = 'flex';
}

function closePreview() {
    document.getElementById('previewModal').style.display = 'none';
    document.getElementById('modalFrame').src = '';
}
</script>

<div class="ak-pk-ui">
    <div class="ak-container">

        {{-- BANNER --}}
        <div class="ak-pagehead">
            <h1>ZI-WBK {{ $tahun }}</h1>
            <div class="ak-breadcrumb">
                {{ ucwords(str_replace('-', ' ', $area)) }} /
                {{ ucwords(str_replace('-', ' ', $sub)) }}
            </div>
        </div>

        {{-- CARD --}}
        <div class="ak-card">

            <div class="ak-card-section">
                <div class="ak-section-title">Daftar Dokumen</div>
                <div class="ak-section-subtitle">Dokumen ZI-WBK yang tersedia</div>
            </div>

            <div class="ak-thead">
                <div>Nama Dokumen</div>
                <div>Tahun</div>
                <div>Pilar</div>
                <div>File</div>
                <div>Aksi</div>
            </div>

            @forelse ($dokumen as $item)
            <div class="ak-row">
                <div class="ak-docname">{{ $item->judul }}</div>
                <div><span class="ak-badge">{{ $item->tahun }}</span></div>
                <div>{{ ucwords(str_replace('-', ' ', $item->pilar)) }}</div>
                <div><span class="ak-filepill">PDF</span></div>

                <div class="ak-action">
                    {{-- TINJAU POPUP --}}
                    <a onclick="openPreview('{{ asset('storage/'.$item->file) }}')"
                       class="ak-download"
                       title="Tinjau">
                        <i class="fa fa-eye"></i>
                    </a>

                    {{-- UNDUH --}}
                    <a href="{{ asset('storage/'.$item->file) }}"
                       download
                       class="ak-download"
                       title="Unduh">
                        <i class="fa fa-download"></i>
                    </a>
                </div>
            </div>
            @empty
            <div class="ak-empty">Dokumen belum tersedia</div>
            @endforelse

        </div>
    </div>
</div>

{{-- MODAL --}}
<div id="previewModal" class="ak-modal" onclick="closePreview()">
    <div class="ak-modal-box" onclick="event.stopPropagation()">
        <span class="ak-modal-close" onclick="closePreview()">&times;</span>
        <iframe id="modalFrame"></iframe>
    </div>
</div>

@endsection