<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<section class="tokoh-section">
    <div class="tokoh-container">

        <div class="tokoh-header">
            <h2 class="section-title">
                Tokoh <span>Bahasa dan Sastra</span>
            </h2>
        </div>

        <div class="slider-wrapper-relative">

            <div class="tokoh-next"><i class="fa-solid fa-chevron-right"></i></div>
            <div class="tokoh-prev"><i class="fa-solid fa-chevron-left"></i></div>

            <div class="swiper tokohSlider">
                <div class="swiper-wrapper">

                    <div class="swiper-slide">
                        <div class="tokoh-card" onclick="openTokohModal('Raja Ali Haji', 'img/maskot-serindit.png', 'Pahlawan Nasional di bidang bahasa. Terkenal dengan karya Gurindam Dua Belas.', 'bahasa')">
                            <div class="card-img-wrapper">
                                <span class="label-tokoh bg-blue">Tokoh Bahasa</span>
                                <img src="img/maskot-serindit.png" alt="Raja Ali Haji">
                            </div>
                            <div class="tokoh-info">
                                <h3>Raja Ali Haji</h3>
                                <p>Bapak Bahasa Indonesia</p>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="tokoh-card" onclick="openTokohModal('Soeman Hs', 'img/maskot-serindit.png', 'Sastrawan pelopor angkatan Balai Pustaka. Bapak cerita detektif Indonesia.', 'sastra')">
                            <div class="card-img-wrapper">
                                <span class="label-tokoh bg-orange">Tokoh Sastra</span>
                                <img src="img/maskot-serindit.png" alt="Soeman Hs">
                            </div>
                            <div class="tokoh-info">
                                <h3>Soeman Hs</h3>
                                <p>Pelopor Cerita Detektif</p>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="tokoh-card" onclick="openTokohModal('Chairil Anwar', 'img/maskot-serindit.png', 'Penyair terkemuka Indonesia. Pelopor Angkatan 45.', 'sastra')">
                            <div class="card-img-wrapper">
                                <span class="label-tokoh bg-orange">Tokoh Sastra</span>
                                <img src="img/maskot-serindit.png" alt="Chairil Anwar">
                            </div>
                            <div class="tokoh-info">
                                <h3>Chairil Anwar</h3>
                                <p>Si Binatang Jalang</p>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="tokoh-card" onclick="openTokohModal('Sutan Takdir A.', 'img/maskot-serindit.png', 'Sastrawan dan ahli tata bahasa Indonesia.', 'bahasa')">
                            <div class="card-img-wrapper">
                                <span class="label-tokoh bg-blue">Tokoh Bahasa</span>
                                <img src="img/maskot-serindit.png" alt="Sutan Takdir">
                            </div>
                            <div class="tokoh-info">
                                <h3>Sutan Takdir A.</h3>
                                <p>Tokoh Pujangga Baru</p>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="tokoh-card" onclick="openTokohModal('Tenas Effendy', 'img/maskot-serindit.png', 'Budayawan Riau yang menjaga Tunjuk Ajar Melayu.', 'budaya')">
                            <div class="card-img-wrapper">
                                <span class="label-tokoh bg-green">Tokoh Budaya</span>
                                <img src="img/maskot-serindit.png" alt="Tenas Effendy">
                            </div>
                            <div class="tokoh-info">
                                <h3>Tenas Effendy</h3>
                                <p>Tunjuk Ajar Melayu</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
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