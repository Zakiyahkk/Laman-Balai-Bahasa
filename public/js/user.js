/* ==========================================================================
   USER.JS - MASTER STABLE VERSION (FIXED)
   ========================================================================== */

/* --- 1. GLOBAL STATE (Unik agar tidak bentrok) --- */
let multimediaIdx = 0;
let fasIdx = 0;
let heroIdx = 0;

/* --- 2. MULTIMEDIA DATA (Yelyel & Podcast) --- */
const mmData = [
    {
        type: "Yel-Yel",
        title: "Yel-Yel Balai Bahasa Riau",
        videoId: "Vh_EdTzUN2g",
        desc: "Membawa pesan perubahan menuju Zona Integritas Wilayah Bebas dari Korupsi (ZI-WBK).",
    },
    {
        type: "Siniar",
        title: "RESAM BASTRA",
        videoId: "PhnYJL-LSx8",
        desc: "Membahas isu terkini mengenai perkembangan bahasa Indonesia dan sastra daerah di Riau.",
    },
    {
        type: "Konten",
        title: "Kegiatan Balai Bahasa Riau",
        videoId: "5TAGi3OeScY",
        desc: "Upaya nyata dalam pelindungan dan pemasyarakatan bahasa di tengah masyarakat.",
    },
];

/* --- 3. FUNGSI GLOBAL (Agar Terbaca Tombol Onclick) --- */

// A. Logika Multimedia
window.loadContent = function (index) {
    const container = document.getElementById("videoContainer");
    if (!container) return;
    const data = mmData[index];
    const frame = document.getElementById("videoFrame");
    const thumb = document.getElementById("videoThumbnail");
    const textCont = document.getElementById("textContent");

    container.classList.remove("is-playing");
    if (frame) frame.src = "";
    if (thumb)
        thumb.src = `https://img.youtube.com/vi/${data.videoId}/maxresdefault.jpg`;

    if (textCont) {
        textCont.style.opacity = "0";
        setTimeout(() => {
            document.getElementById("badgeText").textContent = data.type;
            document.getElementById("titleText").textContent = data.title;
            document.getElementById(
                "descText"
            ).innerHTML = `<p>${data.desc}</p>`;
            const badge = document.getElementById("badgeText");
            data.type === "Siniar"
                ? badge.classList.add("podcast")
                : badge.classList.remove("podcast");
            textCont.style.opacity = "1";
        }, 300);
    }
};

window.playCurrentVideo = function () {
    const container = document.getElementById("videoContainer");
    const frame = document.getElementById("videoFrame");
    if (container && frame) {
        container.classList.add("is-playing");
        frame.src = `https://www.youtube.com/embed/${mmData[multimediaIdx].videoId}?autoplay=1&rel=0`;
    }
};

window.changeVideo = function (dir) {
    multimediaIdx = (multimediaIdx + dir + mmData.length) % mmData.length;
    window.loadContent(multimediaIdx);
};

// B. Logika Modal Pengumuman (FIX FINAL)
window.closeDocModal = function () {
    const modal = document.getElementById("docModal");
    const pdfViewer = document.getElementById("pdfViewer");
    const imageViewer = document.getElementById("imageViewer");

    if (modal) modal.classList.remove("active");

    if (pdfViewer) {
        pdfViewer.src = "";
        pdfViewer.style.display = "none";
    }

    if (imageViewer) {
        imageViewer.src = "";
        imageViewer.style.display = "none";
    }

    document.body.classList.remove("modal-open");
};

// C. Logika Modal Piagam (Dokpres)
window.openModal = function (element) {
    const modal = document.getElementById("piagamModal");
    const modalImg = document.getElementById("modalImg");

    if (!modal || !modalImg) return;

    modalImg.src = element.querySelector("img").src;
    modal.classList.add("active");

    // ✅ FIX UTAMA
    document.body.classList.add("modal-open");
};

window.closeModal = function () {
    const modal = document.getElementById("piagamModal");
    if (modal) modal.classList.remove("active");

    document.body.classList.remove("modal-open");
};

