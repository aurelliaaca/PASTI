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
        Schema::create('ketua_program_studi', function (Blueprint $table) {
            $table->string('prodi', 50);
            $table->string('nip', 18)->primary();

            $table->foreign('nip')->references('nip')->on('dosen')->ondelet('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ketua_program_studi');
    }
};
