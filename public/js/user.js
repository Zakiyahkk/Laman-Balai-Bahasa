document.addEventListener("DOMContentLoaded", function () {
    /* ==================================================
       NAVBAR & MOBILE MENU
    ================================================== */
    const menuToggle = document.getElementById("menuToggle");
    const navMenu = document.getElementById("navMenu");
    const dropdownLinks = document.querySelectorAll(".dropdown > a");

    if (menuToggle && navMenu) {
        menuToggle.addEventListener("click", function () {
            navMenu.classList.toggle("show");
        });
    }

    /* Dropdown klik khusus mobile */
    dropdownLinks.forEach((link) => {
        link.addEventListener("click", function (e) {
            if (window.innerWidth <= 768) {
                e.preventDefault();
                this.parentElement.classList.toggle("open");
            }
        });
    });

    /* ==================================================
       HERO SLIDER
    ================================================== */
    const slides = document.querySelectorAll(".hero-slider .slide");
    let slideIndex = 0;

    if (slides.length) {
        setInterval(() => {
            slides[slideIndex].classList.remove("active");
            slideIndex = (slideIndex + 1) % slides.length;
            slides[slideIndex].classList.add("active");
        }, 4000);
    }

    /* ==================================================
       TOKOH FILTER + MODAL
    ================================================== */
    const filterButtons = document.querySelectorAll(".filter-btn");
    const cards = document.querySelectorAll(".tokoh-card");

    filterButtons.forEach((btn) => {
        btn.addEventListener("click", function () {
            filterButtons.forEach((b) => b.classList.remove("active"));
            this.classList.add("active");

            const filter = this.dataset.filter;

            cards.forEach((card) => {
                card.style.display =
                    filter === "all" || card.classList.contains(filter)
                        ? "block"
                        : "none";
            });
        });
    });

    const modal = document.getElementById("tokohModal");
    const modalFoto = document.getElementById("modalFoto");
    const modalNama = document.getElementById("modalNama");
    const modalDeskripsi = document.getElementById("modalDeskripsi");
    const modalClose = document.querySelector(".tokoh-modal-close");

    if (modal) {
        document.querySelectorAll(".tokoh-card").forEach((card) => {
            card.addEventListener("click", function () {
                modalFoto.src = this.dataset.foto;
                modalNama.textContent = this.dataset.nama;
                modalDeskripsi.textContent = this.dataset.deskripsi;
                modal.classList.add("show");
            });
        });

        modalClose.onclick = () => modal.classList.remove("show");

        modal.onclick = (e) => {
            if (e.target === modal) modal.classList.remove("show");
        };
    }

    /* ==================================================
       FASILITAS SLIDER + INDICATOR
    ================================================== */
    const slider = document.getElementById("fasilitasSlider");
    const prev = document.getElementById("fasilitasPrev");
    const next = document.getElementById("fasilitasNext");
    const indicator = document.getElementById("fasilitasIndicator");

    if (slider) {
        const cards = slider.querySelectorAll(".fasilitas-card");
        const scrollAmount = slider.offsetWidth;

        if (prev && next) {
            prev.addEventListener("click", () => {
                slider.scrollBy({ left: -scrollAmount, behavior: "smooth" });
            });

            next.addEventListener("click", () => {
                slider.scrollBy({ left: scrollAmount, behavior: "smooth" });
            });
        }

        if (indicator) {
            cards.forEach((_, i) => {
                const dot = document.createElement("span");
                if (i === 0) dot.classList.add("active");
                indicator.appendChild(dot);
            });

            const dots = indicator.querySelectorAll("span");

            slider.addEventListener("scroll", () => {
                const index = Math.round(
                    slider.scrollLeft / slider.clientWidth
                );

                dots.forEach((dot) => dot.classList.remove("active"));
                if (dots[index]) dots[index].classList.add("active");
            });
        }
    }
});
/* ==================================================
       Navbar & Sidebar Fix User
    ================================================== */
