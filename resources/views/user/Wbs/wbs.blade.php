@extends('layouts.user')

@section('title', 'WBS')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/wbs.css') }}">
@endsection

@section('content')

    <!-- ===============================
                         SECTION: ABOUT WBS
                    ================================ -->
    <div class="cleaning-about-area-wrap" data-padding-top="60" data-padding-bottom="60">
        <div class="container">
            <div class="row wbs-align">

                <!-- GAMBAR -->
                <div class="col-lg-6">
                    <div class="left-content-wrap">
                        <div class="img-wrap">
                            <img src="https://bbgtkjateng.kemendikdasmen.go.id/assets/uploads/media-uploader/wbs1751239670.jpg"
                                alt="Whistleblowing System">
                        </div>
                    </div>
                </div>

                <!-- KONTEN -->
                <div class="col-lg-6">
                    <div class="right-content-wrap">
                        <span class="subtitle">Pengaduan & Pelaporan</span>
                        <h3 class="title">Whistleblowing System (WBS)</h3>

                        <div class="paragraph">
                            <p style="text-align: justify;">
                                <i>Whistleblowing System</i> (WBS) adalah mekanisme untuk menerima laporan mengenai dugaan
                                pelanggaran, penyimpangan, atau tindakan yang tidak sesuai dengan peraturan
                                perundang-undangan di lingkungan Kemendikdasmen.
                            </p>

                            <p style="text-align: justify;">
                                Sistem ini bertujuan untuk menciptakan budaya kerja yang transparan, akuntabel, serta bebas
                                dari praktik korupsi, kolusi, dan nepotisme (KKN). Melalui WBS, setiap individu baik pegawai
                                maupun masyarakat umum dapat berperan aktif dalam menjaga integritas institusi.
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- ===============================
                         SECTION: CARA MELAPOR
                    ================================ -->
    <section class="text-editor-widget-wrapper" data-padding-top="30" data-padding-bottom="40">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <div class="text-editor-content-wrap">
                        <p>
                            <b><span style="font-size:18px;">Cara Melaporkan Dugaan Pelanggaran melalui WBS</span></b>
                        </p>

                        <p>
                            Pelaporan melalui <i>Whistleblowing System</i> dapat dilakukan dengan langkah-langkah berikut:
                        </p>

                        <ol>
                            <li>
                                <b>Akses Situs WBS.</b> Kunjungi laman WBS melalui link yang tersedia di bawah.
                            </li>
                            <li>
                                <b>Isi Identitas Pelapor.</b> Pelapor dapat menyampaikan laporan secara anonim atau
                                mencantumkan identitas.
                            </li>
                            <li>
                                <b>Jelaskan Dugaan Pelanggaran.</b> Uraikan waktu, lokasi, pihak terkait, serta sertakan
                                bukti pendukung jika ada.
                            </li>
                            <li>
                                <b>Kirim Laporan.</b> Pastikan data yang diisi lengkap dan benar sebelum dikirim.
                            </li>
                        </ol>

                        <p>
                            <b><span style="font-size:18px;">Jaminan Kerahasiaan dan Perlindungan Pelapor</span></b>
                        </p>

                        <p>
                            Kami menjamin kerahasiaan identitas pelapor serta isi laporan. Pelapor yang bertindak dengan
                            itikad baik akan mendapatkan perlindungan dari segala bentuk intimidasi atau tindakan balasan.
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- ===============================
                         SECTION: LINK WBS
                    ================================ -->
    <div class="logistics-key-feature-area" data-padding-top="20" data-padding-bottom="100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <div class="lkey-feature-outer-warpp">
                        <ul class="lkey-features-list">

                            <li class="single-logistic-key-feature-one">
                                <div class="icon">
                                    <i class="fas fa-bullhorn"></i>
                                </div>
                                <div class="content">
                                    <h3 class="title">
                                        <a href="https://wbs.kemdikbud.go.id/" target="_blank">
                                            WBS Itjen Kemendikdasmen
                                        </a>
                                    </h3>
                                </div>
                            </li>

                            <li class="single-logistic-key-feature-one">
                                <div class="icon">
                                    <i class="fas fa-comment-dots"></i>
                                </div>
                                <div class="content">
                                    <h3 class="title">
                                        <a href="https://forms.gle/NJxsM3CyZJVUfrzC8" target="_blank"
                                            rel="noopener noreferrer">
                                            WBS Balai Bahasa Provinsi Riau
                                        </a>
                                    </h3>
                                </div>
                            </li>

                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
