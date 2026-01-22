@extends('admin.layout')

@section('content')
<!-- =================  SECTION LAYOUT ATAS ================= -->
<div class="page-header d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="mb-1" style="color:#ffffff;">Struktur Organisasi</h3>
        <p class="mb-0" style="color:#ffffff;">Struktur organisasi BPP Riau</p>
    </div>

    <div class="header-logo">
        <img src="/img/logobbpr4.png" class="img-fluid header-logo">
    </div>
</div>

<!-- ================= ISI MAIN CONTENT ================= -->
<div class="row g-4">

    <!-- ================= KIRI : STRUKTUR AKTIF ================= -->
    <div class="col-lg-8">

        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-body p-4">

                <!-- HEADER CARD KIRI -->
                <div class="mb-4">
                    <h4 class="fw-semibold mb-1">Struktur Organisasi Aktif</h4>
                    @if($strukturAktif)
                    <small class="text-muted">
                        Terakhir diupdate:
                            {{ \Carbon\Carbon::parse($strukturAktif['created_at'], 'UTC')
                                ->setTimezone('Asia/Jakarta')
                                ->translatedFormat('d F Y, H:i') }}
                    </small>
                    @endif
                </div>

                <!-- BAGAN (KODE KAMU, TIDAK DIUBAH) -->
                <div class="bagan-container">
                <div class="bagan-wrapper">

                    <!-- KEPALA BALAI -->
                    <div class="bagan-box box-top">
                        @if($kepalaBalai)
                            <div class="card pegawai-card p-3 text-center">
                                <div class="avatar-wrapper mx-auto mb-2">
                                    <img src="{{ $kepalaBalai['foto'] }}" class="avatar-img">
                                </div>
                                <div class="fw-semibold">{{ $kepalaBalai['nama'] }}</div>
                                <div class="text-muted small">{{ $kepalaBalai['jabatan'] }}</div>
                            </div>
                        @endif
                    </div>

                    <!-- KASUBBAG -->
                    <div class="bagan-box box-right">
                        @if($kasubbagUmum)
                            <div class="card pegawai-card p-3 text-center">
                                <div class="avatar-wrapper mx-auto mb-2">
                                    <img src="{{ $kasubbagUmum['foto'] }}" class="avatar-img">
                                </div>
                                <div class="fw-semibold">{{ $kasubbagUmum['nama'] }}</div>
                                <div class="text-muted small">{{ $kasubbagUmum['jabatan'] }}</div>
                            </div>
                        @endif
                    </div>

                    <!-- FUNGSIONAL -->
                    <div class="bagan-box box-bottom">
                        <div class="card p-4 text-center fw-semibold">
                            Kelompok Jabatan Fungsional
                        </div>
                    </div>

                    <!-- GARIS -->
                    <div class="line vertical"></div>
                    <div class="line horizontal"></div>
                </div>
                </div>
            </div>
        </div>

    </div>

    <!-- ================= KANAN : RIWAYAT VERSI ================= -->
    <div class="col-lg-4">

        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-body p-4">

                <!-- HEADER RIWAYAT -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-semibold mb-0">Riwayat Versi</h5>
                    <i class="bi bi-clock-history text-muted"></i>
                </div>

                <!-- LIST RIWAYAT -->
                <div class="riwayat-list">
                @foreach($riwayat as $item)
                    <div class="riwayat-card
                        {{ isset($strukturAktif) && $strukturAktif['struktur_id'] == $item['struktur_id'] ? 'selected' : '' }}"
                        data-id="{{ $item['struktur_id'] }}"
                        onclick="location.href='?struktur=' + this.dataset.id">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <div class="fw-semibold">
                                    Struktur Organisasi {{ $item['versi'] ?? '-' }}
                                </div>
                            <div class="small text-muted">
                                    <i class="bi bi-calendar3"></i>
                                {{ \Carbon\Carbon::parse($item['created_at'], 'UTC')
                                        ->setTimezone('Asia/Jakarta')
                                        ->translatedFormat('d F Y, H:i') }}
                                </div>
                            </div>

                            @if($item['status'])
                                <i class="bi bi-check-circle-fill fs-5"></i>
                            @endif
                        </div>

                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
