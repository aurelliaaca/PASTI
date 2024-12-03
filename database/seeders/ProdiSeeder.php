<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $prodi = [
            [
                'kodeprodi' => 'A',
                'namaprodi' => 'Matematika',
            ],
            [
                'kodeprodi' => 'B',
                'namaprodi' => 'Biologi',
            ],
            [
                'kodeprodi' => 'C',
                'namaprodi' => 'Kimia',
            ],
            [
                'kodeprodi' => 'D',
                'namaprodi' => 'Fisika',
            ],
            [
                'kodeprodi' => 'E',
                'namaprodi' => 'Informatika',
            ],
            [
                'kodeprodi' => 'F',
                'namaprodi' => 'Statistika',
            ],
            [
                'kodeprodi' => 'G',
                'namaprodi' => 'Bioteknologi',
            ]
        ];
        DB::table('programstudi')->insert($prodi);
    }
}
