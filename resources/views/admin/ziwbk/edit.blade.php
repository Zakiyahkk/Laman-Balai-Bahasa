@extends('admin.layout')

@section('content')

<style>
/* ===== ZI-WBK EDIT PAGE ===== */
.ziwbk-form-wrapper {
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: flex-start;
    padding: 30px;
    background: #f3f4f6;
}

.ziwbk-form-card {
    width: 100%;
    max-width: 1000px;
    background: #ffffff;
    border-radius: 14px;
    padding: 25px 30px;
    box-shadow: 0 10px 25px rgba(0,0,0,.08);
}

.ziwbk-form-title {
    font-size: 22px;
    font-weight: 700;
    margin-bottom: 25px;
    color: #1f2933;
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
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 6px;
    color: #374151;
}

.ziwbk-form-group input,
.ziwbk-form-group select {
    padding: 10px 12px;
    border-radius: 8px;
    border: 1px solid #d1d5db;
    font-size: 14px;
}

.ziwbk-form-group input:focus,
.ziwbk-form-group select:focus {
    outline: none;
    border-color: #2563eb;
}

.ziwbk-preview {
    margin-top: 15px;
}

.ziwbk-preview-label {
    font-size: 13px;
    font-weight: 600;
    margin-bottom: 8px;
    color: #374151;
}

.ziwbk-preview iframe {
    width: 100%;
    height: 450px;
    border: 1px solid #e5e7eb;
    border-radius: 10px;
}

.ziwbk-actions {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    margin-top: 25px;
}

.ziwbk-btn-primary {
    background: #2563eb;
    color: #fff;
    border: none;
    padding: 10px 18px;
    border-radius: 8px;
    font-size: 14px;
    cursor: pointer;
}

.ziwbk-btn-primary:hover {
    background: #1e40af;
}

.ziwbk-btn-secondary {
    background: #e5e7eb;
    color: #374151;
    padding: 10px 18px;
    border-radius: 8px;
    text-decoration: none;
    font-size: 14px;
}

.ziwbk-btn-secondary:hover {
    background: #d1d5db;
}
</style>

<div class="ziwbk-form-wrapper">
    <div class="ziwbk-form-card">

        <div class="ziwbk-form-title">
            Edit Dokumen ZI-WBK
        </div>

        <form action="{{ route('admin.ziwbk.update', $data->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="ziwbk-form-grid">

                <div class="ziwbk-form-group full">
                    <label>Judul Dokumen</label>
                    <input type="text" name="judul" value="{{ $data->judul }}" required>
                </div>

                <div class="ziwbk-form-group">
                    <label>Tahun</label>
                    <select name="tahun" required>
                        @for ($i = 2024; $i <= 2030; $i++)
                            <option value="{{ $i }}" {{ $data->tahun == $i ? 'selected' : '' }}>
                                {{ $i }}
                            </option>
                        @endfor
                    </select>
                </div>

                <div class="ziwbk-form-group">
                    <label>Pilar</label>
                    <select name="pilar" id="pilar-select" required>
                        <option value="">-- Pilih Pilar --</option>
                        <option value="manajemen-perubahan" {{ $data->pilar=='manajemen-perubahan'?'selected':'' }}>Manajemen Perubahan</option>
                        <option value="penguatan-tata-laksana" {{ $data->pilar=='penguatan-tata-laksana'?'selected':'' }}>Penguatan Tata Laksana</option>
                        <option value="manajemen-sdm" {{ $data->pilar=='manajemen-sdm'?'selected':'' }}>Manajemen SDM</option>
                        <option value="penguatan-akuntabilitas" {{ $data->pilar=='penguatan-akuntabilitas'?'selected':'' }}>Penguatan Akuntabilitas</option>
                        <option value="penguatan-pengawasan" {{ $data->pilar=='penguatan-pengawasan'?'selected':'' }}>Penguatan Pengawasan</option>
                        <option value="layanan-publik" {{ $data->pilar=='layanan-publik'?'selected':'' }}>Layanan Publik</option>
                    </select>
                </div>

                <div class="ziwbk-form-group">
                    <label>Sub Pilar</label>
                    <select name="sub_pilar" id="sub-pilar-select" required>
                        </select>
                </div>
                <div class="ziwbk-form-group">
                <label>Status Dokumen</label>
                <select name="status" required>
                    <option value="draft" {{ $data->status=='draft'?'selected':'' }}>
                        Draft
                    </option>
                    <option value="publish" {{ $data->status=='publish'?'selected':'' }}>
                        Publish
                    </option>
                </select>
            </div>

                <div class="ziwbk-form-group full">
                    <label>File Dokumen (Kosongkan jika tidak ingin mengganti PDF)</label>
                    <input type="file" name="file" id="file-input" accept="application/pdf">

                    <div class="ziwbk-preview">
                        <div class="ziwbk-preview-label" id="preview-label">Preview Dokumen Saat Ini</div>
                        <iframe id="pdf-preview" src="{{ asset('storage/'.$data->file) }}"></iframe>
                    </div>
                </div>

            </div>

            <div class="ziwbk-actions">
                <a href="{{ route('admin.ziwbk.index') }}" class="ziwbk-btn-secondary">
                    Kembali
                </a>
                <button type="submit" class="ziwbk-btn-primary">
                    Update Dokumen
                </button>
            </div>

        </form>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const pilarSelect = document.getElementById('pilar-select');
    const subPilarSelect = document.getElementById('sub-pilar-select');
    const fileInput = document.getElementById('file-input');
    const pdfPreview = document.getElementById('pdf-preview');
    const previewLabel = document.getElementById('preview-label');

    // Data Sub Pilar
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

    // Fungsi untuk mengisi Sub Pilar
    function populateSubPilar(pilarKey, selectedSub = null) {
        subPilarSelect.innerHTML = '<option value="">-- Pilih Sub Pilar --</option>';
        if (pilarKey && dataSubPilar[pilarKey]) {
            dataSubPilar[pilarKey].forEach(item => {
                const opt = document.createElement('option');
                opt.value = item.val;
                opt.text = item.text;
                if (selectedSub && item.val === selectedSub) {
                    opt.selected = true;
                }
                subPilarSelect.appendChild(opt);
            });
        }
    }

    // Jalankan pertama kali saat load (untuk mode Edit)
    const initialPilar = pilarSelect.value;
    const initialSubPilar = "{{ $data->sub_pilar }}";
    populateSubPilar(initialPilar, initialSubPilar);

    // Event saat Pilar diganti manual
    pilarSelect.addEventListener('change', function() {
        populateSubPilar(this.value);
    });

    // Event saat File dipilih (Live Preview baru)
    fileInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file && file.type === "application/pdf") {
            const fileURL = URL.createObjectURL(file);
            pdfPreview.src = fileURL;
            previewLabel.innerText = "Preview File Baru (Belum Tersimpan)";
            previewLabel.style.color = "#2563eb";
        }
    });
});
</script>

@endsection