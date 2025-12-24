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
use App\Http\Controllers\Admin\SiteContentController;

// --- HALAMAN PUBLIK (Tanpa Login) ---
Route::get('/', [FrontController::class, 'index'])->name('home');
Route::post('/booking', [FrontController::class, 'storeBooking'])->name('booking.store');
// Halaman Form Booking (Tampilan)
Route::get('/booking-now', [FrontController::class, 'createBooking'])->name('booking.create');
Route::get('/check-availability', [FrontController::class, 'checkAvailability'])->name('api.check_availability');

// --- HALAMAN YANG BUTUH LOGIN ---
Route::middleware(['auth', 'verified'])->group(function () {

    // ===================================================
    // 1. KHUSUS ADMIN (Jadwal, Keuangan, Edit, Hapus)
    // ===================================================
    Route::middleware(['role:admin'])->group(function () {
        
        // Dashboard Utama Admin (Menggunakan AdminBookingController sesuai kode lama Anda)
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/admin/bookings', [AdminBookingController::class, 'index'])->name('admin.bookings.index');
        Route::post('/admin/bookings', [AdminBookingController::class, 'store'])->name('admin.bookings.store');
        
        // Detail Booking (Yang ada maps dan data mempelai lengkap)
        Route::get('/dashboard/booking/{id}', [DashboardController::class, 'show'])->name('dashboard.show');

        // CRUD Booking (Edit, Update, Delete)
        Route::get('/admin/booking/{id}/edit', [AdminBookingController::class, 'edit'])->name('admin.bookings.edit');
        // --- ROUTE UPDATE BOOKING (YANG HILANG TADI) ---
Route::put('/admin/bookings/{id}', [AdminBookingController::class, 'update'])->name('bookings.update');
Route::delete('/admin/bookings/{id}', [AdminBookingController::class, 'destroy'])->name('bookings.destroy');

// --- ROUTE KHUSUS PEMBAYARAN DI HALAMAN EDIT ---
Route::post('/admin/bookings/{id}/payment', [FinanceController::class, 'storeBookingPayment'])->name('bookings.payment.store');
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

        // Route Pengaturan Konten
    Route::get('/admin/site-content', [SiteContentController::class, 'index'])->name('admin.site.index');
    Route::put('/admin/site-settings', [SiteContentController::class, 'updateSettings'])->name('admin.site.update');
    Route::post('/admin/gallery', [SiteContentController::class, 'storeGallery'])->name('admin.gallery.store');
    Route::delete('/admin/gallery/{id}', [SiteContentController::class, 'destroyGallery'])->name('admin.gallery.destroy');
    });

    // ===================================================
// 2. KHUSUS MEMBER / ANGGOTA
// ===================================================
Route::middleware(['role:member'])->group(function () {
    // Beranda (Home)
    Route::get('/member/dashboard', [MemberAreaController::class, 'index'])->name('member.dashboard');
    
    // Menu Jadwal Lengkap
    Route::get('/member/schedule', [MemberAreaController::class, 'schedule'])->name('member.schedule');
    
    // Menu Keuangan (Transparansi)
    Route::get('/member/finance', [MemberAreaController::class, 'finance'])->name('member.finance');
});

    // ===================================================
    // 3. UMUM (Bisa Admin & Member)
    // ===================================================
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';