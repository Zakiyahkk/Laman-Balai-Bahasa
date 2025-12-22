<?php $__env->startSection('content'); ?>
<!-- =================  SECTION LAYOUT ATAS ================= -->
<div class="page-header d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="mb-1">Publikasi</h3>
        <p class="text-muted mb-0">
            Total publikasi: 4
        </p>
    </div>

    <div class="header-logo">
        <img src="/img/logo.png"
             alt="Logo Balai Bahasa Provinsi Riau"
             class="img-fluid header-logo">
    </div>
</div>

<!-- ================= FILTER + ACTION BAR ================= -->
<div class="d-flex align-items-center mb-4 gap-2">

    <!-- SEARCH -->
    <div class="flex-grow-1">
        <div class="input-group">
            <span class="input-group-text bg-white border-end-0">
                <i class="bi bi-search"></i>
            </span>

            <input type="text"
                   class="form-control border-start-0"
                   placeholder="Cari judul...">

            <button class="btn btn-outline-secondary dropdown-toggle"
                    type="button"
                    data-bs-toggle="dropdown">
                <i class="bi bi-funnel"></i>
            </button>

            <ul class="dropdown-menu dropdown-menu-end">
                <li><h6 class="dropdown-header">Status</h6></li>
                <li><a class="dropdown-item" href="#">Draf</a></li>
                <li><a class="dropdown-item" href="#">Terbit</a></li>
                <li><a class="dropdown-item active" href="#">Semua</a></li>
            </ul>
        </div>
    </div>

    <!-- TOMBOL TAMBAH -->
    <a href="<?php echo e(route('admin.publikasi.create')); ?>"
       class="btn btn-add-article d-flex align-items-center ms-2">
        <span class="icon-plus">+</span>
        Publikasi
    </a>
</div>

<!-- ================= LIST PUBLIKASI ================= -->

<!-- ================= DRAF ================= -->
<h6 class="text-uppercase text-muted fw-semibold mb-3">
    Draf
</h6>

<!-- DRAF - TERBARU -->
<div class="publication-card d-flex gap-4 mb-3"
     data-link="<?php echo e(route('admin.publikasi.show', 1)); ?>">

    <img src="https://picsum.photos/220/160?1"
         class="publication-thumb-lg">

    <div class="flex-grow-1">
        <div class="d-flex align-items-center gap-2 mb-2">
            <h5 class="fw-bold mb-0">
                Perkembangan Teknologi AI di Indonesia
            </h5>
            <span class="badge-draft">Draf</span>
        </div>

        <div class="d-flex align-items-center flex-wrap gap-3 text-muted small mb-3">
            <span><i class="bi bi-calendar-event me-1"></i> 15 Desember 2025</span>
            <span><i class="bi bi-person me-1"></i> Refanny Nabilla</span>
            <span><i class="bi bi-eye me-1"></i> 1.245 Pembaca</span>
        </div>

        <p class="mb-0 text-muted">
            Perkembangan teknologi AI di Indonesia menunjukkan tren positif dan mulai
            diterapkan di berbagai sektor strategis.
        </p>
    </div>

    <div class="publication-action">
        <a href="<?php echo e(route('admin.publikasi.edit', 1)); ?>"
            class="btn btn-outline-secondary btn-sm"
            onclick="event.stopPropagation()">
            <i class="bi bi-pencil"></i>
        </a>
        <button class="btn btn-outline-danger btn-sm">
            <i class="bi bi-trash"></i>
        </button>
    </div>
</div>

<!-- DRAF - LEBIH LAMA -->
<div class="publication-card d-flex gap-4 mb-4"
     data-link="<?php echo e(route('admin.publikasi.show', 2)); ?>">

    <img src="https://picsum.photos/220/160?3"
         class="publication-thumb-lg">

    <div class="flex-grow-1">
        <div class="d-flex align-items-center gap-2 mb-2">
            <h5 class="fw-bold mb-0">
                Literasi Digital di Kalangan Pelajar
            </h5>
            <span class="badge-draft">Draf</span>
        </div>

        <div class="d-flex align-items-center flex-wrap gap-3 text-muted small mb-3">
            <span><i class="bi bi-calendar-event me-1"></i> 8 Desember 2025</span>
            <span><i class="bi bi-person me-1"></i> Zakiyah Binti Adlas</span>
            <span><i class="bi bi-eye me-1"></i> 532 Pembaca</span>
        </div>

        <p class="mb-0 text-muted">
            Literasi digital menjadi kebutuhan penting bagi pelajar untuk menghadapi
            tantangan era informasi dan teknologi.
        </p>
    </div>

    <div class="publication-action">
        <a href="<?php echo e(route('admin.publikasi.edit', 2)); ?>"
            class="btn btn-outline-secondary btn-sm"
            onclick="event.stopPropagation()">
                <i class="bi bi-pencil"></i>
        </a>
        <button class="btn btn-outline-danger btn-sm">
            <i class="bi bi-trash"></i>
        </button>
    </div>
