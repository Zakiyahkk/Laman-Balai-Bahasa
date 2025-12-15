<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>

<div class="d-flex min-vh-100">
    <aside class="sidebar d-flex flex-column">
        
      <div class="sidebar-header p-3 text-center">
            <img src="/img/logo.png" alt="Logo Balai Bahasa Provinsi Riau" 
            class="img-fluid header-logo-full">
        </div>
       <div class="admin-profile p-3 mb-4">
    <div class="d-flex align-items-center">
        <img src="/img/AkunLogo.jpg" alt="Foto Profil Admin" class="avatar-circle me-3"> 
        <div>
            <div class="fw-bold">Admin</div>
            <div class="small">admin@balaibahasa.go.id</div>
        </div>
    </div>
</div>

        <ul class="nav flex-column menu-list flex-grow-1">
            <li class="nav-item">
                <a class="nav-link active" href="/admin/dashboard">
                    <i class="bi bi-grid-fill me-2"></i>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-file-earmark-text-fill me-2"></i>
                    Artikel & Berita
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-calendar-check-fill me-2"></i>
                    Kegiatan
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-book-fill me-2"></i>
                    Publikasi
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-person-badge-fill me-2"></i>
                    Pendaftaran
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-images me-2"></i>
                    Galeri
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-globe me-2"></i>
                    Halaman Web
                </a>
            </li>
        </ul>

        <div class="p-3 mt-auto">
            <hr class="sidebar-hr">
            <a href="/logout" class="nav-link logout-link">
                <i class="bi bi-box-arrow-right me-2"></i>
                Logout
            </a>
        </div>
        
    </aside>

    <main class="flex-fill p-4 bg-light">
        @yield('content')
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>