@extends('admin.layout')
@php use Carbon\Carbon; @endphp

@section('content')
@php
    $totalDraf = $list->where('status','draf')->count();
    $totalTerbit = $list->where('status','terbit')->count();
@endphp

<div class="page-header d-flex justify-content-between align-items-center mb-4">
    <div>
    <h3 class="mb-1" style="color:#ffffff;">Publikasi</h3>
    <p class="mb-0" style="color:#ffffff;">
        Total publikasi: {{ $total }}
    </p>
</div>


    <div class="header-logo">
        <img src="/img/logobbpr4.png"
             alt="Logo Balai Bahasa Provinsi Riau"
             class="img-fluid header-logo">
    </div>
</div>

{{-- ================= PENCARIAN + FILTER + TAMBAH PUBLIKASI ================= --}}
<div class="d-flex justify-content-between align-items-center mb-4 gap-2">
  <div class="flex-grow-1">
    <div class="search-wrapper-inside">
        <i class="bi bi-search search-icon"></i>
        <form method="GET" action="{{ route('admin.publikasi') }}" class="flex-grow-1 m-0 p-0">
        <input
            type="text"
            name="search"
            placeholder="Cari publikasi..."
            id="searchField"
            class="search-input-inside"
            value="{{ request('search') }}"
        >
        </form>

      <button class="filter-btn-inside" id="filterToggle">
        <i class="bi bi-sliders"></i>
      </button>

      <div class="filter-dropdown" id="filterDropdown">
        <div class="filter-header">Kategori</div>
        <a href="{{ request('search') ? '?search='.request('search').'&kategori=alinea' : '?kategori=alinea' }}" class="filter-item">Alinea</a>
        <a href="{{ request('search') ? '?search='.request('search').'&kategori=berita' : '?kategori=berita' }}" class="filter-item">Berita</a>
        <a href="{{ request('search') ? '?search='.request('search').'&kategori=lensa' : '?kategori=lensa' }}" class="filter-item">Lensa</a>
        <a href="{{ request('search') ? '?search='.request('search').'&kategori=ragam' : '?kategori=ragam' }}" class="filter-item">Ragam</a>
        <a href="{{ request('search') ? '?search='.request('search').'&kategori=pengumuman' : '?kategori=pengumuman' }}" class="filter-item">Pengumuman</a>
      </div>
    </div>
  </div>

  <a href="{{ route('admin.publikasi.create') }}" class="btn btn-add-article d-flex align-items-center ms-2">
    <span class="icon-plus">+</span> Publikasi
  </a>
</div>


{{-- ================= DRAF ================= --}}
<h6 class="text-uppercase fw-semibold mb-3 text-white">Draf</h6>

@foreach($list->where('status','draf') as $item)
<div class="publication-card d-flex gap-4 mb-3"
     data-link="{{ route('admin.publikasi.show', $item->publikasi_id) }}"
     data-judul="{{ strtolower($item->judul) }}"
     data-penulis="{{ strtolower($item->penulis) }}"
     data-kategori="{{ strtolower($item->kategori) }}">

    @php
        if ($item->gambar) {
            $img = asset($item->gambar);
        } else {
            $img = asset('img/logobbpr4.png');
        }
    @endphp
    <img src="{{ $img }}" class="publication-thumb-lg">


    <div class="flex-grow-1">
        <div class="d-flex align-items-center gap-2 mb-2">
            <h5 class="fw-bold mb-0">{{ $item->judul }}</h5>
                @if($item->status === 'draf')
                    <span class="badge badge-draft">Draf</span>
                @else
                    <span class="badge badge-published">Terbit</span>
                @endif

        </div>

        <div class="d-flex flex-wrap gap-3 text-muted small mb-3">
            <span class="publication-category category-{{ $item->kategori }}">
                {{ ucfirst($item->kategori) }}
            </span>

            <span><i class="bi bi-calendar-event me-1"></i>
                {{ $item->tanggal ? Carbon::parse($item->tanggal)->translatedFormat('d F Y') : '-' }}
            </span>

            <span><i class="bi bi-person me-1"></i> {{ $item->penulis ?? 'Tanpa penulis' }}</span>

            <span><i class="bi bi-eye me-1"></i> {{ $item->pembaca ?? 0 }} Pembaca</span>
        </div>

        <p class="mb-0 text-muted">{{ \Illuminate\Support\Str::limit($item->isi, 150) }}</p>
    </div>

    <div class="publication-action">
        <a href="{{ route('admin.publikasi.edit', $item->publikasi_id) }}"
           class="btn btn-outline-secondary btn-sm"
           onclick="event.stopPropagation()">
            <i class="bi bi-pencil"></i>
        </a>
        <form action="{{ route('admin.publikasi.delete', $item->publikasi_id) }}"
            method="POST"
            class="d-inline"
            onsubmit="return confirmDelete('{{ $item->judul }}', this)">
            @csrf @method('DELETE')
            <button class="btn btn-outline-danger btn-sm"><i class="bi bi-trash"></i></button>
        </form>
    </div>
