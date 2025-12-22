

<?php $__env->startSection('title', 'Logo BPP Riau'); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/profil.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="profil-page">
        <div class="container profil-container">

            <div class="profil-header">
                <h1>Logo BPP Riau</h1>
                <p class="profil-subtitle">
                    Identitas Resmi Balai Bahasa Provinsi Riau
                </p>
            </div>

            <div class="profil-card text-center">
                <img src="<?php echo e(asset('images/logo-bpp-riau.png')); ?>" alt="Logo BPP Riau"
                    style="max-width: 220px; margin-bottom: 20px;">

                <h3>Makna Logo</h3>
                <p>
                    Logo Balai Bahasa Provinsi Riau melambangkan komitmen dalam
                    pembinaan, pengembangan, dan pelindungan bahasa dan sastra
                    Indonesia serta bahasa daerah di Provinsi Riau.
                </p>
            </div>

        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Laman-Balai-Bahasa\resources\views/user/profil/logo-bpp-riau.blade.php ENDPATH**/ ?>