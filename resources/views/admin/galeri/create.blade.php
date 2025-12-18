@extends('admin.layout')

@section('content')
<!-- =================  SECTION LAYOUT ATAS ================= -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Media - Balai Bahasa</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
<body>

    <div class="container">
        <div class="header" style="display: flex; justify-content: space-between; align-items: flex-start; padding: 20px 40px;">
    <div>
        <h1 style="font-size: 24px; color: #334155; font-weight: bold; margin-bottom: 5px;">Upload Media</h1>
        <p style="font-size: 14px; color: #64748b;">Upload gambar atau video untuk galeri Balai Bahasa Provinsi Riau</p>
    </div>
    {{-- HAPUS BARIS DI BAWAH INI JIKA TIDAK INGIN ADA "x" --}}
    {{-- <a href="/admin/galeri" style="text-decoration: none; font-size: 30px; color: #94a3b8;">&times;</a> --}} </div>
       <form action="/admin/galeri/store" method="POST" enctype="multipart/form-data">
    @csrf
    <form id="uploadForm">
            <label class="label-title">File Media</label>
            <div id="dropzone" class="dropzone">
                <input type="file" id="fileInput" accept="image/*,video/mp4">
                <div class="dropzone-content">
                    <i class="fa-solid fa-upload upload-icon"></i>
                    <p id="fileNameDisplay">Klik untuk upload atau drag & drop</p>
                    <span>PNG, JPG, GIF atau MP4 (max. 50MB)</span>
                </div>
            </div>

            <div class="form-card">
                <div class="input-group">
                    <label>Judul Media</label>
                    <input type="text" id="judul" placeholder="Masukkan judul media..." required>
                </div>

                <div class="input-group">
                    <label>Kategori</label>
                    <select id="kategori">
                        <option>Kegiatan</option>
                        <option>Bahasa</option>
                        <option>Berita</option>
                    </select>
                </div>

<div style="margin-bottom: 25px; display: flex; align-items: center; gap: 20px;">
    <label style="font-weight: 600; color: #475569; margin: 0; min-width: 100px;">Tipe Media</label>
    
    <div style="display: flex; gap: 20px; align-items: center;">
        <label style="display: inline-flex; align-items: center; cursor: pointer; margin: 0; font-weight: normal;">
            <input type="radio" name="tipe" value="foto" checked style="width: 18px; height: 18px; margin-right: 8px;"> 
            Foto
        </label>
        <label style="display: inline-flex; align-items: center; cursor: pointer; margin: 0; font-weight: normal;">
            <input type="radio" name="tipe" value="video" style="width: 18px; height: 18px; margin-right: 8px;"> 
            Video
        </label>
    </div>
</div>

        <div style="display: flex; justify-content: flex-end; gap: 15px; margin-top: 100px; padding-top: 25px; border-top: 1px solid #f1f5f9;">
    
    <a href="/admin/galeri" 
       style="padding: 10px 35px; border-radius: 8px; border: 1px solid #d1d5db; color: #64748b; text-decoration: none; font-weight: 600; background: #fff; display: inline-flex; align-items: center;">
       Batal
    </a>

    <button type="submit" 
            style="padding: 10px 40px; border-radius: 8px; border: none; background: #0ea5e9; color: white; font-weight: 600; cursor: pointer;">
       Upload Media
    </button>
</div>

    <script>
        const dropzone = document.getElementById('dropzone');
        const fileInput = document.getElementById('fileInput');
        const fileNameDisplay = document.getElementById('fileNameDisplay');

        // Drag & Drop Logic
        dropzone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropzone.classList.add('active');
        });

        dropzone.addEventListener('dragleave', () => {
            dropzone.classList.remove('active');
        });

        dropzone.addEventListener('drop', () => {
            dropzone.classList.remove('active');
        });

        // Menampilkan nama file saat dipilih
        fileInput.addEventListener('change', function() {
            if (this.files.length > 0) {
                fileNameDisplay.innerText = "File: " + this.files[0].name;
                fileNameDisplay.style.color = "#0ea5e9";
            }
        });

        // Submit alert
        document.getElementById('uploadForm').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('File siap diupload!');
        });
    </script>
</body>
</html>
</html>
</div>
@endsection
