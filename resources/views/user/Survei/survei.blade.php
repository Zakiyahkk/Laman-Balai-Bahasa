@extends('layouts.user')

@section('title', 'Hasil Survei')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/akuntabilitas.css') }}">
@endsection

@section('content')

    <div class="ak-container ak-survei-ui">

        {{-- Header halaman --}}
        <div class="ak-pagehead">
            <h1>Hasil Survei</h1>
            <div class="ak-breadcrumb">
                <a href="{{ url('/') }}">Beranda</a>
                <span>/</span>
                <span>Survei</span>
                <span>/</span>
                <span>Hasil Survei</span>
            </div>
        </div>

        {{-- Card Judul --}}
        <div class="ak-card ak-card-section">
            <div class="ak-section-title">Hasil Survei Pelayanan Publik</div>
            <div class="ak-section-subtitle">
                Survei Kepuasan Masyarakat, Persepsi Kualitas Pelayanan, dan Antikorupsi
            </div>
        </div>

        {{-- Card Tabel --}}
        <div class="ak-card ak-doc-card">

            {{-- Tools --}}
            <form class="ak-tools" method="GET" action="{{ url('/survei/hasil') }}">
                <div class="ak-tools-row">

                    <div class="ak-search">
                        <input type="text" name="q" value="{{ $q ?? '' }}" placeholder="Cari judul survei">
                    </div>

                    <select class="ak-year" name="year">
                        <option value="">Pilih Tahun</option>
                        @foreach ($years ?? [] as $y)
                            <option value="{{ $y }}" @selected((string) ($selectedYear ?? '') === (string) $y)>
                                {{ $y }}
                            </option>
                        @endforeach
                    </select>

                    <button class="ak-btn ak-btn-primary">Cari</button>

                    @if (!empty($q) || !empty($selectedYear))
                        <a class="ak-btn ak-btn-ghost" href="{{ url('/survei/hasil') }}">
                            Reset
                        </a>
                    @endif
                </div>
            </form>

            {{-- Table --}}
            <div class="ak-table">
                <div class="ak-thead">
                    <div>Judul Survei</div>
                    <div class="c">Tahun</div>
                    <div class="c">Jenis</div>
                    <div class="c">Pratinjau</div>
                    <div class="c">Unduh</div>
                </div>

                <div class="ak-tbody">
                    @forelse(($surveis ?? []) as $s)
                        <div class="ak-row">
                            <div class="ak-docname">{{ $s['judul'] ?? '-' }}</div>

                            <div class="c">
                                <span class="ak-badge">{{ $s['tahun'] ?? '-' }}</span>
                            </div>

                            <div class="c">
                                <span class="ak-filepill">
                                    📄 {{ strtoupper($s['tipe'] ?? 'PDF') }}
                                </span>
                            </div>

                            <div class="c">
                                @if (!empty($s['file']))
                                    <button class="ak-icon-btn ak-preview-btn"
                                        data-file="{{ asset('storage/' . $s['file']) }}">
                                        <i class="fa-regular fa-eye"></i>
                                    </button>
                                @else
                                    -
                                @endif
                            </div>

                            <div class="c">
                                @if (!empty($s['file']))
                                    <a class="ak-icon-btn ak-download" href="{{ asset('storage/' . $s['file']) }}">
                                        <i class="fa-solid fa-download"></i>
                                    </a>
                                @else
                                    -
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="ak-empty">Data survei belum tersedia.</div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>

    {{-- Modal Preview --}}
    <div class="ak-preview-modal" id="akPreviewModal">
        <div class="ak-preview-overlay"></div>
        <div class="ak-preview-box">
            <div class="ak-preview-header">
                <span>Pratinjau Dokumen</span>
                <button class="ak-preview-close">&times;</button>
            </div>
            <div class="ak-preview-body">
                <iframe id="akPreviewFrame"></iframe>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        document.addEventListener('click', function(e) {
            const btn = e.target.closest('.ak-preview-btn');
            if (!btn) return;

            const file = btn.dataset.file;
            if (!file) return;

            document.getElementById('akPreviewFrame').src =
                file + '#toolbar=0&navpanes=0&scrollbar=1';

            document.getElementById('akPreviewModal')
                .classList.add('active');
        });

        document.querySelector('.ak-preview-close')?.addEventListener('click', closePreview);
        document.querySelector('.ak-preview-overlay')?.addEventListener('click', closePreview);

        function closePreview() {
            document.getElementById('akPreviewFrame').src = '';
            document.getElementById('akPreviewModal').classList.remove('active');
        }
    </script>
@endpush
