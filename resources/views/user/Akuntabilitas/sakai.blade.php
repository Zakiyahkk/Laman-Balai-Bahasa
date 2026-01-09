@extends('layouts.user')

@section('title', 'SAKAI')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/akuntabilitas.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/dearflip/css/dflip.min.css') }}">
@endsection

@section('content')

    <section class="sakai-container">

        <div class="sakai-header">
            <h1>Sakai</h1>
            <p>Disini Halaman Sakai</p>
        </div>
    </section>

@endsection

@section('js')
    <script src="{{ asset('vendor/dearflip/js/libs/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/dearflip/js/dflip.min.js') }}"></script>
@endsection
