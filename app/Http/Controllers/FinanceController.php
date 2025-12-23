<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FinanceController extends Controller
{
    public function index(Request $request)
    {
        // 1. Filter Bulan (Default bulan ini jika tidak ada filter)
        $month = $request->get('month', date('m'));
        $year = $request->get('year', date('Y'));

        // 2. Ambil Data Transaksi sesuai filter
        $transactions = Transaction::whereMonth('date', $month)
                                   ->whereYear('date', $year)
                                   ->orderBy('date', 'desc')
                                   ->orderBy('created_at', 'desc')
                                   ->get();

        // 3. Hitung Ringkasan (Rekap)
        $totalIncome = $transactions->where('type', 'income')->sum('amount');
        $totalExpense = $transactions->where('type', 'expense')->sum('amount');
        $balance = $totalIncome - $totalExpense;

        // 4. Hitung Saldo Keseluruhan (Sepanjang masa)
        $allTimeBalance = Transaction::where('type', 'income')->sum('amount') - 
                          Transaction::where('type', 'expense')->sum('amount');

        return view('finance.index', compact('transactions', 'totalIncome', 'totalExpense', 'balance', 'allTimeBalance', 'month', 'year'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'description' => 'required|string',
        ]);

        Transaction::create([
            'type' => $request->type,
            'amount' => $request->amount,
            'date' => $request->date,
            'description' => $request->description,
            'booking_id' => null, // Karena ini input manual lewat menu kas
        ]);

        return redirect()->back()->with('success', 'Data transaksi berhasil disimpan');
    }

    public function destroy($id)
    {
        Transaction::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Transaksi dihapus.');
    }

    // Tambahkan method ini di FinanceController
    public function print(Request $request)
    {
        $month = $request->get('month', date('m'));
        $year = $request->get('year', date('Y'));
        $scope = $request->get('scope', 'monthly'); // 'monthly' atau 'yearly'

        $query = Transaction::query();

        // Filter Tahun (Selalu wajib)
        $query->whereYear('date', $year);

        // Filter Bulan (Hanya jika scope-nya monthly)
        if ($scope == 'monthly') {
            $query->whereMonth('date', $month);
            $title = "Laporan Keuangan Bulan " . date('F', mktime(0, 0, 0, $month, 10)) . " " . $year;
        } else {
            $title = "Laporan Keuangan Tahunan " . $year;
        }

        $transactions = $query->orderBy('date', 'asc')->get();

        // Hitung Total untuk Laporan
        $totalIncome = $transactions->where('type', 'income')->sum('amount');
        $totalExpense = $transactions->where('type', 'expense')->sum('amount');
        $balance = $totalIncome - $totalExpense;

        return view('finance.print', compact('transactions', 'totalIncome', 'totalExpense', 'balance', 'title', 'scope', 'month', 'year'));
    }
}