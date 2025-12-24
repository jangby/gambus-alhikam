<x-app-layout>
    <div class="-mt-4 -mx-4 pb-20 bg-[#FEFAE0] min-h-screen">
        
        <div class="bg-gradient-to-br from-gambus-primary to-[#2C1810] relative pt-8 pb-24 rounded-b-[40px] shadow-xl overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-full overflow-hidden opacity-20">
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-gambus-secondary rounded-full blur-3xl"></div>
                <div class="absolute top-10 -left-10 w-32 h-32 bg-[#8B6E4E] rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 right-1/2 w-24 h-24 bg-white opacity-10 rounded-full blur-2xl"></div>
            </div>

            <div class="relative z-10 px-6 flex justify-between items-start">
                <div class="text-white">
                    <p class="text-gambus-secondary text-sm font-medium mb-1">Assalamualaikum,</p>
                    <h1 class="text-2xl font-bold tracking-tight capitalize">{{ explode(' ', Auth::user()->name)[0] }}</h1>
                    <span class="inline-block mt-2 bg-black/20 border border-white/10 backdrop-blur-md text-xs py-1 px-3 rounded-full text-[#FEFAE0]">
                        {{ $member->position ?? 'Personil' }}
                    </span>
                </div>
                
                <div class="h-12 w-12 rounded-full bg-gradient-to-tr from-gambus-secondary to-[#F3E5AB] p-0.5 shadow-lg">
                    <div class="h-full w-full rounded-full bg-gambus-primary flex items-center justify-center overflow-hidden">
                        <span class="text-xl">👳‍♂️</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="px-6 -mt-16 relative z-20">
            <div class="bg-white rounded-2xl p-5 shadow-[0_8px_30px_rgb(0,0,0,0.06)] border border-[#EFEAD8] relative overflow-hidden">
                <div class="absolute -right-4 -bottom-4 opacity-5">
                    <svg class="w-24 h-24 text-gambus-primary" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm.31-8.86c-1.77-.45-2.34-.94-2.34-1.67 0-.84.79-1.43 2.1-1.43 1.38 0 1.9.66 1.94 1.64h1.71c-.05-1.34-.87-2.57-2.49-2.97V5H10.9v1.69c-1.51.32-2.72 1.3-2.72 2.81 0 1.79 1.49 2.69 3.66 3.21 1.95.46 2.34 1.15 2.34 1.87 0 .53-.39 1.39-2.1 1.39-1.6 0-2.23-.72-2.32-1.64H8.04c.1 1.7 1.36 2.66 2.86 2.97V19h2.34v-1.67c1.52-.29 2.72-1.16 2.73-2.77-.01-2.2-1.9-2.96-3.66-3.42z"/></svg>
                </div>

                <div class="flex justify-between items-center mb-2 relative z-10">
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Saldo Kas Grup</p>
                    <a href="{{ route('member.finance') }}" class="text-xs text-gambus-primary font-bold bg-[#FEFAE0] px-3 py-1.5 rounded-lg hover:bg-gambus-secondary hover:text-white transition border border-gambus-secondary/30">
                        Detail &rarr;
                    </a>
                </div>
                <h2 class="text-3xl font-extrabold text-gambus-text tracking-tight relative z-10">
                    Rp {{ number_format($currentBalance ?? 0, 0, ',', '.') }}
                </h2>
                <div class="mt-3 flex items-center gap-2 text-xs text-gray-500 bg-[#FEFAE0]/50 p-2 rounded-lg relative z-10">
                    <svg class="w-4 h-4 text-gambus-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                    <span>Update Terakhir: Hari ini</span>
                </div>
            </div>
        </div>

        <div class="px-6 mt-6 space-y-6">

            <div>
                <div class="flex justify-between items-end mb-4">
                    <h3 class="font-bold text-gambus-primary text-lg">Manggung Terdekat</h3>
                    <a href="{{ route('member.schedule') }}" class="text-sm text-gray-400 hover:text-gambus-secondary transition">Lihat Semua</a>
                </div>

                @if($nextJob)
                <div class="group bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100 hover:shadow-md transition-shadow relative">
                    <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-gambus-primary"></div>
                    
                    <div class="p-5 pl-7"> 
                        <div class="flex justify-between items-start mb-3">
                            <div class="flex flex-col">
                                <span class="text-xs font-bold text-gambus-secondary uppercase mb-1 tracking-wide">
                                    {{ \Carbon\Carbon::parse($nextJob->event_date)->isoFormat('MMMM') }}
                                </span>
                                <span class="text-3xl font-bold text-gambus-text leading-none">
                                    {{ \Carbon\Carbon::parse($nextJob->event_date)->format('d') }}
                                </span>
                                <span class="text-xs text-gray-400 mt-1 uppercase font-bold">
                                    {{ \Carbon\Carbon::parse($nextJob->event_date)->isoFormat('dddd') }}
                                </span>
                            </div>
                            <div class="text-right">
                                <span class="block text-xl font-bold text-gambus-primary">{{ $nextJob->event_time }}</span>
                                <span class="block text-[10px] text-gray-400 uppercase font-bold">WIB</span>
                            </div>
                        </div>

                        <div class="border-t border-dashed border-gray-200 my-3"></div>

                        <div class="space-y-3">
                            <div class="flex items-start gap-3">
                                <div class="bg-[#FEFAE0] p-1.5 rounded-full mt-0.5">
                                    <svg class="w-3.5 h-3.5 text-gambus-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                </div>
                                <p class="text-sm text-gray-600 font-medium line-clamp-2 leading-relaxed">
                                    {{ $nextJob->venue_address }}
                                </p>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="bg-[#FEFAE0] p-1.5 rounded-full">
                                    <svg class="w-3.5 h-3.5 text-gambus-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/></svg>
                                </div>
                                <p class="text-sm font-bold text-gambus-secondary">
                                    {{ $nextJob->event_theme ?? 'Tema Menyesuaikan' }}
                                </p>
                            </div>
                        </div>

                        @if($nextJob->location_gmaps)
                        <a href="{{ $nextJob->location_gmaps }}" target="_blank" class="mt-5 block w-full bg-gambus-primary text-white text-center py-3 rounded-xl text-sm font-bold hover:bg-[#3E2D20] transition active:scale-[0.98] shadow-lg shadow-gambus-primary/20">
                            Buka Maps Lokasi 🗺️
                        </a>
                        @endif
                    </div>
                </div>
                @else
                <div class="bg-white rounded-2xl p-8 text-center border border-gray-100 shadow-sm">
                    <div class="bg-[#FEFAE0] w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-3 border border-gambus-secondary/30">
                        <svg class="w-8 h-8 text-gambus-secondary opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                    </div>
                    <p class="text-gambus-primary font-medium">Belum ada jadwal manggung</p>
                    <p class="text-xs text-gray-400 mt-1">Istirahat dulu, kumpulkan energi! ☕</p>
                </div>
                @endif
            </div>

            <div>
                <h3 class="font-bold text-gambus-primary text-lg mb-4">Menu Pintas</h3>
                <div class="grid grid-cols-2 gap-4">
                    <a href="{{ route('member.finance') }}" class="flex flex-col items-center justify-center p-5 bg-white border border-gray-100 rounded-2xl shadow-sm active:bg-[#FEFAE0] transition active:scale-95 group hover:border-gambus-secondary/50">
                        <div class="w-12 h-12 rounded-full bg-[#FEFAE0] text-gambus-primary flex items-center justify-center mb-3 group-hover:bg-gambus-primary group-hover:text-white transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 3.666A5.002 5.002 0 0115 17m7-5v-3.5a.5.5 0 00-.5-.5H5.5a.5.5 0 00-.5.5V12m16 0h-6.25a3.75 3.75 0 01-7.5 0"/></svg>
                        </div>
                        <span class="text-sm font-bold text-gray-700 group-hover:text-gambus-primary">Laporan Kas</span>
                        <span class="text-[10px] text-gray-400">Transparansi</span>
                    </a>

                    <a href="{{ route('profile.edit') }}" class="flex flex-col items-center justify-center p-5 bg-white border border-gray-100 rounded-2xl shadow-sm active:bg-[#FEFAE0] transition active:scale-95 group hover:border-gambus-secondary/50">
                        <div class="w-12 h-12 rounded-full bg-orange-50 text-orange-600 flex items-center justify-center mb-3 group-hover:bg-orange-100 transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <span class="text-sm font-bold text-gray-700 group-hover:text-orange-600">Pengaturan</span>
                        <span class="text-[10px] text-gray-400">Edit Profil</span>
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>