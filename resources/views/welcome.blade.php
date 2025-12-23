<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Sim Gambus') }}</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        .glass {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }
        /* Style khusus untuk separator form */
        .form-section-title {
            display: flex;
            align-items: center;
            font-size: 0.85rem;
            font-weight: 700;
            color: #065f46; /* Emerald 800 */
            margin-bottom: 1rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .form-section-title::after {
            content: "";
            flex: 1;
            height: 1px;
            background: #d1fae5; /* Emerald 100 */
            margin-left: 1rem;
        }
    </style>
</head>
<body class="antialiased font-sans text-gray-800 bg-gray-50">

    <nav class="fixed w-full z-50 transition-all duration-300 glass border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex-shrink-0 flex items-center gap-2">
                    <div class="bg-emerald-600 text-white p-1.5 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" /></svg>
                    </div>
                    <span class="font-bold text-xl tracking-tight text-emerald-900">Gambus<span class="text-emerald-600">AlWafa</span></span>
                </div>
                <div>
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-sm font-bold text-emerald-700 bg-emerald-50 px-4 py-2 rounded-full transition">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-bold text-gray-600 hover:text-emerald-600 transition flex items-center gap-1">
                                Login
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" /></svg>
                            </a>
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <section class="relative pt-32 pb-10 px-4 sm:px-6 lg:px-8 overflow-hidden">
        <div class="relative z-10 max-w-7xl mx-auto text-center">
            <h1 class="text-4xl sm:text-6xl font-extrabold text-gray-900 tracking-tight mb-4">
                Musik Gambus <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-teal-500">Pernikahan Impian</span>
            </h1>
            <p class="mt-4 text-lg text-gray-600 max-w-2xl mx-auto mb-8">
                Lengkapi momen sakral Anda dengan alunan musik Islami yang syahdu, elegan, dan profesional.
            </p>
            <a href="#booking-form" class="inline-block px-8 py-4 bg-emerald-600 text-white rounded-xl font-bold shadow-lg shadow-emerald-600/30 hover:bg-emerald-700 hover:-translate-y-1 transition">
                Isi Formulir Booking 📝
            </a>
        </div>
    </section>

    <section id="booking-form" class="py-10 px-4 bg-gray-50">
        <div class="max-w-3xl mx-auto">
            
            @if(session('success'))
            <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-r shadow-sm flex justify-between items-center" role="alert">
                <div>
                    <p class="font-bold">Booking Terkirim!</p>
                    <p class="text-sm">{{ session('success') }}</p>
                </div>
                <button onclick="this.parentElement.style.display='none'" class="text-green-700 font-bold">x</button>
            </div>
            @endif

            <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">
                <div class="bg-emerald-900 p-6 text-center">
                    <h2 class="text-2xl font-bold text-white">Formulir Pemesanan</h2>
                    <p class="text-emerald-200 text-sm mt-1">Mohon isi data dengan lengkap untuk keperluan administrasi</p>
                </div>
                
                <form action="{{ route('booking.store') }}" method="POST" class="p-6 sm:p-10 space-y-8">
                    @csrf
                    
                    <div>
                        <div class="form-section-title">1. Data Pemesan & Acara</div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-xs font-bold text-gray-500 mb-1 uppercase">Nama Pemesan (CP)</label>
                                <input type="text" name="booker_name" required class="w-full rounded-xl border-gray-200 bg-gray-50 focus:border-emerald-500 focus:ring-emerald-500 py-3 text-sm" placeholder="Nama Anda">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-500 mb-1 uppercase">WhatsApp Aktif</label>
                                <input type="number" name="booker_phone" required class="w-full rounded-xl border-gray-200 bg-gray-50 focus:border-emerald-500 focus:ring-emerald-500 py-3 text-sm" placeholder="0812...">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-500 mb-1 uppercase">Tanggal Acara</label>
                                <input type="date" name="event_date" required class="w-full rounded-xl border-gray-200 bg-gray-50 focus:border-emerald-500 focus:ring-emerald-500 py-3 text-sm">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-500 mb-1 uppercase">Jam Mulai</label>
                                <input type="time" name="event_time" required class="w-full rounded-xl border-gray-200 bg-gray-50 focus:border-emerald-500 focus:ring-emerald-500 py-3 text-sm">
                            </div>
                            <div class="sm:col-span-2">
                                <label class="block text-xs font-bold text-gray-500 mb-1 uppercase">Lokasi / Alamat Lengkap</label>
                                <textarea name="venue_address" rows="2" required class="w-full rounded-xl border-gray-200 bg-gray-50 focus:border-emerald-500 focus:ring-emerald-500 py-3 text-sm" placeholder="Nama Gedung / Alamat Rumah..."></textarea>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="form-section-title text-blue-800">2. Data Mempelai Pria</div>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-xs font-bold text-gray-500 mb-1 uppercase">Nama Lengkap Pria</label>
                                <input type="text" name="groom_name" class="w-full rounded-xl border-gray-200 bg-blue-50 focus:border-blue-500 focus:ring-blue-500 py-3 text-sm" placeholder="Nama pengantin pria...">
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-bold text-gray-500 mb-1 uppercase">Nama Ayah (Pria)</label>
                                    <input type="text" name="groom_father" class="w-full rounded-xl border-gray-200 bg-blue-50 focus:border-blue-500 focus:ring-blue-500 py-3 text-sm" placeholder="Bpk...">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-500 mb-1 uppercase">Nama Ibu (Pria)</label>
                                    <input type="text" name="groom_mother" class="w-full rounded-xl border-gray-200 bg-blue-50 focus:border-blue-500 focus:ring-blue-500 py-3 text-sm" placeholder="Ibu...">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="form-section-title text-pink-800">3. Data Mempelai Wanita</div>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-xs font-bold text-gray-500 mb-1 uppercase">Nama Lengkap Wanita</label>
                                <input type="text" name="bride_name" class="w-full rounded-xl border-gray-200 bg-pink-50 focus:border-pink-500 focus:ring-pink-500 py-3 text-sm" placeholder="Nama pengantin wanita...">
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-bold text-gray-500 mb-1 uppercase">Nama Ayah (Wanita)</label>
                                    <input type="text" name="bride_father" class="w-full rounded-xl border-gray-200 bg-pink-50 focus:border-pink-500 focus:ring-pink-500 py-3 text-sm" placeholder="Bpk...">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-500 mb-1 uppercase">Nama Ibu (Wanita)</label>
                                    <input type="text" name="bride_mother" class="w-full rounded-xl border-gray-200 bg-pink-50 focus:border-pink-500 focus:ring-pink-500 py-3 text-sm" placeholder="Ibu...">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                         <div class="form-section-title">4. Tambahan</div>
                         <div>
                            <label class="block text-xs font-bold text-gray-500 mb-1 uppercase">Tema / Request Khusus</label>
                            <input type="text" name="event_theme" class="w-full rounded-xl border-gray-200 bg-gray-50 focus:border-emerald-500 focus:ring-emerald-500 py-3 text-sm" placeholder="Misal: Baju Putih, Request Lagu Arab...">
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-emerald-800 text-white font-bold py-4 rounded-xl shadow-lg hover:bg-emerald-900 transition transform active:scale-95 text-lg mt-4">
                        Kirim Data Booking ✅
                    </button>
                </form>
            </div>
        </div>
    </section>

    <footer class="bg-gray-900 text-white py-8 px-4 border-t border-gray-800 mt-10">
        <div class="max-w-7xl mx-auto flex flex-col items-center text-center">
            <h2 class="text-xl font-bold mb-2 text-emerald-400">Gambus AlWafa</h2>
            <p class="text-gray-500 text-xs">&copy; {{ date('Y') }} All rights reserved.</p>
        </div>
    </footer>

    <a href="https://wa.me/6281234567890" target="_blank" class="fixed bottom-6 right-6 z-50 bg-green-500 text-white p-4 rounded-full shadow-lg hover:bg-green-600 transition-transform hover:-translate-y-1">
        <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
    </a>

</body>
</html>