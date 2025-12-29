@extends('layouts.user')

@section('title', 'Kontak Kami')
@section('css')
<link rel="stylesheet" href="{{ asset('css/profil.css') }}">
@endsection
@section('content')
<section class="profil-ntb">
    <div class="container">

        <div class="profil-header">
            <h1>Kontak Kami</h1>
        </div>

        <div class="profil-content">
            <div class="profil-section">
                <p><strong>Balai Bahasa Provinsi Riau</strong></p>

                <p>
                    Jalan H.R. Soebrantas Km. 12,5<br>
                    Kampus Binawidya UNRI<br>
                    Simpang Baru, Tampan, Pekanbaru, Riau
                </p>

                <p>
                    <strong>Telepon:</strong> (0761) 65930<br>
                    <strong>Email:</strong> balaibahasariau@kemdikbud.go.id
                </p>
            </div>
            <div class="section-divider"></div>
        </div>
</section>
@endsection