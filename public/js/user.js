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
    const navbar = document.getElementById("navbar");
    navbar.classList.toggle("mobile-open");
}
function toggleSub(element) {
    // Cek apakah sedang di mode mobile (layar < 1200px)
    if (window.innerWidth <= 1200) {
        // Toggle class open-sub pada parent <li>
        const parentLi = element.parentElement;
        parentLi.classList.toggle("open-sub");
    }
}

// ================================
// Footer
// ================================
document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById("visitorChart").getContext("2d");

    const gradient = ctx.createLinearGradient(0, 0, 0, 160);
    gradient.addColorStop(0, "#facc15");
    gradient.addColorStop(1, "rgba(250, 204, 21, 0.05)");

    new Chart(ctx, {
        type: "bar",
        data: {
            labels: [
                "Sen",
                "Sel",
                "Rab",
                "Kam",
                "Jum",
                "Sab",
                "Min",
                "Sen",
                "Sel",
                "Rab",
            ],
            datasets: [
                {
                    label: "Pengunjung",
                    data: [45, 52, 38, 65, 48, 23, 15, 50, 60, 42],
                    backgroundColor: gradient,
                    // Pastikan warna hover adalah putih solid agar efek "menyala" terlihat jelas
                    hoverBackgroundColor: "#ffffff",
                    // Menambah pendaran cahaya (glow) saat kursor menyentuh batang
                    hoverBorderColor: "#ffffff",
                    hoverBorderWidth: 2,
                    borderRadius: 5,
                    borderSkipped: false,
                    barPercentage: 0.7,
                    categoryPercentage: 0.6,
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            // PENTING: Pengaturan agar hover lebih sensitif
            interaction: {
                mode: "index",
                intersect: false, // Membuat batang menyala meski kursor tidak tepat di tengah batang
            },
            plugins: {
                legend: {
                    display: false,
                },
                tooltip: {
                    enabled: true,
                    backgroundColor: "#0f172a",
                    titleFont: {
                        family: "Montserrat",
                        size: 11,
                        weight: "bold",
                    },
                    bodyFont: {
                        family: "Montserrat",
                        size: 11,
                    },
                    padding: 10,
                    cornerRadius: 8,
                    displayColors: false,
                    // Tambahkan callback agar informasi muncul lebih rapi
                    callbacks: {
                        label: function (context) {
                            return " " + context.parsed.y + " Pengunjung";
                        },
                    },
                },
            },
            scales: {
                y: {
                    display: true,
                    beginAtZero: true,
                    grid: {
                        color: "rgba(255, 255, 255, 0.05)",
                        drawBorder: false,
                    },
                    ticks: {
                        color: "#64748b",
                        font: {
                            size: 9,
                            family: "Montserrat",
                        },
                        padding: 10,
                    },
                },
                x: {
                    grid: {
                        display: false,
                    },
                    ticks: {
                        color: "#94a3b8",
                        font: {
                            size: 10,
                            family: "Montserrat",
                            weight: "600",
                        },
                        padding: 5,
                    },
                },
            },
            // Tambahkan animasi hover agar transisinya halus
            animation: {
                duration: 1000,
                easing: "easeOutQuart",
            },
        },
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById("monthlyVisitorChart").getContext("2d");

    const monthlyVisitorChart = new Chart(ctx, {
        type: "bar", // Tipe Chart Batang
        data: {
            // Label Bulan (Bisa disesuaikan dengan data real)
            labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun"],
            datasets: [
                {
                    label: "Pengunjung",
                    data: [1200, 1900, 3000, 5000, 2300, 3200], // Data Dummy
                    backgroundColor: "#3b82f6", // Warna Batang (Biru)
                    borderRadius: 4, // Sudut batang membulat
                    barThickness: 15, // Ketebalan batang
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false, // Sembunyikan legenda agar bersih
                },
                tooltip: {
                    enabled: true,
                    backgroundColor: "rgba(0,0,0,0.8)",
                    titleColor: "#fff",
                    bodyColor: "#fff",
                },
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: "rgba(255, 255, 255, 0.1)", // Garis grid transparan
                        drawBorder: false,
                    },
                    ticks: {
                        color: "#94a3b8", // Warna angka sumbu Y
                        font: { size: 10 },
                    },
                },
                x: {
                    grid: {
                        display: false, // Hilangkan grid vertikal
                    },
                    ticks: {
                        color: "#94a3b8", // Warna bulan sumbu X
                        font: { size: 10 },
                    },
                },
            },
        },
    });
});

