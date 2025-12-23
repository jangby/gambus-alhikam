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
            'event_date' => 'required',
            'event_time' => 'required',
            'venue_address' => 'required',
        ]);

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

    // Menampilkan Halaman Form Booking
    public function createBooking()
    {
        return view('booking'); // Kita akan buat file booking.blade.php
    }
}