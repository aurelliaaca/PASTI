<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlottingRuangTable extends Migration
{
    public function up()
    {
        Schema::create('plotting_ruang', function (Blueprint $table) {
            $table->id();
            $table->string('prodi_id');
            $table->foreignId('ruangan_id')->constrained('ruangan')->onDelete('cascade');
            $table->string('status')->default('Belum Disetujui');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('plotting_ruang');
    }
} 