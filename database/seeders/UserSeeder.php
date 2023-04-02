<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'username' => '160421101',
                'password' => bcrypt('123456'),
                'role' => "Student"
            ],
            [
                'username' => '111111',
                'password' => bcrypt('123456'),
                'role' => "Principal"
            ],
            [
                'username' => '222222',
                'password' => bcrypt('123456'),
                'role' => "Teacher"
            ],
            [
                'username' => '333333',
                'password' => bcrypt('123456'),
                'role' => "Librarian"
            ],
        ];

        foreach ($user as $value){
            User::create($value);
        }
    }
}
