<!DOCTYPE html>
<html lang="id">

<head>
    <link rel="stylesheet" href="{{ asset('css/produk.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>

    <section class="quick-access-section" style="padding: 40px 0; margin-bottom: 20px; margin-top: -80px; position: relative; z-index: 20;">
        <div class="container">
            <div class="quick-access-card" style="box-shadow: 0 20px 50px rgba(0,0,0,0.15); background: white; border-radius: 20px; padding: 20px;">

                <!-- WRAPPER INI YANG MENGAKTIFKAN KIRI–KANAN -->
                <div class="qa-split">

                    <!-- ===== KIRI : LAYANAN ===== -->
                    <div class="qa-col">
                        <h4 class="group-title">Layanan</h4>

                        <div class="grid-layanan">
                            <a class="access-item" href="https://ppidbbpriau.kemendikdasmen.go.id/form/permohonan" target="_blank" rel="noopener noreferrer">
                                <div class="icon-wrap color-blue-dark">
                                    <i class="fa-solid fa-user-tie"></i>
                                </div>
                                <div class="text-wrap">
                                    <span class="app-title">Ahli Bahasa</span>
                                </div>
                            </a>
                            
                            <a class="access-item" href="https://ppidbbpriau.kemendikdasmen.go.id/form/permohonan" target="_blank" rel="noopener noreferrer">
                                <div class="icon-wrap color-teal">
                                    <i class="fa-solid fa-globe"></i>
                                </div>
                                <div class="text-wrap">
                                    <span class="app-title">BIPA</span>
                                </div>
                            </a>
                            
                            <a class="access-item" href="https://ppidbbpriau.kemendikdasmen.go.id/form/permohonan" target="_blank" rel="noopener noreferrer">
                                <div class="icon-wrap color-cyan">
                                    <i class="fa-solid fa-graduation-cap"></i>
                                </div>
                                <div class="text-wrap">
                                    <span class="app-title">UKBI</span>
                                </div>
                            </a>
                            
                             <a class="access-item" href="https://ppidbbpriau.kemendikdasmen.go.id/form/permohonan" target="_blank" rel="noopener noreferrer">
                                <div class="icon-wrap color-blue">
                                    <i class="fa-solid fa-book"></i>
                                </div>
                                <div class="text-wrap">
                                    <span class="app-title">Perpustakaan</span>
                                </div>
                            </a>
                            
                            <a class="access-item" href="https://ppidbbpriau.kemendikdasmen.go.id/form/permohonan" target="_blank" rel="noopener noreferrer">
                                <div class="icon-wrap color-indigo">
                                    <i class="fa-solid fa-language"></i>
                                </div>
                                <div class="text-wrap">
                                    <span class="app-title">Penerjemahan</span>
                                </div>
                            </a>

                            <a class="access-item" href="https://ppidbbpriau.kemendikdasmen.go.id/form/permohonan" target="_blank" rel="noopener noreferrer">
                                <div class="icon-wrap color-orange">
                                    <i class="fa-solid fa-briefcase"></i>
                                </div>
                                <div class="text-wrap">
                                    <span class="app-title">Magang</span>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- ===== KANAN : SUPERAPLIKASI ===== -->
                    <div class="qa-col">
                        <h4 class="group-title">SUAI (Super Aplikasi dan Informasi)</h4>

                        <div class="grid-super">
                            <a class="access-item" href="https://ppidbbpriau.kemendikdasmen.go.id/portal/tamu"
                                target="_blank" rel="noopener noreferrer">
                                <div class="icon-wrap color-slate">
                                    <img src="{{ asset('img/logo/sapa.jpeg') }}" alt="SAPA">
                                </div>
                                <div class="text-wrap">
                                    <span class="app-title">SAPA</span>
                                    <span class="app-desc">Sistem Aspirasi&Pelayanan</span>
                                </div>
                            </a>
                            
                             <a class="access-item" href="https://kamusbahasariau.kemendikdasmen.go.id/"
                                target="_blank" rel="noopener noreferrer">
                                <div class="icon-wrap color-slate">
                                    <img src="{{ asset('img/logo/kemala.png') }}" alt="KEMALA">
                                </div>
                                <div class="text-wrap">
                                    <span class="app-title">KEMALA</span>
                                    <span class="app-desc">Kamus Melayu</span>
                                </div>
                            </a>

                            <a class="access-item" href="https://madah.kemendikdasmen.go.id/index.php/madah"
                                target="_blank" rel="noopener noreferrer">
                                <div class="icon-wrap color-slate">
                                    <i class="fa-solid fa-newspaper"></i>
                                </div>
                                <div class="text-wrap">
                                    <span class="app-title">Jurnal Madah</span>
                                    <span class="app-desc">Publikasi Ilmiah</span>
                                </div>
                            </a>

                            <a class="access-item" href="#" target="_blank" rel="noopener noreferrer">
                                <div class="icon-wrap color-slate">
                                    <img src="{{ asset('img/logo/sembari.png') }}" alt="SEMBARI">
                                </div>
                                <div class="text-wrap">
                                    <span class="app-title">SEMBARI</span>
                                    <span class="app-desc">Serial Terjemahan</span>
                                </div>
                            </a>
                            
                            <a class="access-item"
                                href="https://sites.google.com/view/petapembinaanbahasabalaibahasa?usp=sharing" target="_blank"
                                rel="noopener noreferrer">
                                <div class="icon-wrap color-slate">
                                    <img src="{{ asset('img/logo/peta-bahasa.jpeg') }}" alt="Peta Bahasa">
                                </div>
                                <div class="text-wrap">
                                    <span class="app-title">Peta Bahasa</span>
                                    <span class="app-desc">Informasi Bahasa</span>
                                </div>
                            </a>
                            
                            <a class="access-item" href="https://majalahserindit.kemendikdasmen.go.id/" target="_blank"
                                rel="noopener noreferrer">
                                <div class="icon-wrap color-slate">
                                    <img src="{{ asset('img/logo/serindit.png') }}" alt="Majalah Serindit">
                                </div>
                                <div class="text-wrap">
                                    <span class="app-title">Majalah Serindit</span>
                                    <span class="app-desc">Majalah Digital</span>
                                </div>
                            </a>

                            <a class="access-item" href="#" target="_blank" rel="noopener noreferrer">
                                <div class="icon-wrap color-slate">
                                    <i class="fa-solid fa-list-check"></i>
                                </div>
                                <div class="text-wrap">
                                    <span class="app-title">SILERA</span>
                                    <span class="app-desc">Komunitas Literasi</span>
                                </div>
                            </a>
                            
                            <a class="access-item" href="https://sites.google.com/view/peta-pembinaan-sastra-balai-ba?usp=sharing" target="_blank" rel="noopener noreferrer">
                                <div class="icon-wrap color-slate">
                                    <i class="fa-solid fa-map-location-dot"></i>
                                </div>
                                <div class="text-wrap">
                                    <span class="app-title">Peta Sastra</span>
                                    <span class="app-desc">Data Sastra</span>
                                </div>
                            </a>

                            <a class="access-item" href="#" target="_blank" rel="noopener noreferrer">
                                <div class="icon-wrap color-slate">
                                    <i class="fa-solid fa-comments"></i>
                                </div>
                                <div class="text-wrap">
                                    <span class="app-title">SAPA BIPA</span>
                                    <span class="app-desc">Pembelajaran Interaktif</span>
                                </div>
                            </a>
                        </div>
                    </div>

                </div>
                <!-- END qa-split -->

            </div>
        </div>
    </section>


</body>

</html>
