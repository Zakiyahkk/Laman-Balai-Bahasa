@extends('layouts.user')

@section('title', 'Perjanjian Kinerja')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/akuntabilitas.css') }}">
@endsection

@section('content')

    <div class="ak-container ak-pk-ui">

        {{-- Header --}}
        <div class="ak-pagehead">
            <h1>Dokumen</h1>
            <div class="ak-breadcrumb">
                <a href="{{ url('/') }}">Beranda</a>
                <span>/</span>
                <span>Perjanjian Kinerja</span>
            </div>
        </div>

        {{-- Card Judul --}}
        <div class="ak-card ak-card-section">
            <div class="ak-section-title">Perjanjian Kinerja</div>
            <div class="ak-section-subtitle">Perjanjian Kinerja</div>
        </div>

        {{-- Card Dokumen --}}
        <div class="ak-card ak-doc-card">

            <form class="ak-tools" method="GET" action="{{ url('/akuntabilitas/perjanjian-kinerja') }}">
                <div class="ak-tools-row">
                    <div class="ak-search">
                        <span class="ak-search-icon">🔎</span>
                        <input type="text" name="q" value="{{ $q ?? '' }}" placeholder="Masukkan kata kunci">
                    </div>

                    <select class="ak-year" name="year">
                        <option value="">Pilih Tahun</option>
                        @foreach ($years ?? [] as $y)
                            <option value="{{ $y }}" @selected((string) ($selectedYear ?? '') === (string) $y)>
                                {{ $y }}
                            </option>
                        @endforeach
                    </select>

                    <button class="ak-btn ak-btn-primary" type="submit">Cari</button>

                    @if (!empty($q) || !empty($selectedYear))
                        <a class="ak-btn ak-btn-ghost" href="{{ url('/akuntabilitas/perjanjian-kinerja') }}">Reset</a>
                    @endif
                </div>
            </form>

            <div class="ak-table">
                <div class="ak-thead">
                    <div>Judul Dokumen</div>
                    <div class="c">Tahun</div>
                    <div class="c">Bentuk Berkas</div>
                    <div class="c">Unduh</div>
                </div>

                <div class="ak-tbody">
                    @forelse(($docs ?? []) as $doc)
                        <div class="ak-row">
                            <div class="ak-docname">
                                {{ \Illuminate\Support\Str::title(strtolower($doc['judul'] ?? '-')) }}
                            </div>

                            <div class="c">
                                <span class="ak-badge">{{ $doc['tahun'] ?? '-' }}</span>
                            </div>

                            <div class="c">
                                <span class="ak-filepill">
                                    <span class="ak-file-ico">📄</span>
                                    {{ strtoupper($doc['tipe'] ?? 'PDF') }}
                                </span>
                            </div>

                            <div class="c">
                                <a class="ak-download"
                                    href="{{ isset($doc['file']) ? asset('storage/' . $doc['file']) : '#' }}"
                                    target="_blank">
                                    <i class="fa fa-download" style="font-size: 15px;"></i>
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
