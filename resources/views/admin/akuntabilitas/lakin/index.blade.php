@extends('admin.layout')

@section('content')
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
    }

    /* Toolbar Styling */
    .toolbar { display: flex; gap: 12px; margin-bottom: 25px; align-items: center; }
    .search-wrapper { position: relative; flex: 1; }
    .search-wrapper i { position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: #94a3b8; }
    .form-control-custom {
        height: 46px;
        border-radius: 10px;
        border: 1px solid #e2e8f0;
        padding-left: 45px;
        font-size: 14px;
        width: 100%;
        background: white;
        outline: none;
    }
    .form-control-custom:focus { border-color: #3b82f6; }

    .btn-custom {
        height: 46px;
        padding: 0 20px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 8px;
        white-space: nowrap;
        transition: all 0.2s;
        border: none;
    }
    .btn-add { background-color: #1d4ed8; color: white; }
    .btn-add:hover { background-color: #1e40af; }

    .select-status {
        height: 46px;
        border-radius: 10px;
        border: 1px solid #e2e8f0;
        font-size: 14px;
        padding: 0 15px;
        min-width: 160px;
        background: white;
        cursor: pointer;
        outline: none;
    }

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
        background-color: #f0f7ff;
        color: #3b82f6;
        width: 38px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        margin-right: 15px;
    }

    /* Status Badge Dynamic */
    .status-badge {
        padding: 5px 12px;
        border-radius: 100px;
        font-size: 12px;
        font-weight: 600;
        display: inline-block;
        text-transform: capitalize;
    }
    .bg-published { background-color: #ecfdf5; color: #10b981; }
    .bg-draft { background-color: #fffbeb; color: #f59e0b; }

    /* Pagination Buttons */
    .pagination-wrapper { padding: 15px 24px; display: flex; justify-content: space-between; align-items: center; background: white; border-top: 1px solid #f1f5f9; }
    .btn-nav {
        padding: 8px 16px;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        background-color: white;
        color: #64748b;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
    }
    .btn-nav:hover:not(:disabled) { background-color: #f8fafc; border-color: #cbd5e1; }
    .btn-nav:disabled { opacity: 0.5; cursor: not-allowed; }

    .btn-page-num {
        width: 36px;
        height: 36px;
        border: none;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
    }
    .page-active { background-color: #1d4ed8; color: white; }
    .page-inactive { background-color: transparent; color: #64748b; }

    /* Info Box */
    .info-box {
        background-color: #eef6ff;
        border: 1px solid #dbeafe;
        border-radius: 12px;
        padding: 20px;
        margin-top: 25px;
        display: flex;
        gap: 15px;
    }
    .info-title { color: #1e40af; font-weight: 700; font-size: 15px; }
    .info-desc { color: #1e40af; font-size: 13.5px; opacity: 0.8; }

    /* Modal Styling */
    .modal-content { border-radius: 16px; border: none; }
    .modal-header { padding: 24px 30px; border-bottom: 1px solid #f1f5f9; }
    .input-modal { border-radius: 10px; border: 1px solid #e2e8f0; padding: 12px 16px; width: 100%; outline: none; }
    .btn-modal-submit { background: #1d4ed8; border: none; border-radius: 10px; padding: 10px 25px; font-weight: 600; color: white; }
</style>

<div class="content-wrapper">
    <div class="header-box">
        <div class="icon-container shadow-sm">
            <i class="fas fa-file-alt"></i>
        </div>
        <div class="header-text">
            <h3 class="m-0">LAKIN (Laporan Kinerja)</h3>
            <p class="fw-medium m-0">Menu Akuntabilitas</p>
            <p class="text-secondary mt-1 small">Kelola dokumen Laporan Kinerja instansi pemerintah secara berkala</p>
        </div>
    </div>

    <div class="toolbar">
        <div class="search-wrapper">
            <i class="fas fa-search"></i>
            <input type="text" id="searchInput" class="form-control-custom shadow-sm" placeholder="Cari nama dokumen atau deskripsi...">
        </div>
        <button class="btn btn-custom btn-add shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambah">
            <i class="fas fa-plus"></i> Tambah Dokumen
        </button>
        <select id="statusFilter" class="select-status shadow-sm">
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
                <tr class="document-row" data-status="published">
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="doc-icon-box"><i class="fas fa-file-alt"></i></div>
                            <span class="fw-bold text-dark">Laporan Kinerja Tahun 2025</span>
                        </div>
                    </td>
                    <td class="text-secondary">Laporan kinerja tahunan organisasi tahun 2025 mencakup seluruh program</td>
                    <td class="text-secondary">12 Januari 2026</td>
                    <td><span class="status-badge bg-published">Published</span></td>
                    <td>
                        <div class="d-flex justify-content-center gap-3">
                            <a href="#" class="text-primary"><i class="far fa-edit"></i></a>
                            <a href="#" class="text-success"><i class="fas fa-download"></i></a>
                            <a href="#" class="text-danger"><i class="far fa-trash-alt"></i></a>
                        </div>
                    </td>
                </tr>
                <tr class="document-row" data-status="draft">
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="doc-icon-box"><i class="fas fa-file-alt"></i></div>
                            <span class="fw-bold text-dark">Draft LAKIN Triwulan I 2026</span>
                        </div>
                    </td>
                    <td class="text-secondary">Draft laporan kinerja triwulan pertama tahun 2026 proses review</td>
                    <td class="text-secondary">30 Januari 2026</td>
                    <td><span class="status-badge bg-draft">Draft</span></td>
                    <td>
                        <div class="d-flex justify-content-center gap-3">
                            <a href="#" class="text-primary"><i class="far fa-edit"></i></a>
                            <a href="#" class="text-success"><i class="fas fa-download"></i></a>
                            <a href="#" class="text-danger"><i class="far fa-trash-alt"></i></a>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="pagination-wrapper">
            <span class="text-muted small" id="rowCountInfo">Menampilkan 2 dokumen</span>
            <div class="d-flex align-items-center gap-2">
                <button type="button" class="btn-nav" disabled>Previous</button>
                <button type="button" class="btn-page-num page-active">1</button>
                <button type="button" class="btn-nav">Next</button>
            </div>
        </div>
    </div>

    <div class="info-box shadow-sm">
        <i class="fas fa-info-circle"></i>
        <div>
            <div class="info-title">Informasi</div>
            <div class="info-desc">Lakin merupakan dokumen yang menyajikan informasi tentang kinerja instansi pemerintah dalam suatu periode tertentu, berisi capaian keluaran dan hasil program/kegiatan, serta hambatan dan solusi yang dilakukan.</div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content shadow-lg">
            <div class="modal-header">
                <h5 class="fw-bold mb-0">Tambah Dokumen Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="#" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row g-4">
                        <div class="col-12">
                            <label class="fw-semibold mb-2 d-block">Nama Dokumen *</label>
                            <input type="text" name="nama" class="input-modal" placeholder="Masukkan nama dokumen" required>
                        </div>
                        <div class="col-12">
                            <label class="fw-semibold mb-2 d-block">Deskripsi *</label>
                            <textarea name="deskripsi" class="input-modal" rows="4" placeholder="Masukkan deskripsi" required style="resize: none;"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="fw-semibold mb-2 d-block">Tanggal *</label>
                            <input type="text" name="tanggal" class="input-modal" value="{{ date('d/m/Y') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="fw-semibold mb-2 d-block">Status *</label>
                            <select name="status" class="input-modal">
                                <option value="Draft">Draft</option>
                                <option value="Published">Published</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end gap-2 mt-5">
                        <button type="button" class="btn-nav" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn-modal-submit">Simpan Dokumen</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Ambil elemen-elemen yang dibutuhkan
    const searchInput = document.getElementById('searchInput');
    const statusFilter = document.getElementById('statusFilter');
    // Ambil semua baris tabel yang ada di dalam tbody
    const tableBody = document.querySelector('#documentTable tbody');
    
    function performFilter() {
        const query = searchInput.value.toLowerCase().trim();
        const status = statusFilter.value.toLowerCase();
        const rows = tableBody.querySelectorAll('tr'); // Ambil ulang rows di dalam fungsi
        
        let visibleCount = 0;

        rows.forEach(row => {
            // Ambil teks dari kolom Nama (kolom 1) dan Deskripsi (kolom 2)
            const docName = row.querySelector('td:nth-child(1)').textContent.toLowerCase();
            const docDesc = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
            const rowStatus = row.getAttribute('data-status') ? row.getAttribute('data-status').toLowerCase() : '';
            
            // Logika Pencarian: Cek apakah query ada di nama ATAU deskripsi
            const matchSearch = docName.includes(query) || docDesc.includes(query);
            
            // Logika Filter Status
            const matchStatus = (status === 'all' || rowStatus === status);

            // Tampilkan jika keduanya terpenuhi
            if (matchSearch && matchStatus) {
                row.style.setProperty('display', '', 'important');
                visibleCount++;
            } else {
                row.style.setProperty('display', 'none', 'important');
            }
        });

        // Update info jumlah dokumen yang tampil
        const rowCountInfo = document.getElementById('rowCountInfo');
        if(rowCountInfo) {
            rowCountInfo.textContent = `Menampilkan ${visibleCount} dokumen`;
        }
    }

    // Jalankan fungsi setiap kali ada perubahan input
    searchInput.addEventListener('input', performFilter); // 'input' lebih responsif dari 'keyup'
    statusFilter.addEventListener('change', performFilter);
});
</script>
@endsection