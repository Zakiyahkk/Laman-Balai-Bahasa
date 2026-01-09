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
                <img src="{{ asset('img/logobalai.png') }}" alt="BBP Riau">
            </div>

            <ul class="nav-menu">

                <li class="mobile-sidebar-header">
                    <img src="{{ asset('img/logobbpr4.png') }}" alt="BBP Riau">
                </li>

                <li><a href="/" class="{{ request()->is('/') ? 'active' : '' }}">
                        Beranda
                    </a>
                </li>

                <li class="has-dropdown {{ request()->is('profil*') ? 'active open' : '' }}">
                    <a href="#" class="dropdown-toggle">
                        Profil
                        <i class="fa-solid fa-chevron-down dropdown-icon"></i>
                    </a>

                    <!-- Menu Dekstop Aktif -->
                    <ul class="dropdown">
                        <li>
                            <a href="{{ url('/profil/visi-misi') }}"
                                class="{{ request()->is('profil/visi-misi') ? 'active' : '' }}">
                                Visi & Misi
                            </a>
                        </li>

                        <li>
                            <a href="{{ url('/profil/tugas-dan-fungsi') }}"
                                class="{{ request()->is('profil/tugas-dan-fungsi') ? 'active' : '' }}">
                                Tugas & Fungsi
                            </a>
                        </li>

                        <li>
                            <a href="{{ url('/profil/struktur-organisasi') }}"
                                class="{{ request()->is('profil/struktur-organisasi') ? 'active' : '' }}">
                                Struktur Organisasi
                            </a>
                        </li>

                        <li>
                            <a href="{{ url('/profil/pegawai') }}"
                                class="{{ request()->is('profil/pegawai') ? 'active' : '' }}">
                                Pegawai
                            </a>
                        </li>

                        <li>
                            <a href="{{ url('/profil/logo-bpp-riau') }}"
                                class="{{ request()->is('profil/logo-bpp-riau') ? 'active' : '' }}">
                                Logo BBP Riau
                            </a>
                        </li>

                        <li>
                            <a href="{{ url('/profil/kontak-kami') }}"
                                class="{{ request()->is('profil/kontak-kami') ? 'active' : '' }}">
                                Kontak Kami
                            </a>
                        </li>
                    </ul>


                </li>

                <li class="has-dropdown">
                    <a href="#" class="dropdown-toggle">
                        Produk
                        <i class="fa-solid fa-chevron-down dropdown-icon"></i>
                    </a>
                    <div class="dropdown">
                        <a href="{{ url('/produk/terbitan-bbpr') }}"
                            class="{{ request()->is('produk/terbitan-bbpr') ? 'active' : '' }}">Terbitan BBPR
                        </a>
                        <a href="{{ url('/produk/jurnal') }}"
                            class="{{ request()->is('produk/jurnal') ? 'active' : '' }}">Jurnal</a>
                        <a href="{{ url('/produk/majalah') }}"
                            class="{{ request()->is('produk/majalah') ? 'active' : '' }}">Majalah Serindit</a>
                        <a href="{{ url('/produk/sembari') }}"
                            class="{{ request()->is('produk/sembari') ? 'active' : '' }}">Sembari (Serial
                            Terjemahan BBPR)</a>
                        <a href="{{ url('/produk/peta-pembinaan-bahasa') }}"
                            class="{{ request()->is('produk/peta-pembinaan-bahasa') ? 'active' : '' }}">Peta
                            Pembinaan
                            Bahasa</a>
                        <a href="{{ url('/produk/peta-pembinaan-sastra') }}"
                            class="{{ request()->is('produk/peta-pembinaan-sastra') ? 'active' : '' }}">Peta
                            Pembinaan
                            Sastra</a>
                        <a href="{{ url('/produk/bipa') }}"
                            class="{{ request()->is('produk/bipa') ? 'active' : '' }}">Bipa</a>
                        <a href="{{ url('/produk/kemala') }}"
                            class="{{ request()->is('produk/kemala') ? 'active' : '' }}">kemala</a>
                    </div>
                </li>

                <li class="has-dropdown">
                    <a href="#" class="dropdown-toggle">Akuntabilitas
                        <i class="fa-solid fa-chevron-down dropdown-icon"></i>
                    </a>
                    <div class="dropdown">
                        <a href="{{ url('/akuntabilitas/perjanjian-kinerja') }}"
                            class="{{ request()->is('akuntabilitas/perjanjian-kinerja') ? 'active' : '' }}">Perjanjian
                            Kinerja</a>
                        <a href="{{ url('/akuntabilitas/renstra') }}"
                            class="{{ request()->is('akuntabilitas/renstra') ? 'active' : '' }}">Renstra</a>
                        <a href="{{ url('/akuntabilitas/lakip') }}"
                            class="{{ request()->is('akuntabilitas/lakip') ? 'active' : '' }}">LAKIP</a>
                        <a href="{{ url('/akuntabilitas/lakin') }}"
                            class="{{ request()->is('akuntabilitas/lakin') ? 'active' : '' }}">LAKIN</a>
                        <a href="{{ url('/akuntabilitas/rencana-aksi') }}"
                            class="{{ request()->is('akuntabilitas/rencana-aksi') ? 'active' : '' }}">Rencana Aksi</a>
                    </div>
                </li>

                <li class="has-dropdown">
                    <a href="#" class="dropdown-toggle">Layanan
                        <i class="fa-solid fa-chevron-down dropdown-icon"></i>
                    </a>
                    <div class="dropdown">
                        <a href="#">Layanan Ahli Bahasa Balai Bahasa Provinsi Riau</a>
                        <a href="#">Layanan Penerjemahan Balai Bahasa Provinsi Riau</a>
                        <a href="#">Layanan Bahasa Indonesia Untuk Penutur Asing (BIPA) Balai Bahasa Provinsi
                            Riau</a>
                        <a href="#">Layanan Uji Kemahiran Berbahasa Indonesia (UKBI) Adaptif Balai Bahasa Provinsi
                            Riau</a>
                        <a href="#">Layanan Perpustakaan</a>
                        <a href="#">Layanan Magang</a>
                    </div>
                </li>


                <li>
                    <a href="{{ url('/ppid/ppid') }}" class="{{ request()->is('ppid*') ? 'active' : '' }}">
                        PPID
                    </a>
                </li>

                <li>
                    <a href="{{ url('/survei/survei') }}" class="{{ request()->is('survei*') ? 'active' : '' }}">
                        Survei
                    </a>
                </li>

                <li>
                    <a href="{{ url('/wbs/wbs') }}" class="{{ request()->is('wbs') ? 'active' : '' }}">
                        WBS
                    </a>
                </li>

                <li>
                    <a href="{{ url('/ziwbk/ziwbk') }}" class="{{ request()->is('ziwbk*') ? 'active' : '' }}">
                        ZI-WBK
                    </a>
                </li>

            </ul>
            <button class="menu-toggle" id="menuToggle">
                <i class="fa-solid fa-bars"></i>
            </button>

        </div>
    </div>
</header>
