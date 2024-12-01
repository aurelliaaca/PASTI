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
            $table->integer('irsid', true);
            $table->string('nim', 14)->index('irs_nim');
            $table->string('smt', 2);
            $table->boolean('status_verifikasi')->nullable();
            $table->timestamp('tanggal_disetujui')->nullable();

            $table->foreign('nim')->references('nim')->on('mahasiswa')->ondelete('cascade');
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