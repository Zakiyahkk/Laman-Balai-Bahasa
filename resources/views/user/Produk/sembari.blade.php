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
                    <div class="c">Pratinjau</div>
                    <div class="c">Unduh</div>
                </div>

                <div class="ak-sembari-tbody">
                    @forelse ($docs ?? [] as $doc)
                        <div class="ak-sembari-row">

                            <div class="ak-sembari-docname">
                                {{ \Illuminate\Support\Str::title(strtolower($doc['judul'] ?? '-')) }}
                            </div>

                            <div class="c">
                                <span class="ak-sembari-badge">{{ $doc['tahun'] ?? '-' }}</span>
                            </div>

                            <div class="c">
                                <span class="ak-sembari-filepill">
                                    📄 {{ strtoupper($doc['tipe'] ?? 'PDF') }}
                                </span>
                            </div>

                            {{-- Pratinjau --}}
                            <div class="c">
                                @if (!empty($doc['file']))
                                    <button class="ak-icon-btn ak-preview-btn"
                                        data-file="{{ asset('storage/' . $doc['file']) }}" title="Pratinjau">
                                        <i class="fa-regular fa-eye"></i>
                                    </button>
                                @else
                                    <button class="ak-icon-btn is-disabled" disabled title="Dokumen belum tersedia">
                                        <i class="fa-regular fa-eye"></i>
                                    </button>
                                @endif
                            </div>

                            {{-- Unduh --}}
                            <div class="c">
                                @if (!empty($doc['file']))
                                    <a class="ak-icon-btn" href="{{ asset('storage/' . $doc['file']) }}" title="Unduh">
                                        <i class="fa-solid fa-download"></i>
                                    </a>
                                @else
                                    <button class="ak-icon-btn is-disabled" disabled title="Dokumen belum tersedia">
                                        <i class="fa-solid fa-download"></i>
                                    </button>
                                @endif
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

    {{-- MODAL PREVIEW (PAKAI GLOBAL, SATU KALI SAJA) --}}
    <div class="ak-preview-modal" id="akPreviewModal">
        <div class="ak-preview-overlay"></div>

        <div class="ak-preview-box">
            <div class="ak-preview-header">
                <span>Pratinjau Dokumen</span>
                <button type="button" class="ak-preview-close">&times;</button>
            </div>

            <div class="ak-preview-body">
                <iframe id="akPreviewFrame"></iframe>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            document.body.addEventListener('click', function(e) {
                const btn = e.target.closest('.ak-preview-btn');
                if (!btn) return;

                const file = btn.dataset.file;
                if (!file) return;

                document.getElementById('akPreviewFrame').src = file + '#toolbar=0&navpanes=0&scrollbar=1';
                document.getElementById('akPreviewModal').classList.add('active');
            });

            document.querySelector('.ak-preview-close')?.addEventListener('click', closePreview);
            document.querySelector('.ak-preview-overlay')?.addEventListener('click', closePreview);

            function closePreview() {
                document.getElementById('akPreviewFrame').src = '';
                document.getElementById('akPreviewModal').classList.remove('active');
            }

        });
    </script>
@endpush
