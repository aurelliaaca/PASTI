<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $users = [
            [
                'username' => 'mahasiswa',
                'name' => 'ini akun mahasiswa',
                'email' => 'user@students.com',
                'level' => 'mahasiswa',
                'password' => bcrypt('123456'),
            ],

            [
                'username' => 'dosen',
                'name' => 'ini akun dosen',
                'email' => 'user@lecturer.com',
                'level' => 'dosen',
                'password' => bcrypt('123456'),
            ]
        ];
         
        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
