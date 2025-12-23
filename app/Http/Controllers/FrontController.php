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

    // Memproses Data Booking dari Form
    public function storeBooking(Request $request)
    {
        // 1. Validasi Input (Wajib diisi)
        $request->validate([
            'booker_name' => 'required|string|max:255',
            'booker_phone' => 'required|string|max:20',
            'event_date' => 'required|date',
            'event_time' => 'required',
            'venue_address' => 'required',
        ]);

        // 2. Generate Kode Booking Unik (Contoh: GMB-20231220-123)
        $code = 'GMB-' . date('Ymd') . '-' . rand(100, 999);

        // 3. Simpan ke Database
        Booking::create([
            'booking_code' => $code,
            'booker_name' => $request->booker_name,
            'booker_phone' => $request->booker_phone,
            'event_date' => $request->event_date,
            'event_time' => $request->event_time,
            'event_theme' => $request->event_theme,
            'location_gmaps' => $request->location_gmaps,
            'venue_address' => $request->venue_address,
            'groom_name' => $request->groom_name,
            'bride_name' => $request->bride_name,
            'groom_parents' => $request->groom_parents,
            'bride_parents' => $request->bride_parents,
            'status' => 'pending', // Default status
            'notes' => $request->notes,
        ]);

        // 4. Kembali ke halaman depan dengan pesan sukses
        return redirect()->back()->with('success', 'Booking berhasil! Kode Anda: ' . $code . '. Admin kami akan segera menghubungi WhatsApp Anda.');
    }
}