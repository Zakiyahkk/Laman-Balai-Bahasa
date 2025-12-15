<!-- NAVBAR -->
<nav class="navbar">
    <div class="container nav-content">

        <!-- TOGGLE MOBILE -->
        <div class="menu-toggle" id="menuToggle">
            <i class="fa-solid fa-bars"></i>
        </div>

        <!-- MENU -->
        <ul class="nav-menu" id="navMenu">
            <li><a href="/">BERANDA</a></li>
            <li><a href="#">PROFIL</a></li>
            <li><a href="/berita">BERITA</a></li>
            <li><a href="#">LAYANAN</a></li>
            <li><a href="#">SAKIP</a></li>
            <li><a href="#">PPID</a></li>
            <li><a href="#">KERJA SAMA</a></li>
            <li><a href="#">APLIKASI</a></li>
            <li><a href="#">ZI-WBK/WBBM</a></li>
            <li><a href="#">ULT</a></li>
            <li><a href="#">FAQ</a></li>
        </ul>

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