// ================================
// Popup Pantun & Slider Text
// ================================
// Gunakan window load agar lebih stabil
window.addEventListener("load", function () {
    
    // --- 1. POPUP PANTUN ---
    const popup = document.getElementById("welcomePopup");

    if (popup) {
        // Berikan delay 1 detik agar transisi terlihat halus
        setTimeout(() => {
            popup.classList.add("show");
        }, 1000);

        // Fungsi Global untuk Menutup Popup
        window.closeWelcomePopup = function () {
            popup.classList.remove("show");
        };

        // Tutup jika mengklik area gelap di luar gambar
        popup.addEventListener("click", function (e) {
            if (e.target === this) {
                closeWelcomePopup();
            }
        });
    }

    // --- 2. TYPED.JS (Jika digunakan) ---
    const typingEl = document.querySelector("#typing-element");
    if (typingEl && typeof Typed !== 'undefined') {
        new Typed("#typing-element", {
            strings: ["Ligat.", "Giat.", "Loyal.", "Inovatif.", "Akuntabel."],
            typeSpeed: 60,
            backSpeed: 40,
            backDelay: 1500,
            loop: true
        });
    }

    // --- 3. SLIDER SEQUENCE ---
    const seqBrand = document.getElementById("seq-brand");
    const seqService = document.getElementById("seq-service");

    if (seqBrand && seqService) {
        const showTime = 5000;
        const serviceTime = 6000;

        function switchState(state) {
            if (state === "brand") {
                seqService.classList.remove("active");
                setTimeout(() => { seqBrand.classList.add("active"); }, 500);
            } else if (state === "service") {
                seqBrand.classList.remove("active");
                setTimeout(() => { seqService.classList.add("active"); }, 500);
            }
        }

        // Jalankan loop slider
        setTimeout(() => { switchState("service"); }, showTime);
        setInterval(() => {
            switchState("brand");
            setTimeout(() => { switchState("service"); }, showTime);
        }, showTime + serviceTime);
    }
});

// ================================
// Pengumuman
// ================================
document.addEventListener("DOMContentLoaded", function () {
    // Ambil Elemen Modal & Viewer
    const modal = document.getElementById("docModal");
    const pdfViewer = document.getElementById("pdfViewer");
    const imageViewer = document.getElementById("imageViewer");
    const fallbackMsg = document.getElementById("fallbackMessage");

    // Ambil Tombol Aksi di Modal
    const downloadBtn = document.getElementById("downloadBtn");
    const fallbackLink = document.getElementById("fallbackLink");

    // Ambil semua item pengumuman
    const triggers = document.querySelectorAll(".trigger-modal");

    // LOOP SETIAP ITEM PENGUMUMAN
    triggers.forEach((trigger) => {
        trigger.addEventListener("click", function () {
            // 1. Ambil Data dari HTML Atribut
            const docUrl = this.getAttribute("data-doc");
            const docType = this.getAttribute("data-type"); // 'pdf' atau 'image'

            // 2. Reset Semua Tampilan Viewer (Sembunyikan dulu)
            pdfViewer.style.display = "none";
            imageViewer.style.display = "none";
            fallbackMsg.style.display = "none";

            // 3. Set Link Download
            downloadBtn.href = docUrl;
            fallbackLink.href = docUrl;

            // 4. Cek Tipe File dan Tampilkan Viewer yang sesuai
            if (docType === "pdf") {
                pdfViewer.src = docUrl;
                pdfViewer.style.display = "block";
            } else if (docType === "image") {
                imageViewer.src = docUrl;
                imageViewer.style.display = "block";
            } else {
                // Jika tipe lain (misal docx) atau error
                fallbackMsg.style.display = "block";
            }

            // 5. Munculkan Modal
            modal.classList.add("active");
        });
    });

    // FUNGSI TUTUP MODAL
    window.closeDocModal = function () {
        modal.classList.remove("active");

        // Bersihkan src setelah animasi selesai agar hemat memori
        setTimeout(() => {
            pdfViewer.src = "";
            imageViewer.src = "";
        }, 400);
    };

    // Tutup Modal jika klik di background gelap
    modal.addEventListener("click", function (e) {
        if (e.target === this) {
            closeDocModal();
        }
    });
});

