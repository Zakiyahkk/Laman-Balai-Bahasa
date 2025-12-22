<?php $__env->startSection('page-title', 'Artikel & Berita'); ?>
<?php $__env->startSection('page-subtitle', 'Kelola semua artikel dan berita Balai Bahasa Provinsi Riau'); ?>

<?php $__env->startSection('content'); ?>
<!-- =================  SECTION LAYOUT ATAS ================= -->
<div class="page-header d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="mb-1">Artikel dan Berita</h3>
        <p class="text-muted mb-0">
            Total Artikel dan Berita: 2
        </p>
    </div>

    <div class="header-logo">
        <img src="/img/logo.png"
             alt="Logo Balai Bahasa Provinsi Riau"
             class="img-fluid header-logo">
    </div>
</div>
<!-- =================  ISI MAIN CONTENT ================= -->

<!-- ================= FILTER + ACTION BAR ================= -->
<div class="d-flex align-items-center mb-4 gap-2">

    <!-- SEARCH (LEBAR MAKSIMAL) -->
    <div class="flex-grow-1">
        <div class="input-group">
            <span class="input-group-text bg-white border-end-0">
                <i class="bi bi-search"></i>
            </span>

            <input type="text"
                   class="form-control border-start-0"
                   placeholder="Cari artikel...">

            <button class="btn btn-outline-secondary dropdown-toggle"
                    type="button"
                    data-bs-toggle="dropdown">
                <i class="bi bi-funnel"></i>
            </button>

            <ul class="dropdown-menu dropdown-menu-end">
                <li><h6 class="dropdown-header">Kategori</h6></li>
                <li><a class="dropdown-item active" href="#">Semua</a></li>
                <li><a class="dropdown-item" href="#">Bahasa</a></li>
                <li><a class="dropdown-item" href="#">Sastra</a></li>
                <li><a class="dropdown-item" href="#">Kegiatan</a></li>
                <li><a class="dropdown-item" href="#">Pelatihan</a></li>
            </ul>
        </div>
    </div>
    <!-- TOMBOL TAMBAH -->
    <button class="btn btn-add-article d-flex align-items-center ms-2">
        <span class="icon-plus">+</span>
        Artikel
    </button>
</div>

<!-- ================= TABLE ================= -->
<div class="content-card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr class="text-muted small">
                    <th class="ps-4">JUDUL</th>
                    <th>KATEGORI</th>
                    <th>PENULIS</th>
                    <th>TANGGAL</th>
                    <th>STATUS</th>
                    <th class="text-end pe-4">AKSI</th>
                </tr>
            </thead>
            <tbody>

                <tr>
                    <td class="ps-4 fw-semibold">
                        Pelestarian Bahasa Melayu Riau di Era Digital
                    </td>
                    <td>
                        <span class="badge rounded-pill text-bg-info">Bahasa</span>
                    </td>
                    <td>Dr. Ahmad Syahid</td>
                    <td>12 Des 2024</td>
                    <td>
                        <span class="badge rounded-pill text-bg-success">Published</span>
                    </td>
                    <td class="text-end pe-4">
                        <a href="#" class="text-primary me-3" title="Edit">
                            <i class="bi bi-pencil"></i>
                        </a>

                    <button type="button"
                            class="btn-icon-danger"
                            title="Hapus"
                            onclick="return confirm('Yakin ingin menghapus artikel ini?')">
                        <i class="bi bi-trash"></i>
                    </button>


                    </td>
                </tr>

                <tr>
                    <td class="ps-4 fw-semibold">
                        Workshop Penulisan Kreatif untuk Pelajar
                    </td>
                    <td>
                        <span class="badge rounded-pill text-bg-warning text-dark">
                            Kegiatan
                        </span>
                    </td>
                    <td>Sri Wahyuni, M.Pd</td>
                    <td>10 Des 2024</td>
                    <td>
                        <span class="badge rounded-pill text-bg-success">Published</span>
                    </td>
                    <td class="text-end pe-4">
                        <a href="#" class="text-primary me-3" title="Edit">
                            <i class="bi bi-pencil"></i>
                        </a>

                       <button type="button"
                                class="btn-icon-danger"
                                title="Hapus"
                                onclick="return confirm('Yakin ingin menghapus artikel ini?')">
                            <i class="bi bi-trash"></i>
                        </button>

                    </td>
                </tr>

            </tbody>
        </table>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Laman-Balai-Bahasa\resources\views/admin/artikel/index.blade.php ENDPATH**/ ?>