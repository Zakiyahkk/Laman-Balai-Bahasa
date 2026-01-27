<section class="section pengumuman-section" style="margin-top: -10px;">
    <div class="container" style="margin-top: -10px;">

        <div class="section-header">
            <h2 class="judul-section">Pengumuman Terbaru</h2>
            <div class="header-line"></div>
        </div>

        <div class="pengumuman-list">

            @forelse ($items as $item)
                @php
                    $tanggal = \Carbon\Carbon::parse($item['tanggal']);
                    $docUrl = !empty($item['file_url']) ? $item['file_url'] : $item['gambar_url'];
                @endphp

                <div class="pengumuman-item trigger-modal" data-doc="{{ $docUrl }}" data-type="{{ $item['type'] }}">

                    <div class="date-badge">
                        <span class="day">{{ $tanggal->format('d') }}</span>
                        <span class="month">{{ $tanggal->translatedFormat('M') }}</span>
                        <span class="year">{{ $tanggal->format('Y') }}</span>
                    </div>

                    <div class="doc-icon {{ $item['type'] === 'image' ? 'image-type' : '' }}">
                        <i class="fa-solid {{ $item['type'] === 'pdf' ? 'fa-file-pdf' : 'fa-image' }}"></i>
                    </div>

                    <div class="item-content">
                        <span class="doc-title">{{ $item['judul'] }}</span>
                        <div class="doc-meta">
                            <i class="fa-solid fa-eye"></i>
                            {{ $item['type'] === 'pdf' ? 'Klik untuk melihat dokumen' : 'Klik untuk melihat poster' }}
                        </div>
                    </div>

                    <div class="action-btn">
                        <i class="fa-solid fa-chevron-right"></i>
                    </div>
                </div>
            @empty
                <p style="text-align:center;color:#94a3b8;">Belum ada pengumuman.</p>
            @endforelse


        </div>
    </div>
</section>

{{-- MODAL (STRUKTUR TIDAK DIUBAH) --}}
<div id="docModal" class="modal-overlay">
    <div class="modal-container">
        <div class="modal-header">
            <h3 id="modalTitle">Pratinjau Dokumen</h3>
            <div class="modal-actions">
                <a id="downloadBtn" href="#" target="_blank" download class="btn-action btn-download"
                    title="Unduh File">
                    <i class="fa-solid fa-download"></i>
                </a>
                <button class="btn-action btn-close" onclick="closeDocModal()">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
        </div>

        <div class="modal-body">
            <iframe id="pdfViewer" src="" frameborder="0"></iframe>
            <img id="imageViewer" src="" alt="Preview">

            <div id="fallbackMessage" class="fallback-msg">
                <i class="fa-regular fa-file-excel"></i>
                <p>Pratinjau tidak tersedia atau file tidak ditemukan.</p>
                <a id="fallbackLink" href="#" target="_blank" class="btn-fallback">
                    Unduh Dokumen Saja
                </a>
            </div>
        </div>
    </div>
</div>
