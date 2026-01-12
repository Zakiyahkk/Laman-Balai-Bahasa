@extends('layouts.user')

@section('title', 'MAJALAH')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/produk.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/dearflip/css/dflip.min.css') }}">
@endsection

@section('content')

    <section class="majalah-container">

        <div class="majalah-header">
            <h1>Majalah</h1>
            <p>Disini Halaman Majalah</p>
        </div>
    </section>

@endsection

@section('js')
    <script src="{{ asset('vendor/dearflip/js/libs/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/dearflip/js/dflip.min.js') }}"></script>
@endsection
