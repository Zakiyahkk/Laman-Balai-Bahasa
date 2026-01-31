    @extends('layouts.user')

    @section('title', 'Hasil Survei')

    @section('css')
    <style>
    /* =========================================
    CSS KHUSUS HALAMAN SURVEI
    ========================================= */
    .ak-survei-ui {
        padding: 0 0 120px; /* Padding atas 0 agar nempel */
    }

    .ak-container {
        max-width: 1200px;
        margin: auto;
        margin-top: -20px; /* Tarik sedikit ke atas untuk menutup gap putih */
    }

    /* Header */
    .ak-pagehead {
        background: #0b2a4a;
        color: #fff;
        border-radius: 14px;
        padding: 22px 20px;
    }
    .ak-pagehead h1 { margin: 0; font-size: 30px; font-weight: 900; }
    .ak-breadcrumb { margin-top: 8px; font-size: 13px; color: rgba(255, 255, 255, 0.85); }
    .ak-breadcrumb a { color: #fff; text-decoration: none; }
    .ak-breadcrumb span { margin: 0 6px; opacity: 0.9; }

    /* Card */
    .ak-card {
        background: #fff;
        border: 1px solid #e6ecf5;
        border-radius: 14px;
        box-shadow: 0 10px 30px rgba(16, 24, 40, 0.08);
    }
    .ak-card:hover { transform: none !important; background: #fff !important; }

    /* Section Title */
    .ak-card-section { margin-top: 14px; padding: 16px 20px; }
    .ak-section-title { font-size: 18px; font-weight: 900; }
    .ak-section-subtitle { margin-top: 6px; font-size: 14px; color: #6b7a90; }

    /* Tools */
    .ak-doc-card { margin-top: 14px; overflow: hidden; }
    .ak-tools { padding: 14px 20px; border-bottom: 1px solid #e6ecf5; }
    .ak-tools-row { display: flex; gap: 10px; flex-wrap: wrap; align-items: center; }
    .ak-search { position: relative; width: min(420px, 100%); }
    .ak-search input { width: 100%; padding: 10px 12px; border: 1px solid #e6ecf5; border-radius: 12px; outline: none; }
    .ak-year { padding: 10px 12px; border-radius: 12px; border: 1px solid #e6ecf5; background: #fff; min-width: 120px; }
    .ak-btn { padding: 10px 14px; border-radius: 12px; border: 0; cursor: pointer; font-size: 14px; }
    .ak-btn-primary { background: #1d5aa6; color: #fff; }
    .ak-btn-ghost { background: transparent; border: 1px solid #e6ecf5; color: #1a2433; text-decoration: none; display: inline-block; }

    /* Table */
    .ak-table { width: 100%; }
    .ak-thead {
        display: grid;
        grid-template-columns: 1fr 110px 150px 90px 90px;
        gap: 12px;
        padding: 12px 20px;
        font-size: 12px;
        font-weight: 400;
        color: #6b7a90;
        background: #fcfcfd;
        border-bottom: 1px solid #e6ecf5;
    }
    .ak-tbody .ak-row {
        display: grid;
        grid-template-columns: 1fr 110px 150px 90px 90px;
        gap: 12px;
        padding: 14px 20px;
        border-bottom: 1px solid #e6ecf5;
        align-items: center;
    }
    .ak-tbody .ak-row:last-child { border-bottom: none; }
    .ak-docname { font-size: 13px; color: #1a2433; line-height: 1.4; }
    .c { display: flex; justify-content: center; align-items: center; }
    .ak-badge { background: #eaf2ff; color: #2d5aa6; padding: 6px 10px; border-radius: 99px; font-size: 12px; }
    .ak-filepill { display: inline-flex; align-items: center; gap: 6px; padding: 6px 10px; border-radius: 99px; border: 1px solid #e6ecf5; font-size: 12px; background: #fff; }
    .ak-file-ico { opacity: 0.8; }
    .ak-icon-btn { width: 36px; height: 36px; display: flex; justify-content: center; align-items: center; border-radius: 10px; border: 1px solid #e6ecf5; background: #fff; color: #6b7a90; cursor: pointer; transition: all 0.2s; text-decoration: none; }
    .ak-icon-btn:hover { border-color: #1d5aa6; color: #1d5aa6; background: #f0f7ff; }
    .ak-empty { padding: 30px; text-align: center; color: #6b7a90; }

    /* Mobile Responsive */
    @media (max-width: 820px) {
        .ak-thead { display: none; }
        .ak-tbody .ak-row {
            display: block;
            grid-template-columns: unset;
            background: #fff;
            border: 1px solid #e6ecf5;
            border-radius: 12px;
            margin-bottom: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.03);
            padding: 16px;
        }
        .ak-docname {
            font-weight: 700;
            font-size: 14px;
            margin-bottom: 12px;
            padding-bottom: 10px;
            border-bottom: 1px solid #f0f0f0;
            display: block;
        }
        .ak-tbody .ak-row > .c {
            display: flex;
            justify-content: space-between !important;
            width: 100%;
            margin-bottom: 8px;
        }
        .ak-tbody .ak-row > .c::before {
            content: attr(data-label);
            font-size: 13px;
            color: #64748b;
            font-weight: 500;
        }
        .ak-tbody .ak-row > .c:last-child { margin-bottom: 0; }
    }

    /* Modal */
    .ak-preview-modal { position: fixed; inset: 0; z-index: 9999; display: none; align-items: center; justify-content: center; }
    .ak-preview-modal.active { display: flex; }
    .ak-preview-overlay { position: absolute; inset: 0; background: rgba(0, 0, 0, 0.6); backdrop-filter: blur(2px); }
    .ak-preview-box { position: relative; background: #fff; width: 90%; max-width: 900px; height: 85vh; border-radius: 12px; overflow: hidden; box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3); z-index: 10; display: flex; flex-direction: column; }
    .ak-preview-header { height: 50px; display: flex; justify-content: space-between; align-items: center; padding: 0 16px; border-bottom: 1px solid #e6ecf5; background: #fff; font-weight: 600; }
    .ak-preview-close { background: none; border: none; font-size: 24px; cursor: pointer; color: #64748b; }
    .ak-preview-body { flex: 1; background: #f1f5f9; }
    .ak-preview-body iframe { width: 100%; height: 100%; border: none; }
    </style>
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

                                <div class="c" data-label="Tahun">
                                    <span class="ak-badge">{{ $s['tahun'] ?? '-' }}</span>
                                </div>

                                <div class="c" data-label="Jenis">
                                    <span class="ak-filepill">
                                        📄 {{ strtoupper($s['tipe'] ?? 'PDF') }}
                                    </span>
                                </div>

                                <div class="c" data-label="Pratinjau">
                                    @if (!empty($s['file']))
                                        <button class="ak-icon-btn ak-preview-btn"
                                            data-file="{{ asset('storage/' . $s['file']) }}">
                                            <i class="fa-regular fa-eye"></i>
                                        </button>
                                    @else
                                        -
                                    @endif
                                </div>

                                <div class="c" data-label="Unduh">
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
