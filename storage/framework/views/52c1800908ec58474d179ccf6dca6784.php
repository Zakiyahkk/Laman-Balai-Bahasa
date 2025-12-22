

<?php $__env->startSection('title', 'Detail Berita'); ?>

<?php $__env->startSection('content'); ?>

    <section class="section">
        <div class="container">

            <!-- JUDUL -->
            <h1 style="font-size:32px; font-weight:700; margin-bottom:10px;">
                Kolaborasi dengan Komunitas Relawan Cerdas Riau
            </h1>

            <!-- META -->
            <div style="color:#777; font-size:14px; margin-bottom:20px;">
                <span>14 Desember 2025</span> |
                <span>Admin</span>
            </div>

            <!-- GAMBAR -->
            <div style="margin-bottom:30px;">
                <img src="/img/berita1.jpg" alt="Kolaborasi Relawan Cerdas Riau"
                    style="width:100%; max-width:900px; border-radius:6px;">
            </div>

            <!-- ISI BERITA -->
            <div style="max-width:900px; line-height:1.9; font-size:16px; color:#444; text-align:justify;">

                <p>
                    Balai Bahasa Provinsi Riau melaksanakan kegiatan kolaborasi
                    dengan Komunitas Relawan Cerdas Riau sebagai upaya memperkuat
                    peran literasi dan kebahasaan di tengah masyarakat.
                </p>

                <p>
                    Kegiatan ini bertujuan untuk meningkatkan kesadaran masyarakat
                    terhadap penggunaan bahasa Indonesia yang baik dan benar,
                    serta pelestarian bahasa daerah sebagai kekayaan budaya
                    bangsa.
                </p>

                <p>
                    Kepala Balai Bahasa Provinsi Riau menyampaikan bahwa sinergi
                    antara lembaga pemerintah dan komunitas sangat penting dalam
                    menyukseskan program kebahasaan dan kesastraan.
                </p>

                <p>
                    Melalui kegiatan ini diharapkan terbangun jejaring kerja sama
                    yang berkelanjutan untuk mendukung visi Balai Bahasa Provinsi
                    Riau sebagai pusat pembinaan bahasa di wilayah Riau.
                </p>

            </div>

            <!-- GARIS -->
            <div style="margin:40px 0; border-top:1px solid #e5e5e5;"></div>

            <!-- TOMBOL KEMBALI -->
            <a href="<?php echo e(route('berita.index')); ?>"
                style="
                display:inline-block;
                background:#000;
                color:#fff;
                padding:10px 18px;
                text-decoration:none;
                font-size:14px;
                border-radius:3px;
           ">
                ← Kembali ke Berita
            </a>

        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Laman-Balai-Bahasa\resources\views/user/berita/show.blade.php ENDPATH**/ ?>