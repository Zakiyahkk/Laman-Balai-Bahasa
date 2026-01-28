document.addEventListener("DOMContentLoaded", function () {
    const swiper = new Swiper(".mySwiper", {
        loop: true,
        speed: 800,

        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },

        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },

        effect: "fade",
        fadeEffect: {
            crossFade: true,
        },
    });
});
