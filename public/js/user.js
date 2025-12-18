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
document.addEventListener("DOMContentLoaded", function () {
    const navLinks = document.querySelectorAll(".nav-menu a");

    navLinks.forEach((link) => {
        link.addEventListener("click", function () {
            // hapus active sementara
            document
                .querySelectorAll(".nav-item, .dropdown-menu li")
                .forEach((el) => el.classList.remove("active"));

            // aktifkan parent menu
            const parentItem = this.closest("li");
            if (parentItem) parentItem.classList.add("active");

            // aktifkan nav utama jika submenu
            const navItem = this.closest(".nav-item");
            if (navItem) navItem.classList.add("active");
        });
    });
});
