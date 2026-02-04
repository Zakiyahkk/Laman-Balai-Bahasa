@extends('admin.layout')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
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

    /* --- STICKY HEADER SECTION --- */
    .sticky-header-container {
        position: sticky;
        top: 0;
        z-index: 1000;
        background-color: #f8faff; 
        padding-top: 10px;
        padding-bottom: 20px;
        margin-top: -20px;
    }

    .header-box { display: flex; align-items: flex-start; gap: 18px; margin-bottom: 20px; }
    
    .icon-container { 
        background-color: #e0eaff; color: #2563eb; 
        width: 44px; height: 44px; display: flex; 
        align-items: center; justify-content: center; 
        border-radius: 10px; font-size: 20px; 
    }

    .toolbar { 
        display: flex; gap: 15px; align-items: center; 
        background: white; padding: 15px; border-radius: 12px; 
        border: 1px solid #eef2f7; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); 
    }
    /* --- END STICKY HEADER --- */

    .search-wrapper { position: relative; flex: 1; }
    .search-wrapper i { position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: #94a3b8; }
    
    .form-control-custom { 
        height: 48px; border-radius: 10px; border: 1px solid #e2e8f0; 
        padding-left: 45px; font-size: 14px; width: 100%; outline: none; 
        background: white;
    }

    .btn-primary-custom { 
        background-color: #1d4ed8; color: #ffffff !important; 
        height: 48px; padding: 0 20px; border-radius: 10px; 
        font-weight: 600; font-size: 14px; display: flex; 
        align-items: center; gap: 8px; text-decoration: none; 
        border: none; white-space: nowrap; transition: all 0.2s;
    }
    .btn-primary-custom:hover { background-color: #1e40af; transform: translateY(-1px); }

    /* Table Styling */
    .table-card { background: white; border-radius: 12px; border: 1px solid #eef2f7; overflow: hidden; box-shadow: 0 2px 4px rgba(0,0,0,0.02); }
    .custom-table thead th { 
        background-color: #fcfdfe; color: #8e9aaf; 
        font-size: 11px; font-weight: 700; text-transform: uppercase; 
        padding: 15px 24px; border-bottom: 1px solid #f1f5f9; 
    }
    .custom-table tbody td { padding: 18px 24px; vertical-align: middle; border-bottom: 1px solid #f8fafc; font-size: 14px; }
    
    .doc-icon-box { background-color: #e8f1ff; color: #3b82f6; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; border-radius: 8px; margin-right: 15px; font-size: 18px; }
    
    .status-badge { padding: 5px 12px; border-radius: 8px; font-size: 12px; font-weight: 600; }
    .bg-published { background-color: #ecfdf5; color: #10b981; }
    .bg-draft { background-color: #fffbeb; color: #f59e0b; }

    .action-btn { 
        width: 36px; height: 36px; display: flex; align-items: center; 
        justify-content: center; border-radius: 8px; border: 1px solid #e2e8f0; 
        background-color: white; transition: all 0.2s; text-decoration: none; 
    }

    /* PAGINATION STYLING (DI UJUNG KANAN) */
    .pagination-wrapper { 
        padding: 15px 24px; display: flex; 
        justify-content: space-between; align-items: center; 
        background: white; border-top: 1px solid #f1f5f9; 
    }
    .pagination { display: flex; list-style: none; margin: 0; padding: 0; gap: 5px; align-items: center; }
    .page-item .page-link { 
        padding: 8px 16px; border-radius: 10px; border: 1px solid #e2e8f0; 
        color: #2563eb; text-decoration: none; font-size: 13px; font-weight: 500; 
    }
    .page-item.active .page-link { background-color: #2563eb; color: white; border-color: #2563eb; }
    .page-item.disabled .page-link { color: #cbd5e1; pointer-events: none; background-color: #f8fafc; }

    .info-box { background-color: #eef6ff; border: 1px solid #dbeafe; border-radius: 12px; padding: 20px; margin-top: 25px; display: flex; align-items: flex-start; gap: 15px; }
</style>

<div class="content-wrapper">
    <div class="sticky-header-container">
        <div class="header-box">
            <div class="icon-container shadow-sm"><i class="fa-solid fa-file-lines"></i></div>
            <div class="header-text">
                <h3 class="m-0 text-uppercase fw-bold">{{ str_replace('-', ' ', $tipe) }}</h3>
                <p class="fw-medium m-0 text-muted">Menu Akuntabilitas</p>
                <p class="text-secondary mt-1 small">Kelola dokumen {{ str_replace('-', ' ', $tipe) }} instansi pemerintah secara berkala (Maks. 10 data)</p>
            </div>
        </div>

        <div class="toolbar shadow-sm">
            <div class="search-wrapper">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" id="searchInput" class="form-control-custom" placeholder="Cari dokumen DIPA...">
            </div>

            <a href="{{ route('admin.akuntabilitas.create', $tipe) }}" class="btn-primary-custom">
                <i class="fa-solid fa-plus"></i> Tambah Dokumen
            </a>

            <select id="statusFilter" class="form-control-custom" style="width: 180px; padding-left: 15px; cursor: pointer;">
                <option value="all">Semua Status</option>
                <option value="published">Published</option>
                <option value="draft">Draft</option>
            </select>
        </div>
    </div>

    <div class="table-card shadow-sm mt-3">
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
                @forelse($data as $item)
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
                    <td class="text-secondary">{{ \Carbon\Carbon::parse($item->tanggal)->format('d F Y') }}</td>
                    <td>
                        <span class="status-badge {{ strtolower($item->status) == 'published' ? 'bg-published' : 'bg-draft' }}">
                            {{ ucfirst($item->status) }}
                        </span>
                    </td>
                    <td>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('admin.akuntabilitas.edit', [$tipe, $item->id]) }}" class="action-btn text-primary" title="Edit">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </a>
                            <a href="{{ route('admin.akuntabilitas.download', $item->id) }}" class="action-btn text-success" title="Download">
                                <i class="fa-solid fa-download"></i>
                            </a>
                            <button type="button" class="action-btn text-danger btn-delete border-0" data-id="{{ $item->id }}" data-name="{{ $item->nama_dokumen }}">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center py-5 text-muted">Belum ada data {{ strtoupper($tipe) }} tersedia.</td></tr>
                @endforelse
            </tbody>
        </table>

        <div class="pagination-wrapper">
            <div class="text-muted small">
                Menampilkan <strong>{{ $data->firstItem() ?? 0 }}</strong> - <strong>{{ $data->lastItem() ?? 0 }}</strong> dari <strong>{{ $data->total() }}</strong> dokumen
            </div>
            
            <nav>
                <ul class="pagination">
                    @if ($data->onFirstPage())
                        <li class="page-item disabled"><span class="page-link">Previous</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $data->previousPageUrl() }}">Previous</a></li>
                    @endif

                    @foreach ($data->getUrlRange(1, $data->lastPage()) as $page => $url)
                        <li class="page-item {{ $page == $data->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endforeach

                    @if ($data->hasMorePages())
                        <li class="page-item"><a class="page-link" href="{{ $data->nextPageUrl() }}">Next</a></li>
                    @else
                        <li class="page-item disabled"><span class="page-link">Next</span></li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>

    <div class="info-box shadow-sm">
        <div style="color: #3b82f6; font-size: 20px;"><i class="fa-solid fa-circle-info"></i></div>
        <div>
            <div style="color: #1e40af; font-weight: 700; font-size: 15px;">Informasi</div>
            <div style="color: #1e40af; font-size: 13.5px; opacity: 0.9;">
                {{ strtoupper(str_replace('-', ' ', $tipe) ) }} merupakan dokumen pelaksanaan anggaran yang disusun oleh Pengguna Anggaran/Kuasa Pengguna Anggaran berdasarkan alokasi anggaran yang ditetapkan.
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    // Search Filter
    $("#searchInput").on("keyup", function() {
        let value = $(this).val().toLowerCase();
        $("#documentTable tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    // Status Filter
    $("#statusFilter").on("change", function() {
        let value = $(this).val().toLowerCase();
        if(value === 'all') {
            $("#documentTable tbody tr").show();
        } else {
            $("#documentTable tbody tr").filter(function() {
                $(this).toggle($(this).data('status') === value)
            });
        }
    });

    // Delete SweetAlert
    $(document).on('click', '.btn-delete', function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        let name = $(this).data('name');
        let token = "{{ csrf_token() }}";

        Swal.fire({
            title: 'Hapus Dokumen?',
            text: "Dokumen '" + name + "' akan dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            confirmButtonText: 'Ya, Hapus!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ url('/admin/akuntabilitas/delete') }}/" + id,
                    type: 'DELETE',
                    data: { "_token": token },
                    success: function() {
                        Swal.fire('Berhasil!', '', 'success').then(() => location.reload());
                    }
                });
            }
        });
    });
});
</script>
@endsection