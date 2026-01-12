@extends('layouts.user')

@section('title', 'DIPA')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/akuntabilitas.css') }}">
@endsection

@section('content')

    <div class="ak-container ak-dipa">

        <div class="ak-title">
            <h1>Dipa</h1>
            <p>Pratinjau dokumen Dipa</p>
        </div>

        <div class="ak-card">

            <div class="ak-content">
                <h3>Dipa</h3>
                <p>
                    dipa merupakan laporan resmi yang memuat hasil pengukuran
                    kinerja instansi pemerintah dalam satu periode pelaporan.
                </p>

                <p>
                    Dokumen ini menjadi bagian penting dalam pelaksanaan sistem
                    akuntabilitas kinerja instansi pemerintah.
                </p>

                <div class="ak-actions">
                    <a href="{{ asset('document/dokumentesting1.pdf') }}#zoom=page-width" target="_blank" class="ak-btn">
                        <i class="fa-solid fa-file-pdf"></i>
                        Buka Dokumen Lengkap
                    </a>
                </div>
            </div>

        </div>
    </div>

@endsection
