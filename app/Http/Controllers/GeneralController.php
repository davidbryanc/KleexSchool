<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        $user = auth() -> user();

        if($user->role == 'Student'){
            $profile = Student::where('user_id', $user->id)->first();
        }else{
            $profile = Teacher::where('user_id', $user->id)->first();
        }

        return view('dashboard', compact('user', 'profile'));
    }
}
