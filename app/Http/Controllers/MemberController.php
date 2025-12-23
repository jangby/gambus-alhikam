<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::with('user')->latest()->get();
        return view('members.index', compact('members'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'position' => 'required',
            'phone' => 'required',
        ]);

        // Gunakan Transaction agar data aman (User & Member terbuat bersamaan)
        DB::transaction(function () use ($request) {
            // 1. Buat Akun User
            $user = User::create([
                'name' => $request->full_name,
                'email' => $request->email,
                'password' => Hash::make('12345678'), // Password Default
                // 'role' => 'member', // Jika Anda punya kolom role di tabel users
            ]);

            // 2. Buat Data Member
            Member::create([
                'user_id' => $user->id,
                'full_name' => $request->full_name,
                'position' => $request->position,
                'phone' => $request->phone,
                'join_date' => date('Y-m-d'),
                'address' => $request->address,
            ]);
        });

        return redirect()->back()->with('success', 'Anggota berhasil ditambahkan. Password default: 12345678');
    }

    public function update(Request $request, $id)
    {
        $member = Member::findOrFail($id);
        
        $member->update([
            'full_name' => $request->full_name,
            'position' => $request->position,
            'phone' => $request->phone,
            'address' => $request->address,
            'status' => $request->status,
        ]);

        // Update nama di tabel User juga
        $member->user->update(['name' => $request->full_name]);

        return redirect()->back()->with('success', 'Data anggota diperbarui.');
    }

    public function destroy($id)
    {
        // Menghapus User akan otomatis menghapus Member (karena onDelete cascade di migration)
        $member = Member::findOrFail($id);
        $member->user->delete(); 
        
        return redirect()->back()->with('success', 'Anggota dan Akun berhasil dihapus.');
    }
}