/* ==========================================================================
   D. HALAMAN: TOKOH BAHASA & SASTRA (MODAL LOGIC)
   ========================================================================== */
window.openTokohModal = function (nama, foto, deskripsi, kategori) {
    const modal = document.getElementById("modalTokoh");
    if (!modal) return;

    document.getElementById("mNama").innerText = nama;
    document.getElementById("mFoto").src = foto;
    document.getElementById("mDesc").innerText = deskripsi;

    const katBadge = document.getElementById("mKategori");

    // =====================
    // NORMALISASI KATEGORI
    // =====================
    const kat = (kategori || "").toLowerCase();

    katBadge.innerText = "Tokoh " + kategori;

    // Reset class (AMAN)
    katBadge.classList.remove("bg-blue", "bg-orange", "bg-green");
    katBadge.classList.add("modal-tag");

    // Set warna berdasarkan isi kategori (fleksibel dari DB)
    if (kat.includes("bahasa")) {
        katBadge.classList.add("bg-blue");
    } else if (kat.includes("sastra")) {
        katBadge.classList.add("bg-orange");
    } else {
        katBadge.classList.add("bg-green");
    }

    modal.classList.add("active");
    document.body.classList.add("modal-open");
};

window.closeTokohModal = function () {
    const modal = document.getElementById("modalTokoh");
    if (modal) modal.classList.remove("active");

    document.body.classList.remove("modal-open");

    // 🔥 AMAN: refresh swiper jika ada
    setTimeout(() => {
        if (
            window.tokohSwiper &&
            typeof window.tokohSwiper.update === "function"
        ) {
            window.tokohSwiper.update();
        }
    }, 50);
};

/* --- Batas Script: Modal Tokoh Bahasa & Sastra --- */

