<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $user = auth() -> user();

        if($user->role == 'Student'){
            $profile = Student::where('user_id', $user->id)->first();
        }else{
            $profile = Teacher::where('user_id', $user->id)->first();
        }

        return view('dashboard', compact('user', 'profile'));
    }
}
