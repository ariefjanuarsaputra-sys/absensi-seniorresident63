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
    Schema::create('presensis', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
        $table->foreignId('kegiatan_id')->constrained()->onDelete('cascade');
        $table->string('status_kehadiran'); // Hadir / Izin
        $table->string('bukti')->nullable();
        $table->string('status_verifikasi')->default('Menunggu Verifikasi'); // Menunggu Verifikasi / Disetujui / Ditolak
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presensis');
    }
};
