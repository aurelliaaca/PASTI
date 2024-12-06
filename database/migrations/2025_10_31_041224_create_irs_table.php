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
        Schema::create('irs', function (Blueprint $table) {
            $table->string('jadwalid');
            $table->string('nim', 14);
            $table->integer('smt');
            $table->boolean('status_verifikasi')->nullable();
            $table->timestamp('tanggal_disetujui')->nullable();

            // $table->foreign('jadwalid')->references('jadwalid')->on('jadwal_mata_kuliah')->ondelete('cascade');
            //ca ini aku comment dulu karena tipe data jadwalid kita beda
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('irs');
    }
};