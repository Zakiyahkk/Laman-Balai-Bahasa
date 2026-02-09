<div id="welcomePopup" class="popup-overlay">
    <div class="popup-box">
        <button class="close-btn" onclick="closeWelcomePopup()" aria-label="Tutup Popup">
            <i class="fa-solid fa-xmark"></i>
        </button>

        <img id="dailyPantunImg" src="" alt="Pantun Hari Ini" class="popup-img">

        <div class="auto-close-timer">
            Menutup otomatis dalam <span id="countdownTimer">10</span> detik
        </div>
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
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
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
        flex-direction: column;
        align-items: center;
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
        max-height: 75vh;
        border-radius: 15px;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.6);
        border: 4px solid rgba(255, 255, 255, 0.2);
        object-fit: contain;
        background-color: #f0f0f0;
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

    /* Style teks timer */
    .auto-close-timer {
        margin-top: 15px;
        color: rgba(255, 255, 255, 0.9);
        font-size: 13px;
        font-family: 'Montserrat', sans-serif;
        background: rgba(0, 0, 0, 0.5);
        padding: 5px 15px;
        border-radius: 20px;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .auto-close-timer span {
        font-weight: 800;
        color: #facc15;
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
    window.addEventListener("load", function() {
        const popupPantun = document.getElementById("welcomePopup");
        const imgElement = document.getElementById("dailyPantunImg");
        const timerElement = document.getElementById("countdownTimer");

        // ============================================================
        // UPDATE: Path sudah disesuaikan ke folder 'img/pantun/'
        // ============================================================
        const pantunCollection = [
            "{{ asset('img/pantun/pantunminggu.png') }}", // 0 = Minggu
            "{{ asset('img/pantun/pantunsenin.png') }}",  // 1 = Senin
            "{{ asset('img/pantun/pantunselasa.png') }}", // 2 = Selasa
            "{{ asset('img/pantun/pantunrabu.png') }}",   // 3 = Rabu
            "{{ asset('img/pantun/pantunkamis.png') }}",  // 4 = Kamis
            "{{ asset('img/pantun/pantunjumat.png') }}",  // 5 = Jumat
            "{{ asset('img/pantun/pantunsabtu.png') }}"   // 6 = Sabtu
        ];

        // 2. Set gambar sesuai hari saat ini
        const today = new Date().getDay(); // Mengambil angka hari (0-6)
        if (imgElement) {
            imgElement.src = pantunCollection[today];
        }

        if (popupPantun) {
            let countdownInterval;
            let timeLeft = 10; // Waktu hitung mundur (detik)

            // Fungsi Tutup & Bersihkan Timer
            window.closeWelcomePopup = function() {
                popupPantun.classList.remove("show");
                clearInterval(countdownInterval); // Stop hitungan
            };

            // Munculkan popup setelah 1 detik
            setTimeout(() => {
                popupPantun.classList.add("show");

                // LOGIKA HITUNG MUNDUR (COUNTDOWN)
                countdownInterval = setInterval(() => {
                    timeLeft--; // Kurangi 1 detik

                    if (timerElement) {
                        timerElement.innerText = timeLeft; // Update angka di layar
                    }

                    // Jika waktu habis (0), tutup popup
                    if (timeLeft <= 0) {
                        closeWelcomePopup();
                    }
                }, 1000); // Jalan setiap 1000ms (1 detik)

            }, 1000);

            // Tutup klik area luar
            popupPantun.addEventListener("click", function(e) {
                if (e.target === this) {
                    closeWelcomePopup();
                }
            });
        }
    });
</script>