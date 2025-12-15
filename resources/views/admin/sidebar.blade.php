<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ route('admin.dashboard') }}">
                    Dashboard
                </a>
            </li>
            
            <h6 class="sidebar-heading px-3 mt-4 mb-1 text-muted">
                <span>Manajemen Konten</span>
            </h6>
            
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.posts.index') }}">
                    Berita & Artikel
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.publications.index') }}">
                    Publikasi (Buku/Jurnal)
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.events.index') }}">
                    Data Lomba/Acara
                </a>
            </li>
        </ul>
        
        <h6 class="sidebar-heading px-3 mt-4 mb-1 text-muted">
            <span>Sistem & Data</span>
        </h6>
        
        <ul class="nav flex-column mb-2">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.users.index') }}">
                    Manajemen Pengguna
                </a>
            </li>
        </ul>
    </div>
</nav>