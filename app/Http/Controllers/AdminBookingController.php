<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Str; 
use Illuminate\Support\Facades\DB;

class AdminBookingController extends Controller
{
    // Menampilkan Dashboard Utama
    public function index()
    {
        // Ambil semua booking, urutkan dari acara yang paling baru/akan datang
        $bookings = Booking::orderBy('event_date', 'asc')->get();
        
        // Arahkan ke view khusus list booking
        return view('admin.bookings.index', compact('bookings'));
    }

    // Menampilkan Halaman Edit (Sebenarnya diarahkan ke dashboard.show di route, tapi jaga-jaga)
    public function edit($id)
    {
        $booking = Booking::findOrFail($id);
        return view('admin.bookings.edit', compact('booking'));
    }

    // --- BAGIAN INI YANG PENTING (UPDATE) ---
    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        $booking->update([
            'status' => $request->status,
            'total_price' => $request->total_price,
            'booker_name' => $request->booker_name,
            'event_date' => $request->event_date,
            'event_time' => $request->event_time,
            'venue_address' => $request->venue_address,
            'location_gmaps' => $request->location_gmaps,
            'event_theme' => $request->event_theme,
            'notes' => $request->notes,
            
            // Update Data Orang Tua
            'groom_name' => $request->groom_name,
            'groom_father' => $request->groom_father,
            'groom_mother' => $request->groom_mother,
            'bride_name' => $request->bride_name,
            'bride_father' => $request->bride_father,
            'bride_mother' => $request->bride_mother,
        ]);

        return redirect()->back()->with('success', 'Data booking berhasil diperbarui!');
    }

    // Hapus Booking
    public function destroy($id)
    {
        Booking::findOrFail($id)->delete();
        return redirect()->route('dashboard')->with('success', 'Data booking dihapus.');
    }

    // [TAMBAHAN BARU] Method Store untuk Admin
    public function store(Request $request)
    {
        // 1. Validasi (Bisa disesuaikan jika admin boleh input parsial, tapi ini standar aman)
        $request->validate([
            'booker_name' => 'required',
            'booker_phone' => 'required',
            'event_date' => 'required|date',
            'event_time' => 'required',
            'venue_address' => 'required',
        ]);

        // 2. Generate Kode Booking Unik
        $code = 'GMB-' . date('Ymd') . '-' . rand(100, 999);

        // 3. Simpan Data
        Booking::create([
            'booking_code' => $code,
            'booker_name' => $request->booker_name,
            'booker_phone' => $request->booker_phone,
            'event_date' => $request->event_date,
            'event_time' => $request->event_time,
            'venue_address' => $request->venue_address,
            'location_gmaps' => $request->location_gmaps,
            'event_theme' => $request->event_theme,
            
            // Data Pria
            'groom_name' => $request->groom_name,
            'groom_father' => $request->groom_father,
            'groom_mother' => $request->groom_mother,
            
            // Data Wanita
            'bride_name' => $request->bride_name,
            'bride_father' => $request->bride_father,
            'bride_mother' => $request->bride_mother,
            
            'status' => 'pending', // Default pending, nanti admin bisa confirm manual
            'notes' => $request->notes,
        ]);

        return redirect()->back()->with('success', 'Booking manual berhasil ditambahkan!');
    }
}