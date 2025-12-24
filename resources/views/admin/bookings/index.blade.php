<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-lg text-[#FEFAE0] leading-tight">
            📋 Manajemen Jadwal
        </h2>
    </x-slot>

    <div class="pb-24 pt-4 px-2 max-w-xl mx-auto md:max-w-5xl relative min-h-screen">

        <div class="fixed bottom-0 left-0 p-10 pointer-events-none opacity-5 z-0">
            <img src="{{ asset('logo.jpeg') }}" class="w-96 h-96 object-contain grayscale" alt="Watermark">
        </div>

        <div class="relative z-10">
            
            <div class="bg-[#EFEAD8] p-1 rounded-xl flex items-center mb-6 relative border border-gambus-secondary/30">
                <button class="flex-1 bg-gambus-primary text-white shadow-md rounded-lg py-2 text-sm font-bold transition-all transform scale-100">
                    <span class="flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" /></svg>
                        List View
                    </span>
                </button>
                
                <a href="{{ route('calendar.index') }}" class="flex-1 text-gambus-primary/70 hover:text-gambus-primary py-2 text-sm font-medium transition-all hover:bg-white/50 rounded-lg">
                    <span class="flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                        Kalender
                    </span>
                </a>
            </div>

            <div class="relative mb-4">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gambus-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                </div>
                <input type="text" id="searchInput" onkeyup="searchFunction()" placeholder="Cari nama pemesan atau lokasi..." class="w-full pl-10 rounded-xl border-gray-200 shadow-sm text-sm focus:ring-gambus-secondary focus:border-gambus-secondary py-3 bg-white text-gambus-text placeholder-gray-400">
            </div>

            <div class="space-y-4" id="bookingList">
                @forelse($bookings as $booking)
                <a href="{{ route('dashboard.show', $booking->id) }}" class="booking-item block bg-white p-4 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md hover:border-gambus-secondary transition relative overflow-hidden group">
                    
                    <div class="absolute left-0 top-0 bottom-0 w-1.5 
                        @if($booking->status == 'confirmed') bg-gambus-primary 
                        @elseif($booking->status == 'pending') bg-gambus-secondary 
                        @elseif($booking->status == 'completed') bg-gray-400 
                        @else bg-red-400 @endif">
                    </div>

                    <div class="flex justify-between items-center pl-3">
                        <div class="text-center min-w-[3.8rem] mr-3 bg-[#FEFAE0] rounded-lg py-2 border border-[#EFEAD8] group-hover:border-gambus-secondary transition">
                            <span class="block text-xl font-bold text-gambus-primary leading-none">
                                {{ \Carbon\Carbon::parse($booking->event_date)->format('d') }}
                            </span>
                            <span class="block text-[10px] uppercase font-bold text-gambus-text/60 mt-0.5">
                                {{ \Carbon\Carbon::parse($booking->event_date)->isoFormat('MMM') }}
                            </span>
                        </div>

                        <div class="flex-1 min-w-0 pr-2">
                            <h3 class="search-name font-bold text-gambus-text truncate text-sm mb-0.5 group-hover:text-gambus-primary transition">
                                {{ $booking->booker_name }}
                            </h3>
                            
                            <div class="flex items-center gap-2 text-xs text-gray-500 mb-1">
                                <span class="bg-gray-100 text-gambus-text px-1.5 py-0.5 rounded font-bold text-[10px] border border-gray-200">
                                    {{ $booking->event_time }}
                                </span>
                                <span class="truncate max-w-[120px] text-gambus-secondary font-medium">{{ $booking->event_theme ?? 'No Theme' }}</span>
                            </div>

                            <div class="search-loc flex items-center gap-1 text-[11px] text-gray-400">
                                <svg class="w-3 h-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /></svg>
                                <span class="truncate">{{ $booking->venue_address }}</span>
                            </div>
                        </div>

                        <div class="flex-shrink-0">
                            @if($booking->status == 'confirmed')
                                <div class="bg-gambus-primary/10 text-gambus-primary p-2 rounded-full">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                </div>
                            @elseif($booking->status == 'pending')
                                <div class="bg-yellow-100 text-gambus-secondary p-2 rounded-full animate-pulse">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                </div>
                            @elseif($booking->status == 'completed')
                                <div class="bg-gray-100 text-gray-400 p-2 rounded-full">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                </div>
                            @else
                                <div class="bg-red-100 text-red-500 p-2 rounded-full">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                </div>
                            @endif
                        </div>
                    </div>
                </a>
                @empty
                <div class="text-center py-12">
                    <div class="bg-[#FEFAE0] rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-3 border border-gambus-secondary/30">
                        <svg class="w-10 h-10 text-gambus-secondary opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                    </div>
                    <p class="text-gambus-primary text-sm font-medium">Belum ada jadwal.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <script>
        function searchFunction() {
            var input, filter, container, items, name, loc, i;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            container = document.getElementById("bookingList");
            items = container.getElementsByClassName("booking-item");

            for (i = 0; i < items.length; i++) {
                name = items[i].querySelector(".search-name").textContent || items[i].querySelector(".search-name").innerText;
                loc = items[i].querySelector(".search-loc").textContent || items[i].querySelector(".search-loc").innerText;
                
                if (name.toUpperCase().indexOf(filter) > -1 || loc.toUpperCase().indexOf(filter) > -1) {
                    items[i].style.display = "";
                } else {
                    items[i].style.display = "none";
                }
            }
        }
    </script>
</x-app-layout>