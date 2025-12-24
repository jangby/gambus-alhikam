<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <title>{{ config('app.name', 'Gambus Al-Hikam') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,500;0,600;1,400;1,500&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Color Variables & Global Reset */
        :root {
            --c-dark: #2C1810;
            --c-gold: #D4A373;
            --c-cream-light: #FDFCF8;
            --c-cream-warm: #F7F4ED;
        }

        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: var(--c-cream-light); 
            color: var(--c-dark);
            overflow-x: hidden;
            -webkit-tap-highlight-color: transparent;
        }
        
        .font-serif { font-family: 'Playfair Display', serif; }

        /* Utility: Hide Scrollbar */
        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }

        /* Utility: Subtle Islamic Dot Pattern */
        .bg-pattern {
            background-image: radial-gradient(var(--c-gold) 0.5px, transparent 0.5px);
            background-size: 24px 24px;
        }
        
        /* Utility: Marquee Animation */
        .marquee-track { display: flex; width: max-content; animation: marquee 40s linear infinite; }
        @keyframes marquee { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }

        /* Smooth Appear Animation */
        .appear { opacity: 0; transform: translateY(20px); transition: all 0.8s cubic-bezier(0.16, 1, 0.3, 1); }
        .appear.visible { opacity: 1; transform: translateY(0); }
    </style>
