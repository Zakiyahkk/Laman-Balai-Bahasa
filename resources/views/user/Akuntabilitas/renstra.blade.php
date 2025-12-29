@extends('layouts.user')

@section('title', 'Renstra')

@section('css')
<link rel="stylesheet" href="{{ asset('css/akuntabilitas.css') }}">
@endsection

@section('content')

<div class="ak-container ak-renstra">

    <div class="ak-title">
        <h1>Rencana Strategis (Renstra)</h1>
        <p>Pratinjau dokumen Rencana Strategis</p>
    </div>

    <div class="ak-card">

        <div class="ak-preview">
            <iframe
                src="{{ asset('document/dokumentesting1.pdf') }}#zoom=page-width"
                title="Preview Renstra">
            </iframe>
        </div>

        <div class="ak-content">
            <h3>Renstra</h3>
            <p>
                Rencana Strategis merupakan dokumen perencanaan jangka menengah
                yang memuat visi, misi, tujuan, sasaran, dan arah kebijakan instansi.
            </p>

            <p>
                Dokumen ini menjadi pedoman pelaksanaan program dan kegiatan
                dalam periode perencanaan tertentu.
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