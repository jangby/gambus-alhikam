<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'full_name',
        'position',
        'phone_number',
        'address',
        'join_date',
        'status',
    ];

    // Relasi: Member mungkin punya akun User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}