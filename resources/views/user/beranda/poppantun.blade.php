<div id="welcomePopup" class="popup-overlay">
    <div class="popup-box">
        <button class="close-btn" onclick="closeWelcomePopup()" aria-label="Tutup Popup">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <img src="{{ asset('img/pantun2.png') }}" alt="Pantun Hari Ini" class="popup-img">
    </div>
</div>

<style>
    .popup-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.85);
        backdrop-filter: blur(5px);
        z-index: 10000;
        /* Pastikan di atas semua elemen */
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
        /* Status Sembunyi untuk Animasi */
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.5s ease-in-out, visibility 0.5s ease-in-out;
    }

    .popup-overlay.show {
        opacity: 1;
        visibility: visible;
    }

    .popup-box {
        position: relative;
        background: transparent;
        max-width: 100%;
        max-height: 100%;
        display: flex;
        transform: scale(0.5);
        transition: transform 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .popup-overlay.show .popup-box {
        transform: scale(1);
    }

    .popup-img {
        display: block;
        width: auto;
        height: auto;
        max-width: 90vw;
        max-height: 80vh;
        border-radius: 15px;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.6);
        border: 4px solid rgba(255, 255, 255, 0.2);
        object-fit: contain;
    }

    .close-btn {
        position: absolute;
        top: -20px;
        right: -20px;
        width: 45px;
        height: 45px;
        background: #ef4444;
        color: white;
        border: 4px solid #fff;
        border-radius: 50%;
        font-size: 20px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        transition: 0.3s;
        z-index: 10001;
    }

    .close-btn:hover {
        background: #dc2626;
        transform: rotate(90deg) scale(1.1);
    }

    @media (max-width: 480px) {
        .close-btn {
            width: 35px;
            height: 35px;
            font-size: 16px;
            top: -15px;
            right: -15px;
        }
    }
</style>

<script>
    // Gunakan fungsi load agar tidak bentrok dengan DOMContentLoaded lainnya
    window.addEventListener("load", function() {
        const popupPantun = document.getElementById("welcomePopup");

        if (popupPantun) {
            // Munculkan popup setelah 1 detik
            setTimeout(() => {
                popupPantun.classList.add("show");
            }, 1000);

            // Fungsi Global Tutup
            window.closeWelcomePopup = function() {
                popupPantun.classList.remove("show");
            };

            // Tutup klik area luar
            popupPantun.addEventListener("click", function(e) {
                if (e.target === this) {
                    closeWelcomePopup();
                }
            });
        }
    });
</script>