<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

// --- PASTIKAN BAGIAN INI LENGKAP ---
use App\Models\Booking;     // Import Model Booking
use App\Models\Transaction; // Import Model Transaction (Ini yang bikin error tadi)
use App\Models\Member;      // Import Model Member
// ------------------------------------

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Statistik Booking
        $pendingJobs = Booking::where('status', 'pending')->count();
        $confirmedJobs = Booking::where('status', 'confirmed')->count();
        
        // Hitung job bulan ini yang tidak batal
        $thisMonthJobs = Booking::whereMonth('event_date', date('m'))
                                ->whereYear('event_date', date('Y'))
                                ->where('status', '!=', 'cancelled')
                                ->count();

        // 2. Statistik Keuangan (Saldo Real)
        // KARENA SUDAH DI-IMPORT DI ATAS, KODE INI SEKARANG AMAN:
        $totalIncome = Transaction::where('type', 'income')->sum('amount');
        $totalExpense = Transaction::where('type', 'expense')->sum('amount');
        $currentBalance = $totalIncome - $totalExpense;

        // 3. Job Terdekat (Next Event)
        $nextJob = Booking::where('status', 'confirmed')
                          ->whereDate('event_date', '>=', now())
                          ->orderBy('event_date', 'asc')
                          ->first();

        // 4. Statistik Anggota
        $totalMembers = Member::where('status', 'active')->count();

        return view('dashboard.index', compact(
            'pendingJobs', 
            'confirmedJobs', 
            'thisMonthJobs', 
            'currentBalance', 
            'nextJob', 
            'totalMembers'
        ));
    }
    
    // Method show() untuk menampilkan detail booking (Maps, dll)
    public function show($id)
    {
        $booking = Booking::findOrFail($id);
        
        // Arahkan ke view detail/edit yang lengkap tadi
        return view('admin.bookings.edit', compact('booking')); 
    }

    // Method confirm() jika tombol konfirmasi ditekan
    public function confirm($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update(['status' => 'confirmed']);
        return redirect()->back()->with('success', 'Status booking berhasil dikonfirmasi!');
    }
}