<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-lg text-gray-800 leading-tight">
            💰 Kas & Keuangan
        </h2>
    </x-slot>

    <div class="pb-24 pt-2 px-2 max-w-xl mx-auto md:max-w-5xl">
        
        <div class="bg-gradient-to-br from-emerald-800 to-emerald-600 rounded-2xl shadow-xl p-6 text-white mb-6 relative overflow-hidden">
            <div class="absolute -top-6 -right-6 w-32 h-32 bg-white opacity-10 rounded-full blur-2xl"></div>
            
            <p class="text-emerald-100 text-xs font-medium uppercase tracking-widest mb-1">Saldo Kas Saat Ini</p>
            <h1 class="text-4xl font-bold mb-4">Rp {{ number_format($allTimeBalance, 0, ',', '.') }}</h1>
            
            <div class="flex gap-4 border-t border-emerald-500/30 pt-4">
                <div class="flex-1">
                    <p class="text-xs text-emerald-200 mb-1">Pemasukan (Bulan Ini)</p>
                    <p class="font-bold text-sm">Rp {{ number_format($totalIncome, 0, ',', '.') }}</p>
                </div>
                <div class="w-px bg-emerald-500/30"></div>
                <div class="flex-1">
                    <p class="text-xs text-red-200 mb-1">Pengeluaran (Bulan Ini)</p>
                    <p class="font-bold text-sm text-white">Rp {{ number_format($totalExpense, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-6">
            <button onclick="openModal('income')" class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex flex-col items-center justify-center gap-2 active:scale-95 transition hover:bg-green-50">
                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center text-green-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" /></svg>
                </div>
                <span class="font-bold text-sm text-gray-700">Catat Masuk</span>
            </button>

            <button onclick="openModal('expense')" class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex flex-col items-center justify-center gap-2 active:scale-95 transition hover:bg-red-50">
                <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center text-red-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" /></svg>
                </div>
                <span class="font-bold text-sm text-gray-700">Catat Keluar</span>
            </button>
        </div>

        <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-4">
            <h3 class="font-bold text-gray-800 text-lg self-start">Riwayat Transaksi</h3>
            
            <div class="flex gap-2 w-full md:w-auto overflow-x-auto pb-2 md:pb-0">
                <form action="{{ route('finance.index') }}" method="GET" class="flex gap-2">
                    <select name="month" class="text-xs rounded-full border-gray-300 py-1.5 px-3 bg-white shadow-sm focus:border-emerald-500 focus:ring-emerald-500" onchange="this.form.submit()">
                        @for($m=1; $m<=12; $m++)
                            <option value="{{ $m }}" {{ $month == $m ? 'selected' : '' }}>
                                {{ date('F', mktime(0, 0, 0, $m, 10)) }}
                            </option>
                        @endfor
                    </select>
                    <select name="year" class="text-xs rounded-full border-gray-300 py-1.5 px-3 bg-white shadow-sm focus:border-emerald-500 focus:ring-emerald-500" onchange="this.form.submit()">
                        <option value="2024" {{ $year == 2024 ? 'selected' : '' }}>2024</option>
                        <option value="2025" {{ $year == 2025 ? 'selected' : '' }}>2025</option>
                    </select>
                </form>

                <a href="{{ route('finance.print', ['month' => $month, 'year' => $year, 'scope' => 'monthly']) }}" target="_blank" class="bg-gray-800 text-white p-2 rounded-full shadow hover:bg-gray-700" title="Cetak Laporan">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" /></svg>
                </a>
            </div>
        </div>

        <div class="space-y-3">
            @forelse($transactions as $trx)
            <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-50 flex justify-between items-center hover:bg-gray-50 transition">
                <div class="flex items-center gap-3 overflow-hidden">
                    <div class="w-10 h-10 rounded-full flex-shrink-0 flex items-center justify-center {{ $trx->type == 'income' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                        @if($trx->type == 'income')
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 10.293a1 1 0 010 1.414l-6 6a1 1 0 01-1.414 0l-6-6a1 1 0 111.414-1.414L9 14.586V3a1 1 0 012 0v11.586l4.293-4.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M3.293 9.707a1 1 0 010-1.414l6-6a1 1 0 011.414 0l6 6a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L4.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd" /></svg>
                        @endif
                    </div>
                    
                    <div class="min-w-0"> <p class="font-bold text-gray-800 text-sm truncate">{{ $trx->description }}</p>
                        <p class="text-xs text-gray-400">
                            {{ \Carbon\Carbon::parse($trx->date)->format('d M Y') }}
                            @if($trx->booking_id) 
                                • <a href="{{ route('dashboard.show', $trx->booking_id) }}" class="text-blue-500">Lihat Job</a> 
                            @endif
                        </p>
                    </div>
                </div>

                <div class="text-right flex flex-col items-end">
                    <span class="font-bold text-sm {{ $trx->type == 'income' ? 'text-green-600' : 'text-red-600' }}">
                        {{ $trx->type == 'income' ? '+' : '-' }} {{ number_format($trx->amount, 0, ',', '.') }}
                    </span>
                    
                    <form action="{{ route('finance.destroy', $trx->id) }}" method="POST" onsubmit="return confirm('Hapus?')" class="mt-1">
                        @csrf @method('DELETE')
                        <button class="text-xs text-red-300 hover:text-red-500">Hapus</button>
                    </form>
                </div>
            </div>
            @empty
            <div class="text-center py-10 opacity-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto mb-2 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                <p class="text-sm">Belum ada transaksi</p>
            </div>
            @endforelse
        </div>

    </div>

    <div id="transactionModal" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity" onclick="closeModal()"></div>

        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-2xl shadow-xl w-full max-w-sm overflow-hidden transform transition-all relative">
                
                <div class="bg-gray-50 px-5 py-4 border-b flex justify-between items-center">
                    <h3 class="font-bold text-gray-800" id="modalTitle">Tambah Transaksi</h3>
                    <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <div class="p-6">
                    <form action="{{ route('finance.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <input type="hidden" name="type" id="formType">

                        <div>
                            <label class="block text-xs font-bold text-gray-400 mb-1 uppercase">Nominal (Rp)</label>
                            <input type="number" name="amount" placeholder="0" class="w-full text-2xl font-bold text-gray-800 border-0 border-b-2 border-gray-200 focus:border-emerald-500 focus:ring-0 px-0 py-2 placeholder-gray-300 transition" required autofocus>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-400 mb-1 uppercase">Tanggal</label>
                            <input type="date" name="date" value="{{ date('Y-m-d') }}" class="w-full rounded-lg border-gray-300 text-sm focus:border-emerald-500 focus:ring-emerald-500 bg-gray-50">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-400 mb-1 uppercase">Keterangan</label>
                            <textarea name="description" rows="2" placeholder="Contoh: Beli bensin, Gaji..." class="w-full rounded-lg border-gray-300 text-sm focus:border-emerald-500 focus:ring-emerald-500 bg-gray-50" required></textarea>
                        </div>

                        <button type="submit" class="w-full bg-emerald-900 text-white py-3 rounded-xl font-bold shadow-lg hover:bg-emerald-800 active:scale-95 transition-transform">
                            Simpan Data
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openModal(type) {
            const modal = document.getElementById('transactionModal');
            const title = document.getElementById('modalTitle');
            const inputType = document.getElementById('formType');

            // Reset Form & Tampilan
            modal.classList.remove('hidden');
            inputType.value = type;

            if (type === 'income') {
                title.innerText = 'Catat Pemasukan (+)';
                title.className = 'font-bold text-green-600';
            } else {
                title.innerText = 'Catat Pengeluaran (-)';
                title.className = 'font-bold text-red-600';
            }
        }

        function closeModal() {
            document.getElementById('transactionModal').classList.add('hidden');
        }
    </script>
</x-app-layout>