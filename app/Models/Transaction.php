<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'type',        // income atau expense
        'amount',
        'description',
        'date',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    // Relasi: Transaksi ini milik Booking yang mana?
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}