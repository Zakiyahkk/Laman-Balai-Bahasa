@extends('layouts.user')

@section('title', 'SEMBARI')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/produk.css') }}">
@endsection

@section('content')

    <div class="ak-container ak-sembari-ui">

        {{-- (Header Dihapus Sesuai Request) --}}

        {{-- Card Judul --}}
        <div class="ak-sembari-card ak-sembari-card-section" style="margin-top: 40px;">
            <div class="ak-sembari-section-title">SEMBARI</div>
            <div class="ak-sembari-section-subtitle">
                Sistem Manajemen Berbasis Riset
            </div>
        </div>

        {{-- Card Dokumen --}}
        <div class="ak-sembari-card">

            <form class="ak-sembari-tools" method="GET" action="{{ url('/produk/sembari') }}">
                <div class="ak-sembari-tools-row" style="justify-content: flex-end;"> 
                    
                    {{-- Input Pencarian Judul DIHAPUS --}}

                    <select class="ak-sembari-year" name="year">
                        <option value="">Semua Tahun</option>
                        @foreach ($years ?? [] as $y)
                            <option value="{{ $y }}" @selected((string) ($selectedYear ?? '') === (string) $y)>
                                {{ $y }}
                            </option>
                        @endforeach
                    </select>

                    <button class="ak-sembari-btn ak-sembari-btn-primary" type="submit">
                        Filter
                    </button>

                    @if (!empty($q) || !empty($selectedYear))
                        <a class="ak-sembari-btn ak-sembari-btn-ghost" href="{{ url('/produk/sembari') }}">
                            Reset
                        </a>
                    @endif

                </div>
            </form>

            <div class="ak-sembari-table">
                {{-- Header Tabel --}}
                <div class="ak-sembari-thead" style="grid-template-columns: 2fr 0.8fr 1.2fr 0.8fr 0.8fr 0.8fr;"> 
                    <div>Judul Dokumen</div>
                    <div class="c">Tahun</div>
                    <div class="c">Daerah</div>   {{-- Ganti Bentuk Berkas --}}
                    <div class="c">Jenjang</div>  {{-- Kolom Baru --}}
                    <div class="c">Pratinjau</div>
                    <div class="c">Unduh</div>
                </div>

                <div class="ak-sembari-tbody">
                    @forelse ($docs ?? [] as $doc)
                        <div class="ak-sembari-row" style="grid-template-columns: 2fr 0.8fr 1.2fr 0.8fr 0.8fr 0.8fr;">

                            <div class="ak-sembari-docname">
                                {{ \Illuminate\Support\Str::title(strtolower($doc['judul'] ?? '-')) }}
                            </div>

                            <div class="c">
                                <span class="ak-sembari-badge">{{ $doc['tahun'] ?? '-' }}</span>
                            </div>

                            {{-- Kolom DAERAH --}}
                            <div class="c">
                                <span style="font-size: 0.9rem; color: #475569;">
                                    {{ $doc['daerah'] }}
                                </span>
                            </div>

                            {{-- Kolom JENJANG --}}
                            <div class="c">
                                <span class="ak-sembari-badge" style="background: #e0f2fe; color: #0284c7;">
                                    {{ $doc['jenjang'] }}
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
                                    <a class="ak-icon-btn" href="{{ url('/produk/sembari/download/' . basename($doc['file'])) }}" title="Unduh" target="_blank">
                                        {{-- Note: Direct asset link might force preview in browser, better use a download route if strictly need download --}}
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
