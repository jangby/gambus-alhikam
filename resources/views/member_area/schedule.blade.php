<x-app-layout>
    <div class="-mt-4 -mx-4 bg-[#FEFAE0] min-h-screen pb-24 relative">
        
        <div class="fixed top-20 right-0 p-10 pointer-events-none opacity-5 z-0">
            <img src="{{ asset('logo.jpeg') }}" class="w-80 h-80 object-contain grayscale" alt="Watermark">
        </div>

        <div class="bg-white sticky top-0 z-30 px-6 py-4 shadow-sm border-b border-[#EFEAD8] flex justify-between items-center">
            <h1 class="font-bold text-xl text-gambus-primary">Kalender Gigs</h1>
            <div class="bg-[#FEFAE0] text-gambus-primary border border-gambus-secondary/30 text-xs font-bold px-3 py-1 rounded-full shadow-sm">
                {{ $schedules->count() }} Jadwal
            </div>
        </div>

        <div class="px-6 py-6 space-y-6 relative z-10">
            @forelse($schedules as $job)
                <div class="relative pl-4">
                    @if(!$loop->last)
                        <div class="absolute left-[19px] top-8 bottom-[-40px] w-0.5 bg-gambus-secondary/30"></div>
                    @endif
                    
                    <div class="absolute left-3 top-3 w-4 h-4 bg-gambus-secondary rounded-full border-4 border-[#FEFAE0] shadow-sm z-10"></div>

                    <div class="ml-6 bg-white rounded-2xl p-5 shadow-[0_2px_15px_-3px_rgba(74,55,40,0.1)] border border-[#EFEAD8] group hover:border-gambus-secondary/50 transition duration-300">
                        
                        <div class="flex justify-between items-start mb-3 border-b border-dashed border-gray-200 pb-3">
                            <div class="flex items-center gap-3">
                                <div class="text-center bg-[#FEFAE0] rounded-lg px-3 py-1.5 border border-gambus-secondary/20 min-w-[3.5rem]">
                                    <span class="block text-[10px] font-bold text-gambus-secondary uppercase tracking-wide">{{ \Carbon\Carbon::parse($job->event_date)->isoFormat('MMM') }}</span>
                                    <span class="block text-xl font-bold text-gambus-primary">{{ \Carbon\Carbon::parse($job->event_date)->format('d') }}</span>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-gambus-text">{{ \Carbon\Carbon::parse($job->event_date)->isoFormat('dddd') }}</p>
                                    <p class="text-xs text-gray-500 flex items-center gap-1 mt-0.5">
                                        <svg class="w-3 h-3 text-gambus-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        <span class="font-medium">{{ $job->event_time }} WIB</span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <div class="flex items-start gap-2.5">
                                <div class="mt-0.5 w-6 h-6 rounded-full bg-[#FEFAE0] flex items-center justify-center shrink-0">
                                    <svg class="w-3.5 h-3.5 text-gambus-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                </div>
                                <div>
                                    <p class="text-[10px] text-gray-400 font-bold uppercase mb-0.5">Lokasi</p>
                                    <p class="text-sm text-gray-700 leading-snug font-medium">{{ $job->venue_address }}</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-2.5">
                                <div class="w-6 h-6 rounded-full bg-[#FEFAE0] flex items-center justify-center shrink-0">
                                    <svg class="w-3.5 h-3.5 text-gambus-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/></svg>
                                </div>
                                <div>
                                    <p class="text-[10px] text-gray-400 font-bold uppercase mb-0.5">Tema</p>
                                    <p class="text-sm font-bold text-gambus-secondary">{{ $job->event_theme ?? 'Menyesuaikan' }}</p>
                                </div>
                            </div>
                        </div>

                        @if($job->location_gmaps)
                            <a href="{{ $job->location_gmaps }}" target="_blank" class="mt-4 flex items-center justify-center w-full py-3 bg-[#FEFAE0]/50 hover:bg-gambus-primary text-gambus-primary hover:text-white rounded-xl text-xs font-bold transition duration-200 border border-gambus-secondary/30 group-hover:border-gambus-primary active:scale-[0.98]">
                                Buka Google Maps 🗺️
                            </a>
                        @endif
                    </div>
                </div>
            @empty
                <div class="flex flex-col items-center justify-center h-[60vh] text-center px-6">
                    <div class="w-24 h-24 bg-[#FEFAE0] rounded-full flex items-center justify-center mb-6 shadow-inner border border-gambus-secondary/20">
                        <svg class="w-10 h-10 text-gambus-secondary opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-gambus-primary">Jadwal Kosong</h3>
                    <p class="text-gambus-secondary text-sm mt-2 leading-relaxed">Saat ini belum ada jadwal manggung yang dikonfirmasi. Nikmati waktu luangmu!</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>