@extends('layouts.user')

@section('title', 'terbitan-bbpr')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/produk.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/dearflip/css/dflip.min.css') }}">
@endsection

@section('content')

    <section class="terbitan-container">

        <div class="terbitan-header">
            <h1>Terbitan BBPR</h1>
            <p>Kumpulan bahan bacaan untuk meningkatkan literasi</p>
        </div>

        <div class="terbitan-grid">

            <div class="book-card">
                <div class="book-cover">
                    <img src="{{ asset('document/buku1.jpg') }}">
                </div>

                <div class="book-info">
                    <h3>Asal Mula Desa Bedari</h3>

                    {{-- BUTTON DEARFLIP RESMI --}}
                    <a href="{{ asset('document/buku6.pdf') }}" class="_df_button book-read-btn"
                        data-title="Asal Mula Desa Bedari">
                        Baca
                    </a>
                </div>
            </div>

        </div>

    </section>

@endsection

@section('js')
    <script src="{{ asset('vendor/dearflip/js/libs/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/dearflip/js/dflip.min.js') }}"></script>
@endsection
