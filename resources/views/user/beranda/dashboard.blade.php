@extends('layouts.user')

@section('title', 'Beranda')

@section('content')
    @include('user.beranda.slider')
    @include('user.beranda.kata_pengantar')
    @include('user.beranda.berita_preview')
    @include('user.beranda.artikel')
    @include('user.beranda.pengumuman')
    @include('user.beranda.fasilitas')
    @include('user.beranda.maskot')
    @include('user.beranda.yelyel')
    @include('user.beranda.dokumenprestasi')
    @include('user.beranda.tokoh_bahasa_sastra')
    @include('user.beranda.kamus')

@endsection