/* --- 4. INISIALISASI (Dijalankan Saat Halaman Siap) --- */
document.addEventListener("DOMContentLoaded", function () {
    // 1. Reveal Animation (Kunci memunculkan Kata Pengantar)
    const reveals = document.querySelectorAll(".kr-reveal");
    const revealObserver = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("show");
                    entry.target.style.opacity = "1"; // Paksa muncul
                }
            });
        },
        { threshold: 0.1 }
    );
    reveals.forEach((el) => revealObserver.observe(el));

    // 2. Pewarnaan Badge Pengumuman Otomatis
    document.querySelectorAll(".pengumuman-item").forEach((item) => {
        const type = item.getAttribute("data-type");

        if (type === "pdf") item.classList.add("type-pdf");
        if (type === "image") item.classList.add("type-image");

        // Listener klik untuk buka modal pengumuman
        item.addEventListener("click", function () {
            const docUrl = this.getAttribute("data-doc");
            const docType = this.getAttribute("data-type");

            if (!docUrl) {
                console.error("URL dokumen kosong");
                return;
            }

            const modal = document.getElementById("docModal");
            const pdfView = document.getElementById("pdfViewer");
            const imgView = document.getElementById("imageViewer");

            // reset
            pdfView.style.display = "none";
            imgView.style.display = "none";
            pdfView.src = "";
            imgView.src = "";

            // 🔥 PAKAI URL APA ADANYA (JANGAN DIUBAH)
            if (docType === "pdf") {
                pdfView.src = docUrl;
                pdfView.style.display = "block";
            } else {
                imgView.src = docUrl;
                imgView.style.display = "block";
            }

            modal.classList.add("active");
            document.body.classList.add("modal-open");
        });
    });
    // 3. Fasilitas Slider Logic
    const fTrack = document.getElementById("track");
    const fNext = document.getElementById("nextBtn");
    const fPrev = document.getElementById("prevBtn");

    if (fTrack && fNext && fPrev) {
        const updateFasilitas = () => {
            const card = fTrack.querySelector(".fasilitas-card");
            const step = card.offsetWidth + 25;
            fTrack.style.transform = `translateX(-${step * fasIdx}px)`;
        };

        fNext.addEventListener("click", () => {
            const visible =
                window.innerWidth >= 1024
                    ? 3
                    : window.innerWidth >= 640
                    ? 2
                    : 1;
            const total = fTrack.querySelectorAll(".fasilitas-card").length;
            fasIdx = fasIdx + 1 >= total - visible + 1 ? 0 : fasIdx + 1;
            updateFasilitas();
        });

        fPrev.addEventListener("click", () => {
            const visible =
                window.innerWidth >= 1024
                    ? 3
                    : window.innerWidth >= 640
                    ? 2
                    : 1;
            const total = fTrack.querySelectorAll(".fasilitas-card").length;
            fasIdx = fasIdx <= 0 ? total - visible : fasIdx - 1;
            updateFasilitas();
        });
    }

    // 4. Hero Slider Auto
    const heroSlides = document.querySelectorAll(".hero-slider .slide");
    if (heroSlides.length) {
        setInterval(() => {
            heroSlides[heroIdx].classList.remove("active");
            heroIdx = (heroIdx + 1) % heroSlides.length;
            heroSlides[heroIdx].classList.add("active");
        }, 4000);
    }

    /* ======================================================================
   FIX FINAL: SWIPER TOKOH BAHASA & SASTRA (SCOPED)
   ====================================================================== */
    document.querySelectorAll(".tokoh-section").forEach((section) => {
        const slider = section.querySelector(".tokohSlider");
        const nextBtn = section.querySelector(".tokoh-next");
        const prevBtn = section.querySelector(".tokoh-prev");

        if (!slider || !nextBtn || !prevBtn) return;

        new Swiper(slider, {
            slidesPerView: 1,
            spaceBetween: 25,
            loop: true,
            navigation: {
                nextEl: nextBtn,
                prevEl: prevBtn,
            },
            breakpoints: {
                640: { slidesPerView: 2 },
                1024: { slidesPerView: 4 },
            },
        });
    });

    /* --- Batas Script: Swiper Tokoh Bahasa --- */

    /* ==========================================================================
   HALAMAN: MAHKOTA KALAM MELAYU (FINAL STABLE PER TAB)
   ========================================================================== */
    if (typeof Swiper !== "undefined") {
        const mahkotaSwipers = {};

        function initMahkotaSwiper(paneId) {
            if (mahkotaSwipers[paneId]) return;

            const pane = document.getElementById(paneId);
            if (!pane) return;

            const swiperEl = pane.querySelector(".mahkotaSwiper");
            const nextBtn = pane.querySelector(".mk-next");
            const prevBtn = pane.querySelector(".mk-prev");

            if (!swiperEl || !nextBtn || !prevBtn) return;

            mahkotaSwipers[paneId] = new Swiper(swiperEl, {
                slidesPerView: 1,
                spaceBetween: 15,
                loop: true,
                navigation: {
                    nextEl: nextBtn,
                    prevEl: prevBtn,
                },
                breakpoints: {
                    768: { slidesPerView: 3 },
                    1024: { slidesPerView: 4 },
                },
            });
        }
        // INIT TAB PERTAMA
        initMahkotaSwiper("mk-tokoh");

        // TAB CLICK LOGIC
        document.querySelectorAll(".mk-tab-btn").forEach((tab) => {
            tab.addEventListener("click", () => {
                document
                    .querySelectorAll(".mk-tab-btn")
                    .forEach((t) => t.classList.remove("active"));
                tab.classList.add("active");

                const target = tab.dataset.tab;

                document
                    .querySelectorAll(".mahkota-pane")
                    .forEach((pane) => pane.classList.remove("active"));

                const activePane = document.getElementById(target);
                if (activePane) activePane.classList.add("active");

                setTimeout(() => {
                    initMahkotaSwiper(target);
                    mahkotaSwipers[target]?.update();
                }, 100);
            });
        });
    }

    /* --- Batas Script: Mahkota Kalam Melayu --- */

    // 5. Init Multimedia
    if (document.getElementById("videoContainer")) window.loadContent(0);

    // 6. Navbar Toggle
    const menuToggle = document.getElementById("menuToggle");
    const bbpNavbar = document.querySelector(".bbp-navbar");
    if (menuToggle && bbpNavbar) {
        menuToggle.addEventListener("click", () =>
            bbpNavbar.classList.toggle("mobile-open")
        );
    }
});

