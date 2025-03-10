<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Tester 1',
                'email' => 'test@example.com',
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'Tester 2',
                'email' => 'test2@example.com',
                'password' => bcrypt('password2'),
            ],
            [
                'name' => 'Tester 3',
                'email' => 'test3@example.com',
                'password' => bcrypt('password3'),
            ],
        ];

        foreach ($data as $value){
            User::create($value);
        }
    }
}
