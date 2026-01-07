@extends('admin.layout')

@section('content')
<!-- =================  SECTION LAYOUT ATAS ================= -->
<div class="page-header d-flex justify-content-between align-items-center mb-4">
    <div>
          <h2 class="text-xl font-bold text-gray-900">Detail Media</h2>
                <p class="text-sm text-gray-500 mt-1">Halaman ini untuk Mengedit informasi media Anda</p>
    </div>

    <div class="header-logo">
        <img src="/img/logobbpr.png"
             alt="Logo Balai Bahasa Provinsi Riau"
             class="img-fluid header-logo">
    </div>
</div>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
    .font-inter { font-family: 'Inter', sans-serif; }
</style>
<script src="https://cdn.tailwindcss.com"></script>

<div class="p-1 md:p-3 bg-[#E5F7FF] min-h-screen font-inter">
    <div class="w-full min-h-[calc(100vh-80px)] bg-white rounded-xl shadow-sm border border-gray-100 flex flex-col">
        
        <div class="p-6 pb-0 flex justify-between items-start">
            <div>
            
            </div>
            <button class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <div class="p-6 space-y-6">
            <div class="w-full rounded-2xl overflow-hidden shadow-sm">
                <img src="https://images.unsplash.com/photo-1513519245088-0e12902e5a38?q=80&w=1000" 
                     alt="Preview" class="w-full h-72 object-cover">
            </div>

            <form action="#" method="POST" class="space-y-4">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-800 mb-1.5">Judul Media</label>
                        <input type="text" value="Workshop Penulisan Kreatif" 
                            class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-gray-700 focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition">
                    </div>

                    <div class="relative">
                        <label class="block text-sm font-semibold text-gray-800 mb-1.5">Kategori</label>
                        <select class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-gray-700 appearance-none focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition cursor-pointer">
                            <option value="acara" selected> Tipe Kategori </option>
                            <option value="kegiatan">Kegiatan</option>
                            <option value="publikasi">Publikasi</option>
                        </select>
                        <div class="absolute right-4 top-[38px] pointer-events-none text-gray-400">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>

                    <div class="relative">
                        <label class="block text-sm font-semibold text-gray-800 mb-1.5">Tipe Media</label>
                        <select class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-gray-700 appearance-none focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition cursor-pointer">
                            <option value="foto" selected>Tipe Media</option>
                            <option value="video">Foto</option>
                            <option value="video">Video</option>
                        </select>
                        <div class="absolute right-4 top-[38px] pointer-events-none text-gray-400">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-800 mb-1.5">Tanggal Upload</label>
                        <input type="text" value="8 Des 2024" 
                            class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-gray-700 focus:outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-1.5">Ukuran File</label>
                    <input type="text" value="1.8 MB" 
                        class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-gray-700 focus:outline-none">
                </div>

                <hr class="border-gray-100 my-6">

                <div class="flex flex-wrap items-center justify-between gap-4">
                    <button type="button" class="px-6 py-2.5 bg-white border border-white-200 hover:bg-white-50 text-white-700 font-bold rounded-lg transition flex items-center gap-2 active:scale-95">
                    </button>
                    
                    <div class="flex items-center gap-3">
                        <button type="button" class="px-6 py-2.5 bg-rose-600 hover:bg-rose-700 text-white font-bold rounded-lg transition active:scale-95 shadow-sm shadow-rose-200">
                            Batal
                        </button>
                        <button type="button" class="px-6 py-2.5 bg-[#067ac1] hover:bg-[#056ba9] text-white font-bold rounded-lg transition flex items-center gap-2 active:scale-95">
                            Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
