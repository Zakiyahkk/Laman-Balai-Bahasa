@extends('layouts.app')

@section('title', 'ZI-WBK')

@section('content')
<div class="container">
    <h2>Zona Integritas – WBK</h2>
    <p>Silakan pilih area dan tahun.</p>

    <ul>
        <li>
            <a href="{{ url('/bbpr/zi-wbk/2025/manajemen-perubahan/tim-kerja') }}">
                Manajemen Perubahan – Tim Kerja
            </a>
        </li>
    </ul>
</div>
@endsection
