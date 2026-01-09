@extends('layouts.user')

@section('title', 'Renstra')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/akuntabilitas.css') }}">
@endsection

@section('content')

    <div class="ak-container ak-renstra-clone">

        {{-- Header ala Badan Bahasa (simpel) --}}
        <div class="ak-pagehead">
            <h1>Dokumen</h1>
            <div class="ak-breadcrumb">
                <a href="{{ url('/') }}">Beranda</a>
                <span>/</span>
                <span>Dokumen</span>
            </div>
        </div>

        <div class="ak-card ak-card-doc">
            <div class="ak-card-top">
                <div class="ak-card-title">Rencana Strategis (Renstra)</div>
                <div class="ak-card-subtitle">Rencana Strategis (Renstra)</div>
            </div>

            {{-- Filter super simpel (kayak web badan bahasa) --}}
            <form class="ak-filter" method="GET" action="{{ url('/akuntabilitas/renstra') }}">
                <div class="ak-filter-left">
                    <div class="ak-search">
                        <span class="ak-search-ico">🔎</span>
                        <input type="text" name="q" value="{{ $q ?? '' }}" placeholder="Masukkan kata kunci">
                    </div>

                    <select name="year" class="ak-year">
                        <option value="">Pilih Tahun</option>
                        @foreach ($years ?? [] as $y)
                            <option value="{{ $y }}" @selected((string) ($selectedYear ?? '') === (string) $y)>{{ $y }}</option>
                        @endforeach
                    </select>

                    <button type="submit" class="ak-btn">Cari</button>

                    @if (!empty($q) || !empty($selectedYear))
                        <a href="{{ url('/akuntabilitas/renstra') }}" class="ak-btn ak-btn-ghost">Reset</a>
                    @endif
                </div>
            </form>

            {{-- List / tabel ala Badan Bahasa (tetap simpel) --}}
            <div class="ak-doc-table">
                <div class="ak-doc-head">
                    <div>Judul Dokumen</div>
                    <div class="c">Tahun</div>
                    <div class="c">Bentuk Berkas</div>
                    <div class="c">Unduh</div>
                </div>

                <div class="ak-doc-body">
                    @forelse(($docs ?? []) as $doc)
                        <div class="ak-doc-row">
                            <div class="ak-doc-name">{{ $doc['judul'] ?? '-' }}</div>

                            <div class="c">
                                <span class="ak-badge">{{ $doc['tahun'] ?? '-' }}</span>
                            </div>

                            <div class="c">
                                <span class="ak-file">
                                    📄 {{ strtoupper($doc['tipe'] ?? 'PDF') }}
                                </span>
                            </div>

                            <div class="c">
                                <a class="ak-download"
                                    href="{{ isset($doc['file']) ? asset('storage/' . $doc['file']) : '#' }}" target="_blank"
                                    title="Unduh">
                                    ⬇️
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="ak-empty">Dokumen tidak ditemukan.</div>
                    @endforelse
                </div>
            </div>
        </div>

    </div>

@endsection
