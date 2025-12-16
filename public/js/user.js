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
