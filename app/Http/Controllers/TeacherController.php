<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Period;
use App\Models\Subject;
use App\Models\Student;
use Facade\Ignition\DumpRecorder\Dump;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {
        //auth utk ngambil user yg login saat ini
        //user-> relasi buat ngambil dr tabel user
        $user = auth()->user();

        //ambil subject dgn id 2
        //$subject = Subject::find(2);
        //ambil subject jgn variable pake where
        //$subject = Subject::where('name', 'Matematika')->get();

        $subject = Subject::all();

        $teacherClass = $user->teacher->class;
        $students = Student::where('class', $teacherClass)->get();

        //compact: utk passing variable dr backend/controller ke frontend/blade
        return view('inputnilai', compact('user', 'subject', 'students'));
    }

    public function inputNilai(Request $request)
    {
        $studentId = $request->get('studentId');
        var_dump($studentId);

        return response()->json(array(
        ), 200);
    }
}
