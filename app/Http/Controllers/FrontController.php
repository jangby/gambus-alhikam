<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FrontController extends Controller
{
    // Menampilkan Halaman Depan
    public function index()
    {
        return view('welcome');
    }

    public function storeBooking(Request $request)
    {
        // 1. Validasi
        $request->validate([
            'booker_name' => 'required',
            'booker_phone' => 'required',
            'event_date' => 'required|date|after:today',
            'event_time' => 'required',
            'venue_address' => 'required',
            'location_gmaps' => 'required',
        ]);

        // [TAMBAHAN BARU] Cek apakah tanggal sudah dibooking (kecuali status cancelled)
        $isBooked = Booking::where('event_date', $request->event_date)
                    ->where('status', '!=', 'cancelled')
                    ->exists();

        if ($isBooked) {
            return redirect()->back()
                ->withInput() // Kembalikan input user agar tidak ngetik ulang
                ->with('error', 'Mohon maaf, tanggal tersebut sudah TERBOOKING. Silakan pilih tanggal lain.');
        }

        // 2. Generate Kode Booking (Ini bagian pentingnya)
        $code = 'GMB-' . date('Ymd') . '-' . rand(100, 999);

        // 3. Simpan
        Booking::create([
            'booking_code' => $code, // <--- Pastikan ini ada
            
            'booker_name' => $request->booker_name,
            'booker_phone' => $request->booker_phone,
            'event_date' => $request->event_date,
            'event_time' => $request->event_time,
            'venue_address' => $request->venue_address,
            'event_theme' => $request->event_theme,
            'location_gmaps' => $request->location_gmaps,
            
            // Data Pria
            'groom_name' => $request->groom_name,
            'groom_father' => $request->groom_father,
            'groom_mother' => $request->groom_mother,
            
            // Data Wanita
            'bride_name' => $request->bride_name,
            'bride_father' => $request->bride_father,
            'bride_mother' => $request->bride_mother,
            
            'status' => 'pending',
            'notes' => $request->notes ?? null,
        ]);

        return redirect()->back()->with('success', 'Booking berhasil! Kode: ' . $code);
    }

    // [METHOD BARU] Untuk API Kalender & Cek Tanggal
    public function checkAvailability(Request $request)
    {
        // Jika ada parameter tanggal spesifik (untuk real-time check di input)
        if ($request->has('date')) {
            $isBooked = Booking::where('event_date', $request->date)
                        ->where('status', '!=', 'cancelled')
                        ->exists();
            
            return response()->json([
                'status' => $isBooked ? 'booked' : 'available',
                'message' => $isBooked ? 'Tanggal sudah penuh!' : 'Tanggal tersedia.'
            ]);
        }

        // Jika tidak ada parameter, kembalikan SEMUA tanggal booked (untuk Kalender Visual)
        $bookings = Booking::where('status', '!=', 'cancelled')
                    ->select('event_date', 'event_time', 'booking_code')
                    ->get();

        // Format untuk FullCalendar
        $events = $bookings->map(function($item) {
            return [
                'title' => 'FULL (Booked)',
                'start' => $item->event_date,
                'color' => '#ef4444', // Warna Merah (Tailwind red-500)
                'display' => 'background' // Tampil sebagai background block
            ];
        });

        return response()->json($events);
    }

    // Menampilkan Halaman Form Booking
    public function createBooking()
    {
        return view('booking'); // Kita akan buat file booking.blade.php
    }
}