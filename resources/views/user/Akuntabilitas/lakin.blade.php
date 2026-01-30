@extends('layouts.user')

@section('title', 'Lakin')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/akuntabilitas.css') }}">
@endsection

@section('content')

    <div class="ak-container ak-lakin-ui">

        {{-- Header halaman --}}
        <div class="ak-pagehead">
            <h1>Dokumen</h1>
            <div class="ak-breadcrumb">
                <a href="{{ url('/') }}">Beranda</a>
                <span>/</span>
                <span>LAKIN</span>
            </div>
        </div>

        {{-- CARD 1 --}}
        <div class="ak-card ak-card-section">
            <div class="ak-section-title">Laporan Akuntabilitas Kinerja (LAKIN)</div>
            <div class="ak-section-subtitle">Laporan Akuntabilitas Kinerja (LAKIN)</div>
        </div>

        {{-- CARD 2 --}}
        <div class="ak-card ak-doc-card">

            <form class="ak-tools" method="GET" action="{{ url('/akuntabilitas/lakin') }}">
                <div class="ak-tools-row">
                    <div class="ak-search">
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
                        <a class="ak-btn ak-btn-ghost" href="{{ url('/akuntabilitas/lakin') }}">Reset</a>
                    @endif
                </div>
            </form>

            <div class="ak-table">
                <div class="ak-thead">
                    <div>Judul Dokumen</div>
                    <div class="c">Tahun</div>
                    <div class="c">Bentuk Berkas</div>
                    <div class="c">Pratinjau</div>
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
                                @if (!empty($doc['file']))
                                    <button class="ak-icon-btn ak-preview-btn"
                                        data-file="{{ asset('storage/' . $doc['file']) }}" title="Pratinjau">
                                        <i class="fa-regular fa-eye"></i>
                                    </button>
                                @else
                                    -
                                @endif
                            </div>

                            <div class="c">
                                @if (!empty($doc['file']))
                                    <a class="ak-icon-btn ak-download" href="{{ asset('storage/' . $doc['file']) }}"
                                        title="Unduh">
                                        <i class="fa-solid fa-download"></i>
                                    </a>
                                @else
                                    -
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="ak-empty">Dokumen tidak ditemukan.</div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>

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