</div>
@endforeach

{{-- ================= TERBIT ================= --}}
<h6 class="text-uppercase fw-semibold text-white mb-3 mt-4">Terbit</h6>

@foreach($list->where('status','terbit') as $item)
<div class="publication-card d-flex gap-4 mb-3"
     data-link="{{ route('admin.publikasi.show', $item->publikasi_id) }}"
     data-judul="{{ strtolower($item->judul) }}"
     data-penulis="{{ strtolower($item->penulis) }}"
     data-kategori="{{ strtolower($item->kategori) }}">

    @php
        if ($item->gambar) {
            $img = asset($item->gambar);
        } else {
            $img = asset('img/logobbpr4.png');
        }
    @endphp
    <img src="{{ $img }}" class="publication-thumb-lg">


    <div class="flex-grow-1">
        <div class="d-flex align-items-center gap-2 mb-2">
            <h5 class="fw-bold mb-0">{{ $item->judul }}</h5>
                @if($item->status === 'draf')
                    <span class="badge badge-draft">Draf</span>
                @else
                    <span class="badge badge-published">Terbit</span>
                @endif
        </div>

        <div class="d-flex flex-wrap gap-3 text-muted small mb-3">
            <span class="publication-category category-{{ $item->kategori }}">
                {{ ucfirst($item->kategori) }}
            </span>

            <span><i class="bi bi-calendar-event me-1"></i>
                {{ $item->tanggal ? Carbon::parse($item->tanggal)->translatedFormat('d F Y') : '-' }}
            </span>

            <span><i class="bi bi-person me-1"></i> {{ $item->penulis ?? 'Tanpa penulis' }}</span>

            <span><i class="bi bi-eye me-1"></i> {{ $item->pembaca ?? 0 }} Pembaca</span>
        </div>

        <p class="mb-0 text-muted">{{ \Illuminate\Support\Str::limit($item->isi, 150) }}</p>
    </div>

    <div class="publication-action">
        <a href="{{ route('admin.publikasi.edit', $item->publikasi_id) }}"
           class="btn btn-outline-secondary btn-sm"
           onclick="event.stopPropagation()">
            <i class="bi bi-pencil"></i>
        </a>

        <form action="{{ route('admin.publikasi.delete', $item->publikasi_id) }}"
            method="POST"
            class="d-inline"
            onsubmit="return confirmDelete('{{ $item->judul }}', this)">
            @csrf @method('DELETE')
            <button class="btn btn-outline-danger btn-sm">
                <i class="bi bi-trash"></i>
            </button>
        </form>

    </div>
</div>
@endforeach

<script>
// Redirect saat card diklik (kecuali klik tombol, form, atau link aksi)
document.querySelectorAll('.publication-card').forEach(card => {
    card.addEventListener('click', function (e) {
        if (e.target.closest('button') || e.target.closest('form') || e.target.closest('a')) return;
        const url = this.dataset.link; if (url) window.location.href = url; }); });
</script>

{{-- NOTIFIKASI SLIDE-DOWN --}}
@if(session('success') || session('error'))
@php
    $msg = strtolower(session('success') ?? session('error'));
    $status = str_contains($msg, 'hapus') ? 'delete'
            : (str_contains($msg, 'draf') ? 'draf' : 'terbit');
@endphp
<div id="notif-top" class="notif-top notif-{{ $status }}">
    {{ session('success') ?? session('error') }}
</div>
@endif

{{-- MODAL KONFIRMASI DELETE (TETAP SEPERTI SEMULA, HANYA UKURAN LEBIH BESAR SESUAI REQUEST SEBELUMNYA TIDAK DIUBAH LAGI) --}}
<div id="deleteModal" class="delete-modal">
    <p id="deleteText"></p>
    <div class="d-flex justify-content-center gap-3 mt-4">
        <button id="btnYes" class="btn-yes">Ya</button>
        <button id="btnNo" class="btn-no">Tidak</button>
    </div>
</div>

<style>
/* MODAL (tidak diubah) */
.delete-modal {
    display: none;
    position: fixed;
    top: -150px;
    left: 50%;
    transform: translate(-50%, 0);
    background: #fef8eb;
    padding: 32px 36px;
    border-radius: 14px;
    width: 460px;
    text-align: center;
    font-size: 18px;
    font-weight: 600;
    z-index: 20000;
    opacity: 0;
    box-shadow: 0 6px 26px rgba(0,0,0,0.22);
    transition: 0.6s ease;
}
.delete-modal.show {
    top: 50%;
    opacity: 1;
    transform: translate(-50%, -50%);
}

