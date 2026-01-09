@extends('layouts.user')

@section('title', 'Bahan Bacaan peta-sastra')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/produk.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/dearflip/css/dflip.min.css') }}">
@endsection

@section('content')

    <section class="peta-sastra-container">

        <div class="peta-sastra-header">
            <h1>Peta Pembinaan Sastra</h1>
            <p>Disini Halaman Peta Pembinaan Sastra</p>
        </div>
    </section>

@endsection

@section('js')
    <script src="{{ asset('vendor/dearflip/js/libs/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/dearflip/js/dflip.min.js') }}"></script>
@endsection
