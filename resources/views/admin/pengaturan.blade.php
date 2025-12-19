@extends('admin.layout')

@section('content')
<!-- =================  SECTION LAYOUT ATAS ================= -->
<div class="page-header d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="mb-1">Pengaturan</h3>
        <p class="text-muted mb-0">
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
        /* Animasi untuk toggle switch */
        .dot { transition: all 0.3s ease-in-out; }
        input:checked ~ .dot { transform: translateX(100%); background-color: #ffffff; }
        input:checked ~ .block-bg { background-color: #0d9488; }
    </style>
</head>
<body class="bg-white p-4 md:p-10 text-gray-800">

    <div class="max-w-full space-y-6">

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <div class="flex items-start gap-4 mb-6">
                <div class="p-3 bg-teal-50 text-teal-600 rounded-lg">
                    <i class="fa-solid fa-globe text-xl"></i>
                </div>
                <div>
                    <h2 class="font-bold text-lg">Pengaturan Website</h2>
                    <p class="text-sm text-gray-500">Atur informasi dasar website</p>
                </div>
            </div>

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Nama Website</label>
                    <input type="text" value="Balai Bahasa Provinsi Riau" class="w-full p-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Deskripsi</label>
                    <textarea rows="3" class="w-full p-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 outline-none">Lembaga yang bertugas melaksanakan pengembangan dan pembinaan bahasa dan sastra di wilayah Provinsi Riau</textarea>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Email</label>
                        <input type="email" value="info@balaibahasa-riau.go.id" class="w-full p-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Telepon</label>
                        <input type="text" value="(0761) 123456" class="w-full p-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 outline-none">
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <div class="flex items-start gap-4 mb-6">
                <div class="p-3 bg-green-50 text-green-600 rounded-lg">
                    <i class="fa-regular fa-bell text-xl"></i>
                </div>
                <div>
                    <h2 class="font-bold text-lg">Notifikasi</h2>
                    <p class="text-sm text-gray-500">Kelola preferensi notifikasi</p>
                </div>
            </div>

            <div class="divide-y divide-gray-100">
                <div class="flex items-center justify-between py-4">
                    <div>
                        <h3 class="font-semibold">Artikel Baru</h3>
                        <p class="text-xs text-gray-500">Notifikasi saat artikel baru dipublikasikan</p>
                    </div>
                    <label class="flex items-center cursor-pointer">
                        <div class="relative">
                            <input type="checkbox" class="sr-only" checked>
                            <div class="block-bg bg-teal-600 w-10 h-6 rounded-full"></div>
                            <div class="dot absolute left-1 top-1 bg-white w-4 h-4 rounded-full transition"></div>
                        </div>
                    </label>
                </div>
                <div class="flex items-center justify-between py-4">
                    <div>
                        <h3 class="font-semibold">Kegiatan Mendatang</h3>
                        <p class="text-xs text-gray-500">Pengingat kegiatan yang akan berlangsung</p>
                    </div>
                    <label class="flex items-center cursor-pointer">
                        <div class="relative">
                            <input type="checkbox" class="sr-only" checked>
                            <div class="block-bg bg-teal-600 w-10 h-6 rounded-full"></div>
                            <div class="dot absolute left-1 top-1 bg-white w-4 h-4 rounded-full transition"></div>
                        </div>
                    </label>
                </div>
                <div class="flex items-center justify-between py-4">
                    <div>
                        <h3 class="font-semibold">Email Notifikasi</h3>
                        <p class="text-xs text-gray-500">Terima notifikasi melalui email</p>
                    </div>
                    <label class="flex items-center cursor-pointer">
                        <div class="relative">
                            <input type="checkbox" class="sr-only">
                            <div class="block-bg bg-gray-300 w-10 h-6 rounded-full"></div>
                            <div class="dot absolute left-1 top-1 bg-white w-4 h-4 rounded-full transition"></div>
                        </div>
                    </label>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <div class="flex items-start gap-4 mb-6">
                <div class="p-3 bg-red-50 text-red-500 rounded-lg">
                    <i class="fa-solid fa-lock text-xl"></i>
                </div>
                <div>
                    <h2 class="font-bold text-lg">Keamanan</h2>
                    <p class="text-sm text-gray-500">Pengaturan keamanan akun</p>
                </div>
            </div>

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Password Saat Ini</label>
                    <input type="password" value="********" class="w-full p-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Password Baru</label>
                    <input type="password" value="********" class="w-full p-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Konfirmasi Password Baru</label>
                    <input type="password" value="********" class="w-full p-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 outline-none">
                </div>
                <button class="bg-red-600 hover:bg-red-700 text-white px-4 py-2.5 rounded-lg font-medium transition duration-200">
                    Update Password
                </button>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <div class="flex items-start gap-4 mb-6">
                <div class="p-3 bg-cyan-50 text-cyan-600 rounded-lg">
                    <i class="fa-solid fa-database text-xl"></i>
                </div>
                <div>
                    <h2 class="font-bold text-lg">Backup Database</h2>
                    <p class="text-sm text-gray-500">Kelola backup data sistem</p>
                </div>
            </div>

            <div class="bg-gray-50 p-4 rounded-xl flex items-center justify-between mb-6">
                <div>
                    <h3 class="font-semibold text-gray-700">Backup Terakhir</h3>
                    <p class="text-sm text-gray-500">12 Desember 2024, 03:00 WIB</p>
                </div>
                <button class="bg-cyan-600 hover:bg-cyan-700 text-white px-5 py-2 rounded-lg font-medium text-sm transition">
                    Backup Sekarang
                </button>
            </div>

            <div class="flex items-center justify-between">
                <div>
                    <h3 class="font-semibold">Auto Backup</h3>
                    <p class="text-xs text-gray-500">Backup otomatis setiap hari pukul 03:00 WIB</p>
                </div>
                <label class="flex items-center cursor-pointer">
                    <div class="relative">
                        <input type="checkbox" class="sr-only" checked>
                        <div class="block-bg bg-teal-600 w-10 h-6 rounded-full"></div>
                        <div class="dot absolute left-1 top-1 bg-white w-4 h-4 rounded-full transition"></div>
                    </div>
                </label>
            </div>
        </div>

        <div class="flex justify-start pt-4">
            <button class="flex items-center gap-2 bg-teal-600 hover:bg-teal-700 text-white px-10 py-3.5 rounded-xl font-bold shadow-md transition transform active:scale-95">
                <i class="fa-solid fa-floppy-disk"></i>
                Simpan Perubahan
            </button>
        </div>
    </div>
</body>
</html>
</div>
@endsection
