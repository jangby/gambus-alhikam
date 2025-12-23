<x-app-layout>
    <div class="-mt-4 -mx-4 pb-20 bg-gray-50 min-h-screen">
        
        <div class="bg-emerald-900 relative pt-8 pb-24 rounded-b-[40px] shadow-lg overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-full overflow-hidden opacity-10">
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-white rounded-full blur-3xl"></div>
                <div class="absolute top-10 -left-10 w-32 h-32 bg-emerald-400 rounded-full blur-3xl"></div>
            </div>

            <div class="relative z-10 px-6 flex justify-between items-start">
                <div class="text-white">
                    <p class="text-emerald-200 text-sm font-medium mb-1">Assalamualaikum,</p>
                    <h1 class="text-2xl font-bold tracking-tight">{{ explode(' ', Auth::user()->name)[0] }}</h1>
                    <span class="inline-block mt-2 bg-emerald-800/50 border border-emerald-700/50 backdrop-blur-sm text-xs py-1 px-3 rounded-full text-emerald-100">
                        {{ $member->position ?? 'Anggota' }}
                    </span>
                </div>
                
                <div class="h-12 w-12 rounded-full bg-gradient-to-tr from-emerald-400 to-teal-300 p-0.5 shadow-lg">
                    <div class="h-full w-full rounded-full bg-emerald-900 flex items-center justify-center overflow-hidden">
                        <span class="text-xl">👳‍♂️</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="px-6 -mt-16 relative z-20">
            <div class="bg-white rounded-2xl p-5 shadow-[0_8px_30px_rgb(0,0,0,0.06)] border border-gray-100">
                <div class="flex justify-between items-center mb-2">
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Saldo Kas Grup</p>
                    <a href="{{ route('member.finance') }}" class="text-xs text-emerald-600 font-bold bg-emerald-50 px-2 py-1 rounded hover:bg-emerald-100 transition">
                        Detail &rarr;
                    </a>
                </div>
                <h2 class="text-3xl font-extrabold text-gray-800 tracking-tight">
                    Rp {{ number_format($currentBalance ?? 0, 0, ',', '.') }}
                </h2>
                <div class="mt-3 flex items-center gap-2 text-xs text-gray-500 bg-gray-50 p-2 rounded-lg">
                    <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                    <span>Update Terakhir: Hari ini</span>
                </div>
            </div>
        </div>

        <div class="px-6 mt-6 space-y-6">

            <div>
                <div class="flex justify-between items-end mb-4">
                    <h3 class="font-bold text-gray-800 text-lg">Manggung Terdekat</h3>
                    <a href="{{ route('member.schedule') }}" class="text-sm text-gray-400 hover:text-emerald-600 transition">Lihat Semua</a>
                </div>

                @if($nextJob)
                <div class="group bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100 hover:shadow-md transition-shadow relative">
                    <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-emerald-500"></div>
                    
                    <div class="p-5 pl-7"> <div class="flex justify-between items-start mb-3">
                            <div class="flex flex-col">
                                <span class="text-xs font-bold text-emerald-600 uppercase mb-1">
                                    {{ \Carbon\Carbon::parse($nextJob->event_date)->isoFormat('MMMM') }}
                                </span>
                                <span class="text-2xl font-bold text-gray-800 leading-none">
                                    {{ \Carbon\Carbon::parse($nextJob->event_date)->format('d') }}
                                </span>
                                <span class="text-xs text-gray-500 mt-1">
                                    {{ \Carbon\Carbon::parse($nextJob->event_date)->isoFormat('dddd') }}
                                </span>
                            </div>
                            <div class="text-right">
                                <span class="block text-lg font-bold text-gray-800">{{ $nextJob->event_time }}</span>
                                <span class="block text-[10px] text-gray-400 uppercase font-bold">WIB</span>
                            </div>
                        </div>

                        <div class="border-t border-dashed border-gray-100 my-3"></div>

                        <div class="space-y-2">
                            <div class="flex items-start gap-2">
                                <svg class="w-4 h-4 text-gray-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <p class="text-sm text-gray-600 font-medium line-clamp-2 leading-relaxed">
                                    {{ $nextJob->venue_address }}
                                </p>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-purple-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/></svg>
                                <p class="text-sm font-bold text-purple-600">
                                    {{ $nextJob->event_theme ?? 'Tema Menyesuaikan' }}
                                </p>
                            </div>
                        </div>

                        @if($nextJob->location_gmaps)
                        <a href="{{ $nextJob->location_gmaps }}" target="_blank" class="mt-4 block w-full bg-emerald-50 text-emerald-700 text-center py-2.5 rounded-xl text-sm font-bold hover:bg-emerald-100 transition active:scale-[0.98]">
                            Buka Maps Lokasi 🗺️
                        </a>
                        @endif
                    </div>
                </div>
                @else
                <div class="bg-white rounded-2xl p-8 text-center border border-gray-100 shadow-sm">
                    <div class="bg-gray-50 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-3">
                        <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                    </div>
                    <p class="text-gray-500 font-medium">Belum ada jadwal manggung</p>
                    <p class="text-xs text-gray-400 mt-1">Istirahat dulu, kumpulkan energi! ☕</p>
                </div>
                @endif
            </div>

            <div>
                <h3 class="font-bold text-gray-800 text-lg mb-4">Menu Pintas</h3>
                <div class="grid grid-cols-2 gap-4">
                    <a href="{{ route('member.finance') }}" class="flex flex-col items-center justify-center p-4 bg-white border border-gray-100 rounded-2xl shadow-sm active:bg-gray-50 transition active:scale-95">
                        <div class="w-12 h-12 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center mb-2">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 3.666A5.002 5.002 0 0115 17m7-5v-3.5a.5.5 0 00-.5-.5H5.5a.5.5 0 00-.5.5V12m16 0h-6.25a3.75 3.75 0 01-7.5 0"/></svg>
                        </div>
                        <span class="text-sm font-bold text-gray-700">Laporan Kas</span>
                        <span class="text-[10px] text-gray-400">Transparansi</span>
                    </a>

                    <a href="{{ route('profile.edit') }}" class="flex flex-col items-center justify-center p-4 bg-white border border-gray-100 rounded-2xl shadow-sm active:bg-gray-50 transition active:scale-95">
                        <div class="w-12 h-12 rounded-full bg-orange-50 text-orange-600 flex items-center justify-center mb-2">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <span class="text-sm font-bold text-gray-700">Pengaturan</span>
                        <span class="text-[10px] text-gray-400">Edit Profil</span>
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>