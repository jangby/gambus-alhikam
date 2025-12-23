<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Transaction; // Jangan lupa import ini
use Illuminate\Support\Facades\Auth;

class MemberAreaController extends Controller
{
    public function index()
    {
        $member = Auth::user()->member;
        
        // Ambil 1 jadwal terdekat saja untuk di Home
        $nextJob = Booking::where('status', 'confirmed')
                            ->whereDate('event_date', '>=', now())
                            ->orderBy('event_date', 'asc')
                            ->first();

        // Hitung Saldo Kas Saat Ini (Pemasukan - Pengeluaran)
        $totalIncome = Transaction::where('type', 'income')->sum('amount');
        $totalExpense = Transaction::where('type', 'expense')->sum('amount');
        $currentBalance = $totalIncome - $totalExpense;

        return view('member_area.dashboard', compact('member', 'nextJob', 'currentBalance'));
    }

    public function schedule()
    {
        // Semua jadwal masa depan
        $schedules = Booking::where('status', 'confirmed')
                            ->whereDate('event_date', '>=', now())
                            ->orderBy('event_date', 'asc')
                            ->get();

        return view('member_area.schedule', compact('schedules'));
    }

    public function finance(Request $request)
    {
        // PERBAIKAN: Tambahkan casting (int) agar terbaca sebagai angka
        $month = (int) $request->input('month', now()->month);
        $year  = (int) $request->input('year', now()->year);
        $type  = $request->input('type', 'all');

        // 2. Query Transaksi dengan Filter
        $query = Transaction::with('booking');

        // Filter Tanggal
        $query->whereMonth('date', $month)
              ->whereYear('date', $year);

        // Filter Tipe (Jika user memilih selain 'all')
        if ($type != 'all') {
            $query->where('type', $type);
        }

        $transactions = $query->orderBy('date', 'desc')->get();

        // 3. Hitung Data Ringkasan
        
        // Saldo Global (Uang Real saat ini - tidak terpengaruh filter)
        $allIncome = Transaction::where('type', 'income')->sum('amount');
        $allExpense = Transaction::where('type', 'expense')->sum('amount');
        $currentBalance = $allIncome - $allExpense;

        // Mutasi Bulan Ini (Sesuai Filter yang dipilih)
        // Kita hitung manual dari hasil filter di atas agar akurat sesuai yang tampil
        $filteredIncome = $transactions->where('type', 'income')->sum('amount');
        $filteredExpense = $transactions->where('type', 'expense')->sum('amount');

        return view('member_area.finance', compact(
            'transactions', 
            'currentBalance', 
            'filteredIncome', 
            'filteredExpense',
            'month', 'year', 'type'
        ));
    }
}