@extends('layouts.user')

@section('title', 'Struktur Organisasi')

@section('css')
{{-- Import Font --}}
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

{{-- Panggil File CSS Eksternal --}}
<link rel="stylesheet" href="{{ asset('css/profil.css') }}">
@endsection

@section('content')
<section class="profil-riau">
    <div class="container">

        <div class="profil-header-struktur">
            <h1>Struktur Organisasi</h1>
            <p>
                Struktur organisasi Balai Bahasa Provinsi Riau menggambarkan
                susunan dan hubungan kerja antarbagian dalam pelaksanaan tugas.
            </p>
        </div>

        <div class="org-tree-wrapper">
            <div class="tree">
                <ul>
                    <li>
                        <div class="card-org card-head">
                            <div class="img-box">
                                <img src="https://ui-avatars.com/api/?name=Kepala+Balai&background=f59e0b&color=fff" alt="Kepala Balai">
                            </div>
                            <div class="role-title">Kepala Balai</div>
                            <div class="role-name">Toha Machsum, M.Ag.</div>
                        </div>

                        <ul>
                            <li>
                                <div class="card-org card-sub">
                                    <div class="img-box">
                                        <img src="https://ui-avatars.com/api/?name=Kasubbag+TU&background=3b82f6&color=fff" alt="Kasubbag TU">
                                    </div>
                                    <div class="role-title">Kasubbag Tata Usaha</div>
                                    <div class="role-name">Zarya Ayu, S.Sos.</div>
                                </div>

                                <ul>
                                    <li>
                                        <div class="card-org card-team">
                                            <div class="role-title">Tim Keuangan</div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="card-org card-team">
                                            <div class="role-title">Tim BMN</div>
                                        </div>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <div class="card-org card-sub">
                                    <div class="img-box">
                                        <img src="https://ui-avatars.com/api/?name=KKLP&background=10b981&color=fff" alt="Koordinator">
                                    </div>
                                    <div class="role-title">Koordinator KKLP</div>
                                    <div class="role-name">Jabatan Fungsional</div>
                                </div>

                                <ul>
                                    <li>
                                        <div class="card-org card-team">
                                            <div class="img-box">
                                                <i class="fa-solid fa-book-open" style="font-size: 24px; margin-top: 15px; color:#10b981;"></i>
                                            </div>
                                            <div class="role-title">KKLP Literasi</div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="card-org card-team">
                                            <div class="img-box">
                                                <i class="fa-solid fa-shield-halved" style="font-size: 24px; margin-top: 15px; color:#10b981;"></i>
                                            </div>
                                            <div class="role-title">KKLP Pelindungan</div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="card-org card-team">
                                            <div class="img-box">
                                                <i class="fa-solid fa-language" style="font-size: 24px; margin-top: 15px; color:#10b981;"></i>
                                            </div>
                                            <div class="role-title">KKLP UKBI</div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="card-org card-team">
                                            <div class="img-box">
                                                <i class="fa-solid fa-book" style="font-size: 24px; margin-top: 15px; color:#10b981;"></i>
                                            </div>
                                            <div class="role-title">KKLP Perkamusan</div>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>

        <div style="text-align: center; margin-top: 30px; font-size: 0.9rem; color: #94a3b8;">
            <i class="fa-solid fa-arrows-left-right"></i> Geser ke samping untuk melihat struktur lengkap (Mobile)
        </div>

        <div class="section-divider"></div>

    </div>
</section>
@endsection