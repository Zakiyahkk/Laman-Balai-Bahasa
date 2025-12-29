@extends('layouts.user')

@section('title', 'Rencana Aksi')

@section('css')
<link rel="stylesheet" href="{{ asset('css/akuntabilitas.css') }}">
@endsection

@section('content')

<div class="ak-container ak-rencana-aksi">

    <div class="ak-title">
        <h1>Rencana Aksi</h1>
        <p>Pratinjau dokumen Rencana Aksi</p>
    </div>

    <div class="ak-card">

        <div class="ak-preview">
            <iframe
                src="{{ asset('document/dokumentesting1.pdf') }}#zoom=page-width"
                title="Preview Rencana Aksi">
            </iframe>
        </div>

        <div class="ak-content">
            <h3>Rencana Aksi</h3>
            <p>
                Rencana Aksi merupakan dokumen yang memuat langkah-langkah
                operasional untuk mencapai target kinerja yang telah ditetapkan.
            </p>

            <p>
                Dokumen ini digunakan sebagai panduan pelaksanaan dan
                pemantauan capaian kinerja secara terukur.
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