<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        // include("csv-reader.php");
        $user = [
            [
                'user_id' => '7',
                'name' => 'Daniel',
                'address' => Crypt::encryptString('Meherba Plaza 33'),
                'birth_date' => '1990-01-17',
                'phone_number' => Crypt::encryptString('082112345678'),
                'gender' => 'Male',
                'class' => null
            ],
            [
                'user_id' => '8',
                'name' => 'Erina',
                'address' => Crypt::encryptString('Jl. Margorejo Indah B/107'),
                'birth_date' => '1989-02-17',
                'phone_number' => Crypt::encryptString('082112345678'),
                'gender' => 'Female',
                'class' => null
            ],
            [
                'user_id' => '9',
                'name' => 'Fahmi',
                'address' => Crypt::encryptString('Jl. Jend. Gatot Subroto Kav.32-34'),
                'birth_date' => '1994-03-17',
                'phone_number' => Crypt::encryptString('082112345678'),
                'gender' => 'Male',
                'class' => '7'
            ],
            [
                'user_id' => '10',
                'name' => 'Adelia',
                'address' => Crypt::encryptString('Taman Permata Indah 32-A'),
                'birth_date' => '1992-04-17',
                'phone_number' => Crypt::encryptString('082112345678'),
                'gender' => 'Female',
                'class' => '8'
            ],
            [
                'user_id' => '11',
                'name' => 'Matthew',
                'address' => Crypt::encryptString('Jl. Kampus Selatan 169'),
                'birth_date' => '1993-07-17',
                'phone_number' => Crypt::encryptString('082112345678'),
                'gender' => 'Male',
                'class' => '9'
            ],
            
        ];
    
        foreach ($user as $value){
            Teacher::create($value);
        }
    }

    
}
