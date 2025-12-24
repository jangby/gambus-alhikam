<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('site_settings', function (Blueprint $table) {
        $table->id();
        $table->string('whatsapp_number')->default('6281234567890');
        $table->string('instagram_link')->nullable();
        $table->string('facebook_link')->nullable();
        $table->text('address')->nullable(); // Alamat Studio/Sekre
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
