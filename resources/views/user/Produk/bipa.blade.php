@extends('layouts.user')

@section('title', 'terbitan-bbpr')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/produk.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/dearflip/css/dflip.min.css') }}">
@endsection

@section('content')
    <section class="sapa-bipa">
        <div class="container">

            {{-- Judul section (bisa dinamis) --}}
            <div class="sapa-bipa-title fade-up">
                <h2>BIPA</h2>
                <span>
                    Bahasa Indonesia<br>
                    Bagi Penutur Asing
                </span>
            </div>

            <div class="sapa-bipa-wrap">

                {{-- KIRI : item BIPA (nanti bisa dinamis / loop) --}}
                <div class="sapa-bipa-item fade-left">

                    <h3>Belajar BIPA</h3>
                    <p>
                        Bahan Pembelajaran BIPA<br>
                        (Bahasa Indonesia Bagi Penutur Asing)
                    </p>

                    <h3 class="mt">Jaga BIPA</h3>
                    <p>
                        Jaringan Lembaga Penyelenggara Program BIPA
                        (Bahasa Indonesia Bagi Penutur Asing)
                    </p>

                    {{--
                LOOP DINAMIS DI SINI (KIRI)
                --}}
                </div>

                {{-- TENGAH : gambar (opsional dinamis) --}}
                <div class="sapa-bipa-center zoom-in">
                    <img src="{{ asset('img/sapabipa.png') }}" alt="Sapa BIPA">
                </div>

                {{-- KANAN : item BIPA (nanti bisa dinamis / loop) --}}
                <div class="sapa-bipa-item fade-right">

                    <h3>Bakti BIPA</h3>
                    <p>
                        Serba-Serbi Kiprah dan Karya Pemerhati BIPA
                        (Bahasa Indonesia Bagi Penutur Asing)
                    </p>

                    <h3 class="mt">Tebar BIPA</h3>
                    <p>
                        Tempat Belajar Daring BIPA
                        (Bahasa Indonesia Bagi Penutur Asing)
                    </p>

                    {{--
                LOOP DINAMIS DI SINI (KANAN)
                --}}
                </div>

            </div>
        </div>
    </section>
@endsection
