<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<section class="mahkota-section" style="margin-top: -90px;">
    <div class="mahkota-container">

        {{-- HEADER --}}
        <div class="mahkota-header">
            <div class="mahkota-title-group">
                <h2 class="mahkota-main-title">Mahkota Kalam Melayu Riau</h2>
            </div>
            <p class="mahkota-sub-text">
                Tokoh dan Komunitas Penggerak Bahasa dan Sastra Melayu
            </p>
        </div>

        {{-- TAB --}}
        <div class="mahkota-tabs">
            <button class="mk-tab-btn active" data-tab="mk-tokoh">
                Tokoh Sastra Lisan
            </button>
            <button class="mk-tab-btn" data-tab="mk-literasi">
                Komunitas Literasi
            </button>
            <button class="mk-tab-btn" data-tab="mk-komunitas">
                Komunitas Sastra
            </button>
        </div>

        {{-- =========================
             TOKOH SASTRA LISAN
             ========================= --}}
        <div class="mahkota-pane active" id="mk-tokoh">
            <div class="mk-slider-wrapper">

                <div class="mk-arrow mk-prev tokoh-prev"><i class="fa-solid fa-chevron-left"></i></div>
                <div class="mk-arrow mk-next tokoh-next"><i class="fa-solid fa-chevron-right"></i></div>

                <div class="swiper mahkotaSwiper tokoh-swiper">
                    <div class="swiper-wrapper">

                        @forelse ($tokohSastra as $item)
                            <div class="swiper-slide">
                                <div class="mk-card-box"
                                    onclick="openTokohModal(
                                            '{{ e($item['nama']) }}',
                                            '{{ $item['foto_url'] }}',
                                            '{{ e($item['deskripsi']) }}',
                                            '{{ e($item['kategori']) }}'
                                        )">

                                    <div class="mk-img-frame">
                                        <img src="{{ $item['foto_url'] }}" alt="{{ $item['nama'] }}">
                                    </div>

                                    <h4 class="mk-name">{{ $item['nama'] }}</h4>
                                    <p class="mk-info">{{ $item['deskripsi'] }}</p>
                                </div>
                            </div>
                        @empty
                            <p class="mk-empty-msg">Belum ada Tokoh Sastra Lisan</p>
                        @endforelse

                    </div>
                </div>
            </div>
        </div>

        {{-- TAB LAIN --}}
        <div class="mahkota-pane" id="mk-literasi">
            <div class="mk-slider-wrapper">

                <div class="mk-arrow mk-prev literasi-prev"><i class="fa-solid fa-chevron-left"></i></div>
                <div class="mk-arrow mk-next literasi-next"><i class="fa-solid fa-chevron-right"></i></div>

                <div class="swiper mahkotaSwiper literasi-swiper">
                    <div class="swiper-wrapper">

                        @forelse ($komunitasLiterasi as $item)
                            <div class="swiper-slide">
                                <div class="mk-card-box"
                                    onclick="openTokohModal(
                                        '{{ e($item['nama']) }}',
                                        '{{ $item['foto_url'] }}',
                                        '{{ e($item['deskripsi']) }}',
                                        '{{ e($item['kategori']) }}'
                                    )">

                                    <div class="mk-img-frame">
                                        <img src="{{ $item['foto_url'] }}" alt="{{ $item['nama'] }}">
                                    </div>

                                    <h4 class="mk-name">{{ $item['nama'] }}</h4>
                                    <p class="mk-info">{{ $item['deskripsi'] }}</p>
                                </div>
                            </div>
                        @empty
                            <p class="mk-empty-msg">Belum ada Komunitas Literasi</p>
                        @endforelse

                    </div>
                </div>
            </div>
        </div>

        <div class="mahkota-pane" id="mk-komunitas">
            <div class="mk-slider-wrapper">

                <div class="mk-arrow mk-prev sastra-prev"><i class="fa-solid fa-chevron-left"></i></div>
                <div class="mk-arrow mk-next sastra-naxt"><i class="fa-solid fa-chevron-right"></i></div>

                <div class="swiper mahkotaSwiper sastra-swiper">
                    <div class="swiper-wrapper">

                        @forelse ($komunitasSastra as $item)
                            <div class="swiper-slide">
                                <div class="mk-card-box"
                                    onclick="openTokohModal(
                                        '{{ e($item['nama']) }}',
                                        '{{ $item['foto_url'] }}',
                                        '{{ e($item['deskripsi']) }}',
                                        '{{ e($item['kategori']) }}'
                                    )">

                                    <div class="mk-img-frame">
                                        <img src="{{ $item['foto_url'] }}" alt="{{ $item['nama'] }}">
                                    </div>

                                    <h4 class="mk-name">{{ $item['nama'] }}</h4>
                                    <p class="mk-info">{{ $item['deskripsi'] }}</p>
                                </div>
                            </div>
                        @empty
                            <p class="mk-empty-msg">Belum ada Komunitas Sastra</p>
                        @endforelse

                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

