<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            UsersSeeder::class,
            DosenSeeder::class,
            MahasiswaSeeder::class,
            BagianAkademikSeeder::class,
            DekanSeeder::class,
            KetuaProdiSeeder::class,
            MatkulSeeder::class,
            JadwalIrsSeeder::class,
            RuanganSeeder::class,
            ProdiSeeder::class,
            JadwalSeeder::class,
            IrsSeeder::class
        ]);
    }
}