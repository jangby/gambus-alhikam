<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    // Pastikan SEMUA nama kolom ini ada agar bisa disimpan
    protected $fillable = [
        'booking_code', // <--- INI WAJIB DITAMBAHKAN
        'booker_name',
        'booker_phone',
        'event_date',
        'event_time',
        'venue_address',
        'event_theme',
        'location_gmaps',
        'status',
        'total_price',
        'notes',
        // Data Mempelai
        'groom_name', 
        'groom_father', 
        'groom_mother',
        'bride_name', 
        'bride_father', 
        'bride_mother',
    ];

    // --- TAMBAHKAN INI ---
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}