@extends('admin.layout')

@section('content')

<style>
/* ===== ZI-WBK CREATE (FULL + ANIMATION) ===== */
@keyframes fadeSlideUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.ziwbk-form-wrapper {
    width: 100%;
    animation: fadeSlideUp .5s ease;
}

.ziwbk-form-card {
    background: #ffffff;
    border-radius: 14px;
    padding: 30px;
    width: 100%;
    max-width: 1100px; 
    box-shadow: 0 10px 25px rgba(0,0,0,.08);
}

.ziwbk-form-title {
    font-size: 24px;
    font-weight: 700;
    margin-bottom: 25px;
}

.ziwbk-form-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
}

.ziwbk-form-group {
    display: flex;
    flex-direction: column;
}

.ziwbk-form-group.full {
    grid-column: span 2;
}

.ziwbk-form-group label {
    font-weight: 600;
    font-size: 14px;
    margin-bottom: 6px;
}

.ziwbk-form-group input,
.ziwbk-form-group select {
    padding: 12px 14px;
    border-radius: 10px;
    border: 1px solid #d1d5db;
    font-size: 14px;
    transition: all .25s ease;
}

.ziwbk-form-group input:focus,
.ziwbk-form-group select:focus {
    outline: none;
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37,99,235,.15);
    transform: translateY(-1px);
}

/* Style untuk Preview PDF */
#preview-container {
    margin-top: 15px;
    display: none; /* Sembunyi jika belum ada file */
}

#pdf-preview {
    width: 100%;
    height: 500px;
    border-radius: 10px;
    border: 1px solid #d1d5db;
}

.ziwbk-actions {
    display: flex;
    justify-content: flex-end;
    gap: 12px;
    margin-top: 30px;
}

.ziwbk-btn-primary {
    background: linear-gradient(135deg, #2563eb, #1e40af);
    color: #fff;
    border: none;
    padding: 12px 22px;
    border-radius: 10px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: all .25s ease;
}

.ziwbk-btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 18px rgba(37,99,235,.35);
}

.ziwbk-btn-secondary {
    background: #e5e7eb;
    color: #111827;
    padding: 12px 22px;
    border-radius: 10px;
    text-decoration: none;
    font-size: 14px;
    transition: all .2s ease;
}

