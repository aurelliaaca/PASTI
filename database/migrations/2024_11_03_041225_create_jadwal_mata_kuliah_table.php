<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwal_mata_kuliah', function (Blueprint $table) {
            $table->bigIncrements('jadwalid');
            $table->string('kodeprodi', 1);
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->integer('ruang_id');
            $table->string('kelas', 1);
            $table->string('hari', 6);
            $table->string('kodemk', 8);
            $table->integer('kuota');
            $table->string('koordinator_nip');
            $table->string('pengampu1_nip')->nullable();
            $table->string('pengampu2_nip')->nullable();
            $table->enum('status', ['belum disetujui', 'diproses', 'sudah disetujui'])->default('belum disetujui');
            
            // Foreign keys
            $table->foreign('kodemk')->references('kode')->on('matakuliah');
            $table->foreign('koordinator_nip')->references('nip')->on('dosen');
            $table->foreign('pengampu1_nip')->references('nip')->on('dosen');
            $table->foreign('pengampu2_nip')->references('nip')->on('dosen');
            $table->foreign('ruang_id')->references('id')->on('plotting_ruang');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_mata_kuliah');
    }
};

