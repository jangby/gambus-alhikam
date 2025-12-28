<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#FEFAE0] leading-tight">
            ⚙️ Pengaturan Website
        </h2>
    </x-slot>

    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto space-y-8">
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-1 space-y-6">
                <div class="bg-white rounded-3xl shadow-sm border border-[#EFEAD8] overflow-hidden relative">
                    <div class="bg-[#FEFAE0] px-6 py-4 border-b border-[#EFEAD8] flex items-center gap-3">
                        <div class="bg-white p-2 rounded-full shadow-sm text-gambus-primary">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                        </div>
                        <h3 class="font-bold text-gambus-primary text-lg">Kontak & Sosmed</h3>
                    </div>

                    <div class="p-6">
                        <form action="{{ route('admin.site.update') }}" method="POST" class="space-y-5">
                            @csrf
                            @method('PUT')
                            
                            <div>
                                <label class="block text-xs font-bold text-gambus-secondary uppercase mb-1.5 ml-1">WhatsApp Admin</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 text-sm font-bold">+</span>
                                    </div>
                                    <input type="number" name="whatsapp_number" value="{{ $settings->whatsapp_number }}" class="w-full pl-7 rounded-xl border-gray-200 focus:border-gambus-secondary focus:ring-gambus-secondary/20 text-sm py-3" placeholder="628123456789">
                                </div>
                                <p class="text-[10px] text-gray-400 mt-1 ml-1">Gunakan format angka saja (cth: 62812...)</p>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gambus-secondary uppercase mb-1.5 ml-1">Alamat Studio/Sekre</label>
                                <textarea name="address" rows="3" class="w-full rounded-xl border-gray-200 focus:border-gambus-secondary focus:ring-gambus-secondary/20 text-sm py-3" placeholder="Jl. Pesantren No...">{{ $settings->address }}</textarea>
                            </div>

                            <div class="space-y-4 pt-2 border-t border-dashed border-gray-100">
                                <div>
                                    <label class="block text-xs font-bold text-gambus-secondary uppercase mb-1.5 ml-1">Link Instagram</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="w-4 h-4 text-pink-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                                        </div>
                                        <input type="url" name="instagram_link" value="{{ $settings->instagram_link }}" class="w-full pl-10 rounded-xl border-gray-200 focus:border-gambus-secondary focus:ring-gambus-secondary/20 text-sm py-3" placeholder="https://instagram.com/...">
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-gambus-secondary uppercase mb-1.5 ml-1">Link Facebook</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 24 24"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/></svg>
                                        </div>
                                        <input type="url" name="facebook_link" value="{{ $settings->facebook_link }}" class="w-full pl-10 rounded-xl border-gray-200 focus:border-gambus-secondary focus:ring-gambus-secondary/20 text-sm py-3" placeholder="https://facebook.com/...">
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="w-full bg-gambus-primary text-white font-bold py-3.5 rounded-xl shadow-lg hover:bg-[#3E2D20] active:scale-95 transition flex justify-center items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                Simpan Kontak
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-3xl shadow-sm border border-[#EFEAD8] overflow-hidden relative">
                    <div class="bg-[#FEFAE0] px-6 py-4 border-b border-[#EFEAD8] flex items-center gap-3">
                        <div class="bg-white p-2 rounded-full shadow-sm text-gambus-primary">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                        </div>
                        <h3 class="font-bold text-gambus-primary text-lg">Galeri Momen</h3>
                    </div>

                    <div class="p-6">
                        <div class="bg-[#FDFCF8] rounded-2xl p-5 border border-dashed border-gambus-secondary/40 mb-8">
                            <h4 class="text-sm font-bold text-gambus-primary mb-3">Upload Foto Baru</h4>
                            
                            <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col md:flex-row gap-4 items-end">
                                @csrf
                                <div class="w-full md:flex-1">
                                    <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1 ml-1">Judul Foto</label>
                                    <input type="text" name="title" required class="w-full rounded-xl border-gray-200 focus:border-gambus-secondary focus:ring-gambus-secondary/20 text-sm" placeholder="Cth: Wedding di Hotel X">
                                </div>
                                <div class="w-full md:w-auto">
                                    <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1 ml-1">File Foto</label>
                                    <label class="flex items-center gap-2 cursor-pointer bg-white border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-500 hover:border-gambus-secondary hover:text-gambus-primary transition w-full md:w-auto justify-center">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                                        <span class="truncate max-w-[100px]">Pilih File...</span>
                                        <input type="file" name="image" class="hidden" onchange="this.previousElementSibling.innerText = this.files[0].name">
                                    </label>
                                </div>
                                <button type="submit" class="w-full md:w-auto bg-gambus-secondary text-white font-bold py-2.5 px-6 rounded-xl shadow-md hover:bg-[#B08968] active:scale-95 transition flex items-center justify-center gap-2">
                                    Upload
                                </button>
                            </form>
                            <p class="text-[10px] text-gray-400 mt-2">*Foto akan otomatis dikompres ke format .webp agar ringan.</p>
                        </div>

                        @if($galleries->count() > 0)
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                                @foreach($galleries as $gallery)
                                <div class="group relative rounded-2xl overflow-hidden shadow-sm border border-gray-100 bg-gray-50 aspect-square">
                                    <img src="{{ asset('storage/' . $gallery->image_path) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                    
                                    <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition duration-300 flex flex-col justify-end p-3">
                                        <p class="text-white text-xs font-bold truncate mb-2">{{ $gallery->title }}</p>
                                        <form action="{{ route('admin.gallery.destroy', $gallery->id) }}" method="POST" onsubmit="return confirm('Yakin hapus foto ini?')">
                                            @csrf @method('DELETE')
                                            <button class="w-full bg-red-500/90 hover:bg-red-600 text-white text-[10px] font-bold py-2 rounded-lg flex items-center justify-center gap-1 backdrop-blur-sm">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-10">
                                <div class="w-16 h-16 bg-[#FEFAE0] rounded-full flex items-center justify-center mx-auto mb-3">
                                    <svg class="w-8 h-8 text-gambus-secondary opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                </div>
                                <p class="text-gray-400 text-sm">Belum ada foto di galeri.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>