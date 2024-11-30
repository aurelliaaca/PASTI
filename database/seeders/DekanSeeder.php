<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DekanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dekan = [
            [
                'nip' => '197405161234567808',
                'fakultas' => 'Fakultas Sains dan Matematika'
            ]
        ];
        DB::table('dekan')->insert($dekan);
    }
}
