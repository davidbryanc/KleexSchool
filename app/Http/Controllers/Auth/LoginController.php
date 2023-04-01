<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        // $this->validate($request,[
            //     'username' => 'required',
            //     'password' => 'required',
            // ]);
            
            // if(Auth::attempt(['username' => $input['username'], 'password' => $input['password']])){
                //     return redirect()->route('home');
                // }else{
                    //     dd("gagal");
                    //     return redirect()->route('login')->with('error', 'NISN/NIPN dan Password salah');
                    // }
                    
        $message = array(
            'required.email'    =>  'This is required',
            'required.password' =>  'This is required',
        );
        $this->validate($request,[
            'username' =>  'required',
            'password'  =>  'required',
        ],$message);
    
        $username = $request->username;
        $pass = $request->password;
    
        if(Auth::attempt(['username' => $username, 'password' => $pass])){
            Session::flash('success','Welcome '.Auth::user()->username);
            return redirect()->route('home');
        }else{
            Session::flash('error','Sorry! Try Again. It seems your login credential is not correct.');
            return redirect()->back();
        }
    }

    // public function username()
    // {
    //     return 'username';
    // }

    // public function redirectTo()
    // {
    //     switch (Auth::user()->role){
    //         case 'Student':
    //             $this->redirectTo = '/home';
    //             return $this->redirectTo;
    //             break;
    //     }
    // }

    // protected function validateLogin(Request $request)
    // {
    //     $request->validate([
    //         $this->username() => 'required|string',
    //         'password' => 'required|string',
    //     ]);
    // }

}
