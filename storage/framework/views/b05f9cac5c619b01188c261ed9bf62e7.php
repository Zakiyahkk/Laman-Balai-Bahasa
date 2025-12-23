<?php $__env->startSection('title', 'Visi dan Misi'); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/profil.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section class="profil-page">
        <div class="container profil-container">

            <div class="profil-header">
                <h1>Visi dan Misi</h1>
                <p class="profil-subtitle">Balai Bahasa Provinsi Riau</p>
            </div>

            <div class="profil-card">
                <h3>Visi</h3>
                <p>
                    Terwujudnya pengutamaan bahasa Indonesia, pelindungan bahasa daerah,
                    dan penginternasionalan bahasa Indonesia di Provinsi Riau.
                </p>
            </div>

            <div class="profil-card">
                <h3>Misi</h3>
                <ol>
                    <li>Meningkatkan sikap positif masyarakat terhadap bahasa Indonesia.</li>
                    <li>Melindungi dan melestarikan bahasa serta sastra daerah.</li>
                    <li>Meningkatkan mutu layanan kebahasaan dan kesastraan.</li>
                    <li>Mengembangkan peran bahasa Indonesia di tingkat nasional.</li>
                </ol>
            </div>

        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Laman-Balai-Bahasa\resources\views/user/profil/visi-misi.blade.php ENDPATH**/ ?>