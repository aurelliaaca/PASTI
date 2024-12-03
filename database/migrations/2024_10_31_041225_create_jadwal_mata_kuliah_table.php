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
            $table->string('jadwalid', 20)->primary();
            $table->time('jam_mulai');
            $table->time('jam_selesai')->nullable();
            $table->string('ruangan', 5)->index('jadwal_ruangan');
            $table->string('kelas', 1);
            $table->string('hari', 6);
            $table->string('kodemk', 8)->index('jadwal_matkul');
            $table->integer('kuota');
            $table->string('koordinator')->index('jadwal_koordinator');
            $table->string('pengampu1')->index('jadwal_pengampu1');
            $table->string('pengampu2')->index('jadwal_pengampu2');

            $table->foreign('kodemk')->references('kode')->on('matakuliah')->ondelete('cascade');
            // $table->foreign('koordinator')->references('nama')->on('dosen')->ondelete('cascade');
            // $table->foreign('pengampu1')->references('nama')->on('dosen')->ondelete('cascade');
            // $table->foreign('pengampu2')->references('nama')->on('dosen')->ondelete('cascade');
            // $table->foreign('ruangan')->references('ruang')->on('ruangan')->ondelete('cascade');
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
