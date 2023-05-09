<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;

class StudentSeeder extends Seeder
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
                'user_id' => '1',
                'name' => 'Bagas',
                'address' => Crypt::encryptString('Jl. Jaksa Agung Suprapto 104'),
                'birth_date' => '2003-01-17',
                'phone_number' => Crypt::encryptString('082112345678'),
                'gender' => 'Male',
                'class' => '7'
            ],
            [
                'user_id' => '2',
                'name' => 'Ruth',
                'address' => Crypt::encryptString('Jl. Letnan Ramli 31'),
                'birth_date' => '2002-02-17',
                'phone_number' => Crypt::encryptString('082112345678'),
                'gender' => 'Female',
                'class' => '8'
            ],
            [
                'user_id' => '3',
                'name' => 'Damar',
                'address' => Crypt::encryptString('Jl. Jend Sudirman Kav 10-11'),
                'birth_date' => '2001-03-10',
                'phone_number' => Crypt::encryptString('082112345678'),
                'gender' => 'Male',
                'class' => '9'
            ],
            [
                'user_id' => '4',
                'name' => 'David',
                'address' => Crypt::encryptString('Jl. Suryopranoto 2 '),
                'birth_date' => '2003-01-17',
                'phone_number' => Crypt::encryptString('082112345678'),
                'gender' => 'Male',
                'class' => '7'
            ],
            [
                'user_id' => '5',
                'name' => 'Nico',
                'address' => Crypt::encryptString('Jl. Bukit Gading Raya'),
                'birth_date' => '2003-03-05',
                'phone_number' => Crypt::encryptString('082112345678'),
                'gender' => 'Male',
                'class' => '8'
            ],
            [
                'user_id' => '6',
                'name' => 'Kenrick',
                'address' => Crypt::encryptString('Jl. RA Kartini 26'),
                'birth_date' => '2001-03-17',
                'phone_number' => Crypt::encryptString('082112345678'),
                'gender' => 'Male',
                'class' => '9'
            ],
            
        ];
    
        foreach ($user as $value){
            Student::create($value);
        }
    }
}
