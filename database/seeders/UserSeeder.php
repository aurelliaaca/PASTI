<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'userid' => '1',
                'password' => 'dhela123',
                'email' => 'dhela@students.com',
                'role' => '1'
            ],
            [
                'userid' => '2',
                'password' => 'tera123',
                'email' => 'tera@students.com',
                'role' => '1'
            ],
            [
                'userid' => '3',
                'password' => 'aurel123',
                'email' => 'aurel@students.com',
                'role' => '1'
            ],
            [
                'userid' => '4',
                'password' => 'nabila123',
                'email' => 'nabila@students.com',
                'role' => '1'
            ],
            [
                'userid' => '5',
                'password' => 'kamaruddin123',
                'email' => 'kamaruddin@dosen.com',
                'role' => '7' // nyoba
            ],
            [
                'userid' => '6',
                'password' => 'azizah123',
                'email' => 'azizah@students.com',
                'role' => '2'
            ]
        ];

        foreach ($users as $user) {
            $user['password'] = Hash::make($user['password']);
            User::create($user);
        }
    }
}