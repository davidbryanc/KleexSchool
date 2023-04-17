<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([UserSeeder::class,]);
        $this->call(BookSeeder::class, false, ["path" => "database/data/1-book.csv", "model" => Book::class]);
        $this->call(SubjectSeeder::class, false, ["path" => "database/data/2-subject.csv", "model" => Subject::class]);
        $this->call(StudentSeeder::class, false, ["path" => "database/data/3-student.csv", "model" => Student::class]);
        $this->call(TeacherSeeder::class, false, ["path" => "database/data/4-teacher.csv", "model" => Teacher::class]);
    }
}