</div>

<!-- ================= TERBIT ================= -->
<h6 class="text-uppercase text-muted fw-semibold mb-3 mt-4">
    Terbit
</h6>

<!-- TERBIT - TERBARU -->
<div class="publication-card d-flex gap-4 mb-3"
     data-link="<?php echo e(route('admin.publikasi.show', 3)); ?>">

    <img src="https://picsum.photos/220/160?2"
         class="publication-thumb-lg">

    <div class="flex-grow-1">
        <div class="d-flex align-items-center gap-2 mb-2">
            <h5 class="fw-bold mb-0">
                Pelestarian Bahasa Melayu Riau
            </h5>
            <span class="badge-published">Terbit</span>
        </div>

        <div class="d-flex align-items-center flex-wrap gap-3 text-muted small mb-3">
            <span><i class="bi bi-calendar-event me-1"></i> 10 Desember 2025</span>
            <span><i class="bi bi-person me-1"></i> Rian Lesmana Putra</span>
            <span><i class="bi bi-eye me-1"></i> 860 Pembaca</span>
        </div>

        <p class="mb-0 text-muted">
            Upaya pelestarian bahasa daerah terus dilakukan melalui program edukasi,
            penelitian, dan publikasi digital.
        </p>
    </div>

    <div class="publication-action">
        <a href="<?php echo e(route('admin.publikasi.edit', 3)); ?>"
            class="btn btn-outline-secondary btn-sm"
            onclick="event.stopPropagation()">
                <i class="bi bi-pencil"></i>
        </a>
        <button class="btn btn-outline-danger btn-sm">
            <i class="bi bi-trash"></i>
        </button>
    </div>
</div>

<!-- TERBIT - LEBIH LAMA -->
<div class="publication-card d-flex gap-4 mb-3"
     data-link="<?php echo e(route('admin.publikasi.show', 4)); ?>">

    <img src="https://picsum.photos/220/160?4"
         class="publication-thumb-lg">

    <div class="flex-grow-1">
        <div class="d-flex align-items-center gap-2 mb-2">
            <h5 class="fw-bold mb-0">
                Ekonomi Digital Indonesia Tahun 2024
            </h5>
            <span class="badge-published">Terbit</span>
        </div>

        <div class="d-flex align-items-center flex-wrap gap-3 text-muted small mb-3">
            <span><i class="bi bi-calendar-event me-1"></i> 3 Desember 2025</span>
            <span><i class="bi bi-person me-1"></i> Sahala Pane</span>
            <span><i class="bi bi-eye me-1"></i> 352 Pembaca</span>
        </div>

        <p class="mb-0 text-muted">
            Laporan terbaru menunjukkan bahwa ekonomi digital Indonesia terus mengalami
            pertumbuhan signifikan di berbagai sektor.
        </p>
    </div>

    <div class="publication-action">
        <a href="<?php echo e(route('admin.publikasi.edit', 4)); ?>"
            class="btn btn-outline-secondary btn-sm"
            onclick="event.stopPropagation()">
                <i class="bi bi-pencil"></i>
        </a>

        <button class="btn btn-outline-danger btn-sm">
            <i class="bi bi-trash"></i>
        </button>
    </div>
</div>

<!-- ================= SCRIPT ================= -->
<script>
document.querySelectorAll('.publication-card').forEach(card => {
    card.addEventListener('click', function (e) {

        // Jika klik tombol edit/hapus, jangan redirect
        if (e.target.closest('button')) {
            return;
        }

        const link = this.dataset.link;
        if (link) {
            window.location.href = link;
        }
    });
});
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Laman-Balai-Bahasa\resources\views/admin/publikasi/index.blade.php ENDPATH**/ ?>