/* Tombol (ukuran sama besar) */
.btn-yes, .btn-no {
    padding: 12px 28px;
    border-radius: 10px;
    font-weight: 600;
    font-size: 17px;
    min-width: 150px;
    height: 46px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
}

/* Tombol YA */
.btn-yes {
    background: #ffffff;
    border: 2px solid #d9534f;
    color: #d9534f;
}

/* Tombol TIDAK */
.btn-no {
    background: #0485c7;
    border: none;
    color: #ffffff;
}

/* TOAST NOTIFIKASI */
.notif-top {
    position: fixed;
    top: -80px;
    left: 50%;
    transform: translateX(-50%);
    padding: 18px 32px;
    border-radius: 10px;
    font-size: 17px;
    font-weight: 600;
    text-align: center;
    min-width: 330px;
    max-width: 90%;
    z-index: 10000;
    opacity: 1;
    box-shadow: 0 4px 14px rgba(0,0,0,0.15);
}

/* WARNA NOTIFIKASI SESUAI KONDISI */
.notif-terbit {
    background: #0dbf4e;
    color: #ffffff;
}
.notif-draf {
    background: #f9a703;
    color: #ffffff;
}
.notif-delete {
    background: #d9534f;
    color: #ffffff;
}

/* ANIMASI SLIDE DARI TENGAH ATAS */
@keyframes slideDownFromTop {
    0% { top: -80px; opacity: 0; }
    100% { top: 40px; opacity: 1; }
}

.notif-top.show {
    animation: slideDownFromTop 0.7s ease forwards;
}

/* AUTO CLOSE (fade out) */
.notif-top.fade-out {
    opacity: 0;
    transition: 0.5s;
}
</style>

<script>
let deleteFormTarget = null;

function confirmDelete(judul, formEl) {
    event.preventDefault();
    deleteFormTarget = formEl;

    document.getElementById("deleteText").innerHTML =
        "<span class='fw-light'>Apakah anda yakin ingin menghapus Publikasi </span><span class='fw-bold'>" + judul + "</span><span class='fw-light'>?</span>";

    let modal = document.getElementById("deleteModal");
    modal.style.display = "block";

    setTimeout(() => {
        modal.classList.add("show");
    }, 60);

    return false;
}

document.getElementById("btnYes").addEventListener("click", function() {
    if (deleteFormTarget) deleteFormTarget.submit();
});

document.getElementById("btnNo").addEventListener("click", function() {
    let modal = document.getElementById("deleteModal");
    modal.classList.remove("show");

    setTimeout(() => {
        modal.style.display = "none";
        deleteFormTarget = null;
    }, 600);
});

document.addEventListener("DOMContentLoaded", function () {
    let notif = document.getElementById("notif-top");
    if (notif) {
        notif.classList.add("show");

        // stay 5 detik, lalu fade out
        setTimeout(() => {
            notif.classList.add("fade-out");
        }, 2500);

        // remove element setelah 5 detik
        setTimeout(() => {
            notif.remove();
        }, 3000);
    }
});

document.getElementById("filterToggle").addEventListener("click", function() {
  const dropdown = document.getElementById("filterDropdown");
  dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
});

// opsional: klik di luar dropdown → tertutup
document.addEventListener("click", function(e) {
  const wrap = document.querySelector(".search-wrapper-inside");
  if (!wrap.contains(e.target)) {
    document.getElementById("filterDropdown").style.display = "none";
  }
});

</script>

<script>
document.addEventListener("DOMContentLoaded", function () {
  const input = document.getElementById("searchField");
  const cards = document.querySelectorAll(".publication-card");
  const filterButtons = document.querySelectorAll(".filter-item");

  filterButtons.forEach(btn => {
    btn.addEventListener("click", (e) => {
      e.stopPropagation();
      btn.classList.toggle("active");
      runFilter();
    });
  });

  input.addEventListener("input", runFilter);

  function runFilter() {
    const q = input.value.toLowerCase().trim();
    const activeCat = Array.from(filterButtons)
        .filter(b => b.classList.contains("active"))
        .map(b => b.dataset.value.toLowerCase());

    cards.forEach(card => {
      const judul = card.dataset.judul || "";
      const penulis = card.dataset.penulis || "";
      const kategori = card.dataset.kategori || "";

      const matchText = judul.includes(q) || penulis.includes(q);
      const matchCat = activeCat.length === 0 || activeCat.includes(kategori);

      card.style.display = (matchText && matchCat) ? "" : "none";
    });
  }
});
</script>

@endsection
