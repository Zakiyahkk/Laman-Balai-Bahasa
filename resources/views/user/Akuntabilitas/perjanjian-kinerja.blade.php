@extends('layouts.user')

@section('title', 'Perjanjian Kinerja')

@section('css')
<link rel="stylesheet" href="{{ asset('css/akuntabilitas.css') }}">
@endsection

@section('content')

<div class="ak-container">

    <!-- JUDUL -->
    <div class="ak-title">
        <h1>Perjanjian Kinerja</h1>
        <p>Pratinjau dokumen Perjanjian Kinerja</p>
    </div>

    <!-- CARD PREVIEW -->
    <div class="ak-card">

        <!-- PREVIEW PDF -->
        <div class="ak-preview">
            <iframe
                src="{{ asset('document/dokumentesting1.pdf') }}#view=FitH&zoom=100"
                title="Preview Perjanjian Kinerja">
            </iframe>

        </div>

        <!-- KONTEN -->
        <div class="ak-content">
            <h3>Perjanjian Kinerja</h3>
            <p>
                Perjanjian Kinerja merupakan dokumen komitmen kinerja antara pimpinan
                unit kerja dengan atasan langsung sebagai dasar pengukuran capaian
                kinerja tahunan dalam pelaksanaan akuntabilitas kinerja instansi.
            </p>

            <p>
                Dokumen ini memuat sasaran strategis, indikator kinerja, serta target
                kinerja yang ditetapkan untuk periode pelaksanaan tertentu.
            </p>

            <p>
                Silakan gunakan pratinjau dokumen di atas atau buka dokumen lengkap
                untuk melihat informasi secara menyeluruh.
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