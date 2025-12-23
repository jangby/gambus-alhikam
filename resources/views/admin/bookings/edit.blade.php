<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between md:items-center gap-2">
            <h2 class="font-semibold text-lg text-gray-800 leading-tight">
                📝 Manajemen Booking
            </h2>
            <div class="flex items-center gap-2">
                <span class="text-xs font-mono bg-gray-200 px-2 py-1 rounded text-gray-600">
                    {{ $booking->booking_code }}
                </span>
                <a href="{{ route('admin.bookings.index') }}" class="text-xs bg-white border border-gray-300 px-3 py-1 rounded-lg hover:bg-gray-50 transition">Kembali</a>
            </div>
        </div>
    </x-slot>

    <div class="pb-24 pt-4 px-4 max-w-lg mx-auto md:max-w-5xl">

        @php
            $totalBayar = $booking->transactions->where('type', 'income')->sum('amount');
            $totalHarga = $booking->total_price ?? 0;
            $sisaTagihan = $totalHarga - $totalBayar;
            $persen = ($totalHarga > 0) ? ($totalBayar / $totalHarga) * 100 : 0;
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            
            <div class="md:col-span-1 bg-white rounded-2xl shadow-sm border border-gray-100 p-5 relative overflow-hidden">
                <div class="absolute top-0 right-0 p-4 opacity-10">
                    <svg class="w-20 h-20 text-emerald-900" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm.31-8.86c-1.77-.45-2.34-.94-2.34-1.67 0-.84.79-1.43 2.1-1.43 1.38 0 1.9.66 1.94 1.64h1.71c-.05-1.34-.87-2.57-2.49-2.97V5H10.9v1.69c-1.51.32-2.72 1.3-2.72 2.81 0 1.79 1.49 2.69 3.66 3.21 1.95.46 2.34 1.15 2.34 1.87 0 .53-.39 1.39-2.1 1.39-1.6 0-2.23-.72-2.32-1.64H8.04c.1 1.7 1.36 2.66 2.86 2.97V19h2.34v-1.67c1.52-.29 2.72-1.16 2.73-2.77-.01-2.2-1.9-2.96-3.66-3.42z"/></svg>
                </div>

                <p class="text-xs text-gray-400 font-bold uppercase tracking-widest mb-1">Sisa Tagihan</p>
                <p class="text-2xl font-bold {{ $sisaTagihan > 0 ? 'text-red-500' : 'text-emerald-600' }} mb-4">
                    Rp {{ number_format($sisaTagihan, 0, ',', '.') }}
                </p>

                <div class="w-full bg-gray-100 rounded-full h-2 mb-2">
                    <div class="bg-emerald-500 h-2 rounded-full transition-all duration-500" style="width: {{ $persen }}%"></div>
                </div>
                <div class="flex justify-between text-[10px] text-gray-500 font-bold uppercase">
                    <span>Masuk: Rp {{ number_format($totalBayar, 0, ',', '.') }}</span>
                    <span>Total: Rp {{ number_format($totalHarga, 0, ',', '.') }}</span>
                </div>
            </div>

            <div class="md:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 p-5 flex flex-col justify-between">
                
                <div class="mb-4">
                    <h3 class="font-bold text-gray-800 text-sm mb-3 flex items-center gap-2">
                        <svg class="w-4 h-4 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
                        Riwayat Pembayaran
                    </h3>
                    <div class="space-y-2 max-h-32 overflow-y-auto pr-1">
                        @forelse($booking->transactions->where('type', 'income') as $trx)
                        <div class="flex justify-between items-center text-xs bg-gray-50 p-2 rounded-lg border border-gray-100">
                            <div>
                                <span class="block font-bold text-gray-700">{{ $trx->description }}</span>
                                <span class="text-gray-400">{{ \Carbon\Carbon::parse($trx->date)->format('d M Y') }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="font-bold text-emerald-600">+ Rp {{ number_format($trx->amount, 0, ',', '.') }}</span>
                                <form action="{{ route('finance.destroy', $trx->id) }}" method="POST" onsubmit="return confirm('Hapus pembayaran ini?')">
                                    @csrf @method('DELETE')
                                    <button class="text-red-300 hover:text-red-500"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button>
                                </form>
                            </div>
                        </div>
                        @empty
                        <p class="text-xs text-gray-400 italic text-center py-2">Belum ada pembayaran masuk.</p>
                        @endforelse
                    </div>
                </div>

                <form action="{{ route('bookings.payment.store', $booking->id) }}" method="POST" class="bg-emerald-50 p-3 rounded-xl border border-emerald-100">
                    @csrf
                    <div class="flex gap-2 items-end">
                        <div class="flex-1">
                            <label class="text-[10px] font-bold text-emerald-800 uppercase block mb-1">Tambah Pembayaran (Rp)</label>
                            <input type="number" name="amount" placeholder="Contoh: 500000" class="w-full text-sm rounded-lg border-emerald-200 focus:ring-emerald-500 py-2" required>
                        </div>
                        <div class="flex-1">
                            <label class="text-[10px] font-bold text-emerald-800 uppercase block mb-1">Keterangan</label>
                            <input type="text" name="description" placeholder="DP / Pelunasan / Cicilan 1" class="w-full text-sm rounded-lg border-emerald-200 focus:ring-emerald-500 py-2" required>
                        </div>
                        <button type="submit" class="bg-emerald-600 text-white p-2.5 rounded-lg hover:bg-emerald-700 transition shadow-sm">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                        </button>
                    </div>
                </form>

            </div>
        </div>

        <form action="{{ route('bookings.update', $booking->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="bg-gray-800 px-5 py-3 border-b border-gray-700 flex justify-between items-center">
                    <h3 class="font-bold text-white text-sm uppercase">Data Acara</h3>
                    <select name="status" class="text-xs rounded-lg border-0 py-1.5 px-3 bg-gray-700 text-white font-bold focus:ring-0 cursor-pointer">
                        <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>🕒 Pending</option>
                        <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>✅ Confirmed</option>
                        <option value="completed" {{ $booking->status == 'completed' ? 'selected' : '' }}>🎉 Selesai</option>
                        <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>❌ Batal</option>
                    </select>
                </div>
                <div class="p-5 space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-xs font-bold text-gray-400 uppercase">Total Harga Deal (Rp)</label>
                            <input type="number" name="total_price" value="{{ $booking->total_price }}" class="w-full mt-1 rounded-xl border-gray-300 text-sm focus:ring-emerald-500 font-bold text-gray-700">
                        </div>
                        <div>
                            <label class="text-xs font-bold text-gray-400 uppercase">Nama Pemesan (CP)</label>
                            <input type="text" name="booker_name" value="{{ $booking->booker_name }}" class="w-full mt-1 rounded-xl border-gray-300 text-sm focus:ring-emerald-500">
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="text-xs font-bold text-gray-400 uppercase">Tanggal</label>
                            <input type="date" name="event_date" value="{{ \Carbon\Carbon::parse($booking->event_date)->format('Y-m-d') }}" class="w-full mt-1 rounded-xl border-gray-300 text-sm focus:ring-emerald-500">
                        </div>
                        <div>
                            <label class="text-xs font-bold text-gray-400 uppercase">Jam</label>
                            <input type="time" name="event_time" value="{{ $booking->event_time }}" class="w-full mt-1 rounded-xl border-gray-300 text-sm focus:ring-emerald-500">
                        </div>
                    </div>
                    <div>
                        <label class="text-xs font-bold text-gray-400 uppercase">Lokasi</label>
                        <textarea name="venue_address" rows="2" class="w-full mt-1 rounded-xl border-gray-300 text-sm focus:ring-emerald-500">{{ $booking->venue_address }}</textarea>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="bg-blue-50 px-5 py-3 border-b border-blue-100">
                        <h3 class="font-bold text-blue-900 text-sm uppercase">Mempelai Pria</h3>
                    </div>
                    <div class="p-5 space-y-3">
                        <div>
                            <label class="text-[10px] font-bold text-gray-400 uppercase">Nama Pria</label>
                            <input type="text" name="groom_name" value="{{ $booking->groom_name }}" class="w-full mt-1 rounded-lg border-gray-300 text-sm focus:ring-blue-500">
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="text-[10px] font-bold text-gray-400 uppercase">Ayah</label>
                                <input type="text" name="groom_father" value="{{ $booking->groom_father }}" class="w-full mt-1 rounded-lg border-gray-300 text-sm focus:ring-blue-500">
                            </div>
                            <div>
                                <label class="text-[10px] font-bold text-gray-400 uppercase">Ibu</label>
                                <input type="text" name="groom_mother" value="{{ $booking->groom_mother }}" class="w-full mt-1 rounded-lg border-gray-300 text-sm focus:ring-blue-500">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="bg-pink-50 px-5 py-3 border-b border-pink-100">
                        <h3 class="font-bold text-pink-900 text-sm uppercase">Mempelai Wanita</h3>
                    </div>
                    <div class="p-5 space-y-3">
                        <div>
                            <label class="text-[10px] font-bold text-gray-400 uppercase">Nama Wanita</label>
                            <input type="text" name="bride_name" value="{{ $booking->bride_name }}" class="w-full mt-1 rounded-lg border-gray-300 text-sm focus:ring-pink-500">
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="text-[10px] font-bold text-gray-400 uppercase">Ayah</label>
                                <input type="text" name="bride_father" value="{{ $booking->bride_father }}" class="w-full mt-1 rounded-lg border-gray-300 text-sm focus:ring-pink-500">
                            </div>
                            <div>
                                <label class="text-[10px] font-bold text-gray-400 uppercase">Ibu</label>
                                <input type="text" name="bride_mother" value="{{ $booking->bride_mother }}" class="w-full mt-1 rounded-lg border-gray-300 text-sm focus:ring-pink-500">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-xs font-bold text-gray-400 uppercase">Tema / Request</label>
                        <input type="text" name="event_theme" value="{{ $booking->event_theme }}" class="w-full mt-1 rounded-xl border-gray-300 text-sm focus:ring-emerald-500">
                    </div>
                    <div>
                        <label class="text-xs font-bold text-gray-400 uppercase">Catatan Admin</label>
                        <input type="text" name="notes" value="{{ $booking->notes }}" class="w-full mt-1 rounded-xl border-gray-300 text-sm focus:ring-emerald-500" placeholder="Catatan internal...">
                    </div>
                </div>
            </div>

            <div class="fixed bottom-0 left-0 w-full bg-white border-t border-gray-200 p-4 pb-safe flex justify-between items-center z-40 md:static md:bg-transparent md:border-0 md:p-0">
                
                <button type="button" onclick="if(confirm('Yakin hapus data ini?')) document.getElementById('delete-form').submit();" class="text-red-500 font-bold text-sm px-4 hover:text-red-700">
                    Hapus Booking
                </button>

                <button type="submit" class="bg-emerald-900 text-white font-bold py-3 px-8 rounded-xl shadow-lg hover:bg-emerald-800 transition active:scale-95">
                    Simpan Perubahan
                </button>
            </div>
        </form>

        <form id="delete-form" action="{{ route('bookings.destroy', $booking->id) }}" method="POST" class="hidden">
            @csrf @method('DELETE')
        </form>

    </div>
</x-app-layout>