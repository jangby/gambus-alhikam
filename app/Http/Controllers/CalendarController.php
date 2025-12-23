<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index()
    {
        // Ambil semua booking yang tidak dibatalkan
        $bookings = Booking::where('status', '!=', 'cancelled')->get();
        $events = [];

        foreach ($bookings as $booking) {
            
            // 1. BERSIHKAN STATUS (Hapus spasi & jadikan huruf kecil semua)
            // Ini untuk mencegah error karena typo "Confirmed " atau "CONFIRMED"
            $statusBersih = strtolower(trim($booking->status));

            // 2. TENTUKAN WARNA
            $color = '#3B82F6'; // Default Biru
            $statusLabel = 'Jadwal';

            if ($statusBersih == 'confirmed') {
                $color = '#10B981'; // HIJAU (Emerald 500)
                $statusLabel = 'Confirmed';
            } elseif ($statusBersih == 'pending') {
                $color = '#F59E0B'; // KUNING (Amber 500)
                $statusLabel = 'Pending';
            } elseif ($statusBersih == 'completed') {
                $color = '#6B7280'; // ABU (Gray 500)
                $statusLabel = 'Selesai';
            }

            $events[] = [
                'id' => $booking->id,
                'title' => $booking->booker_name,
                'start' => $booking->event_date . 'T' . $booking->event_time,
                'backgroundColor' => $color, // Warna Background Event
                'borderColor' => $color,     // Warna Border
                'extendedProps' => [
                    'theme' => $booking->event_theme ?? '-',
                    'location' => $booking->venue_address,
                    'status' => $statusLabel, // Label status yang sudah dirapikan
                    'time' => $booking->event_time,
                    'detail_url' => route('dashboard.show', $booking->id)
                ]
            ];
        }

        return view('admin.calendar.index', compact('events'));
    }
}