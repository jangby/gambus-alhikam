<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
    'booker_name',
    'booker_phone',
    'event_date',
    'event_time',
    'venue_address',
    'event_theme',
    'status',
    'total_price',
    'notes',
    // TAMBAHAN BARU:
    'groom_name', 'groom_father', 'groom_mother',
    'bride_name', 'bride_father', 'bride_mother',
];

    // Agar tanggal otomatis dianggap sebagai format Tanggal oleh Laravel
    protected $casts = [
        'event_date' => 'date',
    ];

    // Relasi: Satu Booking bisa punya banyak Transaksi (DP, Pelunasan)
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    // Atribut tambahan: Menghitung total uang masuk (Income)
    public function getPaidAmountAttribute()
    {
        return $this->transactions->where('type', 'income')->sum('amount');
    }

    // Atribut tambahan: Menghitung Sisa Tagihan
    public function getBalanceDueAttribute()
    {
        return $this->total_price - $this->paid_amount;
    }

    // Atribut tambahan: Status Pembayaran (Lunas/Belum)
    public function getPaymentStatusAttribute()
    {
        if ($this->total_price <= 0) return 'Belum Deal';
        if ($this->balance_due <= 0) return 'Lunas';
        return 'Belum Lunas';
    }
}