// Menambahkan kelas warna berdasarkan data-type saat halaman dimuat
const items = document.querySelectorAll(".pengumuman-item");
items.forEach((item) => {
    const type = item.getAttribute("data-type");
    if (type === "pdf") {
        item.classList.add("type-pdf");
    } else if (type === "image") {
        item.classList.add("type-image");
    }
});

// ================================
// Fasilitas
// ================================
document.addEventListener("DOMContentLoaded", function () {
    const track = document.getElementById("track");
    const nextBtn = document.getElementById("nextBtn");
    const prevBtn = document.getElementById("prevBtn");
    const cards = document.querySelectorAll(".fasilitas-card");

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
    nextBtn.addEventListener("click", () => {
        const visibleCards = getVisibleCards();
        if (currentIndex < totalCards - visibleCards) {
            currentIndex++;
        } else {
            currentIndex = 0; // Loop balik ke awal
        }
        updateSlider();
    });

    // Klik Prev
    prevBtn.addEventListener("click", () => {
        const visibleCards = getVisibleCards();
        if (currentIndex > 0) {
            currentIndex--;
        } else {
            currentIndex = totalCards - visibleCards; // Loop ke akhir
        }
        updateSlider();
    });

    // Update saat layar di-resize agar posisi tetap akurat
    window.addEventListener("resize", updateSlider);
});

// ================================
// Yel-Yel Slider & Podcast
// ================================
const contentData = [
    {
        type: "Yel-Yel",
        title: "Yel-Yel Balai Bahasa Riau",
        videoId: "Is1PyvA0MAU",
        desc: `<p>Penampilan penuh semangat dari seluruh pegawai Balai Bahasa Provinsi Riau. Membawa pesan perubahan menuju Zona Integritas Wilayah Bebas dari Korupsi (ZI-WBK).</p>`,
    },
    {
        type: "Siniar",
        title: "RESAM BASTRA",
        videoId: "PhnYJL-LSx8",
        desc: `<p>Saksikan episode terbaru dari <span class="yelyel-highlight">RESAM BASTRA</span>. Membahas isu-isu terkini mengenai perkembangan bahasa Indonesia dan sastra daerah di Riau.</p>`,
    },
    {
        type: "Konten",
        title: "Kegiatan Balai Bahasa Riau",
        videoId: "5TAGi3OeScY",
        desc: `<p>Cuplikan kegiatan penting yang diselenggarakan oleh Balai Bahasa Provinsi Riau. Upaya nyata dalam pelindungan dan pemasyarakatan bahasa di tengah masyarakat.</p>`,
    },
];

let currentIndex = 0;

const textContainer = document.getElementById("textContent");
const badgeEl = document.getElementById("badgeText");
const titleEl = document.getElementById("titleText");
const descEl = document.getElementById("descText");

const videoContainer = document.getElementById("videoContainer");
const videoThumbnail = document.getElementById("videoThumbnail");
const iframeEl = document.getElementById("videoFrame");

function loadContent(index) {
    const data = contentData[index];

    // 1. Reset State Player (Kembali ke Thumbnail)
    videoContainer.classList.remove("is-playing");

    // Kosongkan src iframe dulu biar stop video lama
    iframeEl.removeAttribute("src");

    // 2. Load Thumbnail Baru
    videoThumbnail.src = `https://img.youtube.com/vi/${data.videoId}/maxresdefault.jpg`;

    // 3. Update Teks
    textContainer.classList.add("fading");
    setTimeout(() => {
        badgeEl.textContent = data.type;
        titleEl.textContent = data.title;
        descEl.innerHTML = data.desc;

        if (data.type === "Podcast") badgeEl.classList.add("podcast");
        else badgeEl.classList.remove("podcast");

        textContainer.classList.remove("fading");
    }, 400);
}

function playCurrentVideo() {
    const data = contentData[currentIndex];

    videoContainer.classList.add("is-playing");

    iframeEl.src = `https://www.youtube.com/embed/${data.videoId}?autoplay=1&mute=1&playsinline=1&rel=0`;
}

