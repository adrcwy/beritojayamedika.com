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
        // 1. Tambah kolom category_id
        $table->foreignId('category_id')
              ->nullable()
              ->after('id') // Posisikan setelah 'id'
              ->constrained('categories') // Buat foreign key ke tabel 'categories'
              ->onDelete('set null'); // Jika kategori dihapus, set produk ke NULL
    });
    }

    /**
     * Reverse the migrations.
     */
public function down(): void
{
    Schema::table('products', function (Blueprint $table) {
        $table->dropForeign(['category_id']);
        $table->dropColumn('category_id');
    });
    }
};
