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
        Schema::create('detail_irs', function (Blueprint $table) {
            $table->integer('irsid');
            $table->integer('jadwalid')->index('jadwal_id');

            $table->primary(['irsid', 'jadwalid']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_irs');
    }
};
