<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Gambus Al-Hikam') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@300;400;600&family=Playfair+Display:ital,wght@0,600;0,700;1,600&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Figtree', sans-serif; background-color: #FEFAE0; color: #2C1810; }
        h1, h2, h3, .font-serif { font-family: 'Playfair Display', serif; }
        
        /* Pola Geometris Halus (Islamic Pattern - Warna Coklat) */
        .islamic-pattern {
            background-color: #2C1810;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23D4A373' fill-opacity='0.1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        /* Hide Scrollbar */
        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="antialiased selection:bg-gambus-secondary selection:text-white pb-20 md:pb-0">

    <nav class="absolute top-0 w-full z-50 px-6 py-6 flex justify-between items-center">
        <div class="text-white font-serif font-bold text-xl tracking-wide flex items-center gap-3">
            <img src="{{ asset('logo.jpeg') }}" class="w-10 h-10 rounded-full border-2 border-gambus-secondary shadow-lg object-cover" alt="Logo">
            <span class="text-[#FEFAE0] drop-shadow-md">AL-HIKAM</span>
        </div>
        
        <div class="flex gap-3">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-[#FEFAE0] font-medium text-sm hover:text-gambus-secondary transition bg-black/20 px-4 py-2 rounded-full backdrop-blur-sm border border-white/10">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-[#FEFAE0] font-medium text-sm hover:text-gambus-secondary transition bg-black/20 px-6 py-2 rounded-full backdrop-blur-sm border border-white/10">Masuk</a>
                @endauth
            @endif
        </div>
    </nav>

    <header class="relative h-[90vh] islamic-pattern flex items-center justify-center text-center px-4 overflow-hidden rounded-b-[3rem] shadow-2xl border-b-4 border-gambus-secondary">
        <div class="absolute inset-0 bg-gradient-to-b from-[#2C1810]/90 via-[#4A3728]/70 to-[#2C1810]/90"></div>

        <div class="absolute top-0 left-1/2 transform -translate-x-1/2 w-full h-full overflow-hidden pointer-events-none">
            <div class="absolute top-[-10%] left-[-10%] w-[500px] h-[500px] bg-gambus-secondary/20 rounded-full blur-[100px]"></div>
            <div class="absolute bottom-[-10%] right-[-10%] w-[400px] h-[400px] bg-gambus-primary/40 rounded-full blur-[100px]"></div>
        </div>

        <div class="relative z-10 max-w-2xl mx-auto space-y-6 pt-10">
            <p class="text-gambus-secondary/90 text-xl font-serif italic mb-2 tracking-wider">﷽</p>
            
            <h1 class="text-4xl md:text-7xl text-[#FEFAE0] font-bold leading-tight drop-shadow-lg">
                Harmoni Nada <br>
                <span class="text-gambus-secondary">Bernuansa Islami</span>
            </h1>
            
            <p class="text-[#EFEAD8] text-sm md:text-lg font-light leading-relaxed max-w-md mx-auto opacity-90">
                Menghadirkan keindahan seni musik gambus untuk melengkapi keberkahan acara pernikahan dan tasyakuran Anda.
            </p>

            <div class="pt-6 flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('booking.create') }}" class="inline-flex justify-center items-center gap-2 bg-gradient-to-r from-gambus-secondary to-[#B08968] text-white font-bold py-4 px-10 rounded-full shadow-xl shadow-gambus-secondary/20 transform transition hover:scale-105 active:scale-95 border border-[#FEFAE0]/20">
                    <span>Booking Jadwal</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </a>
                <a href="#tentang" class="inline-flex justify-center items-center gap-2 bg-[#FEFAE0]/10 backdrop-blur-md border border-[#FEFAE0]/30 text-[#FEFAE0] font-medium py-4 px-10 rounded-full hover:bg-[#FEFAE0]/20 transition">
                    Tentang Kami
                </a>
            </div>
        </div>

        <div class="absolute bottom-10 w-full flex justify-center animate-bounce">
            <svg class="w-6 h-6 text-gambus-secondary/70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
        </div>
    </header>

    <section id="tentang" class="py-16 px-4 -mt-16 relative z-20 max-w-6xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-[#FEFAE0] p-8 rounded-3xl shadow-xl border-b-4 border-gambus-primary flex flex-col items-center text-center gap-4 hover:-translate-y-2 transition duration-300">
                <div class="bg-white p-4 rounded-full text-gambus-primary shadow-sm ring-4 ring-gambus-primary/10">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path></svg>
                </div>
                <div>
                    <h3 class="font-bold text-xl text-gambus-primary mb-2 font-serif">Profesional</h3>
                    <p class="text-sm text-[#6D5440] leading-relaxed">Tim musisi berpengalaman dengan penampilan yang rapi, sopan, dan disiplin waktu.</p>
                </div>
            </div>

            <div class="bg-white p-8 rounded-3xl shadow-xl border-b-4 border-gambus-secondary flex flex-col items-center text-center gap-4 hover:-translate-y-2 transition duration-300 relative overflow-hidden">
                <div class="absolute top-0 w-full h-1 bg-gradient-to-r from-gambus-primary to-gambus-secondary"></div>
                <div class="bg-[#FEFAE0] p-4 rounded-full text-gambus-secondary shadow-sm ring-4 ring-gambus-secondary/10">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                </div>
                <div>
                    <h3 class="font-bold text-xl text-gambus-primary mb-2 font-serif">Syahdu & Islami</h3>
                    <p class="text-sm text-[#6D5440] leading-relaxed">Lantunan sholawat dan musik gambus yang menyejukkan hati, menambah keberkahan acara.</p>
                </div>
            </div>

            <div class="bg-[#FEFAE0] p-8 rounded-3xl shadow-xl border-b-4 border-gambus-primary flex flex-col items-center text-center gap-4 hover:-translate-y-2 transition duration-300">
                <div class="bg-white p-4 rounded-full text-gambus-primary shadow-sm ring-4 ring-gambus-primary/10">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <h3 class="font-bold text-xl text-gambus-primary mb-2 font-serif">Harga Sahabat</h3>
                    <p class="text-sm text-[#6D5440] leading-relaxed">Paket hiburan berkualitas premium dengan penawaran harga terbaik untuk Anda.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-10">
        <div class="px-6 mb-6 flex justify-between items-end max-w-6xl mx-auto">
            <div>
                <h2 class="text-3xl font-bold text-gambus-primary font-serif">Galeri Momen</h2>
                <div class="h-1.5 w-16 bg-gambus-secondary rounded-full mt-2"></div>
            </div>
            <span class="text-xs text-gambus-secondary font-bold uppercase tracking-widest">Geser &rarr;</span>
        </div>

        <div class="flex overflow-x-auto gap-5 px-6 pb-10 snap-x hide-scrollbar max-w-7xl mx-auto">
            <div class="min-w-[300px] h-72 rounded-3xl overflow-hidden relative shadow-lg snap-center group border-2 border-white">
                <img src="https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?q=80&w=1000&auto=format&fit=crop" class="w-full h-full object-cover group-hover:scale-110 transition duration-700 sepia-[0.3]" alt="Wedding">
                <div class="absolute inset-0 bg-gradient-to-t from-gambus-primary/90 to-transparent flex items-end p-6">
                    <div>
                        <p class="text-gambus-secondary text-xs font-bold uppercase tracking-wider mb-1">Resepsi</p>
                        <p class="text-white font-serif text-lg">Wedding Reception</p>
                    </div>
                </div>
            </div>
            
            <div class="min-w-[300px] h-72 rounded-3xl overflow-hidden relative shadow-lg snap-center group border-2 border-white">
                <img src="https://images.unsplash.com/photo-1465847899078-b4905ad92866?q=80&w=1000&auto=format&fit=crop" class="w-full h-full object-cover group-hover:scale-110 transition duration-700 sepia-[0.3]" alt="Gambus">
                <div class="absolute inset-0 bg-gradient-to-t from-gambus-primary/90 to-transparent flex items-end p-6">
                    <div>
                        <p class="text-gambus-secondary text-xs font-bold uppercase tracking-wider mb-1">Acara</p>
                        <p class="text-white font-serif text-lg">Tasyakuran & Aqiqah</p>
                    </div>
                </div>
            </div>

             <div class="min-w-[300px] h-72 rounded-3xl overflow-hidden relative shadow-lg snap-center group border-2 border-white">
                <img src="https://images.unsplash.com/photo-1511192336575-5a79af67a629?q=80&w=1000&auto=format&fit=crop" class="w-full h-full object-cover group-hover:scale-110 transition duration-700 sepia-[0.3]" alt="Music">
                <div class="absolute inset-0 bg-gradient-to-t from-gambus-primary/90 to-transparent flex items-end p-6">
                    <div>
                        <p class="text-gambus-secondary text-xs font-bold uppercase tracking-wider mb-1">Religi</p>
                        <p class="text-white font-serif text-lg">Pengajian Umum</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 px-6 text-center relative overflow-hidden">
        <div class="absolute inset-0 bg-gambus-primary/5 -skew-y-3 z-0 transform scale-110"></div>
        
        <div class="relative z-10 max-w-2xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-bold text-gambus-primary mb-4 font-serif">Siap Melengkapi Hari Bahagia Anda?</h2>
            <p class="text-[#6D5440] mb-8 text-lg">Cek ketersediaan tanggal sekarang sebelum penuh. Kami siap memberikan penampilan terbaik untuk momen spesial Anda.</p>
            
            <a href="{{ route('booking.create') }}" class="inline-block bg-gambus-primary text-[#FEFAE0] font-bold py-4 px-12 rounded-full shadow-2xl hover:bg-[#3E2D20] transition transform hover:-translate-y-1 hover:shadow-gambus-primary/40 border border-gambus-secondary/30">
                Cek Jadwal & Booking Sekarang
            </a>
        </div>
    </section>

    <footer class="bg-[#2C1810] text-[#EFEAD8]/60 py-12 px-6 text-center text-sm border-t-4 border-gambus-secondary relative">
        <div class="absolute inset-0 opacity-5 islamic-pattern pointer-events-none"></div>

        <div class="relative z-10 max-w-4xl mx-auto">
            <div class="flex justify-center items-center gap-3 mb-6">
                 <img src="{{ asset('logo.jpeg') }}" class="w-8 h-8 rounded-full border border-gambus-secondary grayscale opacity-80" alt="Logo">
                 <span class="text-[#FEFAE0] font-serif font-bold text-xl tracking-widest">AL-HIKAM</span>
            </div>
            
            <p class="mb-8 font-light tracking-wide">Jl. Pesantren No. 123, Garut, Jawa Barat</p>
            
            <div class="flex justify-center gap-8 mb-10">
                <a href="#" class="hover:text-gambus-secondary transition transform hover:scale-110">Instagram</a>
                <a href="#" class="hover:text-gambus-secondary transition transform hover:scale-110">WhatsApp</a>
                <a href="#" class="hover:text-gambus-secondary transition transform hover:scale-110">Facebook</a>
            </div>
            
            <div class="w-24 h-px bg-gambus-secondary/30 mx-auto mb-8"></div>

            <p>&copy; {{ date('Y') }} Gambus Al-Hikam. All rights reserved.</p>
        </div>
    </footer>

    <div class="fixed bottom-0 w-full bg-white/95 backdrop-blur-md p-4 border-t border-[#EFEAD8] md:hidden z-40 flex items-center justify-between shadow-[0_-4px_20px_-5px_rgba(0,0,0,0.1)]">
        <div class="text-xs">
            <p class="text-gray-400 font-medium">Mulai dari</p>
            <p class="text-gambus-primary font-bold text-lg leading-none">Rp Juta-an</p>
        </div>
        <a href="{{ route('booking.create') }}" class="bg-gradient-to-r from-gambus-primary to-[#6D5440] text-white text-sm font-bold py-3 px-8 rounded-full shadow-lg shadow-gambus-primary/30">
            Booking
        </a>
    </div>

</body>
</html>