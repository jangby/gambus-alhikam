<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Halo, {{ Auth::user()->name }} 👋
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-emerald-900 text-white p-6 rounded-xl shadow-lg mx-4 md:mx-0">
                <div class="flex items-center gap-4">
                    <div class="bg-white p-3 rounded-full text-emerald-900">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold">{{ $member->full_name ?? Auth::user()->name }}</h3>
                        <p class="text-emerald-200 text-sm">{{ $member->position ?? 'Anggota' }}</p>
                    </div>
                </div>
            </div>

            <div class="px-4 md:px-0">
                <h3 class="font-bold text-gray-700 text-lg flex items-center gap-2">
                    📅 Jadwal Manggung Kamu
                </h3>
            </div>

            <div class="mx-4 md:mx-0 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @forelse($schedules as $job)
                <div class="bg-white rounded-xl shadow-sm border-l-4 border-emerald-500 overflow-hidden">
                    <div class="p-5">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <p class="text-xs font-bold text-gray-400 uppercase">TANGGAL</p>
                                <p class="font-bold text-gray-800 text-lg">
                                    {{ \Carbon\Carbon::parse($job->event_date)->isoFormat('dddd, D MMMM Y') }}
                                </p>
                            </div>
                            <div class="bg-emerald-100 text-emerald-800 text-xs font-bold px-2 py-1 rounded">
                                {{ $job->event_time }}
                            </div>
                        </div>
                        
                        <div class="space-y-2 mt-4">
                            <div>
                                <p class="text-xs text-gray-400">LOKASI:</p>
                                <p class="text-sm font-medium text-gray-700 line-clamp-2">{{ $job->venue_address }}</p>
                            </div>
                            
                            <div>
                                <p class="text-xs text-gray-400">KOSTUM / TEMA:</p>
                                <p class="text-sm font-bold text-purple-600">{{ $job->event_theme ?? 'Menyesuaikan' }}</p>
                            </div>
                        </div>

                        <div class="mt-5 pt-4 border-t border-gray-100 flex gap-2">
                            @if($job->location_gmaps)
                            <a href="{{ $job->location_gmaps }}" target="_blank" class="flex-1 bg-blue-50 text-blue-600 text-center py-2 rounded text-xs font-bold hover:bg-blue-100">
                                🗺️ Buka Maps
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="bg-white p-8 rounded-xl shadow-sm text-center md:col-span-3">
                    <p class="text-gray-400 text-sm">Belum ada jadwal manggung dalam waktu dekat.</p>
                    <p class="text-gray-300 text-xs mt-1">Istirahat dulu ya! ☕</p>
                </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>