document.addEventListener("DOMContentLoaded", () => {
    const navbar = document.querySelector(".bbp-navbar");
    const toggle = document.getElementById("menuToggle");
    const overlay = document.getElementById("bbpOverlay");

    toggle.addEventListener("click", () => {
        navbar.classList.toggle("open");
    });

    overlay.addEventListener("click", () => {
        closeSidebar();
    });

    document
        .querySelectorAll(".has-dropdown > .dropdown-toggle")
        .forEach((trigger) => {
            trigger.addEventListener("click", (e) => {
                if (window.innerWidth <= 768) {
                    e.preventDefault();

                    const parent = trigger.closest(".has-dropdown");
                    document
                        .querySelectorAll(".has-dropdown")
                        .forEach(
                            (item) =>
                                item !== parent && item.classList.remove("open")
                        );

                    parent.classList.toggle("open");
                }
            });
        });

    document.querySelectorAll(".dropdown a").forEach((link) => {
        link.addEventListener("click", (e) => {
            e.stopPropagation();
            closeSidebar();
        });
    });

    document
        .querySelectorAll(".nav-menu > li > a:not(.dropdown-toggle)")
        .forEach((link) => {
            link.addEventListener("click", (e) => {
                e.stopPropagation();
                closeSidebar();
            });
        });

    function closeSidebar() {
        navbar.classList.remove("open");
        document
            .querySelectorAll(".has-dropdown")
            .forEach((item) => item.classList.remove("open"));
    }
});

/* ==================================================
    KATA PENGANTAR REVEAL ANIMATION
    ================================================== */
document.addEventListener("DOMContentLoaded", () => {
    const reveals = document.querySelectorAll(".kr-reveal");

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("show");
                }
            });
        },
        {
            threshold: 0.2,
        }
    );
    reveals.forEach((el) => observer.observe(el));
});

// ================================
// Slider Artikel Terbaru (bb33)
// ================================
(function () {
    function initArtikelSlider() {
        const track = document.getElementById("bb33ArtikelTrack");
        const prev = document.getElementById("bb33ArtikelPrev");
        const next = document.getElementById("bb33ArtikelNext");
        const dots = document.getElementById("bb33ArtikelDots");

        // kalau section tidak ada di halaman ini, stop
        if (!track || !prev || !next || !dots) return;

        const slides = Array.from(track.querySelectorAll(".bb33-slide"));
        if (slides.length === 0) return;

        let index = 0;

        function perView() {
            const w = window.innerWidth;
            if (w < 640) return 1;
            if (w < 992) return 2;
            return 3;
        }

        function maxIndex() {
            return Math.max(0, slides.length - perView());
        }

        function getGap() {
            const style = getComputedStyle(track);
            const gap = parseFloat(style.gap || style.columnGap || 0);
            return Number.isFinite(gap) ? gap : 0;
        }

        function step() {
            const w = slides[0].getBoundingClientRect().width;
            return w + getGap();
        }

        function renderDots() {
            const pages = maxIndex() + 1;
            dots.innerHTML = "";

            for (let i = 0; i < pages; i++) {
                const b = document.createElement("button");
                b.type = "button";
                b.className = "bb33-dot" + (i === index ? " active" : "");
                b.setAttribute("aria-label", "Slide " + (i + 1));
                b.addEventListener("click", () => go(i));
                dots.appendChild(b);
            }
        }

        function go(i) {
            index = Math.max(0, Math.min(i, maxIndex()));
            track.scrollTo({ left: index * step(), behavior: "smooth" });
            renderDots();
        }

        prev.addEventListener("click", () => go(index - 1));
        next.addEventListener("click", () => go(index + 1));

        // update index saat user swipe/drag
        track.addEventListener(
            "scroll",
            () => {
                const i = Math.round(track.scrollLeft / step());
                const clamped = Math.max(0, Math.min(i, maxIndex()));
                if (clamped !== index) {
                    index = clamped;
                    renderDots();
                }
            },
            { passive: true }
        );

        window.addEventListener("resize", () => {
            // snap ulang biar pas setelah breakpoint berubah
            go(index);
        });

        // init
        renderDots();
        go(0);
    }

    // Pastikan jalan setelah DOM siap
    if (document.readyState === "loading") {
        document.addEventListener("DOMContentLoaded", initArtikelSlider);
    } else {
        initArtikelSlider();
    }
})();

document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".profil-hero[data-bg]").forEach((el) => {
        const bg = el.getAttribute("data-bg");
        if (!bg) return;

        // set CSS variable yang dipakai di profil.css
        el.style.setProperty("--hero-bg", `url("${bg}")`);
    });
});


// ================================
// Navbar mobile dan desktop
// ================================
function toggleMenu() {
    const navbar = document.getElementById('navbar');
    navbar.classList.toggle('mobile-open');
}
function toggleSub(element) {
    // Cek apakah sedang di mode mobile (layar < 1200px)
    if (window.innerWidth <= 1200) {
        // Toggle class open-sub pada parent <li>
        const parentLi = element.parentElement;
        parentLi.classList.toggle('open-sub');
    }
}

