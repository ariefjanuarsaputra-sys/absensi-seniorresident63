<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('perizinans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // TAMBAHKAN DUA KOLOM INI
            $table->foreignId('kegiatan_id')->nullable()->constrained('kegiatans')->onDelete('cascade');
            $table->string('bukti_lampiran')->nullable();
            
            $table->string('jenis_izin');
            $table->dateTime('tanggal_mulai');
            $table->dateTime('tanggal_selesai');
            $table->text('alasan');
            $table->string('status')->default('Menunggu');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('perizinans');
    }
};