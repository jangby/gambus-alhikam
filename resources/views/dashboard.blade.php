<x-app-layout>
    <x-slot name="header">
        Jadwal Gambus
    </x-slot>

    <div class="mb-4">
        <input type="text" placeholder="Cari jadwal..." class="w-full rounded-full border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 px-4 py-2 text-sm">
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded-lg mb-4 text-sm font-medium animate-pulse">
            {{ session('success') }}
        </div>
    @endif

    <div class="space-y-4">
        @forelse($bookings as $booking)
        <a href="{{ route('admin.bookings.edit', $booking->id) }}" class="block bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden active:scale-95 transition-transform duration-100">
            <div class="p-4">
                <div class="flex justify-between items-start mb-2">
                    <div>
                        <div class="text-xs text-gray-400 font-bold uppercase tracking-wide">{{ $booking->booking_code }}</div>
                        <h3 class="text-lg font-bold text-gray-800 leading-tight">{{ $booking->booker_name }}</h3>
                        <p class="text-sm text-gray-500 truncate w-48">{{ $booking->venue_address }}</p>
                    </div>
                    <div class="text-center bg-emerald-50 px-3 py-1 rounded-lg border border-emerald-100">
                        <span class="block text-xl font-bold text-emerald-700">{{ \Carbon\Carbon::parse($booking->event_date)->format('d') }}</span>
                        <span class="block text-xs text-emerald-600 uppercase">{{ \Carbon\Carbon::parse($booking->event_date)->format('M') }}</span>
                    </div>
                </div>

                <div class="flex justify-between items-end mt-3 border-t pt-3">
                    <div>
                        @if($booking->status == 'pending')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Pending</span>
                        @elseif($booking->status == 'confirmed')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">Confirmed</span>
                        @elseif($booking->status == 'completed')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Selesai</span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">Batal</span>
                        @endif
                    </div>
                    <div class="text-right">
                        <span class="block text-xs text-gray-400">Harga Deal</span>
                        <span class="block font-bold text-gray-800">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
            @if($booking->balance_due > 0 && $booking->total_price > 0)
                <div class="bg-red-50 text-red-600 text-xs text-center py-1 font-medium">
                    Belum Lunas (Kurang Rp {{ number_format($booking->balance_due, 0, ',', '.') }})
                </div>
            @elseif($booking->total_price > 0)
                <div class="bg-emerald-50 text-emerald-600 text-xs text-center py-1 font-medium">
                    Lunas
                </div>
            @endif
        </a>
        @empty
            <div class="text-center py-10">
                <p class="text-gray-400 text-sm">Belum ada booking masuk.</p>
            </div>
        @endforelse
    </div>
</x-app-layout>