// ================================
// Footer
// ================================
        document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('visitorChart').getContext('2d');

        const gradient = ctx.createLinearGradient(0, 0, 0, 160);
        gradient.addColorStop(0, '#facc15');
        gradient.addColorStop(1, 'rgba(250, 204, 21, 0.05)');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min', 'Sen', 'Sel', 'Rab'],
                datasets: [{
                    label: 'Pengunjung',
                    data: [45, 52, 38, 65, 48, 23, 15, 50, 60, 42],
                    backgroundColor: gradient,
                    // Pastikan warna hover adalah putih solid agar efek "menyala" terlihat jelas
                    hoverBackgroundColor: '#ffffff',
                    // Menambah pendaran cahaya (glow) saat kursor menyentuh batang
                    hoverBorderColor: '#ffffff',
                    hoverBorderWidth: 2,
                    borderRadius: 5,
                    borderSkipped: false,
                    barPercentage: 0.7,
                    categoryPercentage: 0.6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                // PENTING: Pengaturan agar hover lebih sensitif
                interaction: {
                    mode: 'index',
                    intersect: false, // Membuat batang menyala meski kursor tidak tepat di tengah batang
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        enabled: true,
                        backgroundColor: '#0f172a',
                        titleFont: {
                            family: 'Montserrat',
                            size: 11,
                            weight: 'bold'
                        },
                        bodyFont: {
                            family: 'Montserrat',
                            size: 11
                        },
                        padding: 10,
                        cornerRadius: 8,
                        displayColors: false,
                        // Tambahkan callback agar informasi muncul lebih rapi
                        callbacks: {
                            label: function(context) {
                                return ' ' + context.parsed.y + ' Pengunjung';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        display: true,
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(255, 255, 255, 0.05)',
                            drawBorder: false
                        },
                        ticks: {
                            color: '#64748b',
                            font: {
                                size: 9,
                                family: 'Montserrat'
                            },
                            padding: 10
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#94a3b8',
                            font: {
                                size: 10,
                                family: 'Montserrat',
                                weight: '600'
                            },
                            padding: 5
                        }
                    }
                },
                // Tambahkan animasi hover agar transisinya halus
                animation: {
                    duration: 1000,
                    easing: 'easeOutQuart'
                }
            }
        });
    });

    document.addEventListener("DOMContentLoaded", function() {
        const ctx = document.getElementById('monthlyVisitorChart').getContext('2d');
        
        const monthlyVisitorChart = new Chart(ctx, {
            type: 'bar', // Tipe Chart Batang
            data: {
                // Label Bulan (Bisa disesuaikan dengan data real)
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
                datasets: [{
                    label: 'Pengunjung',
                    data: [1200, 1900, 3000, 5000, 2300, 3200], // Data Dummy
                    backgroundColor: '#3b82f6', // Warna Batang (Biru)
                    borderRadius: 4, // Sudut batang membulat
                    barThickness: 15, // Ketebalan batang
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false // Sembunyikan legenda agar bersih
                    },
                    tooltip: {
                        enabled: true,
                        backgroundColor: 'rgba(0,0,0,0.8)',
                        titleColor: '#fff',
                        bodyColor: '#fff'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(255, 255, 255, 0.1)', // Garis grid transparan
                            drawBorder: false
                        },
                        ticks: {
                            color: '#94a3b8', // Warna angka sumbu Y
                            font: { size: 10 }
                        }
                    },
                    x: {
                        grid: {
                            display: false // Hilangkan grid vertikal
                        },
                        ticks: {
                            color: '#94a3b8', // Warna bulan sumbu X
                            font: { size: 10 }
                        }
                    }
                }
            }
        });
    });


// ================================
// Popup Pantun & Slider Text
// ================================
 document.addEventListener('DOMContentLoaded', function() {
    
    // --- 1. LOGIKA POPUP PANTUN ---
    const popup = document.getElementById('welcomePopup');

    // Munculkan popup setelah loading selesai (delay 0.5 detik biar smooth)
    setTimeout(() => {
        popup.classList.add('show');
    }, 500);

    // Fungsi Tutup Popup
    window.closeWelcomePopup = function() {
        popup.classList.remove('show');
    }

    // Tutup kalau klik area gelap (background)
    popup.addEventListener('click', function(e) {
        if (e.target === this) {
            closeWelcomePopup();
        }
    });


    // --- 2. LOGIKA SLIDER TEXT (Tetap jalan di belakang) ---
    const seqBrand = document.getElementById('seq-brand');
    const seqService = document.getElementById('seq-service');

    // Typed.js
    const typed = new Typed('#typing-element', {
        strings: ['Ligat.', 'Giat.', 'Loyal.', 'Inovatif.', 'Akuntabel.'],
        typeSpeed: 60, backSpeed: 40, backDelay: 1500, loop: true, showCursor: true, cursorChar: '|'
    });

    // Looping Slider
    const showTime = 5000; 
    const serviceTime = 6000; 

    function switchState(state) {
        if (state === 'brand') {
            seqService.classList.remove('active');
            setTimeout(() => { seqBrand.classList.add('active'); }, 500); 
        } else if (state === 'service') {
            seqBrand.classList.remove('active');
            setTimeout(() => { seqService.classList.add('active'); }, 500);
        }
    }

    // Jalankan Loop Slider
    setTimeout(() => { switchState('service'); }, showTime);
    
    setInterval(() => {
        switchState('brand');
        setTimeout(() => { switchState('service'); }, showTime);
    }, showTime + serviceTime);

});

