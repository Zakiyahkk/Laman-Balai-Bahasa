<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<section class="tokoh-section">
    <div class="tokoh-container">

        <div class="tokoh-header" style="margin-top: -40px;">
            <h2 class="section-title">
                Tokoh <span>Bahasa dan Sastra Riau</span>
            </h2>
        </div>

        <div class="slider-wrapper-relative" style="margin-top: -70px;">

            <div class="tokoh-next"><i class="fa-solid fa-chevron-right"></i></div>
            <div class="tokoh-prev"><i class="fa-solid fa-chevron-left"></i></div>

            <div class="swiper tokohSlider">
                <div class="swiper-wrapper">

                    @foreach ($tokoh as $item)
                        <div class="swiper-slide">
                            <div class="tokoh-card"
                                onclick="openTokohModal(
                                    '{{ e($item['nama']) }}',
                                    '{{ $item['foto_url'] }}',
                                    '{{ e($item['deskripsi']) }}',
                                    '{{ e($item['kategori']) }}'
                                )">
                                <div class="card-img-wrapper">
                                    <img src="{{ $item['foto_url'] }}" alt="{{ $item['nama'] }}">
                                </div>
                                <div class="tokoh-info">
                                    <h3>{{ $item['nama'] }}</h3>
                                    <p>{{ $item['deskripsi'] }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>

    </div>
</section>

{{-- ===================== --}}
{{-- MODAL TOKOH --}}
{{-- ===================== --}}
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
