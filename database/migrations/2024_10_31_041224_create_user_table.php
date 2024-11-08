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
        Schema::create('user', function (Blueprint $table) {
            $table->integer('userid', true);
            $table->string('password');
            $table->string('email', 50)->unique('email');
            $table->timestamp('email_verified_at')->nullable();
            $table->integer('role'); // 1 : mahasiswa, 2 : dosen, 3 : bagian akademik, 4 : dekan, 5 : kaprodi, 6 : dekan + dosen, 7 : kaprodi + dosen
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
