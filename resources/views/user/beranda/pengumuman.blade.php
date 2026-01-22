<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengumuman Modern dengan Preview</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body>

    <section class="section pengumuman-section">
        <div class="container">

            <div class="section-header">
                <h2 class="judul-section">Pengumuman Terbaru</h2>
                <div class="header-line"></div>
            </div>

            <div class="pengumuman-list">

                <div class="pengumuman-item trigger-modal"
                    data-doc="document/dokumentesting1.pdf"
                    data-type="pdf">

                    <div class="date-badge">
                        <span class="day">15</span>
                        <span class="month">Jan</span>
                        <span class="year">2025</span>
                    </div>
                    <div class="doc-icon">
                        <i class="fa-solid fa-file-pdf"></i>
                    </div>
                    <div class="item-content">
                        <span class="doc-title">Pengumuman Lomba Kebahasaan Tingkat Provinsi</span>
                        <div class="doc-meta">
                            <i class="fa-solid fa-eye"></i> Klik untuk melihat dokumen
                        </div>
                    </div>
                    <div class="action-btn">
                        <i class="fa-solid fa-chevron-right"></i>
                    </div>
                </div>

                <div class="pengumuman-item trigger-modal"
                    data-doc="img/pantun2.png"
                    data-type="image">

                    <div class="date-badge">
                        <span class="day">10</span>
                        <span class="month">Jan</span>
                        <span class="year">2025</span>
                    </div>
                    <div class="doc-icon image-type">
                        <i class="fa-regular fa-image"></i>
                    </div>
                    <div class="item-content">
                        <span class="doc-title">Informasi Terusan dari Badan Bahasa (Poster)</span>
                        <div class="doc-meta">
                            <i class="fa-solid fa-eye"></i> Klik untuk melihat poster
                        </div>
                    </div>
                    <div class="action-btn">
                        <i class="fa-solid fa-chevron-right"></i>
                    </div>
                </div>

                <div class="pengumuman-item trigger-modal"
                    data-doc="document/buku6.pdf"
                    data-type="pdf">

                    <div class="date-badge">
                        <span class="day">05</span>
                        <span class="month">Jan</span>
                        <span class="year">2025</span>
                    </div>
                    <div class="doc-icon">
                        <i class="fa-solid fa-file-pdf"></i>
                    </div>
                    <div class="item-content">
                        <span class="doc-title">Juknis Kegiatan Balai Bahasa Tahun 2025</span>
                        <div class="doc-meta">
                            <i class="fa-solid fa-eye"></i> Klik untuk melihat dokumen
                        </div>
                    </div>
                    <div class="action-btn">
                        <i class="fa-solid fa-chevron-right"></i>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <div id="docModal" class="modal-overlay">
        <div class="modal-container">
            <div class="modal-header">
                <h3 id="modalTitle">Pratinjau Dokumen</h3>
                <div class="modal-actions">
                    <a id="downloadBtn" href="#" download class="btn-action btn-download" title="Unduh File">
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
                    <a id="fallbackLink" href="#" class="btn-fallback">Unduh Dokumen Saja</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>