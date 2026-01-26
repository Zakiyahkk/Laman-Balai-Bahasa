@extends('admin.layout')

@section('content')
<!-- =================  SECTION LAYOUT ATAS ================= -->
<div class="page-header d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="mb-1" style="color:#ffffff;">Pengaturan</h3>
        <p class="mb-0" style="color:#ffffff;">
            Pengaturan hak akses admin
        </p>
    </div>

    <div class="header-logo">
        <img src="/img/logobbpr4.png"
             alt="Logo Balai Bahasa Provinsi Riau"
             class="img-fluid header-logo">
    </div>
</div>

<!-- =================  ISI MAIN CONTENT ================= -->

<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-semibold mb-0 text-white">
        Total Admin: {{ $totalAdmin }}
    </h5>

    <!-- TOMBOL TAMBAH ADMIN -->
    <button class="btn btn-add-article d-flex align-items-center ms-2"
            data-bs-toggle="modal"
            data-bs-target="#modalTambahAdmin">
        <span class="icon-plus">+</span> Admin
    </button>
</div>

<!-- WRAPPER ABU-ABU -->
<div class="admin-table-wrapper mb-4">
    <div class="card border-0 shadow-sm admin-table-card">
        <div class="card-body p-0">

            <table class="table mb-0 align-middle">
                <thead style="background:#f9fafb;">
                    <tr>
                        <th class="ps-4">No</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Role</th>
                        <th class="text-center pe-4">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($admin as $item)
                    <tr>
                        <td class="ps-4">{{ $loop->iteration }}</td>

                        <td class="fw-medium">
                            {{ $item->email }}
                        </td>

                        <td>
                            {{ $item->username }}
                        </td>

                        <td class="text-muted">
                            ••••••••
                        </td>

                        <td>
                            <span class="badge bg-primary-subtle text-primary">
                                {{ ucfirst(str_replace('_',' ', $item->role)) }}
                            </span>
                        </td>

                        <td class="text-center pe-4">
                            <div class="d-flex justify-content-center gap-2">

                                <!-- EDIT -->
                                <button class="btn btn-link text-secondary p-1"
                                        title="Edit"
                                        data-email="{{ $item->email }}">
                                    <i class="bi bi-pencil"></i>
                                </button>

                                <!-- HAPUS -->
                                <button class="btn btn-link text-danger p-1"
                                        title="Hapus"
                                        data-email="{{ $item->email }}">
                                    <i class="bi bi-trash"></i>
                                </button>

                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            Belum ada data admin
                        </td>
                    </tr>
                @endforelse
                </tbody>

            </table>

        </div>
    </div>
</div>

<!-- ================= MODAL TAMBAH ADMIN ================= -->
<div class="modal fade" id="modalTambahAdmin" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4">

            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold">
                    Tambah Admin Baru
                </h5>
                <button type="button" class="btn-close"
                        data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body px-4">
                <form method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email"
                               class="form-control"
                               placeholder="admin@example.com" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="username"
                               class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password"
                               class="form-control" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Role</label>
                        <select name="role" class="form-select" required>
                            <option value="" disabled selected>Pilih role</option>
                            <option value="admin">Admin</option>
                            <option value="super_admin">Super Admin</option>
                        </select>
                    </div>

                    <button class="btn btn-dark w-100">
                        Tambah Admin
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection
