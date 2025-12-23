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
    Schema::create('transactions', function (Blueprint $table) {
        $table->id();
        // Relasi ke booking (Nullable, karena pengeluaran beli bensin tidak ada hubungannya dengan booking tertentu)
        $table->foreignId('booking_id')->nullable()->constrained()->onDelete('cascade');
        
        $table->enum('type', ['income', 'expense']); // Pemasukan atau Pengeluaran
        $table->decimal('amount', 12, 0); // Nominal uang
        $table->string('description'); // Keterangan (misal: Pelunasan Job A, atau Beli Senar)
        $table->date('date');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
