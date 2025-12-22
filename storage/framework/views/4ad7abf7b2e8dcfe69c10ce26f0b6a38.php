

<?php $__env->startSection('title', 'Struktur Organisasi'); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/profil.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="profil-riau">
        <div class="container">

            <div class="profil-header">
                <h1>Struktur Organisasi</h1>
            </div>

            <div class="profil-content">
                <div class="profil-section text-center">
                    <p>
                        Struktur organisasi Balai Bahasa Provinsi Riau menggambarkan
                        susunan dan hubungan kerja antarbagian dalam pelaksanaan tugas.
                    </p>

                    <img src="<?php echo e(asset('images/struktur-organisasi.png')); ?>"
                        alt="Struktur Organisasi Balai Bahasa Provinsi Riau" class="img-fluid mt-4">
                </div>

                <div class="section-divider"></div>
            </div>

        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Laman-Balai-Bahasa\resources\views/user/profil/struktur-organisasi.blade.php ENDPATH**/ ?>