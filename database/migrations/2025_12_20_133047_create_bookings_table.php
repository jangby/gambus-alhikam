<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('bookings', function (Blueprint $table) {
        $table->id();
        $table->string('booking_code')->unique(); // Kode Unik, misal: GMB-001
        
        // Data Pemesan
        $table->string('booker_name');
        $table->string('booker_phone'); // No WA
        
        // Data Acara
        $table->date('event_date');
        $table->time('event_time')->nullable(); // Jam mulai
        $table->string('event_theme')->nullable(); // Tema (untuk kostum)
        $table->text('location_gmaps')->nullable(); // Link Gmaps
        $table->text('venue_address')->nullable(); // Alamat teks lengkap
        
        // Data Pernikahan (Mempelai)
        $table->string('groom_name')->nullable(); // Pengantin Pria
        $table->string('bride_name')->nullable(); // Pengantin Wanita
        $table->string('groom_parents')->nullable(); // Ortu Pria
        $table->string('bride_parents')->nullable(); // Ortu Wanita
        
        // Status & Keuangan Booking
        // Pending=Baru masuk, Confirmed=Sudah DP, Completed=Selesai, Cancelled=Batal
        $table->enum('status', ['pending', 'confirmed', 'completed', 'cancelled'])->default('pending');
        $table->decimal('total_price', 12, 0)->default(0); // Harga Deal
        $table->text('notes')->nullable(); // Catatan tambahan
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
