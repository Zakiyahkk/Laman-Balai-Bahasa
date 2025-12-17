document.addEventListener("DOMContentLoaded", function () {
    /* ===============================
       ELEMENT
    ================================ */
    const menuToggle = document.getElementById("menuToggle");
    const navMenu = document.getElementById("navMenu");
    const navItems = document.querySelectorAll(".nav-item");
    const dropdownLinks = document.querySelectorAll(".dropdown > a");
    const subLinks = document.querySelectorAll(".dropdown-menu a");

    /* ===============================
       TOGGLE MENU MOBILE
    ================================ */
    if (menuToggle && navMenu) {
        menuToggle.addEventListener("click", function () {
            navMenu.classList.toggle("show");
        });
    }

    /* ===============================
       ACTIVE MENU (MENU UTAMA)
    ================================ */
    navItems.forEach((item) => {
        const link = item.querySelector(":scope > a");
        if (!link) return;

        link.addEventListener("click", function () {
            clearActive();
            item.classList.add("active");
        });
    });

    /* ===============================
       ACTIVE MENU (SUBMENU)
    ================================ */
    subLinks.forEach((link) => {
        link.addEventListener("click", function () {
            clearActive();

            this.parentElement.classList.add("active");

            const parent = this.closest(".nav-item");
            if (parent) parent.classList.add("active");
        });
    });

    /* ===============================
       DROPDOWN MOBILE (KLIK)
    ================================ */
    dropdownLinks.forEach((link) => {
        link.addEventListener("click", function (e) {
            if (window.innerWidth <= 768) {
                e.preventDefault();
                this.parentElement.classList.toggle("open");
            }
        });
    });

    /* ===============================
       HELPER
    ================================ */
    function clearActive() {
        navItems.forEach((i) => i.classList.remove("active"));
        subLinks.forEach((s) => s.parentElement.classList.remove("active"));
    }
});

document.addEventListener("DOMContentLoaded", function () {
    const slides = document.querySelectorAll(".hero-slider .slide");
    let index = 0;

    if (!slides.length) return;

    setInterval(() => {
        slides[index].classList.remove("active");
        index = (index + 1) % slides.length;
        slides[index].classList.add("active");
    }, 4000);
});

document.addEventListener("DOMContentLoaded", function () {
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

    document.querySelectorAll(".tokoh-card").forEach((card) => {
        card.addEventListener("click", function () {
            modalFoto.src = this.dataset.foto;
            modalNama.textContent = this.dataset.nama;
            modalDeskripsi.textContent = this.dataset.deskripsi;
            modal.classList.add("show");
        });
    });

    document.querySelector(".tokoh-modal-close").onclick = () =>
        modal.classList.remove("show");

    modal.onclick = (e) => {
        if (e.target === modal) modal.classList.remove("show");
    };
});
