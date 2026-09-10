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
        Schema::create('captchas', function (Blueprint $table) {
            $table->id();
            $table->enum('provider', ['hcaptcha', 'recaptcha', 'cloudflare'])->default('hcaptcha')->nullable();
            $table->string('site_key')->nullable();
            $table->string('secret_key')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('captchas');
    }
};
