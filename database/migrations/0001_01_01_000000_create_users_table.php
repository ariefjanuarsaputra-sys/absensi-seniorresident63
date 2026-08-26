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
            $table->string('name');
            $table->string('email')->unique();
            $table->string('nim')->nullable();
            
            // Kolom lokasi & detail asrama
            $table->string('gedung')->nullable();
            $table->string('kamar')->nullable();
            $table->string('lorong')->nullable();
            
            // Kolom identitas & keanggotaan
            $table->string('angkatan')->nullable();
            $table->string('kontak')->nullable();
            $table->string('departemen')->nullable();
            $table->string('lini')->nullable();
            
            // Role & autentikasi
            $table->enum('role', ['admin', 'pj_gedung', 'anggota'])->default('anggota');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
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