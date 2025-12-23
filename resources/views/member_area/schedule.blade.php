<x-app-layout>
    <div class="-mt-4 -mx-4 bg-gray-50 min-h-screen pb-24">
        
        <div class="bg-white sticky top-0 z-30 px-6 py-4 shadow-sm border-b border-gray-100 flex justify-between items-center">
            <h1 class="font-bold text-xl text-gray-800">Kalender Gigs</h1>
            <div class="bg-emerald-100 text-emerald-700 text-xs font-bold px-3 py-1 rounded-full">
                {{ $schedules->count() }} Jadwal
            </div>
        </div>

        <div class="px-6 py-6 space-y-6">
            @forelse($schedules as $job)
                <div class="relative pl-4">
                    @if(!$loop->last)
                        <div class="absolute left-[19px] top-8 bottom-[-40px] w-0.5 bg-gray-200"></div>
                    @endif
                    
                    <div class="absolute left-3 top-3 w-4 h-4 bg-emerald-500 rounded-full border-4 border-emerald-100 shadow-sm z-10"></div>

                    <div class="ml-6 bg-white rounded-2xl p-5 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07)] border border-gray-100">
                        <div class="flex justify-between items-start mb-3 border-b border-dashed border-gray-100 pb-3">
                            <div class="flex items-center gap-3">
                                <div class="text-center bg-gray-50 rounded-lg px-2.5 py-1 border border-gray-200">
                                    <span class="block text-xs font-bold text-gray-500 uppercase">{{ \Carbon\Carbon::parse($job->event_date)->isoFormat('MMM') }}</span>
                                    <span class="block text-xl font-bold text-gray-800">{{ \Carbon\Carbon::parse($job->event_date)->format('d') }}</span>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-gray-800">{{ \Carbon\Carbon::parse($job->event_date)->isoFormat('dddd') }}</p>
                                    <p class="text-xs text-gray-500 flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        {{ $job->event_time }} WIB
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <div class="flex items-start gap-2">
                                <div class="mt-0.5 w-5 h-5 rounded-full bg-blue-50 flex items-center justify-center shrink-0">
                                    <svg class="w-3 h-3 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                </div>
                                <p class="text-sm text-gray-600 leading-snug">{{ $job->venue_address }}</p>
                            </div>

                            <div class="flex items-center gap-2">
                                <div class="w-5 h-5 rounded-full bg-purple-50 flex items-center justify-center shrink-0">
                                    <svg class="w-3 h-3 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/></svg>
                                </div>
                                <p class="text-sm font-bold text-purple-600">{{ $job->event_theme ?? 'Menyesuaikan' }}</p>
                            </div>
                        </div>

                        @if($job->location_gmaps)
                            <a href="{{ $job->location_gmaps }}" target="_blank" class="mt-4 flex items-center justify-center w-full py-2.5 bg-gray-50 hover:bg-emerald-50 text-gray-600 hover:text-emerald-700 rounded-xl text-xs font-bold transition border border-gray-100">
                                Buka Google Maps 🗺️
                            </a>
                        @endif
                    </div>
                </div>
            @empty
                <div class="flex flex-col items-center justify-center h-[60vh] text-center px-6">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-6 shadow-inner">
                        <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800">Jadwal Kosong</h3>
                    <p class="text-gray-500 text-sm mt-2 leading-relaxed">Saat ini belum ada jadwal manggung yang dikonfirmasi. Nikmati waktu luangmu!</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>