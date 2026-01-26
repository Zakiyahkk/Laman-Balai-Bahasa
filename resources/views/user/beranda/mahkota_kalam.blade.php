<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<section class="mahkota-section" style="margin-top: -90px;">
    <div class="mahkota-container">

        <div class="mahkota-header">
            <div class="mahkota-title-group">
                <h2 class="mahkota-main-title">Mahkota Kalam Melayu Riau</h2>
            </div>
            <p class="mahkota-sub-text">Tokoh dan Komunitas Penggerak Bahasa dan Sastra Melayu</p>
        </div>

        <div class="mahkota-tabs">
            <button class="mk-tab-btn active" data-tab="mk-tokoh">Tokoh Sastra Lisan</button>
            <button class="mk-tab-btn" data-tab="mk-literasi">Komunitas Literasi</button>
            <button class="mk-tab-btn" data-tab="mk-komunitas">Komunitas Sastra</button>
        </div>

        <div class="mahkota-pane active" id="mk-tokoh">
            <div class="mk-slider-wrapper">
                <div class="mk-arrow mk-prev"><i class="fa-solid fa-chevron-left"></i></div>
                <div class="mk-arrow mk-next"><i class="fa-solid fa-chevron-right"></i></div>

                <div class="swiper mahkotaSwiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="mk-card-box">
                                <div class="mk-img-frame">
                                    <img src="{{ asset('img/maskot-serindit.png') }}" alt="Tokoh">
                                </div>
                                <h4 class="mk-name">Raja Ali Haji</h4>
                                <p class="mk-info">Bapak Bahasa Indonesia</p>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="mk-card-box">
                                <div class="mk-img-frame">
                                    <img src="{{ asset('img/maskot-serindit.png') }}" alt="Tokoh">
                                </div>
                                <h4 class="mk-name">Raja Ali Haji</h4>
                                <p class="mk-info">Bapak Bahasa Indonesia</p>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="mk-card-box">
                                <div class="mk-img-frame">
                                    <img src="{{ asset('img/maskot-serindit.png') }}" alt="Tokoh">
                                </div>
                                <h4 class="mk-name">Raja Ali Haji</h4>
                                <p class="mk-info">Bapak Bahasa Indonesia</p>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="mk-card-box">
                                <div class="mk-img-frame">
                                    <img src="{{ asset('img/maskot-serindit.png') }}" alt="Tokoh">
                                </div>
                                <h4 class="mk-name">Raja Ali Haji</h4>
                                <p class="mk-info">Bapak Bahasa Indonesia</p>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="mk-card-box">
                                <div class="mk-img-frame">
                                    <img src="{{ asset('img/maskot-serindit.png') }}" alt="Tokoh">
                                </div>
                                <h4 class="mk-name">Raja Ali Haji</h4>
                                <p class="mk-info">Bapak Bahasa Indonesia</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mahkota-pane" id="mk-literasi">
            <p class="mk-empty-msg">Data belum tersedia</p>
        </div>
        <div class="mahkota-pane" id="mk-komunitas">
            <p class="mk-empty-msg">Data belum tersedia</p>
        </div>

    </div>
</section>
<div class="custom-modal" id="modalTokoh">
    <div class="modal-backdrop" onclick="closeTokohModal()"></div>
    <div class="modal-panel">

        <button class="close-btn" onclick="closeTokohModal()"><i class="fa-solid fa-xmark"></i></button>

        <div class="modal-left">
            <img id="mFoto" src="" alt="Foto">
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
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
