

<?php $__env->startSection('title', 'Kontak Kami'); ?>
<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/profil.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section class="profil-ntb">
        <div class="container">

            <div class="profil-header">
                <h1>Kontak Kami</h1>
            </div>

            <div class="profil-content">
                <div class="profil-section">
                    <p><strong>Balai Bahasa Provinsi Riau</strong></p>

                    <p>
                        Jalan H.R. Soebrantas Km. 12,5<br>
                        Kampus Binawidya UNRI<br>
                        Simpang Baru, Tampan, Pekanbaru, Riau
                    </p>

                    <p>
                        <strong>Telepon:</strong> (0761) 65930<br>
                        <strong>Email:</strong> balaibahasariau@kemdikbud.go.id
                    </p>
                </div>
                <div class="section-divider"></div>
            </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Laman-Balai-Bahasa\resources\views/user/profil/kontak-kami.blade.php ENDPATH**/ ?>