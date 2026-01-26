@extends('layouts.user')

@section('title', 'SEMBARI')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/produk.css') }}">
@endsection

@section('content')

    <div class="ak-container ak-sembari-ui">

        {{-- Header --}}
        <div class="ak-sembari-pagehead">
            <h1>Dokumen</h1>
            <div class="ak-sembari-breadcrumb">
                <a href="{{ url('/') }}">Beranda</a>
                <span>/</span>
                <span>SEMBARI</span>
            </div>
        </div>

        {{-- Card Judul --}}
        <div class="ak-sembari-card ak-sembari-card-section">
            <div class="ak-sembari-section-title">SEMBARI</div>
            <div class="ak-sembari-section-subtitle">
                Sistem Manajemen Berbasis Riset
            </div>
        </div>

        {{-- Card Dokumen --}}
        <div class="ak-sembari-card">

            <form class="ak-sembari-tools" method="GET" action="{{ url('/produk/sembari') }}">
                <div class="ak-sembari-tools-row">

                    <div class="ak-sembari-search">
                        <input type="text" name="q" value="{{ $q ?? '' }}"
                            placeholder="Masukkan Judul Dokumen">
                    </div>

                    <select class="ak-sembari-year" name="year">
                        <option value="">Pilih Tahun</option>
                        @foreach ($years ?? [] as $y)
                            <option value="{{ $y }}" @selected((string) ($selectedYear ?? '') === (string) $y)>
                                {{ $y }}
                            </option>
                        @endforeach
                    </select>

                    <button class="ak-sembari-btn ak-sembari-btn-primary" type="submit">
                        Cari
                    </button>

                    @if (!empty($q) || !empty($selectedYear))
                        <a class="ak-sembari-btn ak-sembari-btn-ghost" href="{{ url('/produk/sembari') }}">
                            Reset
                        </a>
                    @endif

                </div>
            </form>

            <div class="ak-sembari-table">
                <div class="ak-sembari-thead">
                    <div>Judul Dokumen</div>
                    <div class="c">Tahun</div>
                    <div class="c">Bentuk Berkas</div>
                    <div class="c">Unduh</div>
                </div>

                <div class="ak-sembari-tbody">
                    @forelse ($docs ?? [] as $doc)
                        <div class="ak-sembari-row">

                            <div class="ak-sembari-docname">
                                {{ \Illuminate\Support\Str::title(strtolower($doc['judul'])) }}
                            </div>

                            <div class="c">
                                <span class="ak-sembari-badge">
                                    {{ $doc['tahun'] }}
                                </span>
                            </div>

                            <div class="c">
                                <span class="ak-sembari-filepill">
                                    📄 {{ strtoupper($doc['tipe']) }}
                                </span>
                            </div>

                            <div class="c">
                                <a class="ak-sembari-download" href="{{ asset('storage/' . $doc['file']) }}"
                                    target="_blank">
                                    <i class="fa fa-download" style="font-size: 15px;"></i>
                                </a>
                            </div>

                        </div>
                    @empty
                        <div class="ak-sembari-empty">
                            Dokumen tidak ditemukan.
                        </div>
                    @endforelse
                </div>
            </div>

        </div>

    </div>

@endsection
