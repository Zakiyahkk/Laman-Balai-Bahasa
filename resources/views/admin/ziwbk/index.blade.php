@extends('admin.layout')

@section('content')

{{-- SweetAlert --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
/* ===== ZI-WBK INDEX ONLY ===== */
.ziwbk-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 15px;
    margin-bottom: 15px;
    flex-wrap: wrap;
}

.ziwbk-title {
    font-size: 22px;
    font-weight: 600;
    color: #fff;
}

.ziwbk-header-right {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.ziwbk-filter {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
}

.ziwbk-filter input,
.ziwbk-filter select {
    padding: 6px 10px;
    border-radius: 6px;
    border: 1px solid #d1d5db;
    font-size: 13px;
}

.ziwbk-btn {
    background: #2563eb;
    color: #fff;
    padding: 6px 12px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 13px;
    display: inline-block;
    border: none;
    cursor: pointer;
}

.ziwbk-btn:hover {
    background: #1e40af;
}

.ziwbk-btn-danger {
    background: #dc2626;
    color: #fff;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 13px;
    border: none;
    cursor: pointer;
}

.ziwbk-btn-danger:hover {
    background: #b91c1c;
}

.ziwbk-card {
    background: #ffffff;
    border-radius: 12px;
    padding: 15px;
    box-shadow: 0 4px 12px rgba(0,0,0,.05);
}

.ziwbk-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
}

.ziwbk-table th,
.ziwbk-table td {
    padding: 12px 10px;
    border-bottom: 1px solid #e5e7eb;
    vertical-align: middle;
}

.ziwbk-table th {
    background: #f3f4f6;
    font-weight: 600;
    text-align: left;
}

.ziwbk-table tbody tr:hover {
    background: #f9fafb;
}

.ziwbk-file {
    color: #2563eb;
    font-weight: 500;
    text-decoration: none;
}

.ziwbk-file:hover {
    text-decoration: underline;
}

.ziwbk-action {
    display: flex;
    gap: 6px;
}

@media (max-width: 768px) {
    .ziwbk-header {
        flex-direction: column;
        align-items: stretch;
    }

    .ziwbk-filter input,
    .ziwbk-filter select,
    .ziwbk-filter button,
    .ziwbk-btn {
        width: 100%;
    }
}
</style>

<!-- ===== HEADER + SEARCH + FILTER ===== -->
<div class="ziwbk-header">
    <div class="ziwbk-title">Data Dokumen ZI-WBK</div>

    <div class="ziwbk-header-right">
        <form method="GET" action="{{ route('admin.ziwbk.index') }}" class="ziwbk-filter">
            <input
                type="text"
                name="q"
                placeholder="Cari judul..."
                value="{{ request('q') }}"
            >

            <select name="tahun">
                <option value="">Semua Tahun</option>
                <option value="2024" {{ request('tahun')=='2024'?'selected':'' }}>2024</option>
                <option value="2025" {{ request('tahun')=='2025'?'selected':'' }}>2025</option>
                <option value="2026" {{ request('tahun')=='2026'?'selected':'' }}>2026</option>
                <option value="2027" {{ request('tahun')=='2027'?'selected':'' }}>2027</option>
            </select>

            <select name="status">
                <option value="">Semua Status</option>
                <option value="draft" {{ request('status')=='draft'?'selected':'' }}>Draft</option>
                <option value="publish" {{ request('status')=='publish'?'selected':'' }}>Publish</option>
            </select>

            <button type="submit" class="ziwbk-btn">
                Filter
            </button>
        </form>

        <a href="{{ route('admin.ziwbk.create') }}" class="ziwbk-btn">
            + Tambah Dokumen
        </a>
    </div>
</div>

<div class="ziwbk-card">
    <table class="ziwbk-table">
        <thead>
            <tr>
                <th width="40">No</th>
                <th>Tahun</th>
                <th>Pilar</th>
                <th>Sub Pilar</th>
                <th>Judul</th>
                <th width="90">Status</th>
                <th width="80">File</th>
                <th width="140">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $i => $row)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $row->tahun }}</td>
                <td>{{ ucfirst(str_replace('-', ' ', $row->pilar)) }}</td>
                <td>{{ ucfirst(str_replace('-', ' ', $row->sub_pilar)) }}</td>
                <td>{{ $row->judul }}</td>

                <td>
                    @if($row->status === 'publish')
                        <span style="background:#dcfce7;color:#166534;padding:4px 10px;border-radius:999px;font-size:12px;font-weight:600;">
                            Publish
                        </span>
                    @else
                        <span style="background:#fee2e2;color:#991b1b;padding:4px 10px;border-radius:999px;font-size:12px;font-weight:600;">
                            Draft
                        </span>
                    @endif
                </td>

                <td>
                    <a href="{{ asset('storage/'.$row->file) }}" target="_blank" class="ziwbk-file">
                        Lihat
                    </a>
                </td>

                <td>
                    <div class="ziwbk-action">
                        <a href="{{ route('admin.ziwbk.edit', $row->id) }}" class="ziwbk-btn">Edit</a>

                        <form action="{{ route('admin.ziwbk.destroy', $row->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="ziwbk-btn-danger btn-hapus">
                                Hapus
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" style="text-align:center;padding:20px;color:#6b7280;">
                    Belum ada dokumen
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- SCRIPT SWEETALERT --}}
<script>
document.querySelectorAll('.btn-hapus').forEach(button => {
    button.addEventListener('click', function () {
        const form = this.closest('form');

        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: 'Dokumen yang dihapus tidak bisa dikembalikan!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});
</script>

@endsection
