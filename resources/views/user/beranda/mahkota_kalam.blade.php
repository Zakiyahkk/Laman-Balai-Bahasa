<section class="mahkota-kalam">
    <div class="container">

        <div class="section-header">
            <h2>Mahkota Kalam Melayu Riau</h2>
            <p>Tokoh dan Komunitas Penggerak Bahasa dan Sastra Melayu</p>
        </div>

        <!-- TAB -->
        <div class="mahkota-tabs">
            <button class="mk-tab active" data-tab="mk-tokoh">Tokoh Sastra Lisan</button>
            <button class="mk-tab" data-tab="mk-literasi">Komunitas Literasi</button>
            <button class="mk-tab" data-tab="mk-komunitas">Komunitas Sastra</button>
        </div>

        <!-- CONTENT -->
        <div class="mahkota-content active" id="mk-tokoh">
            <div class="mk-grid">
                <div class="mk-card">
                    <img src="{{ asset('img/maskot-serindit.png') }}">
                    <h4>Nama Tokoh</h4>
                    <span>Sastrawan</span>
                </div>
                <div class="mk-card">
                    <img src="{{ asset('img/tokoh/tokoh2.png') }}">
                    <h4>Nama Tokoh</h4>
                    <span>Penyair</span>
                </div>
            </div>
        </div>

        <div class="mahkota-content" id="mk-lisan">
            <p class="empty">Data sastra lisan belum tersedia</p>
        </div>

        <div class="mahkota-content" id="mk-literasi">
            <p class="empty">Data komunitas literasi belum tersedia</p>
        </div>

        <div class="mahkota-content" id="mk-komunitas">
            <p class="empty">Data komunitas sastra belum tersedia</p>
        </div>

    </div>
</section>