function changeVideo(direction) {
    currentIndex += direction;
    if (currentIndex >= contentData.length) currentIndex = 0;
    if (currentIndex < 0) currentIndex = contentData.length - 1;
    loadContent(currentIndex);
}

document.addEventListener("DOMContentLoaded", () => {
    loadContent(0);
});

// ================================
// Piagam di halaman Dokumenprestasi
// ================================
const modal = document.getElementById("piagamModal");
const modalImg = document.getElementById("modalImg");

function openModal(element) {
    // Ambil src gambar dari kartu yang diklik
    const imgSrc = element.querySelector(".card-img").src;

    // Masukkan ke modal
    modalImg.src = imgSrc;

    // Tampilkan Modal
    modal.classList.add("active");
    document.body.style.overflow = "hidden"; // Stop scroll
}

function closeModalBtn() {
    modal.classList.remove("active");
    document.body.style.overflow = "auto"; // Enable scroll
}

function closeModal(event) {
    // Tutup jika klik area gelap di luar gambar
    if (event.target === modal) {
        closeModalBtn();
    }
}
/* =========================================
   SEJARAH LIGHTBOX
========================================= */
document.addEventListener("DOMContentLoaded", function () {
    const lightbox = document.getElementById("lightbox");
    if (!lightbox) return;

    const imgEl = document.getElementById("lightbox-img");
    const captionEl = document.getElementById("lightbox-caption");
    const closeBtn = lightbox.querySelector(".lightbox-close");
    const prevBtn = lightbox.querySelector(".lightbox-nav.prev");
    const nextBtn = lightbox.querySelector(".lightbox-nav.next");

    const items = Array.from(
        document.querySelectorAll(".sejarah-gallery a.sejarah-photo")
    );
    if (!items.length) return;

    let currentIndex = 0;

    function openLightbox(index) {
        currentIndex = index;
        const a = items[currentIndex];
        const img = a.querySelector("img");

        const src = a.getAttribute("href") || img.src;
        const caption = img.getAttribute("alt") || "";

        imgEl.src = src;
        captionEl.textContent = caption;

        lightbox.classList.add("is-open");
        document.body.style.overflow = "hidden";
    }

    function closeLightbox() {
        lightbox.classList.remove("is-open");
        imgEl.src = "";
        document.body.style.overflow = "";
    }

    function prev() {
        openLightbox((currentIndex - 1 + items.length) % items.length);
    }

    function next() {
        openLightbox((currentIndex + 1) % items.length);
    }

    items.forEach((a, index) => {
        a.addEventListener("click", function (e) {
            e.preventDefault();
            openLightbox(index);
        });
    });

    closeBtn.addEventListener("click", closeLightbox);
    prevBtn.addEventListener("click", prev);
    nextBtn.addEventListener("click", next);

    lightbox.addEventListener("click", function (e) {
        if (e.target === lightbox) closeLightbox();
    });

    document.addEventListener("keydown", function (e) {
        if (!lightbox.classList.contains("is-open")) return;
        if (e.key === "Escape") closeLightbox();
        if (e.key === "ArrowLeft") prev();
        if (e.key === "ArrowRight") next();
    });
});