/* ==========================================================================
   E. HALAMAN: HEADER & MOBILE MENU (BURGER LOGIC)
   ========================================================================== */

// Fungsi untuk buka/tutup menu burger
window.toggleMenu = function () {
    const header = document.getElementById("navbar");
    if (header) {
        header.classList.toggle("mobile-open");
    }
};

// Fungsi untuk buka dropdown di mobile
window.toggleSub = function (element) {
    if (window.innerWidth <= 1200) {
        // Cari parent <li> dan toggle class open-sub
        const parentLi = element.parentElement;
        parentLi.classList.toggle("open-sub");
    }
};

/* --- Batas Script: Header Mobile --- */

// --- Masukkan bagian ini di dalam document.addEventListener("DOMContentLoaded", function () { ... ---

/* ==========================================================================
       HALAMAN: HEADER CLEANUP
       ========================================================================== */
// Menutup menu otomatis jika user klik di luar area menu mobile
document.addEventListener("click", function (e) {
    const header = document.getElementById("navbar");
    const navMenu = document.querySelector(".nav-menu");
    const burgerBtn = document.querySelector(".menu-toggle");

    if (header && header.classList.contains("mobile-open")) {
        // Jika yang diklik bukan menu dan bukan tombol burger, maka tutup
        if (
            navMenu &&
            !navMenu.contains(e.target) &&
            !burgerBtn.contains(e.target)
        ) {
            header.classList.remove("mobile-open");
        }
    }
});
/* --- Batas Script: Header Cleanup --- */

/* ==========================================================================
   F. HALAMAN: FOOTER (VISITOR CHART INIT)
   ========================================================================== */
function initFooterChart() {
    const ctxVisitor = document.getElementById("monthlyVisitorChart");

    if (ctxVisitor && typeof Chart !== "undefined") {
        const chartCtx = ctxVisitor.getContext("2d");

        // Membuat gradasi warna agar grafik terlihat premium
        const gradient = chartCtx.createLinearGradient(0, 0, 0, 150);
        gradient.addColorStop(0, "#facc15"); // Kuning emas sesuai header kamu
        gradient.addColorStop(1, "rgba(250, 204, 21, 0.05)");

        new Chart(chartCtx, {
            type: "bar",
            data: {
                labels: ["Agu", "Sep", "Okt", "Nov", "Des", "Jan"],
                datasets: [
                    {
                        label: "Pengunjung",
                        data: [4200, 5100, 3800, 6200, 7500, 8530],
                        backgroundColor: gradient,
                        borderColor: "#facc15",
                        borderWidth: 1,
                        borderRadius: 5,
                        hoverBackgroundColor: "#ffffff",
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: "rgba(255, 255, 255, 0.05)",
                            drawBorder: false,
                        },
                        ticks: { color: "#64748b", font: { size: 10 } },
                    },
                    x: {
                        grid: { display: false },
                        ticks: { color: "#94a3b8", font: { size: 10 } },
                    },
                },
            },
        });
    }
}

// Jalankan fungsi saat halaman siap
document.addEventListener("DOMContentLoaded", function () {
    initFooterChart();
});
/* --- Batas Script: Footer Stats --- */

/* ===========================
   Chatbot
   =========================== */

