<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="flex items-center gap-3">
                <img src="{{ asset('logo.jpeg') }}" class="w-10 h-10 rounded-full border-2 border-white shadow-sm object-cover" alt="Logo">
                <div>
                    <h2 class="font-bold text-lg text-[#FEFAE0] leading-tight">
                        Dashboard
                    </h2>
                    <span class="text-xs text-gray-500">{{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') }}</span>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="pb-24 pt-4 px-2 max-w-xl mx-auto md:max-w-5xl relative min-h-screen">

        <div class="fixed bottom-0 right-0 p-4 pointer-events-none opacity-5 z-0">
            <img src="{{ asset('logo.jpeg') }}" class="w-64 h-64 object-contain grayscale" alt="Watermark">
        </div>

        <div class="relative z-10">
            
            <div class="bg-gradient-to-r from-gambus-primary to-[#6D5440] rounded-2xl p-6 text-white shadow-xl mb-6 relative overflow-hidden border border-gambus-primary">
                <div class="absolute right-0 top-0 p-4 opacity-10">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-32 w-32" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                
                <p class="text-yellow-100/80 text-sm mb-1">Halo, Admin 👋</p>
                <p class="text-xs opacity-75 uppercase tracking-widest mb-2 font-semibold text-[#FEFAE0]">Saldo Kas Saat Ini</p>
                <h1 class="text-3xl font-bold mb-4 text-white">Rp {{ number_format($currentBalance, 0, ',', '.') }}</h1>
                
                <a href="{{ route('finance.index') }}" class="inline-flex items-center gap-2 bg-white/10 hover:bg-white/20 backdrop-blur-sm border border-white/20 px-4 py-2 rounded-lg text-xs font-bold transition text-[#FEFAE0]">
                    Lihat Detail Keuangan &rarr;
                </a>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-6">
                <a href="{{ route('calendar.index') }}" class="bg-white p-4 rounded-xl shadow-sm border-l-4 border-yellow-400 flex flex-col justify-between hover:shadow-md transition group">
                    <div class="text-gray-400 text-xs font-bold uppercase group-hover:text-yellow-600 transition">Pending</div>
                    <div class="flex justify-between items-end mt-2">
                        <span class="text-2xl font-bold text-gray-800">{{ $pendingJobs }}</span>
                        <span class="text-[10px] font-bold text-yellow-700 bg-yellow-100 px-2 py-1 rounded-md">Cek</span>
                    </div>
                </a>

                <div class="bg-white p-4 rounded-xl shadow-sm border-l-4 border-gambus-secondary flex flex-col justify-between">
                    <div class="text-gray-400 text-xs font-bold uppercase">Job Bulan Ini</div>
                    <div class="flex justify-between items-end mt-2">
                        <span class="text-2xl font-bold text-gray-800">{{ $thisMonthJobs }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gambus-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                    </div>
                </div>

                <div class="bg-white p-4 rounded-xl shadow-sm border-l-4 border-gambus-primary flex flex-col justify-between">
                    <div class="text-gray-400 text-xs font-bold uppercase">Deal / Fix</div>
                    <div class="flex justify-between items-end mt-2">
                        <span class="text-2xl font-bold text-gray-800">{{ $confirmedJobs }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gambus-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                </div>

                <a href="{{ route('members.index') }}" class="bg-white p-4 rounded-xl shadow-sm border-l-4 border-gray-500 flex flex-col justify-between hover:shadow-md transition group">
                    <div class="text-gray-400 text-xs font-bold uppercase group-hover:text-gray-600 transition">Personel</div>
                    <div class="flex justify-between items-end mt-2">
                        <span class="text-2xl font-bold text-gray-800">{{ $totalMembers }}</span>
                        <span class="text-[10px] font-bold text-gray-600 bg-gray-100 px-2 py-1 rounded-md">Aktif</span>
                    </div>
                </a>
            </div>

            <h3 class="font-bold text-gambus-primary text-lg mb-3 px-1">Acara Terdekat</h3>
            
            @if($nextJob)
            <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden mb-6 relative">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-gambus-primary to-gambus-secondary"></div>
                
                <div class="bg-[#FEFAE0] px-5 py-3 border-b border-[#F0E6D2] flex justify-between items-center">
                    <span class="text-gambus-primary text-xs font-bold uppercase tracking-wide">Next Project</span>
                    <span class="bg-white text-gambus-primary text-[10px] font-bold px-2 py-1 rounded border border-gambus-secondary/30 shadow-sm">
                        {{ \Carbon\Carbon::parse($nextJob->event_date)->diffForHumans() }}
                    </span>
                </div>
                
                <div class="p-5">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <h4 class="text-xl font-bold text-gray-800">{{ $nextJob->booker_name }}</h4>
                            <p class="text-sm text-gambus-secondary font-bold mt-1">{{ $nextJob->event_theme ?? 'Tanpa Tema Khusus' }}</p>
                        </div>
                        <div class="text-right bg-gray-50 p-2 rounded-lg border border-gray-100">
                            <p class="text-2xl font-bold text-gambus-primary">{{ \Carbon\Carbon::parse($nextJob->event_date)->format('d') }}</p>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">{{ \Carbon\Carbon::parse($nextJob->event_date)->format('M Y') }}</p>
                        </div>
                    </div>
                    
                    <div class="space-y-2 mb-5">
                        <div class="flex items-center gap-3 text-sm text-gray-600">
                            <div class="w-6 h-6 rounded-full bg-[#FEFAE0] flex items-center justify-center text-gambus-primary">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            </div>
                            <span class="font-medium">Pukul {{ $nextJob->event_time }} WIB</span>
                        </div>
                        <div class="flex items-start gap-3 text-sm text-gray-600">
                            <div class="w-6 h-6 rounded-full bg-[#FEFAE0] flex items-center justify-center text-gambus-primary mt-0.5">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                            </div>
                            <span class="line-clamp-2 font-medium">{{ $nextJob->venue_address }}</span>
                        </div>
                    </div>

                    <a href="{{ route('dashboard.show', $nextJob->id) }}" class="block w-full text-center bg-gambus-primary text-white py-3 rounded-xl font-bold text-sm hover:bg-[#3E2D20] transition shadow-lg shadow-gambus-primary/20">
                        Lihat Detail & Persiapan
                    </a>
                </div>
            </div>
            @else
            <div class="bg-[#FEFAE0] border-dashed border-2 border-gambus-secondary/30 rounded-xl p-8 text-center mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gambus-secondary mx-auto mb-3 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                <p class="text-gambus-primary font-medium text-sm">Tidak ada jadwal confirmed dalam waktu dekat.</p>
            </div>
            @endif

            <h3 class="font-bold text-gambus-primary text-lg mb-3 px-1">Menu Cepat</h3>
            <div class="grid grid-cols-2 gap-3">
                <a href="{{ route('finance.index') }}" class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex items-center gap-3 hover:bg-[#FEFAE0] hover:border-gambus-secondary transition group">
                    <div class="bg-[#FEFAE0] p-2 rounded-full text-gambus-primary group-hover:bg-white transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                    </div>
                    <span class="text-sm font-bold text-gray-700 group-hover:text-gambus-primary">Catat Kas</span>
                </a>
                
                <a href="{{ route('members.index') }}" class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex items-center gap-3 hover:bg-[#FEFAE0] hover:border-gambus-secondary transition group">
                    <div class="bg-[#FEFAE0] p-2 rounded-full text-gambus-primary group-hover:bg-white transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" /></svg>
                    </div>
                    <span class="text-sm font-bold text-gray-700 group-hover:text-gambus-primary">Add Personel</span>
                </a>
            </div>

        </div>
    </div>
</x-app-layout>