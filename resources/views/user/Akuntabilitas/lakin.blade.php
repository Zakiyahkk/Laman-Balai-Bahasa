@extends('layouts.user')

@section('title', 'LAKIN')

@section('css')
<link rel="stylesheet" href="{{ asset('css/akuntabilitas.css') }}">
@endsection

@section('content')

<div class="ak-container ak-lakin">

    <div class="ak-title">
        <h1>Laporan Akuntabilitas Kinerja (LAKIN)</h1>
        <p>Pratinjau dokumen Laporan Akuntabilitas Kinerja</p>
    </div>

    <div class="ak-card">

        <div class="ak-preview">
            <iframe
                src="{{ asset('document/dokumentesting1.pdf') }}#zoom=page-width"
                title="Preview LAKIN">
            </iframe>
        </div>

        <div class="ak-content">
            <h3>LAKIN</h3>
            <p>
                Laporan Akuntabilitas Kinerja merupakan dokumen yang menyajikan
                capaian kinerja instansi berdasarkan sasaran dan indikator
                kinerja yang telah ditetapkan.
            </p>

            <p>
                Dokumen ini disusun sebagai bentuk pertanggungjawaban kinerja
                kepada publik dan pemangku kepentingan.
            </p>

            <div class="ak-actions">
                <a href="{{ asset('document/dokumentesting1.pdf') }}#zoom=page-width"
                    target="_blank"
                    class="ak-btn">
                    <i class="fa-solid fa-file-pdf"></i>
                    Buka Dokumen Lengkap
                </a>
            </div>
        </div>

    </div>
</div>

@endsection