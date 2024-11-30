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
        Schema::create('bagian_akademik', function (Blueprint $table) {
            $table->string('nama', 50);
            $table->string('nip', 18)->primary();
            $table->string('telp', 15);
            $table->string('email', 50)->unique('email');
            $table->string('alamat', 100);
            $table->string('prodi', 50);

            $table->foreign('email')->references('email')->on('user')->ondelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bagian_akademik');
    }
};