.ziwbk-btn-secondary:hover { background: #d1d5db; }

@media (max-width: 768px) {
    .ziwbk-form-grid { grid-template-columns: 1fr; }
    .ziwbk-form-group.full { grid-column: span 1; }
}
</style>

<div class="ziwbk-form-wrapper">
    <div class="ziwbk-form-card">
        <div class="ziwbk-form-title">Tambah Dokumen ZI-WBK</div>

        <form action="{{ route('admin.ziwbk.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="ziwbk-form-grid">
                <div class="ziwbk-form-group full">
                    <label>Judul Dokumen</label>
                    <input type="text" name="judul" placeholder="Masukkan judul dokumen" required>
                </div>

                <div class="ziwbk-form-group">
                    <label>Tahun</label>
                    <select name="tahun" required>
                        <option value="">-- Pilih Tahun --</option>
                        <option value="2024">2024</option>
                        <option value="2025" selected>2025</option>
                        <option value="2026">2026</option>
                        <option value="2027">2027</option>
                    </select>
                </div>
                <div class="ziwbk-form-group">
                <label>Status Dokumen</label>
                <select name="status" required>
                    <option value="draft">Draft</option>
                    <option value="publish">Publish</option>
                </select>
            </div>
                <div class="ziwbk-form-group">
                    <label>Pilar</label>
                    <select name="pilar" id="pilar-select" required>
                        <option value="">-- Pilih Pilar --</option>
                        <option value="manajemen-perubahan">Manajemen Perubahan</option>
                        <option value="penguatan-tata-laksana">Penguatan Tata Laksana</option>
                        <option value="manajemen-sdm">Manajemen SDM</option>
                        <option value="penguatan-akuntabilitas">Penguatan Akuntabilitas</option>
                        <option value="penguatan-pengawasan">Penguatan Pengawasan</option>
                        <option value="layanan-publik">Layanan Publik</option>
                    </select>
                </div>

                <div class="ziwbk-form-group">
                    <label>Sub Pilar</label>
                    <select name="sub_pilar" id="sub-pilar-select" required>
                        <option value="">-- Pilih Sub Pilar --</option>
                    </select>
                </div>

                <div class="ziwbk-form-group full">
                    <label>File Dokumen (PDF)</label>
                    <input type="file" name="file" id="file-input" accept="application/pdf" required>
                    
                    <div id="preview-container">
                        <label style="margin-top: 15px; color: #2563eb;">Pratinjau Dokumen:</label>
                        <iframe id="pdf-preview"></iframe>
                    </div>
                </div>
            </div>

            <div class="ziwbk-actions">
                <a href="{{ route('admin.ziwbk.index') }}" class="ziwbk-btn-secondary">Kembali</a>
                <button type="submit" class="ziwbk-btn-primary">Simpan Dokumen</button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const pilarSelect = document.getElementById('pilar-select');
    const subPilarSelect = document.getElementById('sub-pilar-select');
    const fileInput = document.getElementById('file-input');
    const previewContainer = document.getElementById('preview-container');
    const pdfPreview = document.getElementById('pdf-preview');

    // 1. Logika Dropdown Dinamis
    const dataSubPilar = {
        'manajemen-perubahan': [
            { val: 'tim-kerja', text: 'Tim Kerja' },
            { val: 'rencana-pembangunan-wbk', text: 'Rencana Pembangunan WBK' },
            { val: 'pemantauan-evaluasi', text: 'Pemantauan & Evaluasi' },
            { val: 'pola-pikir-budaya-kerja', text: 'Pola Pikir & Budaya Kerja' }
        ],
        'penguatan-tata-laksana': [
            { val: 'pos', text: 'POS (Prosedur Operasional Tetap)' },
            { val: 'sistem-elektronik', text: 'Sistem Elektronik' },
            { val: 'keterbukaan-informasi', text: 'Keterbukaan Informasi' }
        ],
        'manajemen-sdm': [
            { val: 'perencanaan-kebutuhan', text: 'Perencanaan Kebutuhan' },
            { val: 'pola-mutasi-internal', text: 'Pola Mutasi Internal' },
            { val: 'pengembangan-pegawai', text: 'Pengembangan Pegawai' },
            { val: 'penetapan-kinerja', text: 'Penetapan Kinerja' },
            { val: 'penegakan-disiplin', text: 'Penegakan Disiplin' },
            { val: 'sistem-informasi', text: 'Sistem Informasi' }
        ],
        'penguatan-akuntabilitas': [
            { val: 'keterlibatan-pimpinan', text: 'Keterlibatan Pimpinan' },
            { val: 'akuntabilitas-kinerja', text: 'Akuntabilitas Kinerja' }
        ],
        'penguatan-pengawasan': [
            { val: 'gratifikasi', text: 'Gratifikasi' },
            { val: 'spi', text: 'SPI (Sistem Pengendalian Intern)' },
            { val: 'pengaduan-masyarakat', text: 'Pengaduan Masyarakat' },
            { val: 'whistle-blowing', text: 'Whistle Blowing System' },
            { val: 'benturan-kepentingan', text: 'Benturan Kepentingan' }
        ],
        'layanan-publik': [
            { val: 'standar-pelayanan', text: 'Standar Pelayanan' },
            { val: 'budaya-pelayanan-prima', text: 'Budaya Pelayanan Prima' },
            { val: 'pemanfaatan-tik', text: 'Pemanfaatan TIK' },
            { val: 'kepuasan-masyarakat', text: 'Kepuasan Masyarakat' }
        ]
    };

    pilarSelect.addEventListener('change', function() {
        subPilarSelect.innerHTML = '<option value="">-- Pilih Sub Pilar --</option>';
        if (this.value && dataSubPilar[this.value]) {
            dataSubPilar[this.value].forEach(item => {
                const opt = document.createElement('option');
                opt.value = item.val;
                opt.text = item.text;
                subPilarSelect.appendChild(opt);
            });
        }
    });

    // 2. Logika Preview PDF
    fileInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file && file.type === "application/pdf") {
            const fileURL = URL.createObjectURL(file);
            pdfPreview.src = fileURL;
            previewContainer.style.display = 'block';
        } else {
            previewContainer.style.display = 'none';
            if(file) alert("Mohon unggah file dalam format PDF.");
        }
    });
});
</script>

@endsection