@extends('admin.layout')

@section('content')

<div id="notif-top" class="notif-top d-none"></div>

<style>
.notif-top {
    position: fixed;
    top: 20px;
    left: 50%;
    transform: translateX(-50%);
    background: #0485c7;
    color: white;
    padding: 14px 28px;
    border-radius: 10px;
    font-weight: 600;
    font-size: 16px;
    min-width: 300px;
    text-align: center;
    z-index: 9999;
    animation: slideDown 0.5s ease-out forwards;
    opacity: 0;
}

@keyframes slideDown {
    0% { transform: translate(-50%, -30px); opacity: 0; }
    100% { transform: translate(-50%, 0); opacity: 1; }
}

.notif-top.show {
    opacity: 1;
}

.notif-top.hide {
    opacity: 0;
    transition: 0.5s ease;
}
</style>

<!-- ================= HEADER ================= -->
<div class="page-header d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="mb-1" style="color:#ffffff;">Tugas & Fungsi</h3>
        <p class="mb-0" style="color:#ffffff;">Kelola tugas dan fungsi BPP Riau</p>
    </div>
    <img src="/img/logobbpr4.png" class="header-logo">
</div>

<div class="row">

    <!-- ================= KIRI ================= -->
    <div class="col-md-6">
        <div class="card p-4">

            <!-- ===== TUGAS ===== -->
            <label class="fw-bold mb-2">Tugas</label>

            <div id="tugasView" class="bg-light text-muted p-3 rounded mb-3">
                {{ $tugas }}
            </div>

            <textarea id="tugasInput"
                      class="form-control mb-3 d-none"
                      rows="4">{{ $tugas }}</textarea>

            <!-- ===== FUNGSI ===== -->
            <label class="fw-bold mb-2">Fungsi</label>

            <div id="fungsiView" class="bg-light text-muted p-3 rounded mb-3">
                <ol class="mb-0">
                    @foreach($fungsi as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                </ol>
            </div>

            <textarea id="fungsiInput"
                      class="form-control mb-3 d-none"
                      rows="6">@foreach($fungsi as $i => $f){{ ($i+1).'. '.$f."\n" }}@endforeach</textarea>

            <!-- ACTION BUTTON -->
            <div id="actionButtons" class="d-flex gap-2 justify-content-end d-none">
                <button type="button"
                        class="btn-action btn-cancel"
                        onclick="cancelEdit()">
                    Batal
                </button>
                <button type="button"
                        class="btn-action btn-save">
                    Simpan
                </button>
            </div>

        </div>
    </div>

    <!-- ================= KANAN : PREVIEW ================= -->
    <div class="col-md-6">
        <div class="card p-4 position-relative h-100">
        <i class="bi bi-pencil-square position-absolute top-0 end-0 m-3 text-primary" style="cursor:pointer; font-size:1.25rem;" title="Edit" onclick="enableEdit()"></i>
            <h5 class="fw-bold mb-3">
                <i class="bi bi-eye me-1"></i> Preview
            </h5>

            <h6 class="fw-bold" style="color:#067ac1;">Tugas</h6>
            <p id="tugasPreview">{{ $tugas }}</p>

            <h6 class="fw-bold mt-3" style="color:#067ac1;">Fungsi</h6>
            <ol id="fungsiPreview">
                @foreach($fungsi as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ol>

        </div>
    </div>

</div>

<!-- ================= SCRIPT ================= -->
<script>
const tugasView = document.getElementById('tugasView');
const fungsiView = document.getElementById('fungsiView');
const tugasInput = document.getElementById('tugasInput');
const fungsiInput = document.getElementById('fungsiInput');
const actionButtons = document.getElementById('actionButtons');
const tugasPreview = document.getElementById('tugasPreview');
const fungsiPreview = document.getElementById('fungsiPreview');

/* ===== MODE EDIT ===== */
function enableEdit() {
    tugasView.classList.add('d-none');
    fungsiView.classList.add('d-none');

    tugasInput.classList.remove('d-none');
    fungsiInput.classList.remove('d-none');

    actionButtons.classList.remove('d-none');

    attachSaveHandler();
}

/* ===== BATAL EDIT ===== */
function cancelEdit() {
    tugasInput.classList.add('d-none');
    fungsiInput.classList.add('d-none');

    tugasView.classList.remove('d-none');
    fungsiView.classList.remove('d-none');

    actionButtons.classList.add('d-none');
}

/* ===== LIVE PREVIEW ===== */
tugasInput.addEventListener('input', () => {
    tugasPreview.innerText = tugasInput.value;
});

fungsiInput.addEventListener('input', () => {
    const lines = fungsiInput.value.split('\n').filter(l => l.trim() !== '');
    fungsiPreview.innerHTML = lines
        .map(l => `<li>${l.replace(/^\d+\.\s*/, '')}</li>`)
        .join('');
});

/* ===== SIMPAN ===== */
function attachSaveHandler() {
    const saveBtn = document.querySelector('.btn-save');

    saveBtn.onclick = async () => {
        const tugas = tugasInput.value;
        const fungsi = fungsiInput.value;

        try {
            const response = await fetch("{{ route('profil.tugasfungsi.update') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                credentials: "same-origin",
                body: JSON.stringify({ tugas, fungsi })
            });

            const result = await response.json();

            if (!response.ok) {
                showNotif(result.message || 'Gagal menyimpan data');
                return;
            }

            /* ===== UPDATE DOM ===== */
            tugasView.innerText = tugas;
            tugasPreview.innerText = tugas;

            const lines = fungsi.split('\n').filter(l => l.trim() !== '');
            const fungsiHtml = '<ol>' +
                lines.map(l => `<li>${l.replace(/^\d+\.\s*/, '')}</li>`).join('')
                + '</ol>';

            fungsiView.innerHTML = fungsiHtml;
            fungsiPreview.innerHTML = fungsiHtml;

            cancelEdit();
            showNotif('Tugas & Fungsi berhasil disimpan');

        } catch (error) {
            showNotif('Terjadi kesalahan server');
            console.error(error);
        }
    };
}

/* ===== NOTIFIKASI ===== */
function showNotif(message) {
    const notif = document.getElementById('notif-top');

    notif.textContent = message;
    notif.classList.remove('d-none', 'hide');
    notif.classList.add('show');

    setTimeout(() => {
        notif.classList.remove('show');
        notif.classList.add('hide');
    }, 2500);

    setTimeout(() => {
        notif.classList.add('d-none');
    }, 3000);
}
</script>

@endsection
