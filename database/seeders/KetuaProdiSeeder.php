<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KetuaProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kaprodi = [
            [
                'nip' => '197505152005012001',
                'prodi' => 'Informatika'
            ]
        ];
        DB::table('ketua_program_studi')->insert($kaprodi);
    }
}
