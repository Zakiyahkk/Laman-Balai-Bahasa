@extends('layouts.user')

@section('title', 'Bahan Bacaan Literasi')

@section('css')
<link rel="stylesheet" href="{{ asset('css/produk.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/dearflip/css/dflip.min.css') }}">
@endsection

@section('content')

<section class="literasi-container">

    <div class="literasi-header">
        <h1>Peta Pembinaan Bahasa</h1>
        <p>Disini Halaman Peta Pembinaan Bahasa</p>
    </div>
</section>

@endsection

@section('js')
<script src="{{ asset('vendor/dearflip/js/libs/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/dearflip/js/dflip.min.js') }}"></script>
@endsection