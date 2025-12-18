<!-- MOBILE HEADER -->
<div class="mobile-header">
    <img src="{{ asset('img/logo.png') }}" alt="Logo" class="mobile-logo">

    <button class="mobile-menu-btn" id="menuToggle">
        <i class="fa-solid fa-bars"></i>
    </button>
</div>

<!-- MOBILE INFO (KHUSUS MOBILE) -->
<div class="mobile-info">
    <div class="mobile-contact">
        <i class="fa-solid fa-phone-volume"></i>
        <span>081217352004</span>
    </div>

    <div class="mobile-ult">
        <i class="fa-solid fa-bullhorn"></i>
        <span>Pengaduan ULT</span>
    </div>

    <div class="mobile-social">
        <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
        <a href="#"><i class="fa-brands fa-instagram"></i></a>
        <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
        <a href="#"><i class="fa-brands fa-youtube"></i></a>
    </div>
</div>

<!-- HEADER UTAMA -->
<div class="header-main">
    <div class="container header-content">

        <div class="header-brand">
            <img src="{{ asset('img/logo.png') }}" alt="Logo Kemdikbud">
        </div>

        <div class="header-contact">
            <div class="contact-item">
                <i class="fa-solid fa-phone-volume"></i>
                <div>
                    <strong>081217352004</strong>
                    <small>Kontak Aduan & Layanan</small>
                </div>
            </div>

            <div class="contact-item">
                <i class="fa-solid fa-bullhorn"></i>
                <div>
                    <strong>Pengaduan ULT</strong>
                    <small>Klik di sini untuk melakukan pengaduan</small>
                </div>
            </div>
            <div class="topbar">
                <div class="container topbar-content">
                    <div class="topbar-right">
                        <div class="social-icons">
                            <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                            <a href="#"><i class="fa-brands fa-instagram"></i></a>
                            <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
                            <a href="#"><i class="fa-brands fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- NAVBAR (SATU SAJA) -->
<nav class="navbar">
    <div class="container nav-content">

        <ul class="nav-menu" id="navMenu">

            <!-- BERANDA -->
            <li class="nav-item {{ request()->path() === '/' ? 'active' : '' }}">
                <a href="{{ url('/') }}">Beranda</a>
            </li>

            <!-- PROFIL -->
            <li class="nav-item dropdown {{ request()->is('profil*') ? 'active' : '' }}">
                <a href="#">Profil ▾</a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->is('profil/visi-misi') ? 'active' : '' }}">
                        <a href="{{ url('/profil/visi-misi') }}">Visi dan Misi</a>
                    </li>
                    <li class="{{ request()->is('profil/kontak-kami') ? 'active' : '' }}">
                        <a href="{{ url('/profil/kontak-kami') }}">Kontak Kami</a>
                    </li>
                </ul>
            </li>


            <li class="nav-item dropdown">
                <a href="#">Produk ▾</a>
                <ul class="dropdown-menu">
                    <li><a href="#">Publikasi</a></li>
                    <li><a href="#">Kamus</a></li>
                    <li><a href="#">Bahasa Daerah</a></li>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a href="#">Akuntabilitas ▾</a>
                <ul class="dropdown-menu">
                    <li><a href="#">SAKIP</a></li>
                    <li><a href="#">Laporan Kinerja</a></li>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a href="#">Layanan ▾</a>
                <ul class="dropdown-menu">
                    <li><a href="#">Konsultasi Bahasa</a></li>
                    <li><a href="#">Uji Kemahiran</a></li>
                </ul>
            </li>

            <li class="nav-item"><a href="#">PPID</a></li>

            <li class="nav-item dropdown">
                <a href="#">Survei ▾</a>
                <ul class="dropdown-menu">
                    <li><a href="#">Survei Kepuasan</a></li>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a href="#">ZI-WBK ▾</a>
                <ul class="dropdown-menu">
                    <li><a href="#">Pembangunan ZI</a></li>
                </ul>
            </li>

            <li class="nav-item">
                <a href="#">Ruang Konsultasi</a>
            </li>

        </ul>

    </div>
</nav>
