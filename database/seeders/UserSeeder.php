<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
                'password' => Hash::make("dhawiohawodhaoh"),
                'role' => "Student"
            ],
            [
                'username' => '000002',
                'password' => Hash::make("dhawiohawodhaoh"),
                'role' => "Student"
            ],
            [
                'username' => '000003',
                'password' => Hash::make("dhawiohawodhaoh"),
                'role' => "Student"
            ],
            [
                'username' => '000004',
                'password' => Hash::make("dhawiohawodhaoh"),
                'role' => "Student"
            ],
            [
                'username' => '000005',
                'password' => Hash::make("dhawiohawodhaoh"),
                'role' => "Student"
            ],
            [
                'username' => '000006',
                'password' => Hash::make("dhawiohawodhaoh"),
                'role' => "Student"
            ],
            [
                'username' => '100001',
                'password' => Hash::make("dhawiohawodhaoh"),
                'role' => "Principal"
            ],
            [
                'username' => '100002',
                'password' => Hash::make("dhawiohawodhaoh"),
                'role' => "Librarian"
            ],
            [
                'username' => '100003',
                'password' => Hash::make("dhawiohawodhaoh"),
                'role' => "Teacher"
            ],
            [
                'username' => '100004',
                'password' => Hash::make("dhawiohawodhaoh"),
                'role' => "Teacher"
            ],
            [
                'username' => '100005',
                'password' => Hash::make("dhawiohawodhaoh"),
                'role' => "Teacher"
            ],
            
        ];

        foreach ($user as $value){
            User::create($value);
        }
    }
}
