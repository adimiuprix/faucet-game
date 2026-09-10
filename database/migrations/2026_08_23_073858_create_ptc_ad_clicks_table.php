<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ptc_ad_clicks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ptc_ad_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('currency_id')->constrained()->onDelete('cascade'); // coin halaman saat surf
            $table->decimal('reward', 15, 8);           // snapshot reward saat klik
            $table->enum('status', ['pending', 'completed', 'invalid'])->default('pending');
            $table->timestamp('clicked_at');
            $table->timestamp('completed_at')->nullable(); // null = belum selesai timer
            $table->timestamps();

            $table->index(['ptc_ad_id', 'user_id']);
            $table->index(['user_id', 'currency_id']);
            $table->index('status');
            $table->index('clicked_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ptc_ad_clicks');
    }
};
