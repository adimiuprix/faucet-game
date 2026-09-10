<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ptc_ads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('url');
            $table->unsignedInteger('timer');               // detik yang harus ditonton
            $table->unsignedInteger('view_max')->default(0);    // maks total views semua coin
            $table->unsignedInteger('total_views')->default(0); // counter views selesai
            $table->enum('status', ['active', 'paused', 'pending', 'completed', 'rejected', 'archived'])->default('pending');
            $table->enum('ad_type', ['website', 'youtube'])->default('website');
            $table->timestamp('starts_at')->nullable();
            $table->timestamp('ends_at')->nullable();
            $table->timestamps();

            $table->index('status');
            $table->index('user_id');
            $table->index(['status', 'starts_at', 'ends_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ptc_ads');
    }
};
