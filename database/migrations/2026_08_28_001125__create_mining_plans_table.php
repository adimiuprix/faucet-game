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
        Schema::create('mining_plans', function (Blueprint $table) {
            $table->id();
            $table->string('plan_name')->nullable();
            $table->integer('cost')->comment('energy cost');
            $table->string('cost_unit')->nullable();
            $table->decimal('reward', 10, 8)->default(0);
            $table->foreignId('reward_currency_id')->constrained('currencies')->onDelete('cascade');
            $table->unsignedBigInteger('duration');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mining_plans');
    }
};
