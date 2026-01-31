@extends('layouts.user')

@section('title', 'SAKAI')

@section('css')
<style>
/* CSS SAKAI Inline */
.sakai-container {
    max-width: 1200px;
    margin: 40px auto;
    padding: 20px;
}
.sakai-header h1 {
    font-size: 32px;
    font-weight: 700;
    color: #0b2a4a;
    margin-bottom: 10px;
}
.sakai-header p {
    color: #6b7a90;
}
</style>
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
