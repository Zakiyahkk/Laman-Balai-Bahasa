@extends('layouts.user')

@section('css')
    {{-- Pakai CSS SEMBARI / DIPA --}}
    <link rel="stylesheet" href="{{ asset('css/produk.css') }}">
@endsection

@section('title', $judul)

@section('content')

    <div class="ak-container ak-sembari-ui">

        {{-- ================= HEADER ================= --}}
        <div class="ak-sembari-pagehead">
            <h1>Dokumen ZI-WBK</h1>
            <div class="ak-sembari-breadcrumb">
                <a href="{{ url('/') }}">Beranda</a>
                <span>/</span>
                <span>ZI-WBK</span>
                <span>/</span>
                <span>{{ $tahun }}</span>
            </div>
        </div>

        {{-- ================= CARD JUDUL ================= --}}
        <div class="ak-sembari-card ak-sembari-card-section">
            <div class="ak-sembari-section-title">{{ $judul }}</div>
            <div class="ak-sembari-section-subtitle">
                Zona Integritas Menuju Wilayah Bebas dari Korupsi
            </div>
        </div>

        {{-- ================= CARD DOKUMEN ================= --}}
        <div class="ak-sembari-card">

            {{-- ===== FILTER ===== --}}
            <form class="ak-sembari-tools" method="GET">
                <div class="ak-sembari-tools-row">

                    {{-- Cari Judul --}}
                    <div class="ak-sembari-search">
                        <input type="text" name="q" value="{{ request('q') }}"
                            placeholder="Masukkan Judul Dokumen">
                    </div>

                    <button class="ak-sembari-btn ak-sembari-btn-primary" type="submit">
                        Cari
                    </button>

                    @if (request('q'))
                        <a class="ak-sembari-btn ak-sembari-btn-ghost" href="{{ url()->current() }}">
                            Reset
                        </a>
                    @endif

                </div>
            </form>

            {{-- ===== TABLE ===== --}}
            <div class="ak-sembari-table">

                <div class="ak-sembari-thead">
                    <div>Judul Dokumen</div>
                    <div class="c">Tahun</div>
                    <div class="c">Bentuk Berkas</div>
                    <div class="c">Pratinjau</div>
                    <div class="c">Unduh</div>
                </div>

                @forelse ($docs as $doc)
                    <div class="ak-sembari-row">

                        <div class="ak-sembari-docname">
                            {{ $doc['judul'] }}
                        </div>

                        <div class="c">
                            <span class="ak-sembari-badge">{{ $doc['tahun'] }}</span>
                        </div>

                        <div class="c">
                            <span class="ak-sembari-filepill">PDF</span>
                        </div>

                        {{-- ✅ PRATINJAU (MODAL, BUKAN TAB BARU) --}}
                        <div class="c">
                            @if (!empty($doc['file']))
                                <button type="button" class="ak-icon-btn ak-preview-btn"
                                    data-file="{{ asset($doc['file']) }}" title="Pratinjau">
                                    <i class="fa-regular fa-eye"></i>
                                </button>
                            @else
                                <span class="ak-icon-btn is-disabled">
                                    <i class="fa-regular fa-eye"></i>
                                </span>
                            @endif
                        </div>

                        {{-- UNDUH --}}
                        <div class="c">
                            @if (!empty($doc['file']))
                                <a href="{{ asset($doc['file']) }}" download class="ak-icon-btn" title="Unduh">
                                    <i class="fa-solid fa-download"></i>
                                </a>
                            @else
                                <span class="ak-icon-btn is-disabled">
                                    <i class="fa-solid fa-download"></i>
                                </span>
                            @endif
                        </div>

                    </div>
                @empty
                    <div class="ak-sembari-empty">
                        Dokumen belum tersedia.
                    </div>
                @endforelse

            </div>
        </div>

    </div>

    {{-- ================= MODAL PREVIEW PDF ================= --}}
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
