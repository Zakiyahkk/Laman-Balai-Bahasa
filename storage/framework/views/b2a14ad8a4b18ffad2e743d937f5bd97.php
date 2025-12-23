<?php $__env->startSection('title', 'Pegawai'); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/profil.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="profil-page">
        <div class="container profil-container">

            <!-- Header -->
            <div class="profil-header">
                <h1>Pegawai</h1>
                <p class="profil-subtitle">
                    Balai Bahasa Provinsi Riau
                </p>
            </div>

            <!-- Grid Pegawai -->
            <div class="pegawai-grid">

                <div class="pegawai-card">
                    <img src="<?php echo e(asset('images/pegawai/kepala.png')); ?>" alt="Kepala Balai">
                    <h4>Nama Kepala Balai</h4>
                    <p>Kepala Balai Bahasa</p>
                </div>

                <div class="pegawai-card">
                    <img src="<?php echo e(asset('images/pegawai/tu.png')); ?>" alt="Kasubbag TU">
                    <h4>Nama Kasubbag TU</h4>
                    <p>Kepala Subbagian Tata Usaha</p>
                </div>

                <div class="pegawai-card">
                    <img src="<?php echo e(asset('images/pegawai/fungsional.png')); ?>" alt="JF">
                    <h4>Nama Pegawai</h4>
                    <p>Jabatan Fungsional</p>
                </div>

            </div>

        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Laman-Balai-Bahasa\resources\views/user/profil/pegawai.blade.php ENDPATH**/ ?>