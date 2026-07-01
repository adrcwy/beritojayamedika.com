<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // TAMBAHKAN 3 KOLOM INI
            $table->string('link_tokopedia')->nullable()->after('image');
            $table->string('link_shopee')->nullable()->after('link_tokopedia');
            $table->string('link_tiktok')->nullable()->after('link_shopee');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // INI UNTUK 'ROLLBACK'
            $table->dropColumn(['link_tokopedia', 'link_shopee', 'link_tiktok']);
        });
    }
};