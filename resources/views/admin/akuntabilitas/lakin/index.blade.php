@extends('admin.layout')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    /* Global Styling */
    .content-wrapper {
        font-family: 'Inter', sans-serif;
        background-color: #f8faff;
        padding: 2.5rem;
        min-height: 100vh;
    }

    /* Header Section */
    .header-box { display: flex; align-items: flex-start; gap: 18px; margin-bottom: 30px; }
    .icon-container {
        background-color: #e0eaff;
        color: #2563eb;
        width: 44px;
        height: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        font-size: 20px;
    }

    /* Toolbar Styling */
    .toolbar { display: flex; gap: 15px; margin-bottom: 25px; align-items: center; }
    .search-wrapper { position: relative; flex: 1; }
    .search-wrapper i { position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: #94a3b8; }
    
    .form-control-custom {
        height: 48px;
        border-radius: 10px;
        border: 1px solid #e2e8f0;
        padding-left: 45px;
        font-size: 14px;
        width: 100%;
        background: white;
        outline: none;
    }

    .btn-primary-custom {
        background-color: #1d4ed8;
        color: #ffffff !important;
        height: 48px;
        padding: 0 20px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        transition: all 0.2s;
        border: none;
        white-space: nowrap;
    }
    .btn-primary-custom:hover { background-color: #1e40af; opacity: 0.9; }

    /* Table Styling */
    .table-card { background: white; border-radius: 12px; border: 1px solid #eef2f7; overflow: hidden; box-shadow: 0 2px 4px rgba(0,0,0,0.02); }
    .custom-table thead th {
        background-color: #fcfdfe;
        color: #8e9aaf;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        padding: 15px 24px;
        border-bottom: 1px solid #f1f5f9;
    }
    .custom-table tbody td { padding: 18px 24px; vertical-align: middle; border-bottom: 1px solid #f8fafc; font-size: 14px; }
    
    .doc-icon-box {
        background-color: #e8f1ff;
        color: #3b82f6;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        margin-right: 15px;
        font-size: 18px;
    }

    .action-btn {
        width: 36px; height: 36px;
        display: flex; align-items: center; justify-content: center;
        border-radius: 8px; border: 1px solid #e2e8f0;
        background-color: white; transition: all 0.2s;
        text-decoration: none; cursor: pointer;
    }
    .btn-edit:hover { background-color: #f1f5f9; }
    .btn-download:hover { background-color: #f0fdf4; border-color: #bbf7d0; }
    .btn-delete:hover { background-color: #fef2f2; border-color: #fecaca; }

    .text-edit { color: #64748b; }
    .text-download { color: #22c55e; }
    .text-delete { color: #ef4444; }

    .status-badge { padding: 5px 12px; border-radius: 8px; font-size: 12px; font-weight: 600; }
    .bg-published { background-color: #ecfdf5; color: #10b981; }
    .bg-draft { background-color: #fffbeb; color: #f59e0b; }

    .info-box {
        background-color: #eef6ff; border: 1px solid #dbeafe; border-radius: 12px;
        padding: 20px; margin-top: 25px; display: flex; align-items: flex-start; gap: 15px;
    }
    .pagination-wrapper { padding: 15px 24px; display: flex; justify-content: space-between; align-items: center; background: white; border-top: 1px solid #f1f5f9; }
</style>

<div class="content-wrapper">
    <div class="header-box">
        <div class="icon-container shadow-sm"><i class="fa-solid fa-file-lines"></i></div>
        <div class="header-text">
            <h3 class="m-0">LAKIN (Laporan Kinerja)</h3>
            <p class="fw-medium m-0 text-muted">Menu Akuntabilitas</p>
            <p class="text-secondary mt-1 small">Kelola dokumen Laporan Kinerja instansi pemerintah secara berkala</p>
        </div>
    </div>

    <div class="toolbar">
        <div class="search-wrapper">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" id="searchInput" class="form-control-custom shadow-sm" placeholder="Cari nama dokumen atau deskripsi...">
        </div>

        <a href="{{ route('admin.akuntabilitas.create') }}" class="btn-primary-custom shadow-sm">
            <i class="fa-solid fa-plus"></i> Tambah Dokumen
        </a>

        <select id="statusFilter" class="form-control-custom shadow-sm" style="width: 180px; padding-left: 15px; cursor: pointer;">
            <option value="all">Semua Status</option>
            <option value="published">Published</option>
            <option value="draft">Draft</option>
        </select>
    </div>

    <div class="table-card shadow-sm">
        <table class="table custom-table mb-0" id="documentTable">
            <thead>
                <tr>
                    <th width="30%">Nama Dokumen</th>
                    <th width="35%">Tulisan/Deskripsi</th>
                    <th width="15%">Tanggal</th>
                    <th width="10%">Status</th>
                    <th width="10%" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($akuntabilitas as $item)
                <tr class="document-row" data-status="{{ strtolower($item->status) }}">
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="doc-icon-box">
                                <i class="fa-solid {{ Str::endsWith($item->file_path, '.pdf') ? 'fa-file-pdf' : 'fa-file-word' }}"></i>
                            </div>
                            <span class="fw-bold text-dark">{{ $item->nama_dokumen }}</span>
                        </div>
                    </td>
                    <td class="text-secondary">{{ Str::limit($item->deskripsi, 50) }}</td>
                    {{-- Menggunakan kolom tanggal yang bisa diedit --}}
                    <td class="text-secondary">{{ \Carbon\Carbon::parse($item->tanggal)->format('d F Y') }}</td>
                    <td>
                        <span class="status-badge {{ $item->status == 'published' ? 'bg-published' : 'bg-draft' }}">
                            {{ ucfirst($item->status) }}
                        </span>
                    </td>
                    <td>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('admin.akuntabilitas.edit', $item->id) }}" class="action-btn btn-edit text-edit" title="Edit">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </a>
                            {{-- Gunakan atribut download agar tidak buka halaman baru --}}
                            <a href="{{ route('admin.akuntabilitas.download', $item->id) }}" 
   class="action-btn btn-download text-download" 
   title="Download">
    <i class="fa-solid fa-download"></i>
</a>
                            <button type="button" class="action-btn btn-delete text-delete" data-id="{{ $item->id }}" title="Hapus">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="pagination-wrapper">
            <span class="text-muted small" id="rowCountInfo">Menampilkan {{ $akuntabilitas->count() }} dokumen</span>
            <div class="d-flex align-items-center gap-2">
                <button type="button" class="btn btn-sm border" disabled>Previous</button>
                <button type="button" class="btn btn-sm btn-primary">1</button>
                <button type="button" class="btn btn-sm border">Next</button>
            </div>
        </div>
    </div>

    <div class="info-box shadow-sm">
        <div style="color: #3b82f6; font-size: 20px;"><i class="fa-solid fa-circle-info"></i></div>
        <div>
            <div style="color: #1e40af; font-weight: 700; font-size: 15px;">Informasi</div>
            <div style="color: #1e40af; font-size: 13.5px; opacity: 0.9;">
                LAKIN merupakan dokumen yang menyajikan informasi tentang kinerja instansi pemerintah dalam suatu periode tertentu.
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    
    // 1. FITUR PENCARIAN
    $("#searchInput").on("keyup", function() {
        let value = $(this).val().toLowerCase();
        $("#documentTable tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
        updateRowCount();
    });

    // 2. FITUR FILTER STATUS
    $("#statusFilter").on("change", function() {
        let selectedStatus = $(this).val().toLowerCase();
        $("#documentTable tbody tr").each(function() {
            let rowStatus = $(this).data('status');
            if (selectedStatus === "all" || rowStatus === selectedStatus) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
        updateRowCount();
    });

    function updateRowCount() {
        let visibleRows = $("#documentTable tbody tr:visible").length;
        $("#rowCountInfo").text("Menampilkan " + visibleRows + " dokumen");
    }

    // 3. FITUR HAPUS
    $(document).on('click', '.btn-delete', function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        let token = $("meta[name='csrf-token']").attr("content");

        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Data dokumen akan dihapus permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ url('/admin/akuntabilitas/lakin/delete') }}/" + id,
                    type: 'DELETE',
                    data: { "_token": token },
                    success: function(response) {
                        Swal.fire('Terhapus!', 'Dokumen berhasil dihapus.', 'success')
                        .then(() => { location.reload(); });
                    },
                    error: function(xhr) {
                        Swal.fire('Error!', 'Gagal menghapus data.', 'error');
                    }
                });
            }
        });
    });
});
</script>
@endsection