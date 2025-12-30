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
                        <li><a href="{{ url('/profil/tugas-dan-fungsi') }}">Tugas & Fungsi</a></li>
                        <li><a href="{{ url('/profil/struktur-organisasi') }}">Struktur Organisasi</a></li>
                        <li><a href="{{ url('/profil/pegawai') }}">Pegawai</a></li>
                        <li><a href="{{ url('/profil/logo-bpp-riau') }}">Logo BPP Riau</a></li>
                        <li><a href="{{ url('/profil/kontak-kami') }}">Kontak Kami</a></li>
                    </ul>

                </li>

                <li class="has-dropdown">
                    <a href="#" class="dropdown-toggle">
                        Produk
                        <i class="fa-solid fa-chevron-down dropdown-icon"></i>
                    </a>
                    <div class="dropdown">
                        <a href="{{ url('/produk/bahan-bacaan-literasi') }}">Bahan Bacaan Literasi</a>
                        <a href="{{ url('/produk/jurnal-madah') }}">Jurnal Madah</a>
                        <a href="{{ url('/produk/majalah') }}">Majalah</a>
                        <a href="{{ url('/produk/penerjemahan-sembari') }}">Penerjemahan: Sembari</a>
                        <a href="{{ url('/produk/peta-pembinaan-bahasa') }}">Peta Pembinaan Bahasa</a>
                    </div>
                </li>

                <li class="has-dropdown">
                    <a href="#" class="dropdown-toggle">Akuntabilitas
                        <i class="fa-solid fa-chevron-down dropdown-icon"></i>
                    </a>
                    <div class="dropdown">
                        <a href="{{ url('/akuntabilitas/perjanjian-kinerja') }}">Perjanjian Kinerja</a>
                        <a href="{{ url('/akuntabilitas/renstra') }}">Renstra</a>
                        <a href="{{ url('/akuntabilitas/lakip') }}">LAKIP</a>
                        <a href="{{ url('/akuntabilitas/lakin') }}">LAKIN</a>
                        <a href="{{ url('/akuntabilitas/rencana-aksi') }}">Rencana Aksi</a>
                    </div>
                </li>

                <li class="has-dropdown">
                    <a href="#" class="dropdown-toggle">Layanan
                        <i class="fa-solid fa-chevron-down dropdown-icon"></i>
                    </a>
                    <div class="dropdown">
                        <a href="#">Layanan Ahli Bahasa Balai Bahasa Provinsi Riau</a>
                        <a href="#">Layanan Penerjemahan Balai Bahasa Provinsi Riau</a>
                        <a href="#">Layanan Bahasa Indonesia Untuk Penutur Asing (BIPA) Balai Bahasa Provinsi Riau</a>
                        <a href="#">Layanan Uji Kemahiran Berbahasa Indonesia (UKBI) Adaptif Balai Bahasa Provinsi Riau</a>
                        <a href="#">Layanan Perpustakaan</a>
                        <a href="#">Layanan Magang</a>
                    </div>
                </li>


                <li><a href="#">PPID</a></li>
                <li><a href="#">Survei</a></li>
                <li><a href="#">ZI-WBK</a></li>
                <li><a href="#">Ruang Konsultasi</a></li>
            </ul>
            <button class="menu-toggle" id="menuToggle">
                <i class="fa-solid fa-bars"></i>
            </button>

        </div>
    </div>
</header>