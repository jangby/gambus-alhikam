<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

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
        // 1. Cari data booking
        $booking = Booking::findOrFail($id);

        // 2. Validasi input (opsional tapi disarankan)
        $request->validate([
            'status' => 'required',
            'total_price' => 'numeric',
        ]);

        // 3. Simpan perubahan ke Database
        $booking->update([
            'status' => $request->status, // Pastikan ini tersimpan
            'total_price' => $request->total_price,
            'notes' => $request->notes,
        ]);

        // 4. Kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Status dan Data berhasil diperbarui!');
    }

    // Hapus Booking
    public function destroy($id)
    {
        Booking::findOrFail($id)->delete();
        return redirect()->route('dashboard')->with('success', 'Data booking dihapus.');
    }
}