const botData = [
    {
        id: 1,
        question: "Dimana alamat Balai Bahasa Provinsi Riau?",
        answer: "Balai Bahasa Provinsi Riau beralamat di <br><b>Jl. H.R. Soebrantas, Kampus Bina Widya UNRI, Pekanbaru.</b> <br><br>Gedung kami berada di dalam kompleks kampus UNRI Panam.",
    },
    {
        id: 2,
        question: "Apa saja jam pelayanan kantor?",
        answer: "Pelayanan kami buka pada:<br><b>Senin - Kamis:</b> 08.00 - 16.00 WIB<br><b>Jumat:</b> 08.00 - 16.30 WIB<br>Sabtu & Minggu Libur.",
    },
    {
        id: 3,
        question: "Bagaimana cara ikut uji UKBI?",
        answer: "Untuk mendaftar UKBI (Uji Kemahiran Berbahasa Indonesia), silakan kunjungi laman resmi: <a href='https://ukbi.kemdikbud.go.id' target='_blank'>ukbi.kemdikbud.go.id</a> atau datang langsung ke layanan ULT kami.",
    },
    {
        id: 4,
        question: "Saya ingin menerjemahkan dokumen, bisa?",
        answer: "Bisa! Kami menyediakan layanan penerjemahan. Silakan ajukan permohonan melalui email resmi kami atau datang ke bagian layanan teknis.",
    },
    {
        id: 5,
        question: "Apa kontak WhatsApp yang bisa dihubungi?",
        answer: "Anda dapat menghubungi kami via WhatsApp di nomor: <br><b><a href='https://wa.me/6281234567890'>+62 812-3456-7890</a></b>",
    },
];

let isChatOpen = false;

// Fungsi-fungsi ini dibuat global agar bisa dipanggil dari atribut onclick di HTML
window.toggleChat = function () {
    const chatWindow = document.getElementById("icak-chat-window");
    const chatBody = document.getElementById("icak-body");

    if (!isChatOpen) {
        chatWindow.style.display = "flex";
        isChatOpen = true;

        if (chatBody.children.length === 0) {
            botSay(
                "Halo! Saya <b>SIBALAI</b>, asisten virtual Balai Bahasa Riau. 👋<br>Ada yang bisa saya bantu?"
            );
            renderOptions();
        }
    } else {
        chatWindow.style.display = "none";
        isChatOpen = false;
    }
};

function botSay(htmlMsg) {
    const chatBody = document.getElementById("icak-body");
    const bubble = document.createElement("div");
    bubble.className = "chat-bubble bot-msg";
    bubble.innerHTML = htmlMsg;
    chatBody.appendChild(bubble);
    scrollToBottom();
}

function userSay(text) {
    const chatBody = document.getElementById("icak-body");
    const bubble = document.createElement("div");
    bubble.className = "chat-bubble user-msg";
    bubble.innerText = text;
    chatBody.appendChild(bubble);
    scrollToBottom();
}

function renderOptions() {
    const optionsArea = document.getElementById("icak-options");
    optionsArea.innerHTML = "";

    const label = document.createElement("div");
    label.setAttribute(
        "style",
        "font-size: 11px; color: #64748b; margin-bottom: 5px;"
    );
    label.innerText = "Pilih topik bantuan:";
    optionsArea.appendChild(label);

    botData.forEach((item) => {
        const btn = document.createElement("div");
        btn.className = "option-card";
        btn.innerHTML = `<i class="fa-regular fa-comments"></i> ${item.question}`;
        btn.onclick = () => handleSelection(item);
        optionsArea.appendChild(btn);
    });
}

function handleSelection(item) {
    const optionsArea = document.getElementById("icak-options");
    userSay(item.question);

    optionsArea.innerHTML = `<div style="text-align:center; padding:10px; color:#94a3b8; font-size:12px;">
        <i class="fa-solid fa-circle-notch fa-spin"></i> SIBALAI sedang mengetik...
    </div>`;

    setTimeout(() => {
        botSay(item.answer);
        showBackToMenu();
    }, 800);
}

function showBackToMenu() {
    const optionsArea = document.getElementById("icak-options");
    optionsArea.innerHTML = "";
    const btnReset = document.createElement("div");
    btnReset.className = "option-card";
    btnReset.setAttribute(
        "style",
        "background: #f1f5f9; justify-content: center; font-weight: bold;"
    );
    btnReset.innerHTML = `<i class="fa-solid fa-rotate-left"></i> Kembali ke Menu Utama`;
    btnReset.onclick = () => renderOptions();
    optionsArea.appendChild(btnReset);
}

function scrollToBottom() {
    const chatBody = document.getElementById("icak-body");
    chatBody.scrollTop = chatBody.scrollHeight;
}
