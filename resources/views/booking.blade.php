<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Booking - {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-emerald-50 font-sans text-gray-800">

    <nav class="p-4 fixed top-0 w-full bg-white/80 backdrop-blur z-50 border-b border-gray-200">
        <div class="max-w-3xl mx-auto flex items-center gap-3">
            <a href="{{ url('/') }}" class="bg-gray-100 p-2 rounded-full hover:bg-gray-200 transition">
                <svg class="w-5 h-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
            </a>
            <span class="font-bold text-lg text-emerald-900">Kembali ke Beranda</span>
        </div>
    </nav>

    <div class="pt-24 pb-12 px-4">
        <div class="max-w-3xl mx-auto">
            
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-emerald-900 mb-2">Formulir Pemesanan</h1>
                <p class="text-gray-600">Isi data lengkap untuk mengunci jadwal acara Anda.</p>
            </div>

            @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-6 rounded-lg shadow-md mb-8">
                <p class="font-bold text-lg">Booking Berhasil!</p>
                <p>{{ session('success') }}</p>
                <a href="{{ url('/') }}" class="inline-block mt-4 text-green-800 font-bold underline">Kembali ke Beranda</a>
            </div>
            @endif

            <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-emerald-100">
                <div class="bg-emerald-900 p-6 sm:p-8 text-white relative overflow-hidden">
                    <div class="relative z-10">
                        <p class="text-emerald-200 text-xs font-bold uppercase tracking-widest mb-1">Langkah 1 dari 1</p>
                        <h2 class="text-2xl font-bold">Data Lengkap Pernikahan</h2>
                    </div>
                    <div class="absolute -right-6 -bottom-10 w-32 h-32 bg-emerald-800 rounded-full opacity-50"></div>
                </div>
                
                <form action="{{ route('booking.store') }}" method="POST" class="p-6 sm:p-10 space-y-10">
                    @csrf
                    
                    <div class="space-y-4">
                        <h3 class="flex items-center text-emerald-800 font-bold border-b border-emerald-100 pb-2">
                            <span class="bg-emerald-100 text-emerald-800 w-6 h-6 rounded-full flex items-center justify-center text-xs mr-2">1</span>
                            Informasi Acara
                        </h3>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-xs font-bold text-gray-500 mb-1 uppercase">Nama Pemesan (CP)</label>
                                <input type="text" name="booker_name" required class="w-full rounded-xl border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 py-3">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-500 mb-1 uppercase">No. WhatsApp</label>
                                <input type="number" name="booker_phone" required class="w-full rounded-xl border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 py-3">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-500 mb-1 uppercase">Tanggal Acara</label>
                                <input type="date" name="event_date" required class="w-full rounded-xl border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 py-3">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-500 mb-1 uppercase">Jam Mulai</label>
                                <input type="time" name="event_time" required class="w-full rounded-xl border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 py-3">
                            </div>
                            <div class="sm:col-span-2">
                                <label class="block text-xs font-bold text-gray-500 mb-1 uppercase">Lokasi Lengkap</label>
                                <textarea name="venue_address" rows="2" required class="w-full rounded-xl border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 py-3"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <h3 class="flex items-center text-blue-800 font-bold border-b border-blue-100 pb-2">
                            <span class="bg-blue-100 text-blue-800 w-6 h-6 rounded-full flex items-center justify-center text-xs mr-2">2</span>
                            Mempelai Pria
                        </h3>
                        <div class="bg-blue-50/50 p-4 rounded-xl space-y-4 border border-blue-100">
                            <div>
                                <label class="block text-xs font-bold text-gray-500 mb-1">Nama Lengkap Pria</label>
                                <input type="text" name="groom_name" class="w-full rounded-xl border-blue-200 focus:ring-blue-500 focus:border-blue-500 py-3">
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-bold text-gray-500 mb-1">Nama Ayah</label>
                                    <input type="text" name="groom_father" class="w-full rounded-xl border-blue-200 focus:ring-blue-500 focus:border-blue-500 py-3">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-500 mb-1">Nama Ibu</label>
                                    <input type="text" name="groom_mother" class="w-full rounded-xl border-blue-200 focus:ring-blue-500 focus:border-blue-500 py-3">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <h3 class="flex items-center text-pink-800 font-bold border-b border-pink-100 pb-2">
                            <span class="bg-pink-100 text-pink-800 w-6 h-6 rounded-full flex items-center justify-center text-xs mr-2">3</span>
                            Mempelai Wanita
                        </h3>
                        <div class="bg-pink-50/50 p-4 rounded-xl space-y-4 border border-pink-100">
                            <div>
                                <label class="block text-xs font-bold text-gray-500 mb-1">Nama Lengkap Wanita</label>
                                <input type="text" name="bride_name" class="w-full rounded-xl border-pink-200 focus:ring-pink-500 focus:border-pink-500 py-3">
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-bold text-gray-500 mb-1">Nama Ayah</label>
                                    <input type="text" name="bride_father" class="w-full rounded-xl border-pink-200 focus:ring-pink-500 focus:border-pink-500 py-3">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-500 mb-1">Nama Ibu</label>
                                    <input type="text" name="bride_mother" class="w-full rounded-xl border-pink-200 focus:ring-pink-500 focus:border-pink-500 py-3">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <h3 class="flex items-center text-gray-800 font-bold border-b border-gray-200 pb-2">
                            <span class="bg-gray-200 text-gray-800 w-6 h-6 rounded-full flex items-center justify-center text-xs mr-2">4</span>
                            Lainnya
                        </h3>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 mb-1 uppercase">Tema / Kostum / Request Lagu</label>
                            <input type="text" name="event_theme" class="w-full rounded-xl border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 py-3" placeholder="Contoh: Baju Putih, Request Sholawat...">
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full bg-gradient-to-r from-emerald-800 to-emerald-600 text-white font-bold py-4 rounded-xl shadow-lg hover:shadow-xl transition transform hover:-translate-y-1 text-lg">
                            Kirim Booking &rarr;
                        </button>
                    </div>

                </form>
            </div>
            
            <p class="text-center text-gray-400 text-xs mt-8">Data Anda aman dan hanya digunakan untuk keperluan acara.</p>
        </div>
    </div>

</body>
</html>