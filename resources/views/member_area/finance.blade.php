<x-app-layout>
    <div class="-mt-4 -mx-4 bg-gray-50 min-h-screen pb-24">
        
        <div class="bg-gradient-to-br from-emerald-900 via-emerald-800 to-teal-800 pt-8 pb-20 rounded-b-[40px] shadow-lg relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-5 rounded-full blur-3xl -mr-16 -mt-16 pointer-events-none"></div>
            <div class="absolute bottom-0 left-0 w-40 h-40 bg-emerald-400 opacity-10 rounded-full blur-2xl -ml-10 -mb-10 pointer-events-none"></div>

            <div class="relative z-10 px-6 text-center text-white">
                <p class="text-emerald-200 text-xs font-medium uppercase tracking-widest mb-2">Total Saldo Kas</p>
                <h2 class="text-4xl font-bold font-mono tracking-tight">
                    <span class="text-lg text-emerald-300 font-sans font-normal align-top mr-1">Rp</span>{{ number_format($currentBalance, 0, ',', '.') }}
                </h2>
                <div class="mt-2 text-xs text-emerald-100 bg-white/10 inline-block px-3 py-1 rounded-full backdrop-blur-md border border-white/10">
                    Update Terakhir: {{ now()->translatedFormat('d F Y') }}
                </div>
            </div>
        </div>

        <div class="px-5 -mt-12 relative z-20">
            <form method="GET" action="{{ route('member.finance') }}" id="filterForm" class="bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.08)] border border-gray-100 p-1 mb-4">
                
                <div class="flex gap-2 p-3 border-b border-gray-100">
                    <div class="flex-1 relative">
                        <select name="month" onchange="document.getElementById('filterForm').submit()" class="w-full appearance-none bg-gray-50 border border-gray-200 text-gray-700 text-sm rounded-xl px-3 py-2 pr-8 font-bold focus:ring-emerald-500 focus:border-emerald-500">
                            @foreach(range(1, 12) as $m)
                                <option value="{{ $m }}" {{ $month == $m ? 'selected' : '' }}>
                                    {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}
                                </option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-500">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </div>
                    </div>
                    <div class="w-1/3 relative">
                        <select name="year" onchange="document.getElementById('filterForm').submit()" class="w-full appearance-none bg-gray-50 border border-gray-200 text-gray-700 text-sm rounded-xl px-3 py-2 font-bold text-center focus:ring-emerald-500 focus:border-emerald-500">
                            @foreach(range(now()->year, 2023) as $y)
                                <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-1 p-1">
                    <button type="submit" name="type" value="all" class="text-xs font-bold py-2 rounded-lg transition {{ $type == 'all' ? 'bg-gray-800 text-white shadow-sm' : 'text-gray-500 hover:bg-gray-50' }}">
                        Semua
                    </button>
                    <button type="submit" name="type" value="income" class="text-xs font-bold py-2 rounded-lg transition {{ $type == 'income' ? 'bg-emerald-100 text-emerald-700 border border-emerald-200' : 'text-gray-500 hover:bg-gray-50' }}">
                        Pemasukan
                    </button>
                    <button type="submit" name="type" value="expense" class="text-xs font-bold py-2 rounded-lg transition {{ $type == 'expense' ? 'bg-rose-100 text-rose-700 border border-rose-200' : 'text-gray-500 hover:bg-gray-50' }}">
                        Pengeluaran
                    </button>
                </div>
            </form>

            <div class="grid grid-cols-2 gap-3 mb-4">
                <div class="bg-emerald-50 rounded-xl p-3 border border-emerald-100">
                    <p class="text-[10px] text-emerald-600 font-bold uppercase mb-1">Masuk ({{ \Carbon\Carbon::create()->month($month)->translatedFormat('M') }})</p>
                    <p class="text-sm font-bold text-emerald-700">+{{ number_format($filteredIncome, 0, ',', '.') }}</p>
                </div>
                <div class="bg-rose-50 rounded-xl p-3 border border-rose-100">
                    <p class="text-[10px] text-rose-600 font-bold uppercase mb-1">Keluar ({{ \Carbon\Carbon::create()->month($month)->translatedFormat('M') }})</p>
                    <p class="text-sm font-bold text-rose-700">-{{ number_format($filteredExpense, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>

        <div class="px-5 space-y-3">
            @if($transactions->count() > 0)
                <h3 class="font-bold text-gray-700 text-sm ml-1 flex items-center gap-2">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    Riwayat Transaksi
                </h3>
            @endif

            @forelse($transactions as $trx)
                <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4 active:scale-[0.99] transition-transform">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center shrink-0 shadow-sm
                        {{ $trx->type == 'income' ? 'bg-gradient-to-br from-emerald-100 to-emerald-50 text-emerald-600' : 'bg-gradient-to-br from-rose-100 to-rose-50 text-rose-500' }}">
                        @if($trx->type == 'income')
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"/></svg>
                        @else
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6"/></svg>
                        @endif
                    </div>
                    
                    <div class="flex-1 min-w-0">
                        <div class="flex justify-between items-start">
                            <h4 class="text-sm font-bold text-gray-800 line-clamp-1">{{ $trx->description }}</h4>
                            <span class="text-xs font-mono font-bold whitespace-nowrap {{ $trx->type == 'income' ? 'text-emerald-600' : 'text-rose-600' }}">
                                {{ $trx->type == 'income' ? '+' : '-' }}{{ number_format($trx->amount, 0, ',', '.') }}
                            </span>
                        </div>
                        <div class="flex justify-between items-center mt-1">
                            <p class="text-[11px] text-gray-400">
                                {{ $trx->date->translatedFormat('d F Y') }}
                            </p>
                            @if($trx->booking)
                                <span class="text-[10px] bg-blue-50 text-blue-600 px-1.5 py-0.5 rounded font-bold uppercase tracking-wide border border-blue-100">
                                    Job #{{ $trx->booking->id }}
                                </span>
                            @else
                                <span class="text-[10px] text-gray-300 font-medium">Umum</span>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="flex flex-col items-center justify-center py-10 bg-white rounded-2xl border border-dashed border-gray-200">
                    <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-3">
                        <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <p class="text-gray-500 text-sm font-medium">Tidak ada transaksi ditemukan.</p>
                    <p class="text-xs text-gray-400">Coba ganti filter bulan atau tahun.</p>
                </div>
            @endforelse
            
            <div class="h-6"></div>
        </div>

    </div>
</x-app-layout>