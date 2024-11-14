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
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->string('nama', 50);
            $table->string('nim', 14)->primary();
            $table->integer('smt');
            $table->string('telp', 15);
            $table->string('email', 50)->unique('email');
            $table->string('alamat', 100);
            $table->string('prodi', 50); //baru
            $table->string('dosenwali', 18)->index('nip_doswal');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa');
    }
};