/* =========================================
   Slider Swiper di halaman Beranda
========================================= */
document.addEventListener("DOMContentLoaded", function() {
    // Inisialisasi Swiper
    var swiper = new Swiper(".mySwiper", {
        spaceBetween: 0,
        effect: "fade", // Efek pudar
        centeredSlides: true,
        autoplay: {
            delay: 4000, // Ganti slide 4 detik
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        // Navigation (Arrow) dihapus sesuai permintaan
    });

    // Script Popup
    const popup = document.getElementById('welcomePopup');
    const closeBtn = document.querySelector('.close-btn');

    // Fungsi tutup popup
    window.closeWelcomePopup = function() {
        if(popup) popup.style.display = 'none';
    }

    // Jika ingin popup muncul otomatis saat load, uncomment baris di bawah:
    // if(popup) popup.style.display = 'flex';
});

/* =========================================
   SCRIPT TOKOH BAHASA (INIT CHECK)
   ========================================= */
document.addEventListener("DOMContentLoaded", function() {
    
    // --- 1. CONFIG SWIPER ---
    // Cek apakah slider ada di halaman sebelum inisialisasi
    if (document.querySelector('.tokohSlider')) {
        
        // Cek library Swiper
        if (typeof Swiper !== 'undefined') {
            var swiper = new Swiper(".tokohSlider", {
                slidesPerView: 1, 
                spaceBetween: 25,
                loop: true,
                autoplay: {
                    delay: 4000,
                    disableOnInteraction: false,
                    pauseOnMouseEnter: true, 
                },
                navigation: {
                    nextEl: ".tokoh-next",
                    prevEl: ".tokoh-prev",
                },
                breakpoints: {
                    640: { slidesPerView: 2, spaceBetween: 20 },
                    768: { slidesPerView: 3, spaceBetween: 25 },
                    1024: { slidesPerView: 4, spaceBetween: 30 },
                }
            });
        }
    }

    // --- 2. LOGIC MODAL POPUP ---
    const modal = document.getElementById('modalTokoh');
    const mFoto = document.getElementById('mFoto');
    const mNama = document.getElementById('mNama');
    const mDesc = document.getElementById('mDesc');
    const mKat = document.getElementById('mKategori');

    // Fungsi Global Buka Modal
    window.openTokohModal = function(nama, foto, deskripsi, kategori) {
        // Set Data
        if(mNama) mNama.innerText = nama;
        if(mFoto) mFoto.src = foto;
        if(mDesc) mDesc.innerText = deskripsi;

        // Set Warna Badge
        if(mKat) {
            mKat.className = 'modal-tag'; // Reset class
            if(kategori === 'bahasa') {
                mKat.innerText = "Tokoh Bahasa";
                mKat.className += ' bg-blue';
            } else if (kategori === 'sastra') {
                mKat.innerText = "Tokoh Sastra";
                mKat.className += ' bg-orange';
            } else {
                mKat.innerText = "Tokoh Budaya";
                mKat.className += ' bg-green';
            }
        }
        
        // Tampilkan Modal
        if(modal) {
            modal.style.display = 'flex';
            setTimeout(() => {
                modal.classList.add('active');
            }, 10);
        }
    }

    // Fungsi Global Tutup Modal
    window.closeTokohModal = function() {
        if(modal) {
            modal.classList.remove('active');
            setTimeout(() => {
                modal.style.display = 'none';
            }, 300); 
        }
    }

    // Close jika klik backdrop
    if(modal) {
        modal.addEventListener('click', function(e) {
            if(e.target === modal || e.target.classList.contains('modal-backdrop')) {
                closeTokohModal();
            }
        });
    }
});


/* =========================================
   SCRIPT MAHKOTA KALAM (TAB & SLIDER)
   ========================================= */
document.addEventListener("DOMContentLoaded", function() {
    
    // Inisialisasi Swiper
    const initMahkotaSwiper = () => {
        if (document.querySelector('.mahkotaSwiper')) {
            return new Swiper(".mahkotaSwiper", {
                slidesPerView: 1,
                spaceBetween: 15,
                loop: true,
                navigation: {
                    nextEl: ".mk-next",
                    prevEl: ".mk-prev",
                },
                breakpoints: {
                    480: { slidesPerView: 2 },
                    768: { slidesPerView: 3 },
                    1024: { slidesPerView: 4 }
                }
            });
        }
        return null;
    };

    let mahkotaSlider = initMahkotaSwiper();

    // Fungsi Klik Tab
    const mkTabs = document.querySelectorAll(".mk-tab-btn");
    const mkPanes = document.querySelectorAll(".mahkota-pane");

    mkTabs.forEach(tab => {
        tab.addEventListener("click", () => {
            const target = tab.getAttribute("data-tab");

            // Update Active Tab Button
            mkTabs.forEach(t => t.classList.remove("active"));
            tab.classList.add("active");

            // Update Active Pane
            mkPanes.forEach(pane => {
                pane.classList.remove("active");
                if (pane.id === target) {
                    pane.classList.add("active");
                }
            });

            // Re-inisialisasi Swiper agar tidak rusak di tab baru
            if (mahkotaSlider) {
                if (Array.isArray(mahkotaSlider)) {
                    mahkotaSlider.forEach(s => s.destroy());
                } else {
                    mahkotaSlider.destroy();
                }
            }
            mahkotaSlider = initMahkotaSwiper();
        });
    });
});