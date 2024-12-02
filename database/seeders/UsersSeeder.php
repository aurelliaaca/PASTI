<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'dhela',
                'password' => 'dhela123',
                'email' => 'dhela@students.com',
                'role' => '2'
            ],
            [
                'name' => 'arya',
                'password' => 'arya123',
                'email' => 'arya@students.com',
                'role' => '6'
            ],
            [
                'name' => 'dekan',
                'password' => 'dekan123',
                'email' => 'dekan@students.com',
                'role' => '4'
            ]
            // [
            //     'password' => 'tera123',
            //     'email' => 'tera@students.com',
            //     'role' => '1'
            // ],
            // [
            //     'password' => 'farid123',
            //     'email' => 'farid@students.com',
            //     'role' => '1'
            // ],
            // [
            //     'password' => 'qaynan123',
            //     'email' => 'qaynan@students.com',
            //     'role' => '1'
            // ],
            // [
            //     'password' => 'dzu123',
            //     'email' => 'dzu@students.com',
            //     'role' => '1'
            // ],
            // [
            //     'password' => 'aurel123',
            //     'email' => 'aurel@students.com',
            //     'role' => '1'
            // ],
            // [
            //     'password' => 'nabila123',
            //     'email' => 'nabila@students.com',
            //     'role' => '1'
            // ],
            // [
            //     'password' => 'kamaruddin123',
            //     'email' => 'kamaruddin@dosen.com',
            //     'role' => '7' 
            // ],
            // [
            //     'password' => 'dinal123',
            //     'email' => 'dinal@bak.com',
            //     'role' => '3'
            // ],
            // [
            //     'password' => 'priyo123',
            //     'email' => 'priyo@dosen.com',
            //     'role' => '2'
            // ],
            // [
            //     'password' => 'niken123',
            //     'email' => 'niken@dosen.com',
            //     'role' => '6'
            // ],
            // [
            //     'password' => 'azizah123',
            //     'email' => 'azizah@dosen.com',
            //     'role' => '2'
            // ],
            // [
            //     'password' => 'dio123',
            //     'email' => 'dio@dosen.com',
            //     'role' => '2'
            // ],
            // [
            //     'password' => 'anita123',
            //     'email' => 'anita@dosen.com',
            //     'role' => '2'
            // ],
            // [
            //     'password' => 'sri123',
            //     'email' => 'sri@dosen.com',
            //     'role' => '2'
            // ],
            // [
            //     'password' => 'lestari123',
            //     'email' => 'lestari@dosen.com',
            //     'role' => '2'
            // ],
            // [
            //     'password' => 'rahma123',
            //     'email' => 'rahma@dosen.com',
            //     'role' => '2'
            // ],
            // [
            //     'password' => 'indah123',
            //     'email' => 'indah@dosen.com',
            //     'role' => '2'
            // ],
            // [
            //     'password' => 'ahmad123',
            //     'email' => 'ahmad@dosen.com',
            //     'role' => '2'
            // ]
        ];

        foreach ($users as $user) {
            $user['password'] = Hash::make($user['password']);
            User::create($user);
        }
    }
}