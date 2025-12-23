<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class MemberAreaController extends Controller
{
    public function index()
    {
        // Member hanya perlu melihat jadwal yang SUDAH CONFIRMED (bukan pending/batal)
        // dan diurutkan dari yang terdekat
        $schedules = Booking::where('status', 'confirmed')
                            ->whereDate('event_date', '>=', now()) // Hanya jadwal masa depan
                            ->orderBy('event_date', 'asc')
                            ->get();

        // Ambil data member dari user yang login
        // Asumsi: Relasi User -> Member sudah ada (hasOne)
        $member = Auth::user()->member; 

        return view('member_area.dashboard', compact('schedules', 'member'));
    }
}