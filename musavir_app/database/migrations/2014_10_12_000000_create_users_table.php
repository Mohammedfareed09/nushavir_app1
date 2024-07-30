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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('phone')->unique();
            $table->string('tc')->unique();
            $table->string('email')->nullable()->unique();
            $table->text('password');
            $table->string('token');
            $table->string('avatar_path')->nullable();
            $table->timestamps();
            $table->string('verification_code')->nullable();
            $table->dateTime('code_expiry')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
