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
        Schema::create('faucet_claims', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('currency_id')->constrained()->onDelete('cascade');
            $table->decimal('reward_amount', 20, 8);
            $table->integer('energy_used')->default(0);
            
            $table->enum('status', ['pending', 'completed', 'rejected'])->default('completed');
            
            $table->timestamps();
            
            // Indexes untuk performance
            $table->index(['user_id', 'currency_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faucet_claims');
    }
};
