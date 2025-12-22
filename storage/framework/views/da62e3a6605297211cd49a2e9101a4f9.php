<nav class="navbar">
    <div class="nav-container">

        <!-- KIRI: LOGO + NAMA INSTANSI -->
        <div class="nav-brand">
            <img src="<?php echo e(asset('img/logo.png')); ?>" alt="Logo Kemdikbud" class="logo-kemdikbud">

            <div class="brand-text">
                <span class="brand-title">Balai Bahasa</span>
                <span class="brand-subtitle">Provinsi Riau</span>
            </div>
        </div>

        <!-- KANAN: MENU -->
        <ul class="nav-menu">
            <li><a href="/">Beranda</a></li>
            <li><a href="/berita">Berita</a></li>
            <li><a href="/pengumuman">Pengumuman</a></li>
            <li><a href="/sapa-bipa">SAPA BIPA</a></li>
            <li><a href="/kamus">Kamus</a></li>
        </ul>

        <!-- MOBILE TOGGLE -->
        <div class="menu-toggle">☰</div>

    </div>
</nav>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const toggle = document.querySelector(".menu-toggle");
        const menu = document.querySelector(".nav-menu");

        toggle.addEventListener("click", function() {
            menu.classList.toggle("show");
        });
    });
</script>
<?php /**PATH C:\laragon\www\Laman-Balai-Bahasa\resources\views/user/partials/navbar.blade.php ENDPATH**/ ?>