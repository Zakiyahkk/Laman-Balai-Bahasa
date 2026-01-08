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
