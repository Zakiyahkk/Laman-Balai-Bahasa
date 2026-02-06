@extends('layouts.user')

@section('title', 'Detail Berita')

@section('css')
<style>
/* ========================================
   STYLING UNTUK CONTENT PUBLIKASI
   Agar semua formatting dari TinyMCE
   tampil dengan benar di user view
   ======================================== */

.berita-detail-content {
    font-size: 16px;
    line-height: 1.8;
    color: #333;
}

/* === TEXT FORMATTING === */
.berita-detail-content strong,
.berita-detail-content b {
    font-weight: 700;
    color: #000;
}

.berita-detail-content em,
.berita-detail-content i {
    font-style: italic;
}

.berita-detail-content u {
    text-decoration: underline;
}

/* === PARAGRAPHS & ALIGNMENT === */
.berita-detail-content p {
    margin-bottom: 1.2em;
    line-height: 1.8;
}

/* Text alignment dari inline styles sudah didukung,
   tapi kita pastikan tidak ada override */
.berita-detail-content p[style*="text-align: left"] {
    text-align: left !important;
}

.berita-detail-content p[style*="text-align: center"] {
    text-align: center !important;
}

.berita-detail-content p[style*="text-align: right"] {
    text-align: right !important;
}

.berita-detail-content p[style*="text-align: justify"] {
    text-align: justify !important;
}

/* === LISTS === */
.berita-detail-content ul,
.berita-detail-content ol {
    margin: 1.5em 0;
    padding-left: 2.5em;
}

.berita-detail-content ul {
    list-style-type: disc;
}

.berita-detail-content ul ul {
    list-style-type: circle;
    margin-top: 0.5em;
    margin-bottom: 0.5em;
}

.berita-detail-content ol {
    list-style-type: decimal;
}

.berita-detail-content ol ol {
    list-style-type: lower-alpha;
    margin-top: 0.5em;
    margin-bottom: 0.5em;
}

.berita-detail-content li {
    margin-bottom: 0.6em;
    line-height: 1.7;
}

.berita-detail-content li:last-child {
    margin-bottom: 0;
}

/* === TABLES === */
.berita-detail-content table {
    width: 100%;
    border-collapse: collapse;
    margin: 2em 0;
    background: #fff;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}

.berita-detail-content table th,
.berita-detail-content table td {
    padding: 12px 16px;
    border: 1px solid #ddd;
    text-align: left;
}

.berita-detail-content table th {
    background: #f8f9fa;
    font-weight: 600;
    color: #333;
}

.berita-detail-content table tr:nth-child(even) {
    background: #f9fbfd;
}

.berita-detail-content table tr:hover {
    background: #f0f4f8;
}

/* === LINKS === */
.berita-detail-content a {
    color: #0066cc;
    text-decoration: none;
    border-bottom: 1px solid transparent;
    transition: all 0.2s;
}

.berita-detail-content a:hover {
    color: #004499;
    border-bottom-color: #004499;
}

/* === HEADINGS (jika ada) === */
.berita-detail-content h1,
.berita-detail-content h2,
.berita-detail-content h3,
.berita-detail-content h4,
.berita-detail-content h5,
.berita-detail-content h6 {
    margin-top: 1.5em;
    margin-bottom: 0.8em;
    font-weight: 600;
    color: #222;
    line-height: 1.3;
}

.berita-detail-content h1 { font-size: 2em; }
.berita-detail-content h2 { font-size: 1.7em; }
.berita-detail-content h3 { font-size: 1.4em; }
.berita-detail-content h4 { font-size: 1.2em; }
.berita-detail-content h5 { font-size: 1.1em; }
.berita-detail-content h6 { font-size: 1em; }

/* === BLOCKQUOTES (bonus) === */
.berita-detail-content blockquote {
    margin: 1.5em 0;
    padding: 1em 1.5em;
    border-left: 4px solid #0066cc;
    background: #f8f9fa;
    font-style: italic;
    color: #555;
}

/* === IMAGES === */
.berita-detail-content img {
    max-width: 100%;
    height: auto;
    display: block;
    margin: 1.5em auto;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

/* === RESPONSIVE === */
@media (max-width: 768px) {
    .berita-detail-content {
        font-size: 15px;
    }
    
    .berita-detail-content table {
        font-size: 14px;
    }
    
    .berita-detail-content table th,
    .berita-detail-content table td {
        padding: 10px;
    }
}
</style>
@endsection


@section('content')

    <section class="section berita-detail">
        <div class="container">

            {{-- WRAPPER biar rapi di tengah --}}
            <div class="berita-detail-wrap">

                {{-- JUDUL --}}
                <h1 class="berita-detail-title">
                    {{ $berita->judul }}
                </h1>

                {{-- META --}}
                <div class="berita-detail-meta">
                    <span class="meta-item">
                        <i class="fa-regular fa-calendar"></i>
                        {{ \Carbon\Carbon::parse($berita->tanggal)->translatedFormat('d F Y') }}
                    </span>

                    <span class="meta-dot">•</span>

                    <span class="meta-item">
                        <i class="fa-regular fa-user"></i>
                        {{ $berita->penulis ?? 'Admin' }}
                    </span>

                    <span class="meta-dot">•</span>

                    <span class="meta-item meta-views">
                        <i class="fa-regular fa-eye"></i>
                        {{ $berita->pembaca ?? 0 }}
                    </span>
                </div>

                {{-- CARD (konten) --}}
                <div class="berita-detail-card">

                    {{-- GAMBAR --}}
                    @if (!empty($berita->gambar_url))
                        <div class="berita-detail-image">
                            <img src="{{ $berita->gambar_url }}" alt="{{ $berita->judul }}">
                        </div>
                    @endif

                    {{-- ISI --}}
                    <div class="berita-detail-content">
                        {!! $berita->isi !!}
                    </div>

                </div>

                {{-- TOMBOL KEMBALI --}}
                <div class="berita-detail-actions">
                    <a href="{{ route('berita.index') }}" class="btn-kembali">
                        ← Kembali ke Berita
                    </a>
                </div>

            </div>
        </div>
    </section>

@endsection
