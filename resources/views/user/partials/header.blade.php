<header class="bbp-navbar">
    <div class="bbp-overlay" id="bbpOverlay"></div>

    <!-- TOP BAR -->
    <div class="bbp-top">
        <div class="container">
            <div class="bbp-top-left">
                <span><i class="fa-solid fa-phone"></i>081217352004</span>
                <span><i class="fa-solid fa-bullhorn"></i>Pengaduan ULT</span>
            </div>
            <div class="bbp-social">
                <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
                <a href="#"><i class="fa-brands fa-youtube"></i></a>
            </div>
        </div>
    </div>

    <!-- NAV -->
    <div class="bbp-nav">
        <div class="nav-container">

            <div class="logo">
                <img src="{{ asset('img/logobbpr4.png') }}" alt="BBP Riau">
            </div>

            <ul class="nav-menu">

                <li class="mobile-sidebar-header">
                    <img src="{{ asset('img/logobbpr4.png') }}" alt="BBP Riau">
                </li>

                <li><a href="/">Beranda</a></li>

                <li class="has-dropdown">
                    <a href="#" class="dropdown-toggle">
                        Profil
                        <i class="fa-solid fa-chevron-down dropdown-icon"></i>
                    </a>

                    <!-- Menu Dekstop Aktif -->
                    <ul class="dropdown">
                        <li><a href="{{ url('/profil/visi-misi') }}">Visi & Misi</a></li>
                        <li><a href="{{ url('/profil/tugas-fungsi') }}">Tugas & Fungsi</a></li>
                        <li><a href="{{ url('/profil/struktur-organisasi') }}">Struktur Organisasi</a></li>
                        <li><a href="{{ url('/profil/pegawai') }}">Pegawai</a></li>
                        <li><a href="{{ url('/profil/logo') }}">Logo BPP Riau</a></li>
                        <li><a href="{{ url('/profil/kontak') }}">Kontak Kami</a></li>
                    </ul>

                </li>

                <li class="has-dropdown">
                    <a href="#" class="dropdown-toggle">
                        Produk
                        <i class="fa-solid fa-chevron-down dropdown-icon"></i>
                    </a>
                    <div class="dropdown">
                        <a href="#">Publikasi</a>
                        <a href="#">Kamus</a>
                        <a href="#">Bahasa Daerah</a>
                    </div>
                </li>

                <li class="has-dropdown">
                    <a href="#" class="dropdown-toggle">Akuntabilitas
                        <i class="fa-solid fa-chevron-down dropdown-icon"></i>
                    </a>
                    <div class="dropdown">
                        <a href="#">Perjanjian Kinerja</a>
                        <a href="#">Renstra</a>
                        <a href="#">LAKIP</a>
                    </div>
                </li>

                <li><a href="#">PPID</a></li>
                <li><a href="#">Survei</a></li>
                <li><a href="#">ZI-WBK</a></li>
                <li><a href="#">Ruang Konsultasi</a></li>

            </ul>

            <div class="nav-action">
                <a href="#" class="btn-outline">Kontak</a>
                <a href="#" class="btn-primary">Layanan</a>
            </div>

            <button class="menu-toggle" id="menuToggle">
                <i class="fa-solid fa-bars"></i>
            </button>

        </div>
    </div>
</header>
