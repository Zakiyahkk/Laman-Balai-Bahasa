@extends('layouts.user')

@section('title', 'Logo')

@section('css')
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/profil.css') }}">
@endsection

@section('content')
    <section class="brand-section profil-hero profil-theme">
        <div class="hero-bg">
            <img src="https://ppidbbpriau.kemendikdasmen.go.id/images/gedung-balai.jpeg" alt="Gedung Balai">
        </div>
        <div class="ambient-glow"></div>

        <div class="container">

            <div class="brand-header">
                <h1>Logo </h1>
                <p>
                    Unduh logo resmi Balai Bahasa Provinsi Riau dalam format PNG (Transparan) dan PDF (Vektor).
                </p>
            </div>

            <div class="brand-grid">

                <div class="brand-card">
                    <div class="card-visual bg-pattern-light">
                        <img src="{{ asset('img/logobalai.png') }}" alt="Logo Utama">
                    </div>
                    <div class="card-details">
                        <div class="info">
                            <h3>Logo Utama</h3>
                            <p>Full Color</p>
                        </div>
                        <div class="actions">
                            <a href="{{ asset('img/logobalai.png') }}" download class="btn-dl btn-png">
                                <i class="fa-regular fa-image"></i> PNG
                            </a>
                            <a href="{{ asset('document/buku6.pdf') }}" download class="btn-dl btn-pdf">
                                <i class="fa-regular fa-file-pdf"></i> PDF
                            </a>
                        </div>
                    </div>
                </div>

                <div class="brand-card">
                    <div class="card-visual bg-pattern-light">
                        <img src="{{ asset('img/Logo Kemendikdasmen.png') }}" alt="Logo Sekunder">
                    </div>
                    <div class="card-details">
                        <div class="info">
                            <h3>Logo Sekunder</h3>
                            <p>Full Color</p>
                        </div>
                        <div class="actions">
                            <a href="{{ asset('img/Logo Kemendikdasmen.png') }}" download class="btn-dl btn-png">
                                <i class="fa-regular fa-image"></i> PNG
                            </a>
                            <a href="{{ asset('document/Logo Kemendikdasmen.pdf') }}" download class="btn-dl btn-pdf">
                                <i class="fa-regular fa-file-pdf"></i> PDF
                            </a>
                        </div>
                    </div>
                </div>

                <div class="brand-card">
                    <div class="card-visual bg-pattern-light">
                        <img src="{{ asset('img/Logo Pendidikan Bermutu.png') }}" alt="Logo Alternatif">
                    </div>
                    <div class="card-details">
                        <div class="info">
                            <h3>Logo Alternatif</h3>
                            <p>Full Color</p>
                        </div>
                        <div class="actions">
                            <a href="{{ asset('img/Logo Pendidikan Bermutu.png') }}" download class="btn-dl btn-png">
                                <i class="fa-regular fa-image"></i> PNG
                            </a>
                            <a href="{{ asset('document/buku6.pdf') }}" download class="btn-dl btn-pdf">
                                <i class="fa-regular fa-file-pdf"></i> PDF
                            </a>
                        </div>
                    </div>
                </div>

                <div class="brand-card">
                    <div class="card-visual bg-pattern-light">
                        <img src="{{ asset('img/Logo Andal.png') }}" alt="Simbol Logo">
                    </div>
                    <div class="card-details">
                        <div class="info">
                            <h3>Simbol / Icon</h3>
                            <p>Full Color</p>
                        </div>
                        <div class="actions">
                            <a href="{{ asset('img/Logo Andal.png') }}" download class="btn-dl btn-png">
                                <i class="fa-regular fa-image"></i> PNG
                            </a>
                            <a href="{{ asset('document/buku6.pdf') }}" download class="btn-dl btn-pdf">
                                <i class="fa-regular fa-file-pdf"></i> PDF
                            </a>
                        </div>
                    </div>
                </div>

                <div class="brand-card">
                    <div class="card-visual bg-pattern-light">
                        <img src="{{ asset('img/Logo Ramah.png') }}" alt="Simbol Logo">
                    </div>
                    <div class="card-details">
                        <div class="info">
                            <h3>Simbol / Icon</h3>
                            <p>Full Color</p>
                        </div>
                        <div class="actions">
                            <a href="{{ asset('img/Logo Ramah.png') }}" download class="btn-dl btn-png">
                                <i class="fa-regular fa-image"></i> PNG
                            </a>
                            <a href="{{ asset('document/buku6.pdf') }}" download class="btn-dl btn-pdf">
                                <i class="fa-regular fa-file-pdf"></i> PDF
                            </a>
                        </div>
                    </div>
                </div>

                <div class="brand-card">
                    <div class="card-visual bg-pattern-light">
                        <img src="{{ asset('img/Logo_Kemala.png') }}" alt="Simbol Logo">
                    </div>
                    <div class="card-details">
                        <div class="info">
                            <h3>Simbol / Icon</h3>
                            <p>Full Color</p>
                        </div>
                        <div class="actions">
                            <a href="{{ asset('img/Logo_Kemala.png') }}" download class="btn-dl btn-png">
                                <i class="fa-regular fa-image"></i> PNG
                            </a>
                            <a href="{{ asset('document/buku6.pdf') }}" download class="btn-dl btn-pdf">
                                <i class="fa-regular fa-file-pdf"></i> PDF
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
