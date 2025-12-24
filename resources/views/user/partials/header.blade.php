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
                        <a href="{{ url('/profil/visi-misi') }}">Visi Dan Misi Balai Bahasa Provinsi Riau</a>
                    </li>
                    <li class="{{ request()->is('profil/tugas-dan-fungsi') ? 'active' : '' }}">
                        <a href="{{ url('/profil/tugas-dan-fungsi') }}">Tugas Pokok Dan Fungsi</a>
                    </li>
                    <li class="{{ request()->is('profil/struktur-organisasi') ? 'active' : '' }}">
                        <a href="{{ url('/profil/struktur-organisasi') }}">Struktur Organisasi</a>
                    </li>
                    <li class="{{ request()->is('profil/pegawai') ? 'active' : '' }}">
                        <a href="{{ url('/profil/pegawai') }}">Pegawai</a>
                    </li>
                    <li class="{{ request()->is('profil/logo-bpp-riau') ? 'active' : '' }}">
                        <a href="{{ url('/profil/logo-bpp-riau') }}">Logo BPP Riau</a>
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
                <a href="#" class="dropdown-toggle">Akuntabilitas ▾</a>

                <ul class="dropdown-menu">
                    <li class="dropdown-submenu">
                        <a href="#">Perjanjian Kinerja ▸</a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Perjanjian Kinerja Tahun 2025</a></li>
                            <li><a href="#">Perjanjian Kinerja Tahun 2024</a></li>
                            <li><a href="#">Perjanjian Kinerja Tahun 2023</a></li>
                            <li><a href="#">Perjanjian Kinerja Tahun 2022</a></li>
                            <li><a href="#">Perjanjian Kinerja Tahun 2021</a></li>
                            <li><a href="#">Perjanjian Kinerja Tahun 2020</a></li>
                        </ul>
                    </li>

                    <li><a href="#">Renstra</a></li>
                    <li><a href="#">LAKIP</a></li>
                    <li><a href="#">LAKIN</a></li>
                    <li><a href="#">Rencana Aksi</a></li>
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
