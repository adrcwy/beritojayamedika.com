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
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['price', 'link_tokopedia', 'link_shopee', 'link_tiktok']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('price')->nullable(); // Harga (string agar fleksibel, misal "Call for Price")
            $table->string('link_tokopedia')->nullable();
            $table->string('link_shopee')->nullable();
            $table->string('link_tiktok')->nullable();
        });
    }
};