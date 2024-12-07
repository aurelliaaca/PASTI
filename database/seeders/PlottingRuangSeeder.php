<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlottingRuangSeeder extends Seeder
{
    public function run()
    {
        DB::table('plotting_ruang')->insert([
            [
                'prodi_id' => 'E',
                'ruangan_id' => 1,
                'status' => 'belum disetujui',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'prodi_id' => 'E',
                'ruangan_id' => 2,
                'status' => 'belum disetujui',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
