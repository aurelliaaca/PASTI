<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalIrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal_irs', function (Blueprint $table) {
            $table->id(); // ini akan otomatis membuat kolom 'id' dengan auto-increment
            $table->string('keterangan');
            $table->date('jadwal_mulai');
            $table->date('jadwal_berakhir');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jadwal_irs');
    }
}