{{-- =================================================
     MODAL TOKOH (PAKAI YANG SAMA, JANGAN DUPLIKASI)
     ================================================= --}}
<div class="custom-modal" id="modalTokoh">
    <div class="modal-backdrop" onclick="closeTokohModal()"></div>

    <div class="modal-panel">

        <button class="close-btn" onclick="closeTokohModal()">
            <i class="fa-solid fa-xmark"></i>
        </button>

        <div class="modal-inner">

            <div class="modal-left">
                <img id="mFoto" src="" alt="Foto Tokoh">
            </div>

            <div class="modal-right">
                <div>
                    <span id="mKategori" class="modal-tag"></span>
                    <h3 id="mNama" class="modal-title"></h3>
                    <div class="modal-divider"></div>
                    <p id="mDesc" class="modal-desc"></p>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        if (typeof Swiper === "undefined") return;

        const swipers = {
            tokoh: new Swiper(".tokoh-swiper", {
                slidesPerView: 1,
                spaceBetween: 15,
                loop: true,
                navigation: {
                    nextEl: ".tokoh-next",
                    prevEl: ".tokoh-prev",
                },
                breakpoints: {
                    768: {
                        slidesPerView: 3
                    },
                    1024: {
                        slidesPerView: 4
                    },
                },
            }),

            literasi: new Swiper(".literasi-swiper", {
                slidesPerView: 1,
                spaceBetween: 15,
                loop: true,
                navigation: {
                    nextEl: ".literasi-next",
                    prevEl: ".literasi-prev",
                },
                breakpoints: {
                    768: {
                        slidesPerView: 3
                    },
                    1024: {
                        slidesPerView: 4
                    },
                },
            }),

            sastra: new Swiper(".sastra-swiper", {
                slidesPerView: 1,
                spaceBetween: 15,
                loop: true,
                navigation: {
                    nextEl: ".sastra-next",
                    prevEl: ".sastra-prev",
                },
                breakpoints: {
                    768: {
                        slidesPerView: 3
                    },
                    1024: {
                        slidesPerView: 4
                    },
                },
            }),
        };

        // ==========================
        // TAB SWITCH LOGIC
        // ==========================
        document.querySelectorAll(".mk-tab-btn").forEach((tab) => {
            tab.addEventListener("click", function() {
                document
                    .querySelectorAll(".mk-tab-btn")
                    .forEach((t) => t.classList.remove("active"));
                this.classList.add("active");

                const target = this.dataset.tab;

                document
                    .querySelectorAll(".mahkota-pane")
                    .forEach((p) => p.classList.remove("active"));

                const pane = document.getElementById(target);
                if (pane) pane.classList.add("active");

                setTimeout(() => {
                    if (target === "mk-tokoh") swipers.tokoh.update();
                    if (target === "mk-literasi") swipers.literasi.update();
                    if (target === "mk-komunitas") swipers.sastra.update();
                }, 80);
            });
        });
    });
</script>