// ================================
// Pengumuman
// ================================
 document.addEventListener('DOMContentLoaded', function() {

            // Ambil Elemen Modal & Viewer
            const modal = document.getElementById('docModal');
            const pdfViewer = document.getElementById('pdfViewer');
            const imageViewer = document.getElementById('imageViewer');
            const fallbackMsg = document.getElementById('fallbackMessage');

            // Ambil Tombol Aksi di Modal
            const downloadBtn = document.getElementById('downloadBtn');
            const fallbackLink = document.getElementById('fallbackLink');

            // Ambil semua item pengumuman
            const triggers = document.querySelectorAll('.trigger-modal');

            // LOOP SETIAP ITEM PENGUMUMAN
            triggers.forEach(trigger => {
                trigger.addEventListener('click', function() {

                    // 1. Ambil Data dari HTML Atribut
                    const docUrl = this.getAttribute('data-doc');
                    const docType = this.getAttribute('data-type'); // 'pdf' atau 'image'

                    // 2. Reset Semua Tampilan Viewer (Sembunyikan dulu)
                    pdfViewer.style.display = 'none';
                    imageViewer.style.display = 'none';
                    fallbackMsg.style.display = 'none';

                    // 3. Set Link Download
                    downloadBtn.href = docUrl;
                    fallbackLink.href = docUrl;

                    // 4. Cek Tipe File dan Tampilkan Viewer yang sesuai
                    if (docType === 'pdf') {
                        pdfViewer.src = docUrl;
                        pdfViewer.style.display = 'block';
                    } else if (docType === 'image') {
                        imageViewer.src = docUrl;
                        imageViewer.style.display = 'block';
                    } else {
                        // Jika tipe lain (misal docx) atau error
                        fallbackMsg.style.display = 'block';
                    }

                    // 5. Munculkan Modal
                    modal.classList.add('active');
                });
            });

            // FUNGSI TUTUP MODAL
            window.closeDocModal = function() {
                modal.classList.remove('active');

                // Bersihkan src setelah animasi selesai agar hemat memori
                setTimeout(() => {
                    pdfViewer.src = "";
                    imageViewer.src = "";
                }, 400);
            }

            // Tutup Modal jika klik di background gelap
            modal.addEventListener('click', function(e) {
                if (e.target === this) {
                    closeDocModal();
                }
            });
        });

// ================================
// Fasilitas
// ================================
 document.addEventListener('DOMContentLoaded', function() {
            const track = document.getElementById('track');
            const nextBtn = document.getElementById('nextBtn');
            const prevBtn = document.getElementById('prevBtn');
            const cards = document.querySelectorAll('.fasilitas-card');

            let currentIndex = 0;
            const totalCards = cards.length;
            const gap = 25; // Sesuai CSS gap: 25px

            // Fungsi untuk mendapatkan jumlah kartu yang tampil di layar
            function getVisibleCards() {
                if (window.innerWidth >= 1024) return 3; // Desktop
                if (window.innerWidth >= 640) return 2; // Tablet
                return 1; // Mobile
            }

            // Fungsi update posisi slider
            function updateSlider() {
                const visibleCards = getVisibleCards();
                const cardWidth = cards[0].offsetWidth;
                const moveAmount = (cardWidth + gap) * currentIndex;

                track.style.transform = `translateX(-${moveAmount}px)`;

                // Atur state tombol (opsional, bisa dibuat loop)
                // prevBtn.disabled = currentIndex === 0;
                // nextBtn.disabled = currentIndex >= totalCards - visibleCards;
            }

            // Klik Next
            nextBtn.addEventListener('click', () => {
                const visibleCards = getVisibleCards();
                if (currentIndex < totalCards - visibleCards) {
                    currentIndex++;
                } else {
                    currentIndex = 0; // Loop balik ke awal
                }
                updateSlider();
            });

            // Klik Prev
            prevBtn.addEventListener('click', () => {
                const visibleCards = getVisibleCards();
                if (currentIndex > 0) {
                    currentIndex--;
                } else {
                    currentIndex = totalCards - visibleCards; // Loop ke akhir
                }
                updateSlider();
            });

            // Update saat layar di-resize agar posisi tetap akurat
            window.addEventListener('resize', updateSlider);
        });

