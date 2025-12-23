<?php $__env->startSection('content'); ?>

<!-- ================= HEADER ================= -->
<div class="page-header d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="mb-1">Galeri</h3>
        <p class="text-muted mb-0">
            Halaman ini untuk Pengelolaan media dokumentasi Balai Bahasa Provinsi Riau.
        </p>
    </div>

    <div class="header-logo">
        <img src="/img/logo.png" alt="Logo" class="img-fluid header-logo">
    </div>
</div>

<!-- ================= GALERI ================= -->
<div class="galeri-container">

    <!-- FILTER BAR (ATAS) -->
    <div class="filter-bar">

        <div class="search">
            <div class="input-group">
                <span class="input-group-text bg-white">
                    <i class="bi bi-search"></i>
                </span>
                <input type="text" class="form-control" placeholder="Cari media...">
            </div>
        </div>

        <select class="form-select">
            <option>Kategori</option>
            <option>Foto</option>
            <option>Video</option>
        </select>

        <select class="form-select">
            <option>Tipe File</option>
            <option>PNG</option>
            <option>JPG</option>
            <option>MP4</option>
        </select>
        <a href="<?php echo e(route('admin.galeri.create')); ?>"
        class="btn btn-add-article d-flex align-items-center ms-2">
            Upload Media
        </a>

    </div>

    <!-- GRID CARD (DI BAWAH FILTER BAR) -->
    <div class="media-grid">

        <!-- CARD -->
        <div class="media-card">
            <span class="media-type-badge foto">Foto</span>
            <div class="media-preview"></div>
            <div class="media-info">
                <h3>Seminar Bahasa Indonesia 2024</h3>
                <p>Kegiatan</p>
                <p>10 DES 2024</p>
                <p>2.4 MB</p>
            </div>
            <button class="delete-button">Hapus</button>
        </div>

        <!-- CARD -->
        <div class="media-card">
            <span class="media-type-badge video">Video</span>
            <div class="media-preview"></div>
            <div class="media-info">
                <h3>Seminar Bahasa Indonesia 2024</h3>
                <p>Kegiatan</p>
                <p>10 DES 2024</p>
                <p>2.4 MB</p>
            </div>
            <button class="delete-button">Hapus</button>
        </div>

        <!-- CARD -->
        <div class="media-card">
            <span class="media-type-badge video">Video</span>
            <div class="media-preview"></div>
            <div class="media-info">
                <h3>Seminar Bahasa Indonesia 2024</h3>
                <p>Kegiatan</p>
                <p>10 DES 2024</p>
                <p>2.4 MB</p>
            </div>
            <button class="delete-button">Hapus</button>
        </div>


        <!-- CARD -->
        <div class="media-card">
            <span class="media-type-badge foto">Foto</span>
            <div class="media-preview"></div>
            <div class="media-info">
                <h3>Seminar Bahasa Indonesia 2024</h3>
                <p>Kegiatan</p>
                <p>10 DES 2024</p>
                <p>2.4 MB</p>
            </div>
            <button class="delete-button">Hapus</button>
        </div>

        <!-- CARD -->
        <div class="media-card">
            <span class="media-type-badge foto">Foto</span>
            <div class="media-preview"></div>
            <div class="media-info">
                <h3>Seminar Bahasa Indonesia 2024</h3>
                <p>Kegiatan</p>
                <p>10 DES 2024</p>
                <p>2.4 MB</p>
            </div>
            <button class="delete-button">Hapus</button>
        </div>
    </div>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Laman-Balai-Bahasa\resources\views/admin/galeri/index.blade.php ENDPATH**/ ?>