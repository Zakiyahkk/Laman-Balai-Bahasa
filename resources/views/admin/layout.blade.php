<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Laman BBPR</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>

@php
    $profilOpen = request()->routeIs('admin.profil.*');
    $akuntabilitasOpen = request()->routeIs('admin.akuntabilitas.*');
@endphp

<div class="d-flex min-vh-100">
    <aside class="sidebar d-flex flex-column">

        <!-- PROFIL ADMIN -->
        <div class="admin-profile px-2 py-1">
            <div class="d-flex align-items-center">
                <img src="/img/AkunLogo.png" alt="Foto Profil Admin" class="avatar-circle me-1">
                <div class="admin-info">
                    <div class="fw-bold fs-6">{{ session('admin_username', '-') }}</div>
                    <div class="small text-muted">{{ session('admin_role', '-') }}</div>
                </div>
            </div>
        </div>

        <hr class="sidebar-hr">

        <ul class="nav flex-column menu-list flex-grow-1">

            <!-- DASHBOARD -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                   href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-speedometer2 me-2"></i>Dashboard
                </a>
            </li>

            <!-- PUBLIKASI -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.publikasi*') ? 'active' : '' }}"
                   href="{{ route('admin.publikasi') }}">
                    <i class="bi bi-journal-text me-2"></i>Publikasi
                </a>
            </li>

            <!-- GALERI -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.galeri*') ? 'active' : '' }}"
                   href="{{ route('admin.galeri') }}">
                    <i class="bi bi-images me-2"></i>Galeri
                </a>
            </li>

            <!-- PROFIL LAMAN -->
            <li class="nav-item">
                <a class="nav-link d-flex justify-content-between align-items-center"
                   href="#"
                   onclick="toggleSubMenu(this)">
                    <div>
                        <i class="bi bi-building-gear me-2"></i>Profil Laman
                    </div>
                    <i class="bi submenu-arrow {{ $profilOpen ? 'bi-caret-down-fill' : 'bi-caret-right-fill' }}"></i>
                </a>

                <ul id="SubMenu"
                    class="nav flex-column ms-3"
                    @if($profilOpen) style="display:block" @else style="display:none" @endif>

                    <li>
                        <a class="nav-link" href="#">
                            <i class="bi bi-clock-history me-2"></i>Sejarah Singkat
                        </a>
                    </li>

                    <li>
                        <a class="nav-link {{ request()->routeIs('admin.profil.visimisi*') ? 'active' : '' }}"
                           href="{{ route('admin.profil.visimisi') }}">
                            <i class="bi bi-bullseye me-2"></i>Visi & Misi
                        </a>
                    </li>

                    <li>
                        <a class="nav-link {{ request()->routeIs('admin.profil.tugasfungsi*') ? 'active' : '' }}"
                           href="{{ route('admin.profil.tugasfungsi') }}">
                            <i class="bi bi-list-task me-2"></i>Tugas & Fungsi
                        </a>
                    </li>

                    <li><a class="nav-link" href="#"><i class="bi bi-diagram-3 me-2"></i>Struktur Organisasi</a></li>
                    <li><a class="nav-link" href="#"><i class="bi bi-people me-2"></i>Pegawai</a></li>
                    <li><a class="nav-link" href="#"><i class="bi bi-image me-2"></i>Logo</a></li>
                </ul>
            </li>

            <!-- AKUNTABILITAS -->
            <li class="nav-item">
                <a class="nav-link d-flex justify-content-between align-items-center"
                   href="#"
                   onclick="toggleSubMenu(this)">
                    <div>
                        <i class="bi bi-clipboard-check me-2"></i>Akuntabilitas
                    </div>
                    <i class="bi submenu-arrow {{ $akuntabilitasOpen ? 'bi-caret-down-fill' : 'bi-caret-right-fill' }}"></i>
                </a>

                <ul id="SubMenu"
                    class="nav flex-column ms-3"
                    @if($akuntabilitasOpen) style="display:block" @else style="display:none" @endif>
                    <li><a class="nav-link" href="#">Sub Menu 1</a></li>
                    <li><a class="nav-link" href="#">Sub Menu 2</a></li>
                    <li><a class="nav-link" href="#">Sub Menu 3</a></li>
                    <li><a class="nav-link" href="#">Sub Menu 4</a></li>
                    <li><a class="nav-link" href="#">Sub Menu 5</a></li>
                </ul>
            </li>

            <!-- PENGATURAN -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.pengaturan') ? 'active' : '' }}"
                   href="{{ route('admin.pengaturan') }}">
                    <i class="bi bi-gear me-2"></i>Pengaturan
                </a>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link logout-link"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-right me-2"></i>
                    Keluar
                </a>

                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>

        </ul>
    </aside>

    <main class="flex-fill p-4 bg-content">
        @yield('content')
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
function toggleSubMenu(el) {
    const arrow = el.querySelector('.submenu-arrow');
    const submenu = el.nextElementSibling;

    if (!submenu || !arrow) return;

    const isOpen = submenu.style.display === "block";
    submenu.style.display = isOpen ? "none" : "block";

    arrow.classList.toggle("bi-caret-down-fill", !isOpen);
    arrow.classList.toggle("bi-caret-right-fill", isOpen);
}
</script>

</body>
</html>
