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
        Schema::create('ruangan', function (Blueprint $table) {
            $table->id();
            $table->string('namaprodi')->nullable();
            $table->string('gedung');
            $table->string('namaruang')->unique();
            $table->integer('kapasitas');
            $table->boolean('is_plotted')->default(false);
            $table->string('status')->default('belum disetujui');
            $table->string('created_at')->nullable();
            $table->timestamp('tanggal_disetujui')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ruangan', function (Blueprint $table) {
            $table->dropColumn('tanggal_disetujui');
            $table->dropColumn('namaprodi');
            $table->dropColumn('created_at');
        });
        Schema::dropIfExists('ruangan');
    }
};