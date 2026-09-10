<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ptc_ad_rewards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ptc_ad_id')->constrained()->onDelete('cascade');
            $table->foreignId('currency_id')->constrained()->onDelete('cascade');
            $table->decimal('reward', 15, 8);           // reward per view dalam koin ini
            $table->decimal('budget', 15, 8);           // total budget dalam koin ini
            $table->decimal('spent', 15, 8)->default(0); // total terpakai dalam koin ini
            $table->timestamps();

            $table->unique(['ptc_ad_id', 'currency_id']); // satu ad, satu reward per coin
            $table->index('currency_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ptc_ad_rewards');
    }
};
