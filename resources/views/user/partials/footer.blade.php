<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<footer class="footer-clean">
    <div class="footer-container">
        <div class="footer-grid">

            <div class="footer-brand">
                <div class="footer-logo">
                    <img src="{{ asset('img/logobalai.png') }}" alt="Logo Balai Bahasa Riau">
                </div>
                <p class="footer-desc">
                    Balai Bahasa Provinsi Riau berperan dalam pengembangan,
                    pembinaan, dan pelindungan bahasa serta sastra di Provinsi Riau.
                </p>
                <div class="footer-socials">
                    <a href="#" class="social-icon facebook" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="social-icon instagram" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" class="social-icon tiktok" aria-label="TikTok"><i class="fa-brands fa-tiktok"></i></a>
                    <a href="#" class="social-icon youtube" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
                    <a href="#" class="social-icon whatsapp" aria-label="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
                    <a href="mailto:balaibahasaprovriau@gmail.com" class="social-icon email" aria-label="Email"><i class="fa-solid fa-envelope"></i></a>
                </div>
            </div>

            <div class="footer-links">
                <h4>Tautan Cepat</h4>
                <ul>
                    <li><a href="/">Beranda</a></li>
                    <li><a href="/profil/struktur-organisasi">Struktur Organisasi</a></li>
                    <li><a href="/akuntabilitas/renstra">Akuntabilitas</a></li>
                    <li><a href="/produk/jurnal">Jurnal & Terbitan</a></li>
                    <li><a href="/ppid/ppid">Layanan PPID</a></li>
                </ul>
            </div>

            <div class="footer-stats-wrapper">
                <h4>Statistik Pengunjung</h4>
                <div class="stats-counter-box">
                    <div class="stat-item">
                        <span class="stat-label">Hari Ini</span>
                        <span class="stat-number">1,204</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-label">Bulan Ini</span>
                        <span class="stat-number">8,530</span>
                    </div>
                </div>
                <div class="footer-chart-container">
                    <div class="chart-header">
                        <h5>Grafik Bulanan</h5>
                    </div>
                    <div class="canvas-holder" style="height: 150px; position: relative;">
                        <canvas id="monthlyVisitorChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="footer-map">
                <h4>Lokasi Kami</h4>
                <p class="footer-address">
                    <i class="fa-solid fa-location-dot" style="color: #facc15; margin-right: 8px;"></i>
                    Jl. HR. Soebrantas Panam No.Km. 12,5, Simpang Baru,<br>
                    Kec. Tuah Madani, Kota Pekanbaru, Riau 28292
                </p>
                <div class="map-responsive" style="overflow:hidden; padding-bottom:56.25%; position:relative; height:0; border-radius: 12px;">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.696155554378!2d101.37433237582572!3d0.4749216637375253!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d5a8e0f9b177d1%3A0x63351f727c593630!2sBalai%20Bahasa%20Provinsi%20Riau!5e0!3m2!1sid!2sid!4v1706000000000!5m2!1sid!2sid"
                        width="100%"
                        height="100%"
                        style="border:0; position:absolute; top:0; left:0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>

        </div>

        <div class="footer-divider"></div>

        <div class="footer-bottom">
            <span>© {{ date('Y') }} <b>Balai Bahasa Provinsi Riau</b>. Hak Cipta Dilindungi.</span>
            <div class="footer-legal">
                <a href="#">Kebijakan Privasi</a>
                <span class="separator">·</span>
                <a href="#">Ketentuan Layanan</a>
            </div>
        </div>
    </div>
</footer>