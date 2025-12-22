

<?php $__env->startSection('title', 'Tugas Pokok dan Fungsi'); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/profil.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="profil-page">
        <div class="container profil-container">

            <!-- Header -->
            <div class="profil-header">
                <h1>Tugas Pokok dan Fungsi</h1>
                <p class="profil-subtitle">
                    Balai Bahasa Provinsi Riau
                </p>
            </div>

            <!-- Tugas Pokok -->
            <div class="profil-card">
                <h3>Tugas Pokok</h3>
                <p>
                    Balai Bahasa Provinsi Riau mempunyai tugas melaksanakan
                    pengembangan, pembinaan, dan pelindungan bahasa dan sastra
                    Indonesia serta bahasa daerah di wilayah Provinsi Riau.
                </p>
            </div>

            <!-- Fungsi -->
            <div class="profil-card">
                <h3>Fungsi</h3>
                <ol>
                    <li>Pelaksanaan pembinaan bahasa dan sastra</li>
                    <li>Pelaksanaan pengembangan bahasa dan sastra</li>
                    <li>Pelaksanaan pelindungan bahasa dan sastra</li>
                    <li>Pelaksanaan pelayanan kebahasaan kepada masyarakat</li>
                    <li>Pelaksanaan kerja sama di bidang kebahasaan</li>
                </ol>
            </div>

        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Laman-Balai-Bahasa\resources\views/user/profil/tugas-dan-fungsi.blade.php ENDPATH**/ ?>