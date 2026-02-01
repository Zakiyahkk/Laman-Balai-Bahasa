@extends('admin.layout')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">


<div class="content-wrapper" style="background: #f8faff; padding: 2.5rem;">
    <div class="header-box d-flex align-items-center gap-3 mb-4">
        <div style="background: #e8f1ff; color: #2563eb; width: 45px; height: 45px; display: flex; align-items: center; justify-content: center; border-radius: 12px;">
            <i class="fa-solid fa-file-circle-plus"></i>
        </div>
        <div>
            <h3 class="fw-bold m-0" style="font-size: 22px;">Tambah Dokumen Sembari</h3>
            <p class="text-muted m-0">Serial Terjemahan Balai Bahasa</p>
        </div>
    </div>

    <div class="card border-0 shadow-sm" style="border-radius: 16px;">
        <div class="card-body p-4">
            <form action="{{ route('admin.sembari.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row g-4">
                    {{-- Nama Dokumen --}}
                    <div class="col-12">
                        <label class="form-label fw-bold">Nama Dokumen / Judul <span class="text-danger">*</span></label>
                        <input type="text" name="nama_dokumen" class="form-control" placeholder="Masukkan judul dokumen" style="height: 50px; border-radius: 10px;" required>
                    </div>

                    {{-- Tanggal --}}
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Tanggal Terbit / Tahun <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal" class="form-control" style="height: 50px; border-radius: 10px;" required>
                    </div>

                    {{-- Status --}}
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-select" style="height: 50px; border-radius: 10px;">
                            <option value="published">Published</option>
                            <option value="draft">Draft</option>
                        </select>
                    </div>

                    {{-- Daerah (Dropdown) --}}
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Daerah <span class="text-danger">*</span></label>
                        <select name="daerah" class="form-select" style="height: 50px; border-radius: 10px;" required>
                            <option value="">-- Pilih Daerah --</option>
                            <option value="Kabupaten Bengkalis">Kabupaten Bengkalis</option>
                            <option value="Kabupaten Indragiri Hilir">Kabupaten Indragiri Hilir</option>
                            <option value="Kabupaten Indragiri Hulu">Kabupaten Indragiri Hulu</option>
                            <option value="Kabupaten Kampar">Kabupaten Kampar</option>
                            <option value="Kabupaten Kepulauan Meranti">Kabupaten Kepulauan Meranti</option>
                            <option value="Kabupaten Kuantan Singingi">Kabupaten Kuantan Singingi</option>
                            <option value="Kabupaten Pelalawan">Kabupaten Pelalawan</option>
                            <option value="Kabupaten Rokan Hilir">Kabupaten Rokan Hilir</option>
                            <option value="Kabupaten Rokan Hulu">Kabupaten Rokan Hulu</option>
                            <option value="Kabupaten Siak">Kabupaten Siak</option>
                            <option value="Kota Dumai">Kota Dumai</option>
                            <option value="Kota Pekanbaru">Kota Pekanbaru</option>
                        </select>
                    </div>

                    {{-- Jenjang (Dropdown) --}}
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Jenjang <span class="text-danger">*</span></label>
                        <select name="jenjang" class="form-select" style="height: 50px; border-radius: 10px;" required>
                            <option value="">-- Pilih Jenjang --</option>
                            <option value="A">A</option>
                            <option value="B1">B1</option>
                            <option value="B2">B2</option>
                            <option value="B3">B3</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                            <option value="E">E</option>
                        </select>
                    </div>


                    {{-- Upload --}}
                    <div class="col-12 mt-4">
                        <label class="form-label fw-bold">Upload File (PDF/DOCX) <span class="text-danger">*</span></label>
                        <input type="file" name="file_dokumen" class="form-control" style="padding: 10px; border-radius: 10px;" required>
                        <div class="form-text text-muted mt-2">
                            <i class="fa-solid fa-circle-info me-1"></i> Maksimal ukuran file 10MB. Format yang didukung: .pdf, .docx
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-5">
                    <a href="{{ route('admin.sembari.index') }}" class="btn btn-outline-secondary px-4" style="border-radius: 10px;">Batal</a>
                    <button type="submit" class="btn btn-primary px-4" style="background: #2563eb; border-radius: 10px;">Simpan</button>
                </div>
            </form> 
        </div>
    </div>
</div>
@endsection
