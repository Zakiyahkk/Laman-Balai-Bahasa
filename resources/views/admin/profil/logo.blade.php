@extends('admin.layout')

@section('content')

<!-- ================= HEADER ================= -->
<div class="page-header d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="mb-1">Koleksi Logo</h3>
        <p class="text-muted mb-0">
            Kelola koleksi logo dan identitas visual BPP Riau
        </p>
    </div>

    <img src="/img/logobbpr.png" class="header-logo">
</div>

<!-- ================= MAIN CONTENT ================= -->
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4">

        <!-- HEADER TABLE -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <strong>Daftar Logo</strong>
            <button id="btnTambahLogo" class="btn-add-article">
                Tambah Logo
            </button>
        </div>

        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="border-bottom">
                    <tr>
                        <th style="width:40px" class="text-center">No</th>
                        <th style="width:220px">Nama Logo</th>
                        <th class="text-center" style="width:260px">Gambar</th>
                        <th class="text-center" style="width:120px">Aksi</th>
                    </tr>
                </thead>
                <tbody id="logoBody">
                </tbody>
            </table>
        </div>

    </div>
</div>

<!-- ================= SCRIPT ================= -->
<script>
let logoIndex = 1;

document.getElementById('btnTambahLogo').onclick = () => {
    const row = document.createElement('tr');

    row.innerHTML = `
        <td class="text-center">${logoIndex++}</td>

        <td>
            <input type="text"
                   class="form-control form-control-sm"
                   placeholder="Nama logo...">
        </td>

        <td class="text-center">
            <div class="logo-preview-wrapper new">
                <input type="file"
                       accept="image/*"
                       class="d-none"
                       onchange="previewNewLogo(this)">

                <div class="logo-upload-trigger"
                     onclick="this.previousElementSibling.click()">
                    <span>Upload Gambar</span>
                </div>
            </div>
        </td>

        <td class="text-center">
            <i class="bi bi-check-lg text-success me-3"
                style="cursor:pointer"
                onclick="simpanLogo(this)"></i>

            <i class="bi bi-x-lg text-muted"
               style="cursor:pointer"
               onclick="this.closest('tr').remove()"></i>
        </td>
    `;

    document.getElementById('logoBody').appendChild(row);
};

function previewNewLogo(input) {
    const file = input.files[0];
    if (!file) return;

    const wrapper = input.closest('.logo-preview-wrapper');

    // SIMPAN FILE DI WRAPPER
    wrapper.dataset.file = 'selected';
    wrapper._file = file;

    const reader = new FileReader();
    reader.onload = e => {
        wrapper.innerHTML = `
            <img src="${e.target.result}" class="logo-preview-img">

            <input type="file"
                   accept="image/*"
                   class="d-none"
                   onchange="previewNewLogo(this)">

            <div class="logo-overlay"
                 onclick="this.previousElementSibling.click()">
                <i class="bi bi-upload fs-4"></i>
                <small>Ganti Gambar</small>
            </div>
        `;
    };
    reader.readAsDataURL(file);
}
</script>


<script>
function simpanLogo(el) {
    const tr = el.closest('tr');

    const nama = tr.querySelector('input[type="text"]')?.value;
    const wrapper = tr.querySelector('.logo-preview-wrapper');
    const file = wrapper?._file;

    if (!nama || !file) {
        alert('Nama logo dan gambar wajib diisi');
        return;
    }

    const formData = new FormData();
    formData.append('nama_logo', nama);
    formData.append('logo', file);

    fetch('/admin/profil/logo', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: formData
    })
    .then(res => {
        if (!res.ok) throw new Error('Gagal menyimpan');
        return res.json();
    })
    .then(() => {
        alert('Logo berhasil disimpan');
        location.reload();
    })
    .catch(err => alert(err.message));
}
</script>

@endsection
