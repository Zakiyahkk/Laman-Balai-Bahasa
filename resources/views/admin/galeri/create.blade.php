@extends('admin.layout')

@section('content')
<!-- =================  SECTION LAYOUT ATAS ================= -->
<div class="page-header d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="text-xl font-bold text-gray-900">Upload Media</h2>
        <p class="text-muted mb-0">
            Halaman ini untuk mengupload media yang akan dipublikasikan di Balai Bahasa Provinsi Riau
        </p>
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
           <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col flex-1">
            @csrf
            
            <div class="p-6 md:p-10 space-y-6 flex-1">
                
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Judul Media</label>
                    <input type="text" name="judul" required placeholder="Masukkan judul utama media..." 
                        class="w-full px-3 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:outline-none focus:ring-2 focus:ring-[#00897b] focus:bg-white transition text-gray-700">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="relative">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Tipe Media</label>
                        <select name="tipe" id="tipeMedia" class="w-full px-3 py-3 border border-gray-200 
                        rounded-xl bg-gray-50 appearance-none focus:outline-none focus:ring-2 
                        focus:ring-[#00897b] cursor-pointer text-gray-700">
                            <option value="" disabled selected>Pilih Tipe Media...</option>
                            <option value="foto" > Foto (Gambar) </option>
                            <option value="video"> Video (MP4/MKV)</option>
                        </select>
                        <div class="absolute right-4 top-[42px] pointer-events-none text-gray-400">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"><path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" /></svg>
                        </div>
                    </div>

                    <div class="relative">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori</label>
                        <select name="kategori" id="kategoriMedia" required class="w-full px-3 py-3 border border-gray-200 rounded-xl bg-gray-50 appearance-none focus:outline-none focus:ring-2 focus:ring-[#00897b] cursor-pointer text-gray-700">
                            <option value="" disabled selected>Pilih kategori...</option>
                            <option value="kegiatan">Kegiatan</option>
                            <option value="publikasi">Publikasi</option>
                            <option value="acara">Acara</option>
                            <option value="dokumentasi">Dokumentasi</option>
                        </select>
                        <div class="absolute right-4 top-[42px] pointer-events-none text-gray-400">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"><path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" /></svg>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">File Media (Maksimal 10)</label>
                    <input type="file" name="files[]" id="fileInput" class="hidden" accept="image/*,video/*" multiple required>
                    
                    <div id="dropzone" class="border-4 border-dashed border-gray-200 rounded-3xl min-h-[350px] flex flex-col items-center justify-center bg-gray-50 hover:bg-teal-50/50 hover:border-[#00897b]/50 transition-all cursor-pointer overflow-hidden relative group p-6">
                        
                        <div id="defaultContent" class="flex flex-col items-center p-12 text-center group-hover:scale-105 transition-transform duration-300">
                            <div class="bg-blue-100 p-6 rounded-full mb-6">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-[#00897b]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800">Klik atau seret hingga 10 file ke sini</h3>
                            <p class="text-gray-500 mt-2 font-medium">Mendukung Foto (PNG, JPG) atau Video (MP4)</p>
                            <span class="mt-4 px-6 py-2 bg-white border border-gray-300 rounded-lg text-sm font-semibold shadow-sm group-hover:bg-gray-50 transition">Pilih File</span>
                        </div>

                        <div id="previewGrid" class="hidden grid grid-cols-2 md:grid-cols-5 gap-4 w-full z-10">
                            </div>

                        <div id="overlayAction" class="hidden absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center z-20">
                            <button type="button" onclick="resetUpload(event)" class="bg-white text-gray-900 px-8 py-3 rounded-full font-bold uppercase text-xs tracking-widest shadow-2xl active:scale-95 transition">Ganti Semua File</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end gap-4 p-8 border-t border-gray-100 bg-gray-50/50">
                <button type="button" onclick="history.back()" class="px-8 py-2.5 bg-[#EB1212] border border-red-600 rounded-lg text-sm font-bold text-white hover:bg-red-700 transition shadow-sm active:scale-95">
                    Batal
                </button>
                <button type="submit" id="submitBtn" class="px-10 py-2.5 bg-[#067ac1] text-white rounded-lg text-sm font-bold hover:bg-[#00796b] transition shadow-lg shadow-teal-900/10 active:scale-95">
                    Upload Media
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    const fileInput = document.getElementById('fileInput');
    const dropzone = document.getElementById('dropzone');
    const previewGrid = document.getElementById('previewGrid');
    const defaultContent = document.getElementById('defaultContent');
    const overlayAction = document.getElementById('overlayAction');
    const fileCounter = document.getElementById('fileCounter');

    dropzone.addEventListener('click', () => fileInput.click());

    fileInput.addEventListener('change', function() {
        const files = Array.from(this.files);
        
        if (files.length > 10) {
            alert("Anda hanya dapat mengunggah maksimal 10 file.");
            this.value = ""; 
            return;
        }

        if (files.length > 0) {
            previewGrid.innerHTML = ''; 
            previewGrid.classList.remove('hidden');
            previewGrid.classList.add('grid');
            defaultContent.classList.add('hidden');
            overlayAction.classList.remove('hidden');
            fileCounter.classList.remove('hidden');
            fileCounter.innerText = `${files.length} / 10 File Terpilih`;

            files.forEach(file => {
                const wrapper = document.createElement('div');
                wrapper.className = "relative aspect-square bg-gray-100 rounded-xl overflow-hidden border border-gray-200 group/item";

                // Preview untuk GAMBAR
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        wrapper.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover">`;
                    }
                    reader.readAsDataURL(file);
                } 
                
                // Preview untuk VIDEO (Perubahan di sini)
                else if (file.type.startsWith('video/')) {
                    const videoUrl = URL.createObjectURL(file);
                    wrapper.innerHTML = `
                        <video src="${videoUrl}#t=0.5" class="w-full h-full object-cover" muted></video>
                        <div class="absolute inset-0 flex items-center justify-center bg-black/20 pointer-events-none">
                            <svg class="w-8 h-8 text-white drop-shadow-md" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="absolute bottom-0 inset-x-0 bg-black/50 p-1">
                            <p class="text-[8px] text-white truncate text-center">${file.name}</p>
                        </div>
                    `;
                }
                
                previewGrid.appendChild(wrapper);
            });
        }
    });

    function resetUpload(event) {
        event.stopPropagation();
        fileInput.value = "";
        previewGrid.innerHTML = "";
        previewGrid.classList.add('hidden');
        previewGrid.classList.remove('grid');
        defaultContent.classList.remove('hidden');
        overlayAction.classList.add('hidden');
        fileCounter.classList.add('hidden');
    }
</script>
@endsection