</head>
<body class="antialiased bg-pattern">

    <nav class="fixed top-4 inset-x-0 z-50 px-4 transition-all duration-300">
        <div class="max-w-7xl mx-auto flex justify-between items-center bg-white/70 backdrop-blur-xl border border-[#D4A373]/20 rounded-full py-3 px-6 shadow-lg shadow-[#2C1810]/5">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-[#D4A373] flex items-center justify-center overflow-hidden border-2 border-white">
                    <img src="{{ asset('logo.jpeg') }}" class="w-full h-full object-cover" alt="AH">
                </div>
                <span class="text-[#2C1810] font-serif font-bold text-xl tracking-wide">AL-HIKAM</span>
            </div>
            
            <div class="hidden md:flex items-center gap-8 text-sm font-medium text-[#2C1810]/70">
                <a href="#" class="hover:text-[#D4A373] transition">Beranda</a>
                <a href="#tentang" class="hover:text-[#D4A373] transition">Tentang</a>
                <a href="#galeri" class="hover:text-[#D4A373] transition">Galeri</a>
            </div>

            <div>
                @auth
                    <a href="{{ url('/dashboard') }}" class="bg-[#2C1810] text-[#FDFCF8] px-6 py-2.5 rounded-full text-xs font-bold tracking-widest uppercase hover:bg-[#D4A373] transition transform hover:scale-105">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('booking.create') }}" class="bg-[#D4A373] text-[#2C1810] px-6 py-2.5 rounded-full text-xs font-bold tracking-widest uppercase hover:bg-[#2C1810] hover:text-[#FDFCF8] transition transform hover:scale-105 box-shadow-[0_10px_20px_-10px_rgba(212,163,115,0.5)]">
                        Book Now
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <header class="relative min-h-[95vh] flex flex-col justify-center items-center text-center px-6 overflow-hidden pt-24">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-[#D4A373] rounded-full blur-[180px] opacity-10 pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-full h-32 bg-gradient-to-t from-[#FDFCF8] to-transparent"></div>

        <div class="relative z-10 max-w-5xl mx-auto space-y-8 appear-trigger">
            <span class="inline-block text-[#D4A373] text-sm font-bold tracking-[0.3em] uppercase mb-4 relative">
                <span class="absolute top-1/2 -left-12 w-8 h-[1px] bg-[#D4A373]"></span>
                Premium Islamic Entertainment
                <span class="absolute top-1/2 -right-12 w-8 h-[1px] bg-[#D4A373]"></span>
            </span>
            
            <h1 class="text-6xl sm:text-8xl md:text-[8rem] font-serif text-[#2C1810] leading-[0.9] tracking-tight">
                Harmoni <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#D4A373] to-[#b88655] italic pr-2">Jiwa</span> <br>
                Yang Abadi
            </h1>
            
            <p class="text-[#2C1810]/70 text-lg md:text-2xl font-light leading-relaxed max-w-2xl mx-auto">
                Menghadirkan keanggunan seni musik gambus dan sholawat untuk menyempurnakan momen sakral Anda dengan nuansa yang menenangkan.
            </p>

            <div class="pt-12 flex flex-col sm:flex-row gap-6 justify-center w-full max-w-md mx-auto sm:max-w-none">
                <a href="{{ route('booking.create') }}" class="group relative px-10 py-5 bg-[#2C1810] text-[#FDFCF8] rounded-full font-bold text-sm tracking-widest uppercase overflow-hidden transition-all hover:shadow-2xl hover:shadow-[#2C1810]/20 hover:-translate-y-1">
                    <span class="relative z-10 flex items-center justify-center gap-3">
                        Cek Ketersediaan
                        <svg class="w-5 h-5 transition-transform group-hover:translate-x-1 text-[#D4A373]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </span>
                </a>
                <a href="#tentang" class="flex items-center justify-center gap-3 px-10 py-5 bg-white/50 border-2 border-[#2C1810]/10 text-[#2C1810] rounded-full font-bold text-sm tracking-widest uppercase hover:bg-white hover:border-[#D4A373] transition">
                    Pelajari Kami
                </a>
            </div>
        </div>
    </header>

    <div class="py-8 bg-[#2C1810] overflow-hidden relative z-20 rotate-[-2deg] scale-110 my-12">
        <div class="marquee-track">
            @for($i=0; $i<4; $i++)
            <div class="flex items-center gap-8 px-8">
                <span class="text-4xl md:text-5xl font-serif text-[#FDFCF8] uppercase" style="-webkit-text-stroke: 1px #D4A373; color: transparent;">Gambus Al-Hikam</span>
                <svg class="w-8 h-8 text-[#D4A373]" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z"/></svg>
                <span class="text-4xl md:text-5xl font-serif text-[#D4A373] italic">Professional & Syahdu</span>
                <svg class="w-8 h-8 text-[#D4A373]" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z"/></svg>
            </div>
            @endfor
        </div>
    </div>

    <section id="tentang" class="py-32 px-6 md:px-12 bg-[#F7F4ED] relative overflow-hidden rounded-t-[4rem] -mt-20">
        <div class="absolute top-0 right-0 text-[20rem] font-serif text-[#D4A373]/5 leading-none pointer-events-none">AH</div>

        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-20 items-center relative z-10">
            <div class="appear-trigger">
                <h2 class="text-5xl md:text-7xl font-serif text-[#2C1810] mb-8 leading-tight">
                    Mengapa <br>
                    <span class="italic text-[#D4A373] relative pl-4">
                        Berbeda?
                        <span class="absolute left-0 top-0 bottom-0 w-1 bg-[#D4A373]"></span>
                    </span>
                </h2>
                <p class="text-[#2C1810]/70 text-xl leading-relaxed mb-12">
                    Kami tidak sekadar bermain musik. Kami merancang suasana. Kombinasi antara tradisi yang dalam, profesionalitas modern, dan sentuhan hati.
                </p>
                
                <div class="space-y-8">
                     <div class="flex gap-6 items-start group">
                        <div class="w-16 h-16 rounded-2xl bg-[#D4A373]/20 flex items-center justify-center shrink-0 group-hover:bg-[#2C1810] transition duration-500">
                            <svg class="w-8 h-8 text-[#D4A373] group-hover:text-[#FDFCF8]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-serif text-[#2C1810] mb-2">Kualitas Premium</h3>
                            <p class="text-[#2C1810]/60">Sound system berkualitas tinggi dan instrumen terawat untuk output audio terbaik.</p>
                        </div>
                    </div>
                     <div class="flex gap-6 items-start group">
                        <div class="w-16 h-16 rounded-2xl bg-[#D4A373]/20 flex items-center justify-center shrink-0 group-hover:bg-[#2C1810] transition duration-500">
                            <svg class="w-8 h-8 text-[#D4A373] group-hover:text-[#FDFCF8]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-serif text-[#2C1810] mb-2">Disiplin Waktu</h3>
                            <p class="text-[#2C1810]/60">Kami menghargai waktu Anda. Tim selalu hadir lebih awal untuk persiapan matang.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="galeri" class="py-32 bg-[#FDFCF8] relative">
        <div class="px-6 md:px-12 mb-16 flex flex-col md:flex-row justify-between items-end gap-6">
            <div>
                <span class="text-[#D4A373] font-bold tracking-widest uppercase text-sm mb-4 block">Dokumentasi</span>
                <h2 class="text-5xl md:text-6xl font-serif text-[#2C1810]">Momen <span class="italic text-[#D4A373]">Berharga</span></h2>
            </div>
            <p class="text-[#2C1810]/60 max-w-sm text-right hidden md:block">Geser untuk melihat keindahan dalam setiap acara yang kami iringi.</p>
        </div>

        <div class="flex overflow-x-auto gap-8 px-6 md:px-12 pb-12 snap-x mandatory hide-scrollbar">
            @forelse($galleries as $gallery)
                <div class="min-w-[320px] md:min-w-[450px] aspect-[2/3] relative rounded-[2.5rem] overflow-hidden shadow-xl snap-center group cursor-pointer border-4 border-white">
                    <img src="{{ asset('storage/' . $gallery->image_path) }}" 
                         class="w-full h-full object-cover transition duration-1000 group-hover:scale-110 group-hover:rotate-1" 
                         loading="lazy" alt="{{ $gallery->title }}">
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-[#2C1810] via-[#2C1810]/20 to-transparent opacity-80"></div>
                    
                    <div class="absolute bottom-0 left-0 p-8 w-full">
                        <span class="inline-block px-4 py-1 bg-[#D4A373] rounded-full text-xs font-bold text-[#2C1810] mb-4 tracking-widest uppercase">
                            Dokumentasi
                        </span>
                        <h3 class="text-3xl font-serif text-[#FDFCF8] leading-tight group-hover:translate-x-2 transition-transform">{{ $gallery->title }}</h3>
                    </div>
                </div>
            @empty
                <div class="min-w-[320px] md:min-w-[450px] aspect-[2/3] rounded-[2.5rem] bg-[#F7F4ED] flex flex-col items-center justify-center text-center p-8 border-4 border-dashed border-[#D4A373]/20">
                    <svg class="w-12 h-12 text-[#D4A373]/40 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <p class="text-[#2C1810]/50 font-medium">Belum ada foto galeri.</p>
                </div>
            @endforelse
             <div class="min-w-[50px] h-10"></div>
        </div>
    </section>

    <footer class="bg-[#F7F4ED] pt-32 pb-12 px-6 md:px-12 rounded-t-[5rem] relative z-10 overflow-hidden">
         <div class="absolute -top-24 left-1/2 -translate-x-1/2 text-[15vw] font-serif text-[#D4A373]/5 leading-none pointer-events-none whitespace-nowrap">
            AL-HIKAM MUSIC
        </div>

        <div class="max-w-7xl mx-auto relative z-10">
             <div class="text-center mb-24">
                <h2 class="text-5xl md:text-7xl font-serif text-[#2C1810] mb-8">Siap Menciptakan <br> <span class="italic text-[#D4A373]">Harmoni?</span></h2>
                <a href="{{ route('booking.create') }}" class="inline-flex items-center gap-4 px-12 py-6 bg-[#2C1810] text-[#D4A373] rounded-full text-sm font-bold tracking-[0.2em] uppercase hover:bg-[#D4A373] hover:text-[#2C1810] transition duration-300 shadow-2xl hover:shadow-[#D4A373]/30">
                    Amankan Tanggal Anda
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-12 gap-12 border-t border-[#2C1810]/10 pt-16">
                <div class="md:col-span-5 space-y-6">
                    <div class="flex items-center gap-3">
                        <span class="text-[#2C1810] font-serif font-bold text-3xl tracking-widest">AL-HIKAM</span>
                    </div>
                    <p class="text-[#2C1810]/60 text-lg leading-relaxed max-w-sm">
                        Partner terpercaya untuk hiburan islami yang elegan, syahdu, dan profesional.
                    </p>
                </div>

                <div class="md:col-span-4 space-y-6">
                    <h4 class="text-[#D4A373] font-bold uppercase tracking-widest text-xs mb-4">Kontak & Alamat</h4>
                    
                    <div class="space-y-4">
                         <div class="flex gap-4 text-[#2C1810]/80">
                            <svg class="w-6 h-6 text-[#D4A373] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <span class="font-medium">{{ $settings->address ?? 'Alamat studio belum diatur.' }}</span>
                        </div>
                        <a href="https://wa.me/{{ $settings->whatsapp_number ?? '' }}" target="_blank" class="flex gap-4 text-[#2C1810]/80 hover:text-[#D4A373] transition group">
                            <svg class="w-6 h-6 text-[#D4A373] shrink-0 group-hover:scale-110 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            <span class="font-medium">{{ $settings->whatsapp_number ?? 'Hubungi Kami' }} (WhatsApp)</span>
                        </a>
                    </div>
                </div>

                <div class="md:col-span-3 space-y-6">
                    <h4 class="text-[#D4A373] font-bold uppercase tracking-widest text-xs mb-4">Ikuti Kami</h4>
                    <div class="flex gap-4">
                        @if($settings->instagram_link)
                        <a href="{{ $settings->instagram_link }}" target="_blank" class="w-14 h-14 rounded-full bg-[#FDFCF8] border-2 border-[#D4A373]/20 flex items-center justify-center text-[#2C1810] hover:bg-[#D4A373] hover:border-[#D4A373] hover:text-[#FDFCF8] transition-all duration-300 hover:scale-110 hover:rotate-6 shadow-sm">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                        @endif
                        @if($settings->facebook_link)
                        <a href="{{ $settings->facebook_link }}" target="_blank" class="w-14 h-14 rounded-full bg-[#FDFCF8] border-2 border-[#D4A373]/20 flex items-center justify-center text-[#2C1810] hover:bg-[#D4A373] hover:border-[#D4A373] hover:text-[#FDFCF8] transition-all duration-300 hover:scale-110 hover:rotate-6 shadow-sm">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/></svg>
                        </a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="text-center pt-12 text-[#2C1810]/30 text-xs font-medium tracking-widest uppercase">
                &copy; {{ date('Y') }} Gambus Al-Hikam Management. Excellence in Islamic Music.
            </div>
        </div>
    </footer>

    <div class="fixed bottom-4 inset-x-4 z-40 md:hidden animate-pulse-slow">
        <a href="{{ route('booking.create') }}" class="group relative block w-full">
            <div class="absolute inset-0 bg-[#D4A373] rounded-full blur-xl opacity-30 group-hover:opacity-50 transition duration-500"></div>
            
            <div class="relative bg-[#2C1810] h-16 rounded-full flex items-center justify-between px-8 border-2 border-[#D4A373]/50 shadow-2xl">
                <span class="text-[#FDFCF8] font-bold text-sm tracking-widest uppercase">Booking Sekarang</span>
                <div class="w-10 h-10 bg-[#D4A373] rounded-full flex items-center justify-center text-[#2C1810] group-hover:rotate-45 transition duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M12 5l7 7-7 7"/></svg>
                </div>
            </div>
        </a>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const triggers = document.querySelectorAll('.appear-trigger');
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        // Add 'visible' class to children with 'appear' class
                        entry.target.querySelectorAll('.appear, h1, h2, p, .group, .relative').forEach((el, index) => {
                            setTimeout(() => {
                                el.classList.add('appear', 'visible');
                            }, index * 150); // Staggered effect
                        });
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.2 });

            triggers.forEach(trigger => observer.observe(trigger));
            
            // Navbar scroll effect
            const nav = document.querySelector('nav');
            window.addEventListener('scroll', () => {
                if (window.scrollY > 50) {
                    nav.classList.add('py-2');
                    nav.querySelector('div').classList.add('bg-white/90', 'shadow-xl');
                } else {
                    nav.classList.remove('py-2');
                    nav.querySelector('div').classList.remove('bg-white/90', 'shadow-xl');
                }
            });
        });
    </script>

</body>
</html>