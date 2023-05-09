<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Period;
use App\Models\Subject;
use App\Models\Student;
use Facade\Ignition\DumpRecorder\Dump;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $students = Student::where('class', $teacherClass)->get('id');

        $period_id = $students[0]->grade()->get('period_id');
        $periods = Period::find($period_id);

        //compact: utk passing variable dr backend/controller ke frontend/blade
        return view('inputnilai', compact('user', 'subject', 'students', 'periods'));
    }

    public function inputNilai(Request $request)
    {
        $studentId = $request->get('studentId');
        $periodId = $request->get('periodId');
        $subjectId = $request->get('subjectId');
        $nts = $request->get('nts');
        $nas = $request->get('nas');

        foreach($studentId as $key=>$value){
            $na = $nts[$key]*0.4 + $nas[$key]*0.6;
            
            if($na >= 81) $nisbi = 'A';
            else if($na >= 73 ) $nisbi = 'AB';
            else if($na >= 66 ) $nisbi = 'B';
            else if($na >= 60 ) $nisbi = 'BC';
            else if($na >= 55 ) $nisbi = 'C';
            else if($na >= 40 ) $nisbi = 'D';
            else $nisbi = 'E';

            DB::table('grades')->where(['student_id' => $value, 'subject_id' => $subjectId, 'period_id' => $periodId])->update([
                'mid_score' => $nts[$key],
                'end_score' => $nas[$key],
                'final_score' => $na,
                'nisbi' => $nisbi,
            ]);

            //failed hehe :D kalo ada id sebagai key, baru bisa pake ini
            // $grade = Grade::where('student_id', $value)->where('subject_id', $subjectId)->where('period_id', $periodId)->first();
            // $grade->mid_score   = $nts[$key];
            // $grade->end_score = $nas[$key];
            // $grade->final_score = $nts[$key]*0.4 + $nas[$key]*0.6;
            // $grade->save();
        }

        return response()->json(array(
            'message' => "success",
        ), 200);
    }

    public function detailNilai(Request $request)
    {
        $periodId = $request->get('periodId');
        $subjectId = $request->get('subjectId');

        $user = auth()->user();
        $teacherClass = $user->teacher->class;
        $studentId = Student::where('class', $teacherClass)->get('id');
        $grades = Grade::whereIn('student_id', $studentId)->
                            where('subject_id', $subjectId)->
                            where('period_id', $periodId)->get();
        $students = Student::where('class', $teacherClass)->get();
        return response()->json(array(
            'grades' => $grades,
            'students' => $students,
        ), 200);
    }
}
