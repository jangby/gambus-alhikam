<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <span class="font-semibold text-xl text-gray-800">Detail Order</span>
            <a href="{{ route('dashboard') }}" class="text-xs bg-gray-600 hover:bg-gray-700 px-4 py-2 rounded-full text-white transition">
                &larr; Kembali
            </a>
        </div>
    </x-slot>

    <div class="bg-white p-5 rounded-xl shadow-sm mb-4 border-l-4 {{ $booking->balance_due <= 0 && $booking->total_price > 0 ? 'border-emerald-500' : 'border-yellow-500' }}">
        <div class="flex justify-between items-center mb-4">
            <div>
                <p class="text-xs text-gray-500 uppercase tracking-wide">Total Harga</p>
                <p class="text-xl font-bold text-gray-800">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</p>
            </div>
            <div class="text-right">
                <p class="text-xs text-gray-500 uppercase tracking-wide">Sisa Tagihan</p>
                <p class="text-xl font-bold {{ $booking->balance_due > 0 ? 'text-red-600' : 'text-emerald-600' }}">
                    Rp {{ number_format($booking->balance_due, 0, ',', '.') }}
                </p>
            </div>
        </div>
        
        <div class="flex gap-3">
            <a href="https://wa.me/{{ str_replace(['+','-',' '], '', $booking->booker_phone) }}" target="_blank" class="flex-1 bg-green-500 text-white text-center py-2.5 rounded-lg text-sm font-bold hover:bg-green-600 transition flex items-center justify-center gap-2">
                <span>WhatsApp</span>
            </a>
            @if($booking->location_gmaps)
            <a href="{{ $booking->location_gmaps }}" target="_blank" class="flex-1 bg-blue-500 text-white text-center py-2.5 rounded-lg text-sm font-bold hover:bg-blue-600 transition flex items-center justify-center gap-2">
                <span>Buka Maps</span>
            </a>
            @endif
        </div>
    </div>

    <div class="bg-white p-5 rounded-xl shadow-sm mb-4">
        <h3 class="font-bold text-gray-800 text-sm mb-4 uppercase tracking-wider border-b pb-2">Pengaturan Job</h3>
        <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="space-y-4">
                <div>
                    <label class="text-xs font-bold text-gray-500">HARGA DEAL (RP)</label>
                    <input type="number" name="total_price" value="{{ $booking->total_price }}" class="w-full mt-1 rounded-lg border-gray-300 text-lg font-bold text-gray-800 focus:ring-emerald-500 focus:border-emerald-500 p-2.5">
                </div>
                
                <div>
                    <label class="text-xs font-bold text-gray-500">STATUS PESANAN</label>
                    <select name="status" class="w-full mt-1 rounded-lg border-gray-300 text-sm p-2.5 bg-gray-50 font-medium">
    <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>🕒 Pending (Menunggu)</option>
    
    <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>✅ Confirmed (Sudah DP)</option>
    
    <option value="completed" {{ $booking->status == 'completed' ? 'selected' : '' }}>🎉 Selesai</option>
    <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>❌ Batal</option>
