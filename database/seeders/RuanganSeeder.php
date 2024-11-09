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
            ],
            [
                'ruang' => 'E102',
                'gedung'=> 'E',
                'fakultas'=> 'Fakultas Sains dan Matematika',
            ],
            [
                'ruang' => 'E103',
                'gedung'=> 'E',
                'fakultas'=> 'Fakultas Sains dan Matematika',
            ],
            [
                'ruang' => 'A303',
                'gedung'=> 'A',
                'fakultas'=> 'Fakultas Sains dan Matematika',
            ],
            [
                'ruang' => 'A302',
                'gedung'=> 'A',
                'fakultas'=> 'Fakultas Sains dan Matematika',
            ],
            [
                'ruang' => 'K202',
                'gedung'=> 'K',
                'fakultas'=> 'Fakultas Sains dan Matematika',
            ],
            [
                'ruang' => 'K201',
                'gedung'=> 'K',
                'fakultas'=> 'Fakultas Sains dan Matematika',
            ]
        ];
        DB::table('ruangan')->insert($ruangan);
    }
}