// ================================
// Yel-Yel Slider & Podcast
// ================================
        const contentData = [{
            type: 'Yel-Yel',
            title: 'Yel-Yel Balai Bahasa Riau',
            videoId: 'Is1PyvA0MAU',
            desc: `<p>Penampilan penuh semangat dari seluruh pegawai Balai Bahasa Provinsi Riau. Membawa pesan perubahan menuju Zona Integritas Wilayah Bebas dari Korupsi (ZI-WBK).</p>`
        },
        {
            type: 'Podcast',
            title: 'RESAMBASRA: Diskusi Sastra & Bahasa',
            videoId: 'PhnYJL-LSx8',
            desc: `<p>Saksikan episode terbaru dari <span class="yelyel-highlight">RESAMBASRA</span>. Membahas isu-isu terkini mengenai perkembangan bahasa Indonesia dan sastra daerah di Riau.</p>`
        },
        {
            type: 'Dokumentasi',
            title: 'Kegiatan Balai Bahasa Riau',
            videoId: '5TAGi3OeScY',
            desc: `<p>Cuplikan kegiatan penting yang diselenggarakan oleh Balai Bahasa Provinsi Riau. Upaya nyata dalam pelindungan dan pemasyarakatan bahasa di tengah masyarakat.</p>`
        }
    ];

    let currentIndex = 0;

    const textContainer = document.getElementById('textContent');
    const badgeEl = document.getElementById('badgeText');
    const titleEl = document.getElementById('titleText');
    const descEl = document.getElementById('descText');

    const videoContainer = document.getElementById('videoContainer');
    const videoThumbnail = document.getElementById('videoThumbnail');
    const iframeEl = document.getElementById('videoFrame');

    function loadContent(index) {
        const data = contentData[index];

        // 1. Reset State Player (Kembali ke Thumbnail)
        videoContainer.classList.remove('is-playing');

        // Kosongkan src iframe dulu biar stop video lama
        iframeEl.removeAttribute('src');

        // 2. Load Thumbnail Baru
        videoThumbnail.src = `https://img.youtube.com/vi/${data.videoId}/maxresdefault.jpg`;

        // 3. Update Teks
        textContainer.classList.add('fading');
        setTimeout(() => {
            badgeEl.textContent = data.type;
            titleEl.textContent = data.title;
            descEl.innerHTML = data.desc;

            if (data.type === 'Podcast') badgeEl.classList.add('podcast');
            else badgeEl.classList.remove('podcast');

            textContainer.classList.remove('fading');
        }, 400);
    }

    function playCurrentVideo() {
        const data = contentData[currentIndex];

        videoContainer.classList.add('is-playing');

        iframeEl.src =
            `https://www.youtube.com/embed/${data.videoId}?autoplay=1&mute=1&playsinline=1&rel=0`;
    }


    function changeVideo(direction) {
        currentIndex += direction;
        if (currentIndex >= contentData.length) currentIndex = 0;
        if (currentIndex < 0) currentIndex = contentData.length - 1;
        loadContent(currentIndex);
    }

    document.addEventListener('DOMContentLoaded', () => {
        loadContent(0);
    });

    
// ================================
// Piagam di halaman Dokumenprestasi
// ================================
     const modal = document.getElementById('piagamModal');
        const modalImg = document.getElementById('modalImg');

        function openModal(element) {
            // Ambil src gambar dari kartu yang diklik
            const imgSrc = element.querySelector('.card-img').src;

            // Masukkan ke modal
            modalImg.src = imgSrc;

            // Tampilkan Modal
            modal.classList.add('active');
            document.body.style.overflow = 'hidden'; // Stop scroll
        }

        function closeModalBtn() {
            modal.classList.remove('active');
            document.body.style.overflow = 'auto'; // Enable scroll
        }

        function closeModal(event) {
            // Tutup jika klik area gelap di luar gambar
            if (event.target === modal) {
                closeModalBtn();
            }
        }
