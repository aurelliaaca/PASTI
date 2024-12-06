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
        Schema::create('dosen', function (Blueprint $table) {
            $table->string('nama', 50);
            $table->string('nip', 18)->primary();
            $table->string('telp', 15);
            $table->string('email', 50);
            $table->string('alamat', 100);
            $table->string('kodeprodi', 1); //belum disambungin sama tabel prodi
            // $table->string('prodi', 50); //ini aku comment dulu ya karena mau pake kodeprodi


            $table->foreign('email')->references('email')->on('users')->ondelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dosen');
    }
};
