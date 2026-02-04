<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<footer class="footer-clean">
    <div class="footer-container">
        <div class="footer-grid">

            <div class="footer-brand">
                <div class="footer-logo">
                    {{-- Pastikan file gambar ada di public/img/ --}}
                    <img src="{{ asset('img/logobalai.png') }}" alt="Logo Balai Bahasa Riau">
                </div>
                <p class="footer-desc">
                    Balai Bahasa Provinsi Riau berperan dalam pengembangan,
                    pembinaan, dan pelindungan bahasa serta sastra di Provinsi Riau.
                </p>
                <div style="display: flex; flex-wrap: wrap; gap: 12px; margin-top: 20px;">
                    <a href="https://www.facebook.com/balaibahasa.provinsiriau" target="_blank" class="social-icon facebook" aria-label="Facebook" style="width: 40px; height: 40px; background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #94a3b8; text-decoration: none; font-size: 18px; transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="https://www.instagram.com/balaibahasaprovinsiriau/" target="_blank" class="social-icon instagram" aria-label="Instagram" style="width: 40px; height: 40px; background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #94a3b8; text-decoration: none; font-size: 18px; transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);"><i class="fa-brands fa-instagram"></i></a>
                    <a href="https://www.tiktok.com/@balai.bahasa.riau"  target="_blank" class="social-icon tiktok" aria-label="TikTok" style="width: 40px; height: 40px; background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #94a3b8; text-decoration: none; font-size: 18px; transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);"><i class="fa-brands fa-tiktok"></i></a>
                    <a href="https://www.youtube.com/@balaibahasariau" target="_blank" class="social-icon youtube" aria-label="YouTube" style="width: 40px; height: 40px; background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #94a3b8; text-decoration: none; font-size: 18px; transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);"><i class="fa-brands fa-youtube"></i></a>
                    <a href="https://wa.me/628217788663" target="_blank" class="social-icon whatsapp" aria-label="WhatsApp" style="width: 40px; height: 40px; background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #94a3b8; text-decoration: none; font-size: 18px; transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);"><i class="fa-brands fa-whatsapp"></i></a>
                    <a href="mailto:balaibahasaprovriau@gmail.com" target="_blank" class="social-icon email" aria-label="Email" style="width: 40px; height: 40px; background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #94a3b8; text-decoration: none; font-size: 18px; transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);"><i class="fa-solid fa-envelope"></i></a>
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
                        {{-- Menggunakan ?? 0 untuk mencegah error jika variabel null --}}
                        <span class="stat-number">{{ number_format($visitorToday ?? 0) }}</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-label">Bulan Ini</span>
                        <span class="stat-number">{{ number_format($visitorMonth ?? 0) }}</span>
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
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.682349616947!2d101.37938137477644!3d0.4730259995223464!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d5a853e3083e97%3A0x5c40a215adfd57fd!2sBalai%20Bahasa%20Riau!5e0!3m2!1sid!2sid!4v1769796008583!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>

        </div>

        <div class="footer-divider"></div>

        <div class="footer-bottom">
            {{-- PERBAIKAN: Mengganti karakter '©' (Error Encoding) menjadi simbol Copyright '&copy;' --}}
            <span>&copy; {{ date('Y') }} <b>Balai Bahasa Provinsi Riau</b>. Hak Cipta Dilindungi.</span>
            
            <div class="footer-legal">
                <a href="#">Kebijakan Privasi</a>
                {{-- PERBAIKAN: Mengganti karakter '·' menjadi separator '&middot;' --}}
                <span class="separator">&middot;</span>
                <a href="#">Ketentuan Layanan</a>
            </div>
        </div>
    </div>
</footer>

{{-- SCRIPT CHART JS --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('monthlyVisitorChart');
    // Cek jika elemen chart tidak ada, hentikan script agar tidak error di console
    if (!ctx) return;

    const monthLabels = [
        'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
        'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'
    ];

    // Mengambil data dari controller (pastikan variabel $visitorChart dikirim)
    const rawData = {!! json_encode($visitorChart ?? []) !!};

    // Inisialisasi array 12 bulan dengan nilai 0
    const monthlyData = Array(12).fill(0);

    // Mapping data dari database ke array bulanan
    if(Array.isArray(rawData)){
        rawData.forEach(item => {
            // Pastikan bulan valid (1-12)
            if(item.month >= 1 && item.month <= 12) {
                monthlyData[item.month - 1] = item.total;
            }
        });
    }

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: monthLabels,
            datasets: [{
                data: monthlyData,
                backgroundColor: '#facc15', // Warna Kuning Emas
                borderRadius: 4,
                barThickness: 10
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.parsed.y + ' Pengunjung';
                        }
                    }
                }
            },
            scales: {
                x: { 
                    grid: { display: false },
                    ticks: { 
                        color: '#9ca3af', // Warna teks abu-abu terang
                        font: { size: 10 }
                    }
                },
                y: {
                    beginAtZero: true,
                    ticks: { 
                        precision: 0,
                        color: '#9ca3af',
                        font: { size: 10 }
                    },
                    grid: {
                        color: 'rgba(255, 255, 255, 0.1)' // Grid tipis transparan
                    }
                }
            }
        }
    });
});
</script>