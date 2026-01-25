<header class="bbp-navbar" id="navbar">
    <div class="bbp-top">
        <div class="container">
            <div class="bbp-top-left">
                <div class="top-item-box">
                    <i class="fa-regular fa-clock top-icon-big"></i>
                    <div class="top-text-stack">
                        <span class="label-top">JAM PELAYANAN </span>
                        <span class="value-top" style="font-size: 11px; line-height: 1.2;">
                            Senin––Kamis: 08.00–16.00 WIB <br> Jumat: 08.00–16.30 WIB
                        </span>
                    </div>
                </div>

                <div class="top-item-box">
                    <i class="fa-brands fa-whatsapp top-icon-big"></i>
                    <div class="top-text-stack">
                        <span class="label-top">WhatsApp</span>
                        <a href="https://wa.me/628217788663" target="_blank" class="value-top"
                            style="text-decoration: none; color: inherit;">
                            08217788663
                        </a>
                    </div>
                </div>

                <div class="top-item-box">
                    <i class="fa-regular fa-comment-dots top-icon-big"></i>
                    <div class="top-text-stack">
                        <span class="label-top">Pengaduan ULT</span>
                        <a href="{{ url('https://forms.gle/NJxsM3CyZJVUfrzC8') }}" class="btn-ult-big">Klik di sini
                            untuk melakukan pengaduan</a>
                    </div>
                </div>
            </div>
            <div class="bbp-social-top">
                <a href="https://www.facebook.com/balaibahasa.provinsiriau"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="https://www.tiktok.com/@balai.bahasa.riau"><i class="fa-brands fa-tiktok"></i></a>
                <a href="https://www.instagram.com/balaibahasaprovinsiriau/"><i class="fa-brands fa-instagram"></i></a>
                <a href="https://www.youtube.com/@balaibahasariau"><i class="fa-brands fa-youtube"></i></a>
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
                <li>
                    <a href="https://ppidbbpriau.kemendikdasmen.go.id/portal/tamu" target="_blank"
                        rel="noopener noreferrer" class="{{ request()->is('sapa*') ? 'active' : '' }}">
                        <i class="fa-regular fa-book-bookmark menu-icon"></i> SAPA
                    </a>
                </li>

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
                        <li>
                            <a href="https://madah.kemendikdasmen.go.id" target="_blank" rel="noopener noreferrer">
                                <i class="fa-regular fa-newspaper"></i> Jurnal Madah
                            </a>
                        </li>
                </li>
                <li>
                    <a href="https://majalahserindit.kemendikdasmen.go.id" target="_blank" rel="noopener noreferrer">
                        <i class="fa-solid fa-book-open"></i> Majalah Serindit
                    </a>
                </li>
                <li><a href="{{ url('/produk/sembari') }}"><i class="fa-solid fa-gem"></i>
                        Sembari ( Serial Terjemahan BBPR)</a>

                <li>
                    <a href="https://sites.google.com/view/petapembinaanbahasa/halaman-muka" target="_blank"
                        rel="noopener noreferrer">
                        <i class="fa-solid fa-map"></i> Peta Pembinaan Bahasa
                    </a>
                </li>
                <li>
                    <a href="{{ url('/produk/peta-pembinaan-sastra') }}" target="_blank" rel="noopener noreferrer">
                        <i class="fa-solid fa-map"></i> Peta Pembinaan Sastra
                    </a>
                </li>
                <li>
                    <a href="{{ url('/produk/silera') }}" target="_blank" rel="noopener noreferrer">
                        <i class="fa-solid fa-users"></i>
                        Silera (Sistem Informasi Komunitas Literasi Riau)
                    </a>
                </li>
                <li>
                    <a href="https://sapabipa.expert.web.id/" target="_blank" rel="noopener noreferrer">
                        <i class="fa-solid fa-globe-asia"></i> SAPA BIPA
                    </a>
                </li>
                <li>
                    <a href="https://kamusbahasariau.kemendikdasmen.go.id/" target="_blank"
                        rel="noopener noreferrer">
                        <i class="fa-regular fa-language"></i>
                        Kemala (Kamus Elektronik Bahasa Melayu Riau)
                    </a>
                </li>
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
                    <li><a href="{{ url('/layanan/ahli-bahasa') }}"><i class="fa-regular fa-user-tie"></i>
                            Ahli Bahasa</a>
                    </li>
                    <li><a href="{{ url('/layanan/penerjemahan') }}"><i class="fa-regular fa-pen-nib"></i>
                            Penerjemahan</a>
                    </li>
                    <li><a href="{{ url('/layanan/ukbi-adaptif') }}"><i class="fa-regular fa-graduation-cap"></i>
                            UKBI Adaptif</a>
                    </li>
                    <li><a href="{{ url('/layanan/bipa') }}"><i class="fa-regular fa-globe-asia"></i>
                            BIPA</a>
                    </li>
                    <li><a href="{{ url('/layanan/perpustakaan') }}"><i class="fa-regular fa-book"></i>
                            Perpustakaan</a>
                    </li>
                    <li><a href="{{ url('/layanan/magang') }}"><i class="fa-regular fa-users"></i>
                            Magang</a>
                    </li>
                </ul>
            </li>

            <li class="has-dropdown">
                <a href="javascript:void(0)" onclick="toggleSub(this)"
                    class="{{ request()->is('survei*') ? 'active' : '' }}">
                    Survei <i class="fa-solid fa-chevron-down dropdown-arrow"></i>
                </a>
                <ul class="dropdown">
                    <li><a href="{{ url('https://ppidbbpriau.kemendikdasmen.go.id/portal/survei') }}"
                            class="{{ request()->is('skm*') ? 'active' : '' }}"target="_blank"
                            rel="noopener noreferrer"><i class="fa-regular fa-file-lines menu-icon"></i> Survei
                            Kepuasan Masyarakat</a></li>
                    <li><a href="{{ url('#') }}" class="{{ request()->is('spkp*') ? 'active' : '' }}"><i
                                class="fa-regular fa-file-lines menu-icon"></i> Survei Persepsi Kualitas
                            Pelayanan</a></li>
                    <li><a href="{{ url('#') }}" class="{{ request()->is('spak*') ? 'active' : '' }}"><i
                                class="fa-regular fa-file-lines menu-icon"></i> Survei Persepsi Antikorupsi</a>
                    </li>
                    <li><a href="{{ url('#') }}" class="{{ request()->is('spkp*') ? 'active' : '' }}"><i
                                class="fa-regular fa-file-lines menu-icon"></i> Hasil Survei</a></li>
                </ul>
            </li>


            <li><a href="{{ url('https://ppidbbpriau.kemendikdasmen.go.id/') }}"
                    class="{{ request()->is('ppid*') ? 'active' : '' }}" target="_blank"
                    rel="noopener noreferrer"><i class="fa-regular fa-file-lines menu-icon"></i> PPID</a>
            </li>

            <li><a href="{{ url('/wbs/wbs') }}" class="{{ request()->is('wbs*') ? 'active' : '' }}"><i
                        class="fa-solid fa-bullhorn menu-icon"></i> WBS</a></li>
            <li class="has-dropdown dropdown-reverse">
                <a href="javascript:void(0)" onclick="toggleSub(this)"
                    class="{{ request()->is('ziwbk*') ? 'active' : '' }}">
                    <i class="fa-regular fa-star menu-icon"></i> ZI-WBK <i
                        class="fa-solid fa-chevron-down dropdown-arrow"></i>
                </a>
                <ul class="dropdown">
                    <li class="has-dropdown">
                        <a href="javascript:void(0)" onclick="toggleSub(this)">
                            2025 <i class="fa-solid fa-chevron-right dropdown-arrow"></i>
                        </a>
                        <ul class="dropdown">
                            <li class="has-dropdown">
                                <a href="javascript:void(0)" onclick="toggleSub(this)">
                                    Manajemen Perubahan <i class="fa-solid fa-chevron-right dropdown-arrow"></i>
                                </a>
                                <ul class="dropdown">
                                    <li><a href="{{ url('/timkerja/detail/2022') }}">Tim Kerja</a></li>
                                    <li><a href="{{ url('/rencanawbk/detail/2022') }}">Rencana Pembangunan WBK</a>
                                    </li>
                                    <li><a href="{{ url('/monevwbk/detail/2022') }}">Pemantauan & Evaluasi</a>
                                    </li>
                                    <li><a href="{{ url('/budayakerja/detail/2022') }}">Pola Pikir & Budaya
                                            Kerja</a></li>
                                </ul>
                            </li>
                            <li class="has-dropdown">
                                <a href="javascript:void(0)" onclick="toggleSub(this)">
                                    Penguatan Tata Laksana <i class="fa-solid fa-chevron-right dropdown-arrow"></i>
                                </a>
                                <ul class="dropdown">
                                    <li><a href="{{ url('/pos/detail/2022') }}">POS</a></li>
                                    <li><a href="{{ url('/sinde/detail/2022') }}">Sistem Elektronik</a></li>
                                    <li><a href="{{ url('/keterbukaaninformasi/detail/2022') }}">Keterbukaan
                                            Informasi</a></li>
                                </ul>
                            </li>
                            <li class="has-dropdown">
                                <a href="javascript:void(0)" onclick="toggleSub(this)">
                                    Manajemen SDM <i class="fa-solid fa-chevron-right dropdown-arrow"></i>
                                </a>
                                <ul class="dropdown">
                                    <li><a href="{{ url('/rencanakebutuhan/detail/2022') }}">Perencanaan
                                            Kebutuhan</a></li>
                                    <li><a href="{{ url('/mutasiinternal/detail/2022') }}">Pola Mutasi
                                            Internal</a></li>
                                    <li><a href="{{ url('/pbk/detail/2022') }}">Pengembangan Pegawai</a></li>
                                    <li><a href="{{ url('/kinerjaindividu/detail/2022') }}">Penetapan Kinerja</a>
                                    </li>
                                    <li><a href="{{ url('/penegakandisiplin/detail/2022') }}">Penegakan
                                            Disiplin</a></li>
                                    <li><a href="{{ url('/Informasikepegawaian/detail/2022') }}">Sistem
                                            Informasi</a></li>
                                </ul>
                            </li>
                            <li class="has-dropdown">
                                <a href="javascript:void(0)" onclick="toggleSub(this)">
                                    Penguatan Akuntabilitas <i class="fa-solid fa-chevron-right dropdown-arrow"></i>
                                </a>
                                <ul class="dropdown">
                                    <li><a href="{{ url('/keterlibatanpimpinan/detail/2022') }}">Keterlibatan
                                            Pimpinan</a></li>
                                    <li><a href="{{ url('/akuntabilitaskinerja/detail/2022') }}">Akuntabilitas
                                            Kinerja</a></li>
                                </ul>
                            </li>
                            <li class="has-dropdown">
                                <a href="javascript:void(0)" onclick="toggleSub(this)">
                                    Penguatan Pengawasan <i class="fa-solid fa-chevron-right dropdown-arrow"></i>
                                </a>
                                <ul class="dropdown">
                                    <li><a href="{{ url('/gratifikasi/detail/2022') }}">Gratifikasi</a></li>
                                    <li><a href="{{ url('/SpiWbk/detail/2022') }}">SPI</a></li>
                                    <li><a href="{{ url('/aduanmasyarakat/detail/2022') }}">Pengaduan
                                            Masyarakat</a></li>
                                    <li><a href="{{ url('/whistleblowing/detail/2022') }}">Whistle Blowing</a>
                                    </li>
                                    <li><a href="{{ url('/benturankepentingan/detail/2022') }}">Benturan
                                            Kepentingan</a></li>
                                </ul>
                            </li>
                            <li class="has-dropdown">
                                <a href="javascript:void(0)" onclick="toggleSub(this)">
                                    Layanan Publik <i class="fa-solid fa-chevron-right dropdown-arrow"></i>
                                </a>
                                <ul class="dropdown">
                                    <li><a href="{{ url('/standarpelayanan/detail/2022') }}">Standar Pelayanan</a>
                                    </li>
                                    <li><a href="{{ url('/pelayananprima/detail/2022') }}">Budaya Pelayanan
                                            Prima</a></li>
                                    <li><a href="{{ url('/pemanfaatantik/detail/2022') }}">Pemanfaatan TIK</a>
                                    </li>
                                    <li><a href="{{ url('/kepuasanmasyarakat/detail/2022') }}">Kepuasan
                                            Masyarakat</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <li class="has-dropdown">
                        <a href="javascript:void(0)" onclick="toggleSub(this)">
                            2026 <i class="fa-solid fa-chevron-right dropdown-arrow"></i>
                        </a>
                        <ul class="dropdown">
                            <li class="has-dropdown">
                                <a href="javascript:void(0)" onclick="toggleSub(this)">
                                    Manajemen Perubahan <i class="fa-solid fa-chevron-right dropdown-arrow"></i>
                                </a>
                                <ul class="dropdown">
                                    <li><a href="{{ url('/timkerja/detail/2022') }}">Tim Kerja</a></li>
                                    <li><a href="{{ url('/rencanawbk/detail/2022') }}">Rencana Pembangunan WBK</a>
                                    </li>
                                    <li><a href="{{ url('/monevwbk/detail/2022') }}">Pemantauan & Evaluasi</a>
                                    </li>
                                    <li><a href="{{ url('/budayakerja/detail/2022') }}">Pola Pikir & Budaya
                                            Kerja</a></li>
                                </ul>
                            </li>
                            <li class="has-dropdown">
                                <a href="javascript:void(0)" onclick="toggleSub(this)">
                                    Penguatan Tata Laksana <i class="fa-solid fa-chevron-right dropdown-arrow"></i>
                                </a>
                                <ul class="dropdown">
                                    <li><a href="{{ url('/pos/detail/2022') }}">POS</a></li>
                                    <li><a href="{{ url('/sinde/detail/2022') }}">Sistem Elektronik</a></li>
                                    <li><a href="{{ url('/keterbukaaninformasi/detail/2022') }}">Keterbukaan
                                            Informasi</a></li>
                                </ul>
                            </li>
                            <li class="has-dropdown">
                                <a href="javascript:void(0)" onclick="toggleSub(this)">
                                    Manajemen SDM <i class="fa-solid fa-chevron-right dropdown-arrow"></i>
                                </a>
                                <ul class="dropdown">
                                    <li><a href="{{ url('/rencanakebutuhan/detail/2022') }}">Perencanaan
                                            Kebutuhan</a></li>
                                    <li><a href="{{ url('/mutasiinternal/detail/2022') }}">Pola Mutasi
                                            Internal</a></li>
                                    <li><a href="{{ url('/pbk/detail/2022') }}">Pengembangan Pegawai</a></li>
                                    <li><a href="{{ url('/kinerjaindividu/detail/2022') }}">Penetapan Kinerja</a>
                                    </li>
                                    <li><a href="{{ url('/penegakandisiplin/detail/2022') }}">Penegakan
                                            Disiplin</a></li>
                                    <li><a href="{{ url('/Informasikepegawaian/detail/2022') }}">Sistem
                                            Informasi</a></li>
                                </ul>
                            </li>
                            <li class="has-dropdown">
                                <a href="javascript:void(0)" onclick="toggleSub(this)">
                                    Penguatan Akuntabilitas <i class="fa-solid fa-chevron-right dropdown-arrow"></i>
                                </a>
                                <ul class="dropdown">
                                    <li><a href="{{ url('/keterlibatanpimpinan/detail/2022') }}">Keterlibatan
                                            Pimpinan</a></li>
                                    <li><a href="{{ url('/akuntabilitaskinerja/detail/2022') }}">Akuntabilitas
                                            Kinerja</a></li>
                                </ul>
                            </li>
                            <li class="has-dropdown">
                                <a href="javascript:void(0)" onclick="toggleSub(this)">
                                    Penguatan Pengawasan <i class="fa-solid fa-chevron-right dropdown-arrow"></i>
                                </a>
                                <ul class="dropdown">
                                    <li><a href="{{ url('/gratifikasi/detail/2022') }}">Gratifikasi</a></li>
                                    <li><a href="{{ url('/SpiWbk/detail/2022') }}">SPI</a></li>
                                    <li><a href="{{ url('/aduanmasyarakat/detail/2022') }}">Pengaduan
                                            Masyarakat</a></li>
                                    <li><a href="{{ url('/whistleblowing/detail/2022') }}">Whistle Blowing</a>
                                    </li>
                                    <li><a href="{{ url('/benturankepentingan/detail/2022') }}">Benturan
                                            Kepentingan</a></li>
                                </ul>
                            </li>
                            <li class="has-dropdown">
                                <a href="javascript:void(0)" onclick="toggleSub(this)">
                                    Layanan Publik <i class="fa-solid fa-chevron-right dropdown-arrow"></i>
                                </a>
                                <ul class="dropdown">
                                    <li><a href="{{ url('/standarpelayanan/detail/2022') }}">Standar Pelayanan</a>
                                    </li>
                                    <li><a href="{{ url('/pelayananprima/detail/2022') }}">Budaya Pelayanan
                                            Prima</a></li>
                                    <li><a href="{{ url('/pemanfaatantik/detail/2022') }}">Pemanfaatan TIK</a>
                                    </li>
                                    <li><a href="{{ url('/kepuasanmasyarakat/detail/2022') }}">Kepuasan
                                            Masyarakat</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>

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
