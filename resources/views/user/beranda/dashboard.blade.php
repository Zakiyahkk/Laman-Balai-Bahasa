@extends('layouts.user')

@section('title', 'Beranda')

@section('content')

    @include('user.beranda.kata_pengantar')
    @include('user.beranda.berita_preview')
    @include('user.beranda.alinea')
    @include('user.beranda.pantun')
    @include('user.beranda.pengumuman')
    @include('user.beranda.maskot')



@endsection
