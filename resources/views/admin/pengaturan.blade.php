@extends('admin.layout')

@section('content')
<!-- =================  SECTION LAYOUT ATAS ================= -->
<div class="flex justify-between items-start mb-8 w-full">
    
    <div class="flex flex-col">
        <h3 class="text-3xl font-semi bold text-gray-800 leading-none">Pengaturan</h3>
        <p class="text-gray-500 text-sm mt-2">
            Halaman ini untuk mengelola alinea yang dipublikasikan di Balai Bahasa Provinsi Riau
        </p>
    </div>

    <div class="header-logo">
        <img src="/img/logo.png"
             alt="Logo Balai Bahasa Provinsi Riau"
             class="img-fluid header-logo">
    </div>
</div>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* CSS untuk Toggle Switch agar berubah warna saat mati */
        .dot { transition: all 0.3s ease-in-out; }
        input:checked ~ .dot { transform: translateX(100%); }
        
        /* Warna saat AKTIF (Teal) */
        input:checked ~ .switch-bg { background-color: #0d9488; }
        
        /* Warna saat MATI (Abu-abu) - Menjawab permintaan Anda */
        input:not(:checked) ~ .switch-bg { background-color: #d1d5db; }
    </style>
</head>
<body class=>

    <div class="w-full space-y-6">

        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm w-full">
            <div class="flex items-center gap-4 mb-8">
                <div class="p-3 bg-teal-50 text-teal-600 rounded-xl">
                    <i class="fa-solid fa-globe text-xl"></i>
                </div>
                <div>
                    <h2 class="font-bold text-lg leading-tight">Pengaturan Website</h2>
                    <p class="text-sm text-gray-400">Atur informasi dasar website</p>
                </div>
            </div>

            <div class="space-y-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-2">Nama Website</label>
                    <input type="text" value="Balai Bahasa Provinsi Riau" class="w-full p-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-teal-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-2">Deskripsi</label>
                    <textarea rows="4" class="w-full p-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-teal-500 outline-none resize-none">Lembaga yang bertugas melaksanakan pengembangan dan pembinaan bahasa dan sastra di wilayah Provinsi Riau</textarea>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-2">Email</label>
                        <input type="email" value="info@balaibahasa-riau.go.id" class="w-full p-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-teal-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-2">Telepon</label>
                        <input type="text" value="(0761) 123456" class="w-full p-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-teal-500 outline-none">
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm w-full">
            <div class="flex items-center gap-4 mb-8">
                <div class="p-3 bg-green-50 text-green-600 rounded-xl">
                    <i class="fa-regular fa-bell text-xl"></i>
                </div>
                <div>
                    <h2 class="font-bold text-lg leading-tight">Notifikasi</h2>
                    <p class="text-sm text-gray-400">Kelola preferensi notifikasi</p>
                </div>
            </div>

            <div class="divide-y divide-gray-100">
                <div class="flex items-center justify-between py-5">
                    <div>
                        <h3 class="font-bold text-gray-700">Artikel Baru</h3>
                        <p class="text-sm text-gray-400">Notifikasi saat artikel baru dipublikasikan</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer" checked>
                        <div class="switch-bg w-11 h-6 rounded-full transition-colors duration-200"></div>
                        <div class="dot absolute left-[2px] top-[2px] bg-white w-5 h-5 rounded-full transition-transform duration-200 shadow-sm"></div>
                    </label>
                </div>
                <div class="flex items-center justify-between py-5">
                    <div>
                        <h3 class="font-bold text-gray-700">Kegiatan Mendatang</h3>
                        <p class="text-sm text-gray-400">Pengingat kegiatan yang akan berlangsung</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer" checked>
                        <div class="switch-bg w-11 h-6 rounded-full transition-colors duration-200"></div>
                        <div class="dot absolute left-[2px] top-[2px] bg-white w-5 h-5 rounded-full transition-transform duration-200 shadow-sm"></div>
                    </label>
                </div>
                <div class="flex items-center justify-between py-5">
                    <div>
                        <h3 class="font-bold text-gray-700">Email Notifikasi</h3>
                        <p class="text-sm text-gray-400">Terima notifikasi melalui email</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer">
                        <div class="switch-bg w-11 h-6 rounded-full transition-colors duration-200"></div>
                        <div class="dot absolute left-[2px] top-[2px] bg-white w-5 h-5 rounded-full transition-transform duration-200 shadow-sm"></div>
                    </label>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm w-full">
            <div class="flex items-center gap-4 mb-8">
                <div class="p-3 bg-red-50 text-red-500 rounded-xl">
                    <i class="fa-solid fa-lock text-xl"></i>
                </div>
                <div>
                    <h2 class="font-bold text-lg leading-tight">Keamanan</h2>
                    <p class="text-sm text-gray-400">Pengaturan keamanan akun</p>
                </div>
            </div>

            <div class="space-y-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-2">Password Saat Ini</label>
                    <input type="password" value="********" class="w-full p-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-teal-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-2">Password Baru</label>
                    <input type="password" value="********" class="w-full p-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-teal-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-2">Konfirmasi Password Baru</label>
                    <input type="password" value="********" class="w-full p-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-teal-500 outline-none">
                </div>
                <button class="bg-[#e11d48] hover:bg-red-700 text-white px-6 py-3 rounded-xl font-bold transition duration-200 shadow-sm">
                    Update Password
                </button>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm w-full">
            <div class="flex items-center gap-4 mb-8">
                <div class="p-3 bg-cyan-50 text-cyan-600 rounded-xl">
                    <i class="fa-solid fa-database text-xl"></i>
                </div>
                <div>
                    <h2 class="font-bold text-lg leading-tight">Backup Database</h2>
                    <p class="text-sm text-gray-400">Kelola backup data sistem</p>
                </div>
            </div>

            <div class="bg-gray-50/50 p-5 rounded-2xl flex items-center justify-between mb-8 border border-gray-100">
                <div class="flex flex-col">
                    <span class="font-bold text-gray-700">Backup Terakhir</span>
                    <span class="text-sm text-gray-400">12 Desember 2024, 03:00 WIB</span>
                </div>
                <button class="bg-[#0891b2] hover:bg-cyan-700 text-white px-6 py-2.5 rounded-xl font-bold text-sm transition">
                    Backup Sekarang
                </button>
            </div>

            <div class="flex items-center justify-between px-2">
                <div>
                    <h3 class="font-bold text-gray-700">Auto Backup</h3>
                    <p class="text-sm text-gray-400">Backup otomatis setiap hari pukul 03:00 WIB</p>
                </div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" class="sr-only peer" checked>
                    <div class="switch-bg w-11 h-6 rounded-full transition-colors duration-200"></div>
                    <div class="dot absolute left-[2px] top-[2px] bg-white w-5 h-5 rounded-full transition-transform duration-200 shadow-sm"></div>
                </label>
            </div>
        </div>

        <div class="flex justify-start pt-6">
            <button class="flex items-center gap-3 bg-[#0d9488] hover:bg-teal-700 text-white px-10 py-4 rounded-xl font-bold shadow-lg shadow-teal-100 transition active:scale-95">
                <i class="fa-solid fa-floppy-disk text-lg"></i>
                Simpan Perubahan
            </button>
        </div>

    </div>

</body>
</html>
</div>
@endsection
