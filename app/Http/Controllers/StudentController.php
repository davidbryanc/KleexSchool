<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Period;
use App\Models\Subject;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        $period_id = $user->student->grade()->get('period_id');
        $periods = Period::find($period_id);
        
        return view('liatnilai', compact('user', 'periods'));
    }
    
    public function showNilai(Request $request)
    {
        $user = auth()->user();
        $period_id = $request->period_id;
        
        $grades = $user->student->grade()->where('period_id', $period_id)->get();

        $subjects = Subject::all();
        return response()->json(array(
            'grades' => $grades,
            'subjects' => $subjects,
        ), 200);
    }
}
