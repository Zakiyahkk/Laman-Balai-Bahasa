<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>

<div class="d-flex min-vh-100">
    <aside class="sidebar d-flex flex-column">
       <div class="admin-profile px-2 py-1">
        <div class="d-flex align-items-center">
            <img src="/img/AkunLogo.jpg" alt="Foto Profil Admin" class="avatar-circle me-1">
            <div>
                <div class="fw-bold fs-6">Username</div>
                <div class="small">Role</div>
            </div>
        </div>
</div>
        <hr class="sidebar-hr">
        <ul class="nav flex-column menu-list flex-grow-1">

    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
           href="{{ route('admin.dashboard') }}">
            <i class="bi bi-speedometer2 me-2"></i>
            Dashboard
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.artikel*') ? 'active' : '' }}"
           href="{{ route('admin.artikel') }}">
            <i class="bi bi-newspaper me-2"></i>
            Artikel & Berita
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.kegiatan*') ? 'active' : '' }}"
           href="{{ route('admin.kegiatan') }}">
            <i class="bi bi-calendar-event me-2"></i>
            Kegiatan
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.publikasi*') ? 'active' : '' }}"
           href="{{ route('admin.publikasi') }}">
            <i class="bi bi-journal-text me-2"></i>
            Publikasi
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.pendaftaran') ? 'active' : '' }}"
           href="{{ route('admin.pendaftaran') }}">
            <i class="bi bi-clipboard-check me-2"></i>
            Pendaftaran
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.galeri*') ? 'active' : '' }}"
           href="{{ route('admin.galeri') }}">
            <i class="bi bi-images me-2"></i>
            Galeri
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.halamanweb') ? 'active' : '' }}"
           href="{{ route('admin.halamanweb') }}">
            <i class="bi bi-globe me-2"></i>
            Halaman Web
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.pengaturan') ? 'active' : '' }}"
           href="{{ route('admin.pengaturan') }}">
            <i class="bi bi-gear me-2"></i>
            Pengaturan
        </a>
    </li>

    <a href="/logout" class="nav-link logout-link">
                <i class="bi bi-box-arrow-right me-2"></i>
                Logout
    </a>
</ul>

    </aside>

    <main class="flex-fill p-4 bg-content">
        @yield('content')
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
