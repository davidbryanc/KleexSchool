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
                'username' => '000001',
                'password' => bcrypt('123456'),
                'role' => "Student"
            ],
            [
                'username' => '000002',
                'password' => bcrypt('123456'),
                'role' => "Student"
            ],
            [
                'username' => '000003',
                'password' => bcrypt('123456'),
                'role' => "Student"
            ],
            [
                'username' => '100001',
                'password' => bcrypt('123456'),
                'role' => "Principal"
            ],
            [
                'username' => '100002',
                'password' => bcrypt('123456'),
                'role' => "Librarian"
            ],
            [
                'username' => '100003',
                'password' => bcrypt('123456'),
                'role' => "Teacher"
            ],
            [
                'username' => '100004',
                'password' => bcrypt('123456'),
                'role' => "Teacher"
            ],
            [
                'username' => '100005',
                'password' => bcrypt('123456'),
                'role' => "Teacher"
            ],
            
        ];

        foreach ($user as $value){
            User::create($value);
        }
    }
}
