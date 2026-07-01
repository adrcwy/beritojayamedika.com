<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('feedback_clients', function (Blueprint $table) {
            $table->id();
            $table->string('client_name');
            $table->string('client_position');
            $table->string('client_company');
            $table->string('client_photo')->nullable();
            $table->text('feedback');
            $table->integer('rating')->default(5); // 1-5 stars
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('feedback_clients');
    }
};