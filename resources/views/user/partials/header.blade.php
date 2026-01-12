<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Balai Bahasa Provinsi Riau</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link rel="stylesheet" href="style.css">
</head>

<body>

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

                    <li><a href="/" class="{{ request()->is('/') ? 'active' : '' }}"><i class="fa-regular fa-compass menu-icon"></i> Beranda</a></li>

<<<<<<< HEAD
                    <li class="has-dropdown">
                        <a href="javascript:void(0)" onclick="toggleSub(this)" class="{{ request()->is('profil*') ? 'active' : '' }}">
                            Profil <i class="fa-solid fa-chevron-down dropdown-arrow"></i>
=======
                <li class="has-dropdown {{ request()->is('profil*') ? 'active open' : '' }}">
                    <a href="#" class="dropdown-toggle">
                        Profil
                        <i class="fa-solid fa-chevron-down dropdown-icon"></i>
                    </a>

                    <!-- Menu Dekstop Aktif -->
                    <ul class="dropdown">
                        <li>
                            <a href="{{ url('/profil/sejarah-singkat') }}"
                                class="{{ request()->is('profil/sejarah-singkat') ? 'active' : '' }}">
                                Sejarah Singkat
                            </a>
                        </li>
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
                                Logo
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
>>>>>>> 6883b8e58caaadc7258d1a9d662322497200fcfd
                        </a>
                        <ul class="dropdown">
                            <li><a href="{{ url('/profil/visi-misi') }}"><i class="fa-regular fa-lightbulb"></i> Visi & Misi</a></li>
                            <li><a href="{{ url('/profil/tugas-dan-fungsi') }}"><i class="fa-regular fa-id-badge"></i> Tugas & Fungsi</a></li>
                            <li><a href="{{ url('/profil/struktur-organisasi') }}"><i class="fa-solid fa-sitemap"></i> Struktur Organisasi</a></li>
                            <li><a href="{{ url('/profil/pegawai') }}"><i class="fa-regular fa-user"></i> Pegawai</a></li>
                            <li><a href="{{ url('/profil/logo-bpp-riau') }}"><i class="fa-regular fa-image"></i> Logo</a></li>
                            <li><a href="{{ url('/profil/kontak-kami') }}"><i class="fa-regular fa-address-book"></i> Kontak Kami</a></li>
                        </ul>
                    </li>

<<<<<<< HEAD
                    <li class="has-dropdown">
                        <a href="javascript:void(0)" onclick="toggleSub(this)" class="{{ request()->is('produk*') ? 'active' : '' }}">
                            Produk <i class="fa-solid fa-chevron-down dropdown-arrow"></i>
                        </a>
                        <ul class="dropdown">
                            <li><a href="{{ url('/produk/terbitan-bbpr') }}"><i class="fa-regular fa-copy"></i> Terbitan BBPR</a></li>
                            <li><a href="{{ url('/produk/jurnal') }}"><i class="fa-regular fa-newspaper"></i> Jurnal</a></li>
                            <li><a href="{{ url('/produk/majalah') }}"><i class="fa-solid fa-book-open"></i> Majalah Serindit</a></li>
                            <li><a href="{{ url('/produk/sembari') }}"><i class="fa-solid fa-language"></i> Sembari</a></li>
                            <li><a href="{{ url('/produk/kemala') }}"><i class="fa-regular fa-gem"></i> Kemala</a></li>
                        </ul>
                    </li>
=======
                <li class="has-dropdown">
                    <a href="#" class="dropdown-toggle">Akuntabilitas
                        <i class="fa-solid fa-chevron-down dropdown-icon"></i>
                    </a>
                    <div class="dropdown">
                        <a href="{{ url('/akuntabilitas/renstra') }}"
                            class="{{ request()->is('akuntabilitas/renstra') ? 'active' : '' }}">Renstra</a>
                        <a href="{{ url('/akuntabilitas/dipa') }}"
                            class="{{ request()->is('akuntabilitas/dipa') ? 'active' : '' }}">DIPA</a>
                        <a href="{{ url('/akuntabilitas/perjanjian-kinerja') }}"
                            class="{{ request()->is('akuntabilitas/perjanjian-kinerja') ? 'active' : '' }}">Perjanjian
                            Kinerja</a>
                        <a href="{{ url('/akuntabilitas/rencana-aksi') }}"
                            class="{{ request()->is('akuntabilitas/rencana-aksi') ? 'active' : '' }}">Rencana Aksi</a>
                        <a href="{{ url('/akuntabilitas/lakin') }}"
                            class="{{ request()->is('akuntabilitas/lakin') ? 'active' : '' }}">LAKIN</a>
                        <a href="{{ url('/akuntabilitas/sakai') }}"
                            class="{{ request()->is('akuntabilitas/saki') ? 'active' : '' }}">SAKAI</a>
                    </div>
                </li>
>>>>>>> 6883b8e58caaadc7258d1a9d662322497200fcfd

                    <li class="has-dropdown">
                        <a href="javascript:void(0)" onclick="toggleSub(this)" class="{{ request()->is('akuntabilitas*') ? 'active' : '' }}">
                            Akuntabilitas <i class="fa-solid fa-chevron-down dropdown-arrow"></i>
                        </a>
                        <ul class="dropdown">
                            <li><a href="{{ url('/akuntabilitas/perjanjian-kinerja') }}"><i class="fa-regular fa-file-lines"></i> Perjanjian Kinerja</a></li>
                            <li><a href="{{ url('/akuntabilitas/renstra') }}"><i class="fa-regular fa-map"></i> Renstra</a></li>
                            <li><a href="{{ url('/akuntabilitas/lakip') }}"><i class="fa-solid fa-chart-line"></i> LAKIP</a></li>
                            <li><a href="{{ url('/akuntabilitas/rencana-aksi') }}"><i class="fa-regular fa-rectangle-list"></i> Rencana Aksi</a></li>
                        </ul>
                    </li>

                    <li class="has-dropdown">
                        <a href="javascript:void(0)" onclick="toggleSub(this)" class="{{ request()->is('layanan*') ? 'active' : '' }}">
                            Layanan <i class="fa-solid fa-chevron-down dropdown-arrow"></i>
                        </a>
                        <ul class="dropdown">
                            <li><a href="#"><i class="fa-solid fa-user-tie"></i> Ahli Bahasa</a></li>
                            <li><a href="#"><i class="fa-solid fa-pen-nib"></i> Penerjemahan</a></li>
                            <li><a href="#"><i class="fa-solid fa-graduation-cap"></i> UKBI Adaptif</a></li>
                            <li><a href="#"><i class="fa-solid fa-book-reader"></i> Perpustakaan</a></li>
                        </ul>
                    </li>

                    <li><a href="{{ url('/ppid/ppid') }}" class="{{ request()->is('ppid*') ? 'active' : '' }}"><i class="fa-regular fa-file-lines menu-icon"></i> PPID</a></li>
                    <li><a href="{{ url('/survei/survei') }}" class="{{ request()->is('survei*') ? 'active' : '' }}"><i class="fa-solid fa-chart-simple menu-icon"></i> Survei</a></li>
                    <li><a href="{{ url('/wbs/wbs') }}" class="{{ request()->is('wbs*') ? 'active' : '' }}"><i class="fa-solid fa-bullhorn menu-icon"></i> WBS</a></li>
                    <li><a href="{{ url('/ziwbk/ziwbk') }}" class="{{ request()->is('ziwbk*') ? 'active' : '' }}"><i class="fa-regular fa-star menu-icon"></i>ZI-WBK</a></li>
                    

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

    <script src="script.js"></script>

</body>

</html>