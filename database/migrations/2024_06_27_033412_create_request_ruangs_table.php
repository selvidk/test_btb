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
        Schema::create('request_ruang', function (Blueprint $table) {
            $table->id();
            $table->integer('id_divisi');
            $table->integer('id_ruang');
            $table->string('deskripsi_rapat');
            $table->date('tanggal_rapat');
            $table->time('waktu_mulai');
            $table->time('waktu_selesai');
            $table->date('tanggal_request');
            $table->integer('status_verifikasi')->nullable();
            $table->string('keterangan_verifikasi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_ruang');
    }
};
