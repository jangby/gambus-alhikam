<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-lg text-gray-800 leading-tight">
                Dashboard
            </h2>
            <span class="text-xs text-gray-500">{{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') }}</span>
        </div>
    </x-slot>

    <div class="pb-24 pt-2 px-2 max-w-xl mx-auto md:max-w-5xl">

        <div class="bg-gradient-to-r from-emerald-900 to-emerald-700 rounded-2xl p-6 text-white shadow-xl mb-6 relative overflow-hidden">
            <div class="absolute right-0 top-0 p-4 opacity-10">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-32 w-32" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" /></svg>
            </div>
            
            <p class="text-emerald-100 text-sm mb-1">Halo, Admin 👋</p>
            <p class="text-xs opacity-75 uppercase tracking-widest mb-2">Saldo Kas Saat Ini</p>
            <h1 class="text-3xl font-bold mb-4">Rp {{ number_format($currentBalance, 0, ',', '.') }}</h1>
            
            <a href="{{ route('finance.index') }}" class="inline-flex items-center gap-2 bg-white/20 hover:bg-white/30 backdrop-blur-sm border border-white/30 px-4 py-2 rounded-lg text-xs font-bold transition">
                Lihat Detail Keuangan &rarr;
            </a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-6">
            <a href="{{ route('calendar.index') }}" class="bg-white p-4 rounded-xl shadow-sm border-l-4 border-yellow-400 flex flex-col justify-between hover:shadow-md transition">
                <div class="text-gray-400 text-xs font-bold uppercase">Pending</div>
                <div class="flex justify-between items-end mt-2">
                    <span class="text-2xl font-bold text-gray-800">{{ $pendingJobs }}</span>
                    <span class="text-xs text-yellow-600 bg-yellow-50 px-2 py-1 rounded-md">Perlu Cek</span>
                </div>
            </a>

            <div class="bg-white p-4 rounded-xl shadow-sm border-l-4 border-blue-500 flex flex-col justify-between">
                <div class="text-gray-400 text-xs font-bold uppercase">Job Bulan Ini</div>
                <div class="flex justify-between items-end mt-2">
                    <span class="text-2xl font-bold text-gray-800">{{ $thisMonthJobs }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-200" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                </div>
            </div>

            <div class="bg-white p-4 rounded-xl shadow-sm border-l-4 border-emerald-500 flex flex-col justify-between">
                <div class="text-gray-400 text-xs font-bold uppercase">Deal / Fix</div>
                <div class="flex justify-between items-end mt-2">
                    <span class="text-2xl font-bold text-gray-800">{{ $confirmedJobs }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-200" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
            </div>

            <a href="{{ route('members.index') }}" class="bg-white p-4 rounded-xl shadow-sm border-l-4 border-purple-500 flex flex-col justify-between hover:shadow-md transition">
                <div class="text-gray-400 text-xs font-bold uppercase">Personel</div>
                <div class="flex justify-between items-end mt-2">
                    <span class="text-2xl font-bold text-gray-800">{{ $totalMembers }}</span>
                    <span class="text-xs text-purple-600 bg-purple-50 px-2 py-1 rounded-md">Aktif</span>
                </div>
            </a>
        </div>

        <h3 class="font-bold text-gray-800 text-lg mb-3 px-1">Acara Terdekat</h3>
        @if($nextJob)
        <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden mb-6">
            <div class="bg-emerald-50 px-5 py-3 border-b border-emerald-100 flex justify-between items-center">
                <span class="text-emerald-800 text-xs font-bold uppercase tracking-wide">Next Project</span>
                <span class="bg-white text-emerald-600 text-[10px] font-bold px-2 py-1 rounded border border-emerald-200">
                    {{ \Carbon\Carbon::parse($nextJob->event_date)->diffForHumans() }}
                </span>
            </div>
            <div class="p-5">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <h4 class="text-xl font-bold text-gray-800">{{ $nextJob->booker_name }}</h4>
                        <p class="text-sm text-purple-600 font-medium mt-1">{{ $nextJob->event_theme ?? 'Tanpa Tema Khusus' }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-2xl font-bold text-gray-700">{{ \Carbon\Carbon::parse($nextJob->event_date)->format('d') }}</p>
                        <p class="text-xs text-gray-500 uppercase">{{ \Carbon\Carbon::parse($nextJob->event_date)->format('M Y') }}</p>
                    </div>
                </div>
                
                <div class="space-y-2 mb-5">
                    <div class="flex items-center gap-3 text-sm text-gray-600">
                        <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <span>Pukul {{ $nextJob->event_time }} WIB</span>
                    </div>
                    <div class="flex items-start gap-3 text-sm text-gray-600">
                        <svg class="w-4 h-4 text-gray-400 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                        <span class="line-clamp-2">{{ $nextJob->venue_address }}</span>
                    </div>
                </div>

                <a href="{{ route('dashboard.show', $nextJob->id) }}" class="block w-full text-center bg-gray-900 text-white py-3 rounded-xl font-bold text-sm hover:bg-gray-800 transition">
                    Lihat Detail & Persiapan
                </a>
            </div>
        </div>
        @else
        <div class="bg-gray-50 border-dashed border-2 border-gray-200 rounded-xl p-6 text-center mb-6">
            <p class="text-gray-400 text-sm">Tidak ada jadwal confirmed dalam waktu dekat.</p>
        </div>
        @endif

        <h3 class="font-bold text-gray-800 text-lg mb-3 px-1">Menu Cepat</h3>
        <div class="grid grid-cols-2 gap-3">
            <a href="{{ route('finance.index') }}" class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex items-center gap-3 hover:bg-gray-50 transition">
                <div class="bg-green-100 p-2 rounded-full text-green-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                </div>
                <span class="text-sm font-bold text-gray-700">Catat Kas</span>
            </a>
            
            <a href="{{ route('members.index') }}" class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex items-center gap-3 hover:bg-gray-50 transition">
                <div class="bg-purple-100 p-2 rounded-full text-purple-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" /></svg>
                </div>
                <span class="text-sm font-bold text-gray-700">Add Personel</span>
            </a>
        </div>

    </div>
</x-app-layout>