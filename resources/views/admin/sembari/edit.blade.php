@extends('admin.layout')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">


<div class="content-wrapper" style="background: #f8faff; padding: 2.5rem;">
    <div class="header-box d-flex align-items-center gap-3 mb-4">
        <div style="background: #e0f2fe; color: #0284c7; width: 45px; height: 45px; display: flex; align-items: center; justify-content: center; border-radius: 12px;">
            <i class="fa-solid fa-pen-to-square"></i>
        </div>
        <div>
            <h3 class="fw-bold m-0" style="font-size: 22px;">Edit Dokumen Sembari</h3>
            <p class="text-muted m-0">Perbarui data dokumen</p>
        </div>
    </div>

    <div class="card border-0 shadow-sm" style="border-radius: 16px;">
        <div class="card-body p-4">
            <form action="{{ route('admin.sembari.update', $sembari->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row g-4">
                    {{-- Nama Dokumen --}}
                    <div class="col-12">
                        <label class="form-label fw-bold">Nama Dokumen</label>
                        <input type="text" name="nama_dokumen" class="form-control" value="{{ $sembari->nama_dokumen }}" style="height: 50px; border-radius: 10px;" required>
                    </div>

                    {{-- Tanggal --}}
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Tanggal Terbit</label>
                        <input type="date" name="tanggal" class="form-control" value="{{ $sembari->tanggal ? $sembari->tanggal->format('Y-m-d') : '' }}" style="height: 50px; border-radius: 10px;" required>
                    </div>

                    {{-- Status --}}
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Status</label>
                        <select name="status" class="form-select" style="height: 50px; border-radius: 10px;">
                            <option value="published" {{ $sembari->status == 'published' ? 'selected' : '' }}>Published</option>
                            <option value="draft" {{ $sembari->status == 'draft' ? 'selected' : '' }}>Draft</option>
                        </select>
                    </div>

                    {{-- Daerah (Dropdown) --}}
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Daerah</label>
                        <select name="daerah" class="form-select" style="height: 50px; border-radius: 10px;" required>
                            <option value="">-- Pilih Daerah --</option>
                            @foreach(['Kabupaten Bengkalis', 'Kabupaten Indragiri Hilir', 'Kabupaten Indragiri Hulu', 'Kabupaten Kampar', 'Kabupaten Kepulauan Meranti', 'Kabupaten Kuantan Singingi', 'Kabupaten Pelalawan', 'Kabupaten Rokan Hilir', 'Kabupaten Rokan Hulu', 'Kabupaten Siak', 'Kota Dumai', 'Kota Pekanbaru'] as $d)
                                <option value="{{ $d }}" {{ $sembari->daerah == $d ? 'selected' : '' }}>{{ $d }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Jenjang (Dropdown) --}}
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Jenjang</label>
                        <select name="jenjang" class="form-select" style="height: 50px; border-radius: 10px;" required>
                            <option value="">-- Pilih Jenjang --</option>
                            @foreach(['A', 'B1', 'B2', 'B3', 'C', 'D', 'E'] as $j)
                                <option value="{{ $j }}" {{ $sembari->jenjang == $j ? 'selected' : '' }}>{{ $j }}</option>
                            @endforeach
                        </select>
                    </div>


                    {{-- Upload --}}
                    <div class="col-12 mt-4">
                        <label class="form-label fw-bold">Update File (Opsional)</label>
                        
                        @if($sembari->file_path)
                            <div class="mb-2 p-2 px-3 bg-light rounded border d-inline-flex align-items-center gap-2">
                                <i class="fa-solid fa-file-pdf text-danger"></i>
                                <span class="text-muted small">File saat ini: <strong>{{ basename($sembari->file_path) }}</strong></span>
                            </div>
                        @endif

                        <input type="file" name="file_dokumen" class="form-control mt-2" style="padding: 10px; border-radius: 10px;">
                        <div class="form-text text-muted mt-2">
                            <i class="fa-solid fa-circle-info me-1"></i> Biarkan kosong jika tidak ingin mengganti file. Max 10MB.
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-5">
                    <a href="{{ route('admin.sembari.index') }}" class="btn btn-outline-secondary px-4" style="border-radius: 10px;">Batal</a>
                    <button type="submit" class="btn btn-primary px-4" style="background: #0284c7; border:none; border-radius: 10px;">Update Perubahan</button>
                </div>
            </form> 
        </div>
    </div>
</div>
@endsection
