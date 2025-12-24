<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gambus-text leading-tight">
            ⚙️ Pengaturan Website
        </h2>
    </x-slot>

    <div class="py-12 px-4 max-w-7xl mx-auto space-y-6">
        
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-[#EFEAD8]">
            <h3 class="font-bold text-gambus-primary text-lg mb-4 border-b pb-2">Kontak & Media Sosial</h3>
            <form action="{{ route('admin.site.update') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @csrf
                @method('PUT')
                
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">WhatsApp Admin (Format: 628...)</label>
                    <input type="number" name="whatsapp_number" value="{{ $settings->whatsapp_number }}" class="w-full rounded-xl border-gray-300 focus:border-gambus-secondary focus:ring-gambus-secondary">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Alamat Lengkap</label>
                    <input type="text" name="address" value="{{ $settings->address }}" class="w-full rounded-xl border-gray-300 focus:border-gambus-secondary focus:ring-gambus-secondary">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Link Instagram (Opsional)</label>
                    <input type="url" name="instagram_link" value="{{ $settings->instagram_link }}" class="w-full rounded-xl border-gray-300 focus:border-gambus-secondary focus:ring-gambus-secondary" placeholder="https://instagram.com/...">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Link Facebook (Opsional)</label>
                    <input type="url" name="facebook_link" value="{{ $settings->facebook_link }}" class="w-full rounded-xl border-gray-300 focus:border-gambus-secondary focus:ring-gambus-secondary" placeholder="https://facebook.com/...">
                </div>

                <div class="md:col-span-2 text-right">
                    <button type="submit" class="bg-gambus-primary text-white px-6 py-2 rounded-xl font-bold hover:bg-[#3E2D20] transition">Simpan Kontak</button>
                </div>
            </form>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-[#EFEAD8]">
            <h3 class="font-bold text-gambus-primary text-lg mb-4 border-b pb-2">Galeri Momen (Upload)</h3>
            
            <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data" class="mb-8 flex gap-4 items-end bg-[#FEFAE0] p-4 rounded-xl">
                @csrf
                <div class="flex-1">
                    <label class="block text-xs font-bold text-gambus-secondary uppercase mb-1">Judul Foto</label>
                    <input type="text" name="title" required class="w-full rounded-xl border-gray-300 focus:border-gambus-secondary" placeholder="Cth: Wedding di Hotel X">
                </div>
                <div class="flex-1">
                    <label class="block text-xs font-bold text-gambus-secondary uppercase mb-1">File Foto (JPG/PNG)</label>
                    <input type="file" name="image" required class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gambus-secondary file:text-white hover:file:bg-gambus-primary">
                </div>
                <button type="submit" class="bg-gambus-primary text-white px-6 py-2.5 rounded-xl font-bold hover:bg-[#3E2D20] transition shadow-lg">Upload & Kompres</button>
            </form>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach($galleries as $gallery)
                <div class="group relative rounded-xl overflow-hidden shadow-md border border-gray-200">
                    <img src="{{ asset('storage/' . $gallery->image_path) }}" class="w-full h-40 object-cover group-hover:scale-110 transition duration-500">
                    <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition flex flex-col justify-center items-center text-white">
                        <p class="text-xs font-bold mb-2">{{ $gallery->title }}</p>
                        <form action="{{ route('admin.gallery.destroy', $gallery->id) }}" method="POST" onsubmit="return confirm('Hapus foto ini?')">
                            @csrf @method('DELETE')
                            <button class="bg-red-500 text-white px-3 py-1 rounded text-xs hover:bg-red-600">Hapus</button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </div>
</x-app-layout>