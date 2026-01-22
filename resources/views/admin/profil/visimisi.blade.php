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
        <h3 class="mb-1" style="color:#ffffff;">Visi & Misi</h3>
        <p class="mb-0" style="color:#ffffff;">Kelola visi dan misi BPP Riau</p>
    </div>
    <img src="/img/logobbpr4.png" class="header-logo">
</div>

<div class="row">

    <!-- ================= KIRI ================= -->
    <div class="col-md-6">
        <div class="card p-4">

            <!-- ===== Visi ===== -->
            <label class="fw-bold mb-2">Visi</label>

            <!-- VIEW -->
            <div id="visiView" class="bg-light text-muted p-3 rounded mb-3">
                {{ $visi }}
            </div>

            <!-- EDIT -->
            <textarea id="visiInput"
                      class="form-control mb-3 d-none"
                      rows="4">{{ $visi }}</textarea>

            <!-- ===== Misi ===== -->
            <label class="fw-bold mb-2">Misi</label>

            <!-- VIEW -->
            <div id="misiView" class="bg-light text-muted p-3 rounded mb-3">
                <ol class="mb-0">
                    @foreach($misi as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                </ol>
            </div>

            <!-- EDIT -->
            <textarea id="misiInput"
                      class="form-control mb-3 d-none"
                      rows="6">@foreach($misi as $i => $m){{ ($i+1).'. '.$m."\n" }}@endforeach</textarea>

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

            <i class="bi bi-pencil-square position-absolute top-0 end-0 m-3 text-primary"
               style="cursor:pointer; font-size:1.25rem;"
               title="Edit"
               onclick="enableEdit()"></i>

            <h5 class="fw-bold mb-3">
                <i class="bi bi-eye me-1"></i> Preview
            </h5>

            <h6 class="fw-bold" style="color:#067ac1;">Visi</h6>
            <p id="visiPreview">{{ $visi }}</p>

            <h6 class="fw-bold mt-3" style="color:#067ac1;">Misi</h6>
            <ol id="misiPreview">
                @foreach($misi as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ol>

        </div>
    </div>

</div>

<!-- ================= SCRIPT ================= -->
<script>
const visiView = document.getElementById('visiView');
const misiView = document.getElementById('misiView');
const visiInput = document.getElementById('visiInput');
const misiInput = document.getElementById('misiInput');
const actionButtons = document.getElementById('actionButtons');
const visiPreview = document.getElementById('visiPreview');
const misiPreview = document.getElementById('misiPreview');

/* ===== MODE EDIT ===== */
function enableEdit() {
    visiView.classList.add('d-none');
    misiView.classList.add('d-none');

    visiInput.classList.remove('d-none');
    misiInput.classList.remove('d-none');

    actionButtons.classList.remove('d-none');

    attachSaveHandler();
}

/* ===== BATAL EDIT (HANYA TOGGLE UI, TIDAK RESET DATA) ===== */
function cancelEdit() {
    visiInput.classList.add('d-none');
    misiInput.classList.add('d-none');

    visiView.classList.remove('d-none');
    misiView.classList.remove('d-none');

    actionButtons.classList.add('d-none');
}

/* ===== LIVE PREVIEW ===== */
visiInput.addEventListener('input', () => {
    visiPreview.innerText = visiInput.value;
});

misiInput.addEventListener('input', () => {
    const lines = misiInput.value.split('\n').filter(l => l.trim() !== '');
    misiPreview.innerHTML = lines
        .map(l => `<li>${l.replace(/^\d+\.\s*/, '')}</li>`)
        .join('');
});

/* ===== SIMPAN ===== */
function attachSaveHandler() {
    const saveBtn = document.querySelector('.btn-save');

    saveBtn.onclick = async () => {
        const visi = visiInput.value;
        const misi = misiInput.value;

        try {
            const response = await fetch("{{ route('profil.visimisi.update') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                credentials: "same-origin",
                body: JSON.stringify({ visi, misi })
            });

            const result = await response.json();

            if (!response.ok) {
                showNotif(result.message || 'Gagal menyimpan data');
                return;
            }

            /* ===== UPDATE DOM SETELAH SIMPAN ===== */
            visiView.innerText = visi;
            visiPreview.innerText = visi;

            const lines = misi.split('\n').filter(l => l.trim() !== '');
            const misiHtml = '<ol>' +
                lines.map(l => `<li>${l.replace(/^\d+\.\s*/, '')}</li>`).join('')
                + '</ol>';

            misiView.innerHTML = misiHtml;
            misiPreview.innerHTML = misiHtml;

            cancelEdit();
            showNotif('Visi & Misi berhasil disimpan');

        } catch (error) {
            alert('Terjadi kesalahan server');
            console.error(error);
        }
    };
}
</script>

<script>
function showNotif(message) {
    const notif = document.getElementById('notif-top');

    notif.textContent = message;
    notif.classList.remove('d-none', 'hide');
    notif.classList.add('show');

    // mulai fade out
    setTimeout(() => {
        notif.classList.remove('show');
        notif.classList.add('hide');
    }, 2500);

    // hapus total
    setTimeout(() => {
        notif.classList.add('d-none');
    }, 3000);
}
</script>


@endsection
