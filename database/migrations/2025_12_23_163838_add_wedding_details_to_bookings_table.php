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
    Schema::table('bookings', function (Blueprint $table) {
        // Data Mempelai Pria
        $table->string('groom_father')->nullable()->after('groom_name');
        $table->string('groom_mother')->nullable()->after('groom_father');
        
        // Data Mempelai Wanita
        $table->string('bride_father')->nullable()->after('bride_name');
        $table->string('bride_mother')->nullable()->after('bride_father');
    });
}

public function down(): void
{
    Schema::table('bookings', function (Blueprint $table) {
        $table->dropColumn(['groom_name', 'groom_father', 'groom_mother', 'bride_name', 'bride_father', 'bride_mother']);
    });
}
};
