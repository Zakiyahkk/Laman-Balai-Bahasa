

<?php $__env->startSection('title', 'Berita'); ?>

<?php $__env->startSection('content'); ?>

    <section class="section berita-terbaru">
        <div class="container">

            <h2 class="judul-center">
                Berita <span>Terbaru</span>
            </h2>

            <div class="berita-grid">

                
                <div class="berita-card">
                    <div class="berita-img">
                        <span class="badge">BERITA</span>
                        <a href="<?php echo e(route('berita.show', 'kolaborasi-komunitas-relawan-cerdas-riau')); ?>">
                            <img src="/img/img1.png" alt="">
                        </a>
                    </div>

                    <div class="berita-body">
                        <a href="<?php echo e(route('berita.show', 'kolaborasi-komunitas-relawan-cerdas-riau')); ?>">
                            <h4>Kolaborasi dengan Komunitas Relawan Cerdas Riau</h4>
                        </a>

                        <p>
                            Balai Bahasa Provinsi Riau melaksanakan kegiatan
                            pemantapan kebahasaan...
                        </p>

                        <div class="berita-meta">
                            <span>14 Desember 2025</span>
                            <span>Admin</span>
                        </div>
                    </div>
                </div>

                
                <div class="berita-card">
                    <div class="berita-img">
                        <span class="badge">BERITA</span>
                        <a href="<?php echo e(route('berita.show', 'pembinaan-bahasa-riau')); ?>">
                            <img src="/img/img1.png" alt="">
                        </a>
                    </div>

                    <div class="berita-body">
                        <a href="<?php echo e(route('berita.show', 'pembinaan-bahasa-riau')); ?>">
                            <h4>Pembinaan Bahasa di Provinsi Riau</h4>
                        </a>

                        <p>
                            Kegiatan pembinaan dilakukan sebagai upaya
                            peningkatan kualitas bahasa...
                        </p>

                        <div class="berita-meta">
                            <span>13 Desember 2025</span>
                            <span>Admin</span>
                        </div>
                    </div>
                </div>

                
            </div>

        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Laman-Balai-Bahasa\resources\views/user/berita/index.blade.php ENDPATH**/ ?>