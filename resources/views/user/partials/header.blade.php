<header class="bbp-navbar" id="navbar">
    <div class="bbp-top">
        <div class="container">
            <div class="bbp-top-left">
                <div class="top-item-box">
                    <i class="fa-regular fa-envelope top-icon-big"></i>
                    <div class="top-text-stack">
                        <span class="label-top">Email Kami:</span>
                        <span class="value-top">balaibahasaprovriau@gmail.com</span>
                    </div>
                </div>
                <div class="top-item-box">
                    <i class="fa-regular fa-comment-dots top-icon-big"></i>
                    <div class="top-text-stack">
                        <span class="label-top">Pengaduan ULT:</span>
                        <a href="{{ url('/wbs/wbs') }}" class="btn-ult-big">Klik disini untuk melakukan pengaduan</a>
                    </div>
                </div>
            </div>
            <div class="bbp-social-top">
                <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#"><i class="fa-brands fa-tiktok"></i></a>
                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                <a href="#"><i class="fa-brands fa-youtube"></i></a>
            </div>
        </div>
    </div>

    <div class="bbp-nav">
        <div class="nav-container">
            <div class="logo">
                {{-- Gunakan asset() untuk gambar juga --}}
                <img src="{{ asset('img/logobalai.png') }}" alt="Logo">
            </div>

            <button class="menu-toggle" onclick="toggleMenu()" aria-label="Toggle navigation">
                <i class="fa-solid fa-bars"></i>
            </button>

            <ul class="nav-menu">
                <li class="close-menu-item">
                    <button class="close-btn-inner" onclick="toggleMenu()">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </li>

                <li class="mobile-only-logo">
                    <img src="{{ asset('img/logobalai.png') }}" alt="Logo Mobile">
                </li>

                <li><a href="/" class="{{ request()->is('/') ? 'active' : '' }}"><i
                            class="fa-regular fa-home menu-icon"></i> Beranda</a></li>
                <li><a href="{{ url('/ziwbk/ziwbk') }}" class="{{ request()->is('ziwbk*') ? 'active' : '' }}"><i
                            class="fa-regular fa-book-bookmark menu-icon"></i>SAPA</a></li>
                <li class="has-dropdown">
                    <a href="javascript:void(0)" onclick="toggleSub(this)"
                        class="{{ request()->is('profil*') ? 'active' : '' }}">
                        Profil <i class="fa-solid fa-chevron-down dropdown-arrow"></i>
                    </a>
                    <ul class="dropdown">
                        <li><a href="{{ url('/profil/sejarah-singkat') }}"><i class="fa-regular fa-address-book"></i>
                                Sejarah Singkat</a></li>
                        <li><a href="{{ url('/profil/visi-misi') }}"><i class="fa-regular fa-lightbulb"></i> Visi &
                                Misi</a></li>
                        <li><a href="{{ url('/profil/tugas-dan-fungsi') }}"><i class="fa-regular fa-id-badge"></i> Tugas
                                & Fungsi</a></li>
                        <li><a href="{{ url('/profil/struktur-organisasi') }}"><i class="fa-solid fa-sitemap"></i>
                                Struktur Organisasi</a></li>
                        <li><a href="{{ url('/profil/pegawai') }}"><i class="fa-regular fa-user"></i> Pegawai</a></li>
                        <li><a href="{{ url('/profil/logo-bpp-riau') }}"><i class="fa-regular fa-image"></i> Logo</a>
                        </li>
                    </ul>
                </li>

                <li class="has-dropdown">
                    <a href="javascript:void(0)" onclick="toggleSub(this)"
                        class="{{ request()->is('produk*') ? 'active' : '' }}">
                        Produk <i class="fa-solid fa-chevron-down dropdown-arrow"></i>
                    </a>
                    <ul class="dropdown">
                        <li><a href="{{ url('/produk/terbitan-bbpr') }}"><i class="fa-regular fa-copy"></i> Terbitan
                                BBPR</a></li>
                        <li><a href="{{ url('/produk/jurnal') }}"><i class="fa-regular fa-newspaper"></i> Jurnal
                                Madah</a>
                        </li>
                        <li><a href="{{ url('/produk/majalah') }}"><i class="fa-solid fa-book-open"></i> Majalah
                                Serindit</a></li>
                        <li><a href="{{ url('/produk/sembari') }}"><i class="fa-solid fa-gem"></i>
                                Sembari ( Serial Terjemahan BBPR)</a>
                        <li><a href="{{ url('/produk/peta-pembinaan-bahasa') }}"><i class="fa-solid fa-map"></i>
                                Peta Pembinaan Bahasa</a>
                        </li>
                        <li><a href="{{ url('/produk/peta-pembinaan-sastra') }}"><i class="fa-solid fa-map"></i>
                                Peta Pembinaan Sastra</a>
                        </li>
                        <li><a href="{{ url('/produk/bipa') }}"><i class="fa-solid fa-globe-asia"></i> SAPA BIPA</a>
                        </li>
                        <li><a href="{{ url('/produk/kemala') }}"><i class="fa-regular fa-language"></i> Kemala (Kamus
                                Elektronik Bahasa Melayu Riau)</a></li>
                    </ul>
                </li>

                <li class="has-dropdown">
                    <a href="javascript:void(0)" onclick="toggleSub(this)"
                        class="{{ request()->is('akuntabilitas*') ? 'active' : '' }}">
                        Akuntabilitas <i class="fa-solid fa-chevron-down dropdown-arrow"></i>
                    </a>
                    <ul class="dropdown">
                        <li><a href="{{ url('/akuntabilitas/renstra') }}"><i class="fa-regular fa-folder"></i>
                                Renstra</a>
                        </li>
                        <li><a href="{{ url('/akuntabilitas/dipa') }}"><i class="fa-solid fa-calculator"></i>
                                DIPA</a></li>
                        <li><a href="{{ url('/akuntabilitas/lakin') }}"><i class="fa-solid fa-folder-minus"></i>
                                Lakin</a></li>
                        <li><a href="{{ url('/akuntabilitas/perjanjian-kinerja') }}"><i
                                    class="fa-regular fa-file-lines"></i> Perjanjian Kinerja</a></li>
                        <li><a href="{{ url('/akuntabilitas/rencana-aksi') }}"><i
                                    class="fa-regular fa-rectangle-list"></i> Rencana Aksi</a></li>
                        <li><a href="{{ url('/akuntabilitas/sakai') }}"><i class="fa-regular fa-file-lines"></i>
                                SAKAI
                            </a></li>
                    </ul>
                </li>

                <li class="has-dropdown">
                    <a href="javascript:void(0)" onclick="toggleSub(this)"
                        class="{{ request()->is('layanan*') ? 'active' : '' }}">
                        Layanan <i class="fa-solid fa-chevron-down dropdown-arrow"></i>
                    </a>
                    <ul class="dropdown">
                        <li><a href="#"><i class="fa-solid fa-user-tie"></i> Ahli Bahasa</a></li>
                        <li><a href="#"><i class="fa-solid fa-pen-nib"></i> Penerjemahan</a></li>
                        <li><a href="#"><i class="fa-solid fa-graduation-cap"></i> UKBI Adaptif</a></li>
                        <li><a href="#"><i class="fa-solid fa-globe-asia"></i> BIPA </a></li>
                        <li><a href="#"><i class="fa-solid fa-book"></i> Perpustakaan</a></li>
                        <li><a href="#"><i class="fa-solid fa-users"></i> Magang </a></li>
                    </ul>
                </li>

                <li><a href="{{ url('https://ppidbbpriau.kemendikdasmen.go.id/') }}"
                        class="{{ request()->is('ppid*') ? 'active' : '' }}"><i
                            class="fa-regular fa-file-lines menu-icon"></i> PPID</a></li>
                <li class="has-dropdown">
                    <a href="javascript:void(0)" onclick="toggleSub(this)"
                        class="{{ request()->is('layanan*') ? 'active' : '' }}">
                        Survei <i class="fa-solid fa-chevron-down dropdown-arrow"></i>
                    </a>
                    <ul class="dropdown">
                        <li><a href="{{ url('#') }}" class="{{ request()->is('skm*') ? 'active' : '' }}"><i
                                    class="fa-regular fa-file-lines menu-icon"></i> Survei Kepuasan Masyarakat</a></li>
                        <li><a href="{{ url('#') }}" class="{{ request()->is('spkp*') ? 'active' : '' }}"><i
                                    class="fa-regular fa-file-lines menu-icon"></i> Survei Persepsi Kualitas
                                Pelayanan</a></li>
                        <li><a href="{{ url('#') }}" class="{{ request()->is('spak*') ? 'active' : '' }}"><i
                                    class="fa-regular fa-file-lines menu-icon"></i> Survei Persepsi Antikorupsi</a>
                        </li>
                    </ul>
                </li>
                <li><a href="{{ url('/wbs/wbs') }}" class="{{ request()->is('wbs*') ? 'active' : '' }}"><i
                            class="fa-solid fa-bullhorn menu-icon"></i> WBS</a></li>
                <li><a href="{{ url('/ziwbk/ziwbk') }}" class="{{ request()->is('ziwbk*') ? 'active' : '' }}"><i
                            class="fa-regular fa-star menu-icon"></i>ZI-WBK</a></li>

                <li class="mobile-extra-content">
                    <div class="mob-item">
                        <i class="fa-regular fa-envelope"></i>
                        <span>balaibahasaprovriau@gmail.com</span>
                    </div>

                    <a href="{{ url('/wbs/wbs') }}" class="mob-btn">
                        <i class="fa-regular fa-comment-dots"></i> Pengaduan ULT
                    </a>

                    <div class="mob-social">
                        <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
                        <a href="#"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#"><i class="fa-brands fa-youtube"></i></a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</header>
