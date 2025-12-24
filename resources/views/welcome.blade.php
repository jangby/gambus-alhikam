<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Gambus Al-Hikam') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Playfair+Display:ital,wght@0,600;0,700;1,600&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, .font-serif { font-family: 'Playfair Display', serif; }
        
        /* Pola Geometris Halus (Islamic Pattern) */
        .islamic-pattern {
            background-color: #064e3b;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23065f46' fill-opacity='0.4'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
    </style>
</head>
<body class="bg-stone-50 text-gray-800 antialiased selection:bg-amber-500 selection:text-white">

    <nav class="absolute top-0 w-full z-50 px-6 py-5 flex justify-between items-center">
        <div class="text-white font-serif font-bold text-xl tracking-wide flex items-center gap-2">
            <svg class="w-6 h-6 text-amber-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C9.408 2 7.025 2.915 5.161 4.436c-.23.188-.138.566.155.617 3.518.614 6.184 3.684 6.184 7.447s-2.666 6.833-6.184 7.447c-.294.051-.385.429-.155.617C7.025 22.085 9.408 23 12 23c5.523 0 10-4.477 10-10S17.523 2 12 2z"/></svg>
            AL-HIKAM
        </div>
        
        <div class="flex gap-3">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-white/90 font-medium text-sm hover:text-amber-400 transition">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-white/90 font-medium text-sm hover:text-amber-400 transition">Masuk</a>
                @endauth
            @endif
        </div>
    </nav>

    <header class="relative h-[85vh] islamic-pattern flex items-center justify-center text-center px-4 overflow-hidden rounded-b-[3rem] shadow-2xl">
        <div class="absolute inset-0 bg-gradient-to-b from-emerald-950/80 via-emerald-900/60 to-emerald-900/90"></div>

        <div class="relative z-10 max-w-2xl mx-auto space-y-6 pt-10">
            <p class="text-emerald-200/80 text-lg font-serif italic mb-2">﷽</p>
            
            <h1 class="text-4xl md:text-6xl text-white font-bold leading-tight">
                Harmoni Nada <br>
                <span class="text-amber-400">Bernuansa Islami</span>
            </h1>
            
            <p class="text-emerald-100 text-sm md:text-lg font-light leading-relaxed max-w-md mx-auto">
                Menghadirkan keindahan seni musik gambus untuk melengkapi keberkahan acara pernikahan dan tasyakuran Anda.
            </p>

            <div class="pt-4 flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('booking.create') }}" class="inline-flex justify-center items-center gap-2 bg-gradient-to-r from-amber-500 to-amber-600 text-white font-bold py-3 px-8 rounded-full shadow-lg shadow-amber-500/30 transform transition hover:scale-105 active:scale-95">
                    <span>Booking Jadwal</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </a>
                <a href="#tentang" class="inline-flex justify-center items-center gap-2 bg-white/10 backdrop-blur-sm border border-white/20 text-white font-medium py-3 px-8 rounded-full hover:bg-white/20 transition">
                    Tentang Kami
                </a>
            </div>
        </div>

        <div class="absolute bottom-6 w-full flex justify-center animate-bounce">
            <svg class="w-6 h-6 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
        </div>
    </header>

    <section id="tentang" class="py-16 px-4 -mt-10 relative z-20 max-w-5xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-white p-6 rounded-2xl shadow-lg border-b-4 border-amber-500 flex items-start gap-4">
                <div class="bg-amber-50 p-3 rounded-xl text-amber-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path></svg>
                </div>
                <div>
                    <h3 class="font-bold text-lg text-emerald-900 mb-1">Profesional</h3>
                    <p class="text-sm text-gray-500 leading-snug">Tim musisi berpengalaman dengan penampilan yang rapi dan tepat waktu.</p>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-lg border-b-4 border-emerald-500 flex items-start gap-4">
                <div class="bg-emerald-50 p-3 rounded-xl text-emerald-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                </div>
                <div>
                    <h3 class="font-bold text-lg text-emerald-900 mb-1">Syahdu & Islami</h3>
                    <p class="text-sm text-gray-500 leading-snug">Pilihan lagu sholawat dan gambus yang menyejukkan hati para tamu.</p>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-lg border-b-4 border-amber-500 flex items-start gap-4">
                <div class="bg-amber-50 p-3 rounded-xl text-amber-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <h3 class="font-bold text-lg text-emerald-900 mb-1">Harga Bersahabat</h3>
                    <p class="text-sm text-gray-500 leading-snug">Paket hiburan berkualitas dengan penawaran harga terbaik untuk Anda.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-10 bg-white">
        <div class="px-6 mb-6 flex justify-between items-end">
            <div>
                <h2 class="text-2xl font-bold text-emerald-900">Galeri Momen</h2>
                <div class="h-1 w-12 bg-amber-500 rounded-full mt-2"></div>
            </div>
            <span class="text-xs text-gray-400 font-medium">Geser &rarr;</span>
        </div>

        <div class="flex overflow-x-auto gap-4 px-6 pb-8 snap-x hide-scrollbar">
            <div class="min-w-[280px] h-64 rounded-2xl overflow-hidden relative shadow-md snap-center group">
                <img src="https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?q=80&w=1000&auto=format&fit=crop" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" alt="Music">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-end p-4">
                    <p class="text-white font-medium">Wedding Reception</p>
                </div>
            </div>
            <div class="min-w-[280px] h-64 rounded-2xl overflow-hidden relative shadow-md snap-center group">
                <img src="https://images.unsplash.com/photo-1465847899078-b4905ad92866?q=80&w=1000&auto=format&fit=crop" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" alt="Gambus">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-end p-4">
                    <p class="text-white font-medium">Acara Tasyakuran</p>
                </div>
            </div>
             <div class="min-w-[280px] h-64 rounded-2xl overflow-hidden relative shadow-md snap-center group">
                <img src="https://images.unsplash.com/photo-1511192336575-5a79af67a629?q=80&w=1000&auto=format&fit=crop" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" alt="Gambus">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-end p-4">
                    <p class="text-white font-medium">Pengajian Umum</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 px-6 bg-emerald-50 text-center">
        <h2 class="text-2xl md:text-3xl font-bold text-emerald-900 mb-4 font-serif">Siap Melengkapi Hari Bahagia Anda?</h2>
        <p class="text-gray-600 mb-8 max-w-lg mx-auto">Cek ketersediaan tanggal sekarang sebelum penuh. Kami siap memberikan penampilan terbaik.</p>
        
        <a href="{{ route('booking.create') }}" class="inline-block bg-emerald-700 text-white font-bold py-4 px-10 rounded-full shadow-xl shadow-emerald-700/20 hover:bg-emerald-800 transition transform hover:-translate-y-1">
            Cek Jadwal Kosong & Booking
        </a>
    </section>

    <footer class="bg-emerald-900 text-emerald-100/60 py-10 px-6 text-center text-sm border-t border-emerald-800">
        <div class="flex justify-center items-center gap-2 mb-4 text-white font-serif font-bold text-lg">
             <svg class="w-5 h-5 text-amber-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C9.408 2 7.025 2.915 5.161 4.436c-.23.188-.138.566.155.617 3.518.614 6.184 3.684 6.184 7.447s-2.666 6.833-6.184 7.447c-.294.051-.385.429-.155.617C7.025 22.085 9.408 23 12 23c5.523 0 10-4.477 10-10S17.523 2 12 2z"/></svg>
            AL-HIKAM
        </div>
        <p class="mb-6">Jl. Pesantren No. 123, Garut, Jawa Barat</p>
        
        <div class="flex justify-center gap-6 mb-8">
            <a href="#" class="hover:text-white transition">Instagram</a>
            <a href="#" class="hover:text-white transition">WhatsApp</a>
            <a href="#" class="hover:text-white transition">Facebook</a>
        </div>
        
        <p>&copy; {{ date('Y') }} Gambus Al-Hikam. All rights reserved.</p>
    </footer>

    <div class="fixed bottom-0 w-full bg-white p-4 border-t border-gray-100 md:hidden z-40 flex items-center justify-between shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.1)]">
        <div class="text-xs">
            <p class="text-gray-500">Mulai dari</p>
            <p class="text-emerald-700 font-bold text-sm">Rp Juta-an</p>
        </div>
        <a href="{{ route('booking.create') }}" class="bg-amber-500 text-white text-sm font-bold py-2.5 px-6 rounded-full shadow-lg shadow-amber-500/30">
            Booking Sekarang
        </a>
    </div>

</body>
</html>