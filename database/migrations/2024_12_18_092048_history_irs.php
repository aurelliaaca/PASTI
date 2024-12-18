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
        Schema::create('histori_irs', function (Blueprint $table) {
            $table->unsignedBigInteger('jadwalid');
            $table->string('nim', 14);
            $table->integer('smt');
            $table->enum('status_verifikasi',['Belum disetujui', 'Diproses', 'Sudah disetujui', 'Mengajukan perubahan'])->default('Sudah disetujui');
            $table->timestamp('tanggal_disetujui')->nullable();

            $table->foreign('jadwalid')->references('jadwalid')->on('jadwal_mata_kuliah')->ondelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('histori_irs');
    }
};