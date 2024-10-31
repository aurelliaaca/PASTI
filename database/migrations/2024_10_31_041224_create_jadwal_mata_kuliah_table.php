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
        Schema::create('jadwal_mata_kuliah', function (Blueprint $table) {
            $table->time('jam_mulai');
            $table->string('ruangan', 5)->index('jadwal_ruangan');
            $table->string('kelas', 1);
            $table->string('hari', 6);
            $table->string('kodemk', 8)->index('jadwal_matkul');
            $table->integer('jadwalid', true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_mata_kuliah');
    }
};
