<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\AdminBookingController;
use App\Http\Controllers\BookingPaymentController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\MemberAreaController; // Controller Member yang baru
use App\Http\Controllers\CalendarController;

// --- HALAMAN PUBLIK (Tanpa Login) ---
Route::get('/', [FrontController::class, 'index'])->name('home');
Route::post('/booking', [FrontController::class, 'storeBooking'])->name('booking.store');

// --- HALAMAN YANG BUTUH LOGIN ---
Route::middleware(['auth', 'verified'])->group(function () {

    // ===================================================
    // 1. KHUSUS ADMIN (Jadwal, Keuangan, Edit, Hapus)
    // ===================================================
    Route::middleware(['role:admin'])->group(function () {
        
        // Dashboard Utama Admin (Menggunakan AdminBookingController sesuai kode lama Anda)
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/admin/bookings', [AdminBookingController::class, 'index'])->name('admin.bookings.index');
        
        // Detail Booking (Yang ada maps dan data mempelai lengkap)
        Route::get('/dashboard/booking/{id}', [DashboardController::class, 'show'])->name('dashboard.show');

        // CRUD Booking (Edit, Update, Delete)
        Route::get('/admin/booking/{id}/edit', [AdminBookingController::class, 'edit'])->name('admin.bookings.edit');
        Route::put('/admin/booking/{id}', [AdminBookingController::class, 'update'])->name('admin.bookings.update');
        Route::delete('/admin/booking/{id}', [AdminBookingController::class, 'destroy'])->name('admin.bookings.destroy');

        // Pembayaran Cicilan
        Route::post('/admin/booking/{id}/payment', [BookingPaymentController::class, 'store'])->name('booking.payment.store');
        Route::delete('/admin/transaction/{id}', [BookingPaymentController::class, 'destroy'])->name('booking.transaction.destroy');

        // Keuangan (Menu Kas)
        // Note: Route Print ditaruh di atas route {id} agar tidak bentrok
        Route::get('/finance/print', [FinanceController::class, 'print'])->name('finance.print');
        Route::get('/finance', [FinanceController::class, 'index'])->name('finance.index');
        Route::post('/finance', [FinanceController::class, 'store'])->name('finance.store');
        Route::delete('/finance/{id}', [FinanceController::class, 'destroy'])->name('finance.destroy');

        // Manajemen Anggota (Tambah/Hapus Personil)
        Route::resource('members', MemberController::class)->except(['create', 'edit', 'show']);
        Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar.index');
    });

    // ===================================================
    // 2. KHUSUS MEMBER / ANGGOTA (Hanya Lihat Jadwal)
    // ===================================================
    Route::middleware(['role:member'])->group(function () {
        Route::get('/member/dashboard', [MemberAreaController::class, 'index'])->name('member.dashboard');
    });

    // ===================================================
    // 3. UMUM (Bisa Admin & Member)
    // ===================================================
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';