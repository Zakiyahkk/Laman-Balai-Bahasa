<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin | Artikel & Berita</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    <style>
        /* Mengurangi margin pada tabel di mobile */
        .table-responsive .table {
            white-space: nowrap; 
        }
        /* Gaya tambahan untuk badge kategori */
        .badge {
            padding: 0.5em 0.8em;
            font-weight: 500;
        }
        /* Menghilangkan border dan shadow saat fokus pada input/button Bootstrap */
        .form-control:focus, .btn:focus {
            box-shadow: none !important;
            border-color: initial !important; 
        }
    </style>
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
                <a class="nav-link" href="/admin/dashboard">
                    <i class="bi bi-grid-fill me-2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="/admin/artikel-berita"> 
                    <i class="bi bi-file-earmark-text-fill me-2"></i> Artikel & Berita
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/admin/kegiatan">
                    <i class="bi bi-calendar-check-fill me-2"></i> Kegiatan
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/admin/publikasi">
                    <i class="bi bi-book-fill me-2"></i> Publikasi
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/admin/pendaftaran">
                    <i class="bi bi-person-badge-fill me-2"></i> Pendaftaran
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/admin/galeri">
                    <i class="bi bi-images me-2"></i> Galeri
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/admin/halaman-web">
                    <i class="bi bi-globe me-2"></i> Halaman Web
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/admin/pengaturan"> 
                    <i class="bi bi-gear-fill me-2"></i> Pengaturan
                </a>
            </li>
        </ul>

        <div class="p-3 mt-auto">
            <hr class="sidebar-hr">
            <a href="/logout" class="nav-link logout-link">
                <i class="bi bi-box-arrow-right me-2"></i> Logout
            </a>
        </div>
        
    </aside>
    <main class="flex-fill p-4 bg-light">
        <div class="container-fluid">
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold">Artikel & Berita</h2>
                    <p class="text-muted">Kelola semua artikel dan berita</p>
                </div>
                <button class="btn btn-success btn-lg d-flex align-items-center">
                    <i class="bi bi-plus me-2" style="font-size: 1.5rem;"></i> Tambah Artikel
                </button>
            </div>

            <div class="row mb-4">
                <div class="col-md-6 col-lg-4">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0"><i class="bi bi-search"></i></span>
                        <input type="text" class="form-control border-start-0" placeholder="Cari artikel..." aria-label="Cari artikel">
                        
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="border-top-left-radius: 0; border-bottom-left-radius: 0; border-left: 0;">
                                <i class="bi bi-funnel"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <h6 class="dropdown-header">Semua Kategori</h6>
                                <li><a class="dropdown-item active" href="#">Semua Kategori</a></li>
                                <li><a class="dropdown-item" href="#">Bahasa</a></li>
                                <li><a class="dropdown-item" href="#">Sastra</a></li>
                                <li><a class="dropdown-item" href="#">Kegiatan</a></li>
                                <li><a class="dropdown-item" href="#">Pelatihan</a></li>
                                <li><a class="dropdown-item" href="#">Panduan</a></li>
                            </ul>
                        </div>
                        </div>
                </div>
            </div>
            
            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead>
                                <tr class="text-muted small">
                                    <th scope="col" class="border-top-0 ps-4">JUDUL</th>
                                    <th scope="col" class="border-top-0">KATEGORI</th>
                                    <th scope="col" class="border-top-0">PENULIS</th>
                                    <th scope="col" class="border-top-0">TANGGAL</th>
                                    <th scope="col" class="border-top-0">STATUS</th>
                                    <th scope="col" class="border-top-0 text-end pe-4">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="ps-4">
                                        <a href="#" class="text-dark fw-bold text-decoration-none">Pelestarian Bahasa Melayu Riau di Era Digital</a>
                                    </td>
                                    <td><span class="badge rounded-pill text-bg-info">Bahasa</span></td>
                                    <td>Dr. Ahmad Syahid</td>
                                    <td>12 Des 2024</td>
                                    <td><span class="badge rounded-pill text-bg-success">Published</span></td>
                                    <td class="text-end pe-4">
                                        <a href="#" class="text-muted me-2"><i class="bi bi-eye"></i></a>
                                        <a href="#" class="text-primary"><i class="bi bi-pencil"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ps-4">
                                        <a href="#" class="text-dark fw-bold text-decoration-none">Workshop Penulisan Kreatif untuk Pelajar</a>
                                    </td>
                                    <td><span class="badge rounded-pill text-bg-warning text-dark">Kegiatan</span></td>
                                    <td>Sri Wahyuni, M.Pd</td>
                                    <td>10 Des 2024</td>
                                    <td><span class="badge rounded-pill text-bg-success">Published</span></td>
                                    <td class="text-end pe-4">
                                        <a href="#" class="text-muted me-2"><i class="bi bi-eye"></i></a>
                                        <a href="#" class="text-primary"><i class="bi bi-pencil"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        </main>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>