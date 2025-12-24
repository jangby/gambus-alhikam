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
            
            // 1. NORMALISASI STATUS (PENTING!)
            // Ubah ke huruf kecil semua & hapus spasi depan/belakang
            $statusBersih = strtolower(trim($booking->status));

            // 2. TENTUKAN WARNA (Default Biru jika tidak dikenali)
            $color = '#3B82F6'; 
            $statusLabel = 'Jadwal'; 

            switch ($statusBersih) {
                case 'confirmed':
                    $color = '#10B981'; // HIJAU
                    $statusLabel = 'Confirmed';
                    break;
                
                case 'pending':
                    $color = '#F59E0B'; // KUNING
                    $statusLabel = 'Pending';
                    break;
                
                case 'completed':
                    $color = '#6B7280'; // ABU-ABU
                    $statusLabel = 'Selesai';
                    break;

                default:
                    // Jika status aneh, kasih warna merah biar ketahuan error
                    $color = '#EF4444'; 
                    $statusLabel = 'Cek Data: ' . $booking->status;
                    break;
            }

            // 3. Masukkan ke Array Event
            $events[] = [
                'id' => $booking->id,
                'title' => $booking->booker_name, // Kembalikan ke nama asli jika debug selesai
                'start' => $booking->event_date . 'T' . $booking->event_time,
                'backgroundColor' => $color, // <--- Pastikan ini backgroundColor
                'borderColor' => $color,
                'extendedProps' => [
                    'theme' => $booking->event_theme ?? '-',
                    'location' => $booking->venue_address,
                    'status' => $statusLabel,
                    'time' => $booking->event_time,
                    'detail_url' => route('dashboard.show', $booking->id)
                ]
            ];
        }

        return view('admin.calendar.index', compact('events'));
    }
}