</select>
                </div>

                <div>
                    <label class="text-xs font-bold text-gray-500">CATATAN ADMIN</label>
                    <textarea name="notes" rows="2" class="w-full mt-1 rounded-lg border-gray-300 text-sm focus:ring-emerald-500 focus:border-emerald-500" placeholder="Catatan internal...">{{ $booking->notes }}</textarea>
                </div>

                <button type="submit" class="w-full bg-emerald-900 text-white py-3 rounded-xl font-bold text-sm shadow-md hover:bg-emerald-800 active:scale-95 transition-transform">
                    SIMPAN PERUBAHAN
                </button>
            </div>
        </form>
    </div>

    <div class="bg-white p-5 rounded-xl shadow-sm mb-4">
        <h3 class="font-bold text-gray-800 text-sm mb-4 uppercase tracking-wider border-b pb-2">Riwayat Pembayaran</h3>
        
        @if($booking->balance_due > 0)
        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 mb-5">
            <p class="text-xs font-bold text-gray-500 mb-2">TAMBAH PEMBAYARAN BARU</p>
            <form action="{{ route('booking.payment.store', $booking->id) }}" method="POST">
                @csrf
                <div class="grid grid-cols-2 gap-3 mb-3">
                    <input type="text" name="description" placeholder="Keterangan (Contoh: DP)" class="col-span-2 text-sm rounded-md border-gray-300 focus:border-emerald-500 focus:ring-emerald-500" required>
                    <input type="date" name="date" value="{{ date('Y-m-d') }}" class="text-sm rounded-md border-gray-300 focus:border-emerald-500 focus:ring-emerald-500" required>
                    <input type="number" name="amount" placeholder="Rp 0" class="text-sm rounded-md border-gray-300 font-bold text-emerald-700 focus:border-emerald-500 focus:ring-emerald-500" required>
                </div>
                <button type="submit" class="w-full bg-emerald-600 text-white text-xs font-bold py-2.5 rounded shadow hover:bg-emerald-700 transition">
                    + TERIMA UANG
                </button>
            </form>
        </div>
        @else
        <div class="bg-green-100 text-green-800 text-center py-3 rounded-lg text-sm font-bold mb-5 flex items-center justify-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
            PEMBAYARAN LUNAS
        </div>
        @endif

        <div class="space-y-3">
            @forelse($booking->transactions->where('type', 'income') as $trx)
            <div class="flex justify-between items-center border-b border-gray-100 pb-2 last:border-0">
                <div>
                    <p class="text-sm font-bold text-gray-800">{{ $trx->description }}</p>
                    <p class="text-xs text-gray-400">{{ \Carbon\Carbon::parse($trx->date)->format('d M Y') }}</p>
                </div>
                <div class="text-right flex items-center gap-3">
                    <span class="text-sm font-bold text-emerald-600">Rp {{ number_format($trx->amount, 0, ',', '.') }}</span>
                    <form action="{{ route('booking.transaction.destroy', $trx->id) }}" method="POST" onsubmit="return confirm('Hapus transaksi ini?')">
                        @csrf @method('DELETE')
                        <button class="text-red-400 bg-red-50 p-1.5 rounded hover:bg-red-100 hover:text-red-600 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
            @empty
            <p class="text-center text-xs text-gray-400 italic py-2">Belum ada data pembayaran.</p>
            @endforelse
        </div>
    </div>

    <details class="bg-white rounded-xl shadow-sm mb-6 group" open>
        <summary class="list-none p-5 cursor-pointer font-bold text-gray-800 text-sm flex justify-between items-center bg-gray-50 rounded-t-xl hover:bg-gray-100 transition">
            <span class="uppercase tracking-wider">DETAIL LENGKAP ACARA</span>
            <span class="transform group-open:rotate-180 transition-transform text-gray-500">▼</span>
        </summary>
        
        <div class="p-5 border-t border-gray-100 space-y-6">
            
            <div class="flex items-start gap-3">
                <div class="bg-emerald-100 p-2 rounded text-emerald-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                </div>
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase">Waktu Acara</p>
                    <p class="font-bold text-gray-800 text-lg">{{ \Carbon\Carbon::parse($booking->event_date)->isoFormat('dddd, D MMMM Y') }}</p>
                    <p class="text-sm font-medium text-emerald-600">Jam: {{ $booking->event_time }}</p>
                </div>
            </div>

            <hr class="border-dashed border-gray-200">

            <div>
                <p class="text-xs font-bold text-gray-400 uppercase mb-1">Data Pemesan (Contact Person)</p>
                <div class="bg-gray-50 p-3 rounded border border-gray-100">
                    <p class="font-bold text-gray-800">{{ $booking->booker_name }}</p>
                    <p class="text-sm text-gray-500">{{ $booking->booker_phone }}</p>
                </div>
            </div>

            <div>
                <p class="text-xs font-bold text-blue-600 uppercase mb-1">🤵 Mempelai Pria</p>
                <div class="pl-3 border-l-4 border-blue-200">
                    <p class="font-bold text-lg text-gray-800">{{ $booking->groom_name ?? '-' }}</p>
                    <div class="text-sm text-gray-600 mt-1">
                        <span class="text-gray-400 text-xs block">Nama Orang Tua:</span>
                        {{ $booking->groom_parents ?? '-' }}
                    </div>
                </div>
            </div>

            <div>
                <p class="text-xs font-bold text-pink-600 uppercase mb-1">👰 Mempelai Wanita</p>
                <div class="pl-3 border-l-4 border-pink-200">
                    <p class="font-bold text-lg text-gray-800">{{ $booking->bride_name ?? '-' }}</p>
                    <div class="text-sm text-gray-600 mt-1">
                        <span class="text-gray-400 text-xs block">Nama Orang Tua:</span>
                        {{ $booking->bride_parents ?? '-' }}
                    </div>
                </div>
            </div>

            <div>
                <p class="text-xs font-bold text-gray-400 uppercase mb-1">Tema Acara / Kostum</p>
                <p class="font-medium text-gray-800">{{ $booking->event_theme ?? 'Tidak ada tema khusus' }}</p>
            </div>

            <div>
                <p class="text-xs font-bold text-gray-400 uppercase mb-1">Alamat Lokasi</p>
                <div class="bg-yellow-50 p-3 rounded border border-yellow-100">
                    <p class="text-sm text-gray-800 font-medium leading-relaxed">{{ $booking->venue_address }}</p>
                    
                    @if($booking->location_gmaps)
                    <a href="{{ $booking->location_gmaps }}" target="_blank" class="inline-flex items-center gap-1 mt-3 text-blue-600 text-xs font-bold hover:underline">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" /></svg>
                        Klik disini untuk buka Google Maps
                    </a>
                    @else
                    <p class="text-xs text-red-400 mt-2 italic">*Link maps belum diisi</p>
                    @endif
                </div>
            </div>

        </div>
    </details>

    <div class="pb-12 text-center">
        <form action="{{ route('admin.bookings.destroy', $booking->id) }}" method="POST" onsubmit="return confirm('Yakin hapus data booking ini secara permanen?');">
            @csrf @method('DELETE')
            <button class="text-red-400 text-xs uppercase tracking-widest hover:text-red-600 font-bold hover:bg-red-50 px-4 py-2 rounded transition">
                🗑 Hapus Data Booking
            </button>
        </form>
    </div>

</x-app-layout>