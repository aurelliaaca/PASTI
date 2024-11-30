<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class RuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ruangan = [ //gedungnya diilangin
            [
                'ruang' => 'E101',
                // 'prodi'=> 'Informatika',
                'kapasitas' => '100'
            ],
            [
                'ruang' => 'E102',
                // 'prodi'=> 'Informatika',
                'kapasitas' => '50'
            ],
            [
                'ruang' => 'E103',
                // 'prodi'=> 'Informatika',
                'kapasitas' => '50'
            ],
            [
                'ruang' => 'A303',
                // 'prodi'=> 'Informatika',
                'kapasitas' => '50'
            ],
            [
                'ruang' => 'A302',
                // 'prodi'=> 'Informatika',
                'kapasitas' => '50'
            ],
            [
                'ruang' => 'K202',
                // 'prodi'=> 'Informatika',
                'kapasitas' => '50'
            ],
            [
                'ruang' => 'K201',
                // 'prodi'=> 'Informatika',
                'kapasitas' => '50'
            ]
        ];
        DB::table('ruangan')->insert($ruangan);
    }
}