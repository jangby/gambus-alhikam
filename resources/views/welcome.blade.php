<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Gambus Alhikam') }}</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        serif: ['"Playfair Display"', 'serif'],
                    },
                    colors: {
                        emerald: {
                            850: '#064e3b',
                            950: '#022c22',
                        },
                        gold: {
                            400: '#fbbf24',
                            500: '#f59e0b',
                            600: '#d97706',
                        }
                    },
                    backgroundImage: {
                        'islamic-pattern': "url(\"data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%2310b981' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E\")",
                    }
                }
            }
        }
    </script>

    <style>
        /* Hide scrollbar for clean horizontal scroll */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        
        .glass-nav {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255,255,255,0.3);
        }

        .text-stroke {
            -webkit-text-stroke: 1px rgba(255,255,255,0.3);
            color: transparent;
        }
    </style>
</head>
<body class="antialiased text-gray-600 bg-gray-50 selection:bg-emerald-200 selection:text-emerald-900 font-sans">

    <div class="fixed inset-0 bg-islamic-pattern z-0 pointer-events-none"></div>

    <div id="mobile-menu" class="fixed inset-0 z-[100] bg-emerald-950/95 backdrop-blur-xl transform translate-x-full transition-transform duration-300 lg:hidden flex flex-col justify-center items-center text-center">
        <button onclick="toggleMenu()" class="absolute top-6 right-6 text-white p-2">
            <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
        </button>
        <div class="space-y-8">
            <a href="#home" onclick="toggleMenu()" class="block font-serif text-3xl text-white hover:text-gold-400 transition">Beranda</a>
            <a href="#about" onclick="toggleMenu()" class="block font-serif text-3xl text-white hover:text-gold-400 transition">Tentang Kami</a>
            <a href="#gallery" onclick="toggleMenu()" class="block font-serif text-3xl text-white hover:text-gold-400 transition">Galeri</a>
            <a href="#contact" onclick="toggleMenu()" class="block font-serif text-3xl text-white hover:text-gold-400 transition">Kontak</a>
            <a href="{{ route('booking.create') }}" class="inline-block px-8 py-3 bg-white text-emerald-900 rounded-full font-bold mt-4">Booking Jadwal</a>
        </div>
    </div>

    <nav class="fixed w-full z-50 top-0 transition-all duration-300 glass-nav">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-emerald-800 to-emerald-950 text-white rounded-xl flex items-center justify-center shadow-lg shadow-emerald-900/20 rotate-3 hover:rotate-0 transition duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" /></svg>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-serif font-bold text-2xl text-emerald-950 leading-none">Alhikam</span>
                        <span class="text-[9px] font-bold text-gold-600 tracking-[0.2em] uppercase">Gambus Entertainment</span>
                    </div>
                </div>

                <div class="hidden lg:flex items-center gap-8">
                    <a href="#home" class="text-sm font-semibold text-gray-600 hover:text-emerald-900 transition">Beranda</a>
                    <a href="#about" class="text-sm font-semibold text-gray-600 hover:text-emerald-900 transition">Tentang</a>
                    <a href="#gallery" class="text-sm font-semibold text-gray-600 hover:text-emerald-900 transition">Galeri</a>
                    <a href="{{ route('booking.create') }}" class="px-6 py-2.5 bg-emerald-900 text-white rounded-full text-xs font-bold uppercase tracking-wide hover:bg-emerald-800 transition shadow-lg shadow-emerald-900/20 hover:scale-105 transform duration-200">
                        Cek Ketersediaan
                    </a>
                </div>

                <button onclick="toggleMenu()" class="lg:hidden text-emerald-950 p-2">
                    <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" /></svg>
                </button>
            </div>
        </div>
    </nav>

    <section id="home" class="relative pt-32 pb-16 lg:pt-48 lg:pb-32 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">
                
                <div class="text-center lg:text-left order-2 lg:order-1">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white border border-emerald-100 shadow-sm text-emerald-800 text-[10px] font-bold uppercase tracking-widest mb-6 animate-pulse">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        Professional Islamic Music
                    </div>
                    
                    <h1 class="font-serif text-5xl sm:text-6xl lg:text-7xl font-medium text-emerald-950 leading-[1.1] mb-6">
                        Nada Indah <br>
                        <span class="italic text-emerald-700">Penyejuk Hati.</span>
                    </h1>
                    
                    <p class="text-lg text-gray-500 mb-8 leading-relaxed max-w-lg mx-auto lg:mx-0">
                        Gambus <b>Alhikam</b> menghadirkan nuansa sakral dan elegan di hari pernikahan Anda. Perpaduan harmonis musik modern dan nilai Islami.
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="{{ route('booking.create') }}" class="inline-flex items-center justify-center px-8 py-4 bg-emerald-900 text-white rounded-full font-bold hover:bg-emerald-800 transition shadow-xl shadow-emerald-900/20 hover:-translate-y-1">
                            Booking Sekarang
                        </a>
                        <a href="#gallery" class="inline-flex items-center justify-center px-8 py-4 bg-white text-emerald-900 border border-emerald-100 rounded-full font-bold hover:bg-emerald-50 transition shadow-sm">
                            Lihat Portofolio
                        </a>
                    </div>

                    <div class="mt-8 pt-8 border-t border-gray-200 flex justify-center lg:justify-start gap-6 lg:hidden">
                        <div class="text-center">
                            <span class="block font-bold text-xl text-emerald-900">5+ Thn</span>
                            <span class="text-[10px] text-gray-500 uppercase">Pengalaman</span>
                        </div>
                        <div class="text-center">
                            <span class="block font-bold text-xl text-emerald-900">100+</span>
                            <span class="text-[10px] text-gray-500 uppercase">Acara</span>
                        </div>
                    </div>
                </div>

                <div class="order-1 lg:order-2 relative">
                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-gradient-to-tr from-emerald-200/50 to-gold-200/50 rounded-full blur-[80px] -z-10"></div>
                    
                    <div class="relative rounded-[3rem] overflow-hidden shadow-2xl border-4 border-white aspect-[4/5] mx-auto max-w-sm lg:max-w-md transform rotate-2 hover:rotate-0 transition duration-700">
                        <img src="https://images.unsplash.com/photo-1516280440614-6697288d5d38?q=80&w=2070&auto=format&fit=crop" class="w-full h-full object-cover" alt="Gambus Alhikam Performance">
                        
                        <div class="absolute bottom-6 left-6 right-6 bg-white/90 backdrop-blur-md p-5 rounded-2xl shadow-lg border border-white/50">
                            <div class="flex items-center gap-4">
                                <div class="h-12 w-12 bg-emerald-100 rounded-full flex items-center justify-center text-emerald-700 shrink-0">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path></svg>
                                </div>
                                <div>
                                    <p class="font-bold text-emerald-950 text-sm">Best Performance</p>
                                    <p class="text-xs text-gray-500">Rating 4.9/5 dari Klien</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-white border-y border-gray-100">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-10">
                <span class="text-emerald-600 font-bold text-xs tracking-widest uppercase mb-2 block">Layanan Kami</span>
                <h2 class="font-serif text-3xl md:text-4xl text-emerald-950">Spesialisasi Acara</h2>
            </div>
            
            <div class="flex lg:grid lg:grid-cols-3 gap-6 overflow-x-auto no-scrollbar pb-6 lg:pb-0 snap-x snap-mandatory">
                
                <div class="min-w-[280px] snap-center bg-gray-50 rounded-3xl p-8 border border-gray-100 hover:border-emerald-200 hover:shadow-lg transition group">
                    <div class="w-14 h-14 bg-white rounded-2xl shadow-sm flex items-center justify-center text-emerald-600 mb-6 text-2xl group-hover:bg-emerald-600 group-hover:text-white transition">💍</div>
                    <h3 class="font-serif text-xl font-bold text-gray-900 mb-3">Wedding Resepsi</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">Iringan musik syahdu saat menyambut pengantin dan menemani tamu undangan.</p>
                </div>

                <div class="min-w-[280px] snap-center bg-emerald-900 rounded-3xl p-8 border border-emerald-800 shadow-xl relative overflow-hidden group">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-800 rounded-full blur-2xl -mr-10 -mt-10"></div>
                    <div class="w-14 h-14 bg-emerald-800 rounded-2xl shadow-inner flex items-center justify-center text-emerald-200 mb-6 text-2xl relative z-10 group-hover:scale-110 transition">🕌</div>
                    <h3 class="font-serif text-xl font-bold text-white mb-3 relative z-10">Acara Keagamaan</h3>
                    <p class="text-sm text-emerald-100/80 leading-relaxed relative z-10">Pengajian, Tabligh Akbar, dan peringatan hari besar Islam dengan nuansa khidmat.</p>
                </div>

                <div class="min-w-[280px] snap-center bg-gray-50 rounded-3xl p-8 border border-gray-100 hover:border-emerald-200 hover:shadow-lg transition group">
                    <div class="w-14 h-14 bg-white rounded-2xl shadow-sm flex items-center justify-center text-emerald-600 mb-6 text-2xl group-hover:bg-emerald-600 group-hover:text-white transition">🎉</div>
                    <h3 class="font-serif text-xl font-bold text-gray-900 mb-3">Aqiqah & Tasyakuran</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">Menambah keberkahan acara keluarga dengan lantunan sholawat dan musik gambus.</p>
                </div>

            </div>
        </div>
    </section>

    <section id="gallery" class="py-20 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex justify-between items-end mb-12">
                <div>
                    <h2 class="font-serif text-4xl text-emerald-950">Galeri Alhikam</h2>
                    <p class="text-gray-500 mt-2">Dokumentasi kebahagiaan klien kami.</p>
                </div>
                <a href="#" class="hidden lg:flex items-center gap-2 text-sm font-bold text-emerald-700 hover:underline">
                    Lihat Semua <span class="text-lg">&rarr;</span>
                </a>
            </div>

            <div class="columns-1 md:columns-2 lg:columns-3 gap-6 space-y-6">
                <div class="break-inside-avoid rounded-3xl overflow-hidden shadow-lg border-2 border-white group">
                    <div class="aspect-video relative">
                        <iframe class="w-full h-full" src="https://www.youtube.com/embed/dQw4w9WgXcQ?si=Example" title="YouTube" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    <div class="bg-white p-4">
                        <h4 class="font-bold text-gray-900">Live at Wedding Garut</h4>
                        <p class="text-xs text-gray-500">Sholawat Mughrom</p>
                    </div>
                </div>

                <div class="break-inside-avoid relative group rounded-3xl overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1519744531200-c1115e416d74?q=80&w=2070" class="w-full object-cover transition duration-700 group-hover:scale-110" alt="Alhikam Gallery">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex items-end p-6">
                        <span class="text-white font-medium">Dokumentasi Wedding</span>
                    </div>
                </div>

                <div class="break-inside-avoid bg-emerald-50 rounded-3xl p-8 border border-emerald-100 text-center">
                    <p class="font-serif italic text-xl text-emerald-900 leading-relaxed">"Suaranya sangat merdu, bikin tamu undangan betah. Terima kasih Alhikam!"</p>
                    <div class="mt-4 flex items-center justify-center gap-2">
                        <div class="w-8 h-8 bg-gray-300 rounded-full overflow-hidden">
                            <img src="https://ui-avatars.com/api/?name=Fulan+Ahmad&background=random" alt="Client">
                        </div>
                        <span class="text-xs font-bold text-gray-600">Keluarga Bpk. H. Ahmad</span>
                    </div>
                </div>

                <div class="break-inside-avoid relative group rounded-3xl overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1465495976277-4387d4b0b4c6?q=80&w=2070" class="w-full object-cover transition duration-700 group-hover:scale-110" alt="Alhikam Gallery">
                </div>

                <div class="break-inside-avoid relative group rounded-3xl overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?q=80&w=2070" class="w-full object-cover transition duration-700 group-hover:scale-110" alt="Alhikam Gallery">
                </div>
            </div>
            
             <a href="#" class="lg:hidden mt-8 block w-full text-center py-3 rounded-xl bg-gray-100 text-gray-600 font-bold text-sm">
                Lihat Semua Galeri
            </a>
        </div>
    </section>

    <section class="py-16 px-4">
        <div class="max-w-5xl mx-auto bg-emerald-900 rounded-[2.5rem] p-8 md:p-16 text-center text-white relative overflow-hidden shadow-2xl">
            <div class="absolute top-0 right-0 w-64 h-64 bg-emerald-800 rounded-full blur-3xl -mr-20 -mt-20 opacity-50"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-emerald-500 rounded-full blur-3xl -ml-20 -mb-20 opacity-20"></div>
            
            <div class="relative z-10">
                <h2 class="font-serif text-3xl md:text-5xl mb-6">Jangan Sampai Kehabisan Jadwal!</h2>
                <p class="text-emerald-100 mb-10 font-light text-lg max-w-2xl mx-auto">Kami membatasi jumlah acara per minggu untuk menjaga kualitas performa tim Gambus Alhikam.</p>
                
                <div class="flex flex-col sm:flex-row justify-center items-center gap-4">
                    <a href="{{ route('booking.create') }}" class="w-full sm:w-auto px-10 py-4 bg-white text-emerald-900 rounded-full font-bold shadow-lg hover:shadow-xl hover:scale-105 transition duration-300">
                        Isi Formulir Booking
                    </a>
                    <a href="https://wa.me/6281234567890" target="_blank" class="w-full sm:w-auto px-10 py-4 bg-transparent border border-emerald-400 text-emerald-50 rounded-full font-bold hover:bg-emerald-800 transition">
                        Tanya via WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-white border-t border-gray-100 pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-8">
            <div class="text-center md:text-left">
                <span class="font-serif font-bold text-2xl text-emerald-950">Alhikam</span>
                <p class="text-sm text-gray-500 mt-2">Melestarikan Seni, Menjaga Tradisi.</p>
            </div>
            <div class="flex gap-8 text-sm font-medium text-gray-500">
                <a href="#" class="hover:text-emerald-900 transition">Instagram</a>
                <a href="#" class="hover:text-emerald-900 transition">YouTube</a>
                <a href="#" class="hover:text-emerald-900 transition">Facebook</a>
            </div>
        </div>
        <div class="border-t border-gray-100 mt-12 pt-8 text-center">
            <p class="text-xs text-gray-400">&copy; {{ date('Y') }} Gambus Alhikam Management.</p>
            <div class="mt-2">
                <a href="{{ route('login') }}" class="text-[10px] text-gray-300 hover:text-emerald-600">Admin Login</a>
            </div>
        </div>
    </footer>

    <a href="https://wa.me/6281234567890" target="_blank" class="fixed bottom-6 right-6 z-[90] group">
        <span class="absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75 animate-ping group-hover:hidden"></span>
        <div class="relative bg-emerald-600 text-white p-4 rounded-full shadow-xl hover:bg-emerald-700 transition-transform hover:scale-110 flex items-center justify-center">
            <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
        </div>
    </a>

    <script>
        // Script sederhana untuk Mobile Menu Toggle
        function toggleMenu() {
            const menu = document.getElementById('mobile-menu');
            if (menu.classList.contains('translate-x-full')) {
                menu.classList.remove('translate-x-full');
            } else {
                menu.classList.add('translate-x-full');
            }
        }
    </script>
</body>
</html>