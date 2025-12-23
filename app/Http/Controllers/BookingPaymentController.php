<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Transaction;
use Illuminate\Http\Request;

class BookingPaymentController extends Controller
{
    // Simpan Pembayaran Baru (Cicilan/DP)
    public function store(Request $request, $booking_id)
    {
        $booking = Booking::findOrFail($booking_id);

        $request->validate([
            'amount' => 'required|numeric|min:1000',
            'description' => 'required|string', // Misal: DP, Cicilan 1, Pelunasan
            'date' => 'required|date',
        ]);

        // Cek apakah pembayaran melebihi sisa tagihan (Opsional, hanya warning logic)
        if ($request->amount > $booking->balance_due && $booking->total_price > 0) {
             return redirect()->back()->with('error', 'Nominal pembayaran melebihi sisa tagihan!');
        }

        // Simpan ke tabel Transaksi sebagai 'income'
        Transaction::create([
            'booking_id' => $booking->id,
            'type' => 'income',
            'amount' => $request->amount,
            'description' => $request->description,
            'date' => $request->date,
        ]);

        // Update status booking otomatis jika sudah ada pembayaran
        if($booking->status == 'pending') {
            $booking->update(['status' => 'confirmed']);
        }

        return redirect()->back()->with('success', 'Pembayaran berhasil dicatat!');
    }

    // Hapus Pembayaran (Jika salah input)
    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();
        return redirect()->back()->with('success', 'Data pembayaran dihapus.');
    }
}