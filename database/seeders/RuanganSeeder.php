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
        $ruangan = [
            [
                'ruang' => 'E101',
                'gedung'=> 'E',
                'fakultas'=> 'Fakultas Sains dan Matematika',
                'kapasitas' => '100'
            ],
            [
                'ruang' => 'E102',
                'gedung'=> 'E',
                'fakultas'=> 'Fakultas Sains dan Matematika',
                'kapasitas' => '50'
            ],
            [
                'ruang' => 'E103',
                'gedung'=> 'E',
                'fakultas'=> 'Fakultas Sains dan Matematika',
                'kapasitas' => '50'
            ],
            [
                'ruang' => 'A303',
                'gedung'=> 'A',
                'fakultas'=> 'Fakultas Sains dan Matematika',
                'kapasitas' => '50'
            ],
            [
                'ruang' => 'A302',
                'gedung'=> 'A',
                'fakultas'=> 'Fakultas Sains dan Matematika',
                'kapasitas' => '50'
            ],
            [
                'ruang' => 'K202',
                'gedung'=> 'K',
                'fakultas'=> 'Fakultas Sains dan Matematika',
                'kapasitas' => '50'
            ],
            [
                'ruang' => 'K201',
                'gedung'=> 'K',
                'fakultas'=> 'Fakultas Sains dan Matematika',
                'kapasitas' => '50'
            ]
        ];
        DB::table('ruangan')->insert($ruangan);
    }
}
