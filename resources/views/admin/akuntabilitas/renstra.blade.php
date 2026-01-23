@extends('admin.layout')

@section('content')
<style>
    /* 1. Header & Typography */
    .header-wrapper {
        display: flex;
        align-items: center;
        margin-bottom: 8px;
    }
    .header-icon-box {
        background-color: #e5f1ff;
        color: #067ac1;
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        margin-right: 15px;
    }
    .header-title-box h3 {
        font-size: 24px;
        font-weight: 800;
        color: #1a1a1a;
        margin-bottom: 0;
    }
    .header-subtitle {
        font-size: 13px;
        color: #8e94a3;
        display: block;
        margin-top: -2px;
    }
    .page-description {
        font-size: 14px;
        color: #64748b;
        margin-bottom: 25px;
        padding-left: 2px;
    }

    /* 2. Toolbar Simetris (45px) */
    .toolbar-container {
        display: flex;
        gap: 12px;
        align-items: center;
        margin-bottom: 25px;
    }
    .search-group-fixed {
        position: relative;
        flex: 1;
    }
    .search-group-fixed i {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
    }
    .search-group-fixed input {
        width: 100%;
        height: 45px;
        padding-left: 45px !important;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        background-color: #ffffff;
        font-size: 14px;
    }
    .btn-custom-header {
        height: 45px;
        border-radius: 12px;
        padding: 0 20px;
        font-weight: 700;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 8px;
        border: 1px solid #e2e8f0;
    }

    /* 3. Table & Card Style */
    .renstra-card {
        background: white;
        border-radius: 15px;
        border: 1px solid #f0f0f0;
        overflow: hidden;
    }
    .renstra-table thead th {
        background-color: #fcfcfc;
        color: #64748b;
        font-size: 11px;
        text-transform: uppercase;
        padding: 15px 25px;
        border-bottom: 1px solid #f1f5f9;
        font-weight: 700;
    }
    .renstra-table tbody td {
        padding: 20px 25px;
        vertical-align: middle;
        border-bottom: 1px solid #f8f9fa;
        font-size: 14px;
    }
    .pdf-icon-bg {
        background-color: #f0f7ff;
        color: #067ac1;
        padding: 10px;
        border-radius: 8px;
        margin-right: 15px;
    }

    /* 4. Perbaikan Pagination (Clean & No Border) */
    .pagination-wrapper {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 25px;
        background-color: #ffffff;
    }
    .pagination-info {
        color: #64748b;
        font-size: 13px;
        font-weight: 500;
    }
    .pagination-sm .page-link {
        border: none;
        color: #64748b;
        font-weight: 600;
        padding: 6px 14px;
        border-radius: 8px !important;
        margin: 0 2px;
    }
    .pagination-sm .page-item.active .page-link {
        background-color: #0d6efd !important;
        color: #ffffff !important;
        box-shadow: 0 4px 10px rgba(13, 110, 253, 0.2);
    }
    .pagination-sm .page-item.disabled .page-link {
        background-color: transparent;
        color: #cbd5e1;
    }

    /* 5. Badges & Info Box */
    .badge-status {
        font-size: 11px;
        font-weight: 700;
        padding: 6px 16px;
        border-radius: 20px;
    }
    .status-published { background-color: #ecfdf5; color: #10b981; }
    .status-review { background-color: #fffbeb; color: #d97706; }

    .info-section {
        background-color: #eff6ff;
        border-radius: 15px;
        padding: 20px;
        margin-top: 30px;
        display: flex;
        align-items: flex-start;
        border: 1px solid #dbeafe;
    }
</style>

<div class="container-fluid py-3">
    <div class="header-wrapper">
        <div class="header-icon-box shadow-sm">
            <i class="fas fa-file-invoice fs-4"></i>
        </div>
        <div class="header-title-box">
            <h3>RENSTRA (Rencana Strategis)</h3>
            <span class="header-subtitle">Menu Akuntabilitas</span>
        </div>
    </div>
    <p class="page-description">Kelola dokumen Rencana Strategis organisasi untuk periode jangka menengah dan panjang</p>

    <div class="toolbar-container d-flex align-items-center gap-2">
    <div class="search-group-fixed me-auto">
        <i class="fas fa-search"></i>
        <input type="text" class="form-control shadow-sm" placeholder="Cari dokumen...">
    </div>
    
    <select class="form-select shadow-sm" style="height: 45px; border-radius: 12px; width: auto; min-width: 130px; font-size: 14px;">
        <option value="">Semua Status</option>
        <option value="Terbit" {{ request('kategori') == 'kegiatan' ? 'selected' : '' }}>Terbit</option>
        <option value="Tinjau" {{ request('kategori') == 'publikasi' ? 'selected' : '' }}>Tinjau</option>
        <option value="Draft" {{ request('kategori') == 'dokumentasi' ? 'selected' : '' }}>Draft</option>
     </select>

    <button class="btn btn-light btn-custom-header shadow-sm" style="background-color: white;">
        <i class="fas fa-download"></i> Export
    </button>

    <button class="btn btn-primary btn-custom-header border-0 shadow-sm" style="background-color: #0d6efd;">
        <i class="fas fa-plus"></i> Tambah Dokumen
    </button>
</div>

    <div class="renstra-card shadow-sm">
        <div class="table-responsive">
            <table class="table renstra-table mb-0">
                <thead>
                    <tr>
                        <th width="32%">Nama Dokumen</th>
                        <th width="33%">Tulisan/Deskripsi</th>
                        <th width="15%">Tanggal</th>
                        <th width="10%">Status</th>
                        <th width="10%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="pdf-icon-bg"><i class="fas fa-file-pdf fs-5"></i></div>
                                <span class="fw-bold">Rencana Strategis 2026-2030</span>
                            </div>
                        </td>
                        <td class="text-muted small">Dokumen perencanaan strategis lima tahun mencakup visi, misi, dan tujuan organisasi</td>
                        <td class="text-secondary small">5 Januari 2026</td>
                        <td><span class="badge-status status-review">Tinjau</span></td>
                        <td>
                            <div class="d-flex justify-content-center gap-3">
                                <a href="#" class="text-primary"><i class="far fa-edit"></i></a>
                                <a href="#" class="text-secondary"><i class="far fa-share-square"></i></a>
                                <a href="#" class="text-danger"><i class="far fa-trash-alt"></i></a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="pdf-icon-bg"><i class="fas fa-file-pdf fs-5"></i></div>
                                <span class="fw-bold">Review Renstra 2021-2025</span>
                            </div>
                        </td>
                        <td class="text-muted small">Evaluasi pencapaian rencana strategis periode sebelumnya</td>
                        <td class="text-secondary small">20 Desember 2025</td>
                        <td><span class="badge-status status-published">Terbit</span></td>
                        <td>
                            <div class="d-flex justify-content-center gap-3">
                                <a href="#" class="text-primary"><i class="far fa-edit"></i></a>
                                <a href="#" class="text-secondary"><i class="far fa-share-square"></i></a>
                                <a href="#" class="text-danger"><i class="far fa-trash-alt"></i></a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <div class="d-flex justify-content-between align-items-center px-4 py-3 border-top bg-light bg-opacity-10">
            <small class="text-muted">Menampilkan 1 - 2 dari 2 dokumen</small>
            <nav>
                <ul class="pagination pagination-sm mb-0">
                    <li class="page-item "><a class="page-link border-0" href="#">Previous</a></li>
                    <li class="page-item active"><a class="page-link rounded-2 shadow-sm border-0" href="#" style="background-color: #0d6efd;">1</a></li>
                    <li class="page-item"><a class="page-link border-0" href="#">Next</a></li>
                </ul>
            </nav>
        </div>
    </div>

    <div class="info-section shadow-sm">
        <i class="fas fa-info-circle text-primary fs-5 me-3 mt-1"></i>
        <div>
            <h5 class="fw-bold text-primary mb-1" style="font-size: 16px;">Informasi</h5>
            <p class="text-dark mb-0 opacity-75" style="font-size: 14px; line-height: 1.6;">
                Renstra merupakan dokumen perencanaan yang memuat visi, misi, tujuan, strategi, kebijakan, program dan kegiatan pembangunan sesuai dengan tugas dan fungsi organisasi untuk periode 5 tahun.
            </p>
        </div>
    </div>
</div>
@endsection