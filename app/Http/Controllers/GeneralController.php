<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public function index(){
        $user = auth() -> user();

        return view('profile', compact('user